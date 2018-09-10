<?php  include "includes/header.php"; ?>
<?php  include "includes/navigation.php"; ?>

<?php 
    if(!isset($_GET['email']) || !isset($_GET['token'])){
        redirect('index');
    }    
$token = $_GET['token'];
if($stmt = mysqli_prepare($connection, "SELECT username, user_email, token FROM users WHERE token=?")){
     mysqli_stmt_bind_param($stmt,'s',$token);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_bind_result($stmt,$username,$user_email,$token);
     mysqli_stmt_fetch($stmt);
    
    if(mysqli_stmt_affected_rows($stmt) == 0){
        redirect('index');
    }
     mysqli_stmt_close($stmt);
      
     if($_GET['email'] !== $user_email){
         redirect('index');
     }
    
    if(isset($_POST['recover-submit'])){
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        
        if($password !== $confirmPassword){
            echo "You have to type the same password";
        }else{
            $hash_password = password_hash($password, PASSWORD_BCRYPT, array('cost'=> 12));
            $stmt = mysqli_prepare($connection, "UPDATE users SET token='', user_password='$hash_password' WHERE user_email=?");
            mysqli_stmt_bind_param($stmt,'s', $user_email);
            mysqli_stmt_execute($stmt);
            
            echo $hash_password;
            
            if(mysqli_stmt_affected_rows($stmt) >= 1){
               login($username, $password);
               
            }else{
                echo "Password not recovered";
            }
        }
    }
}

?>


<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">Password</span>
                                                <input name="password" placeholder="password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">Confirm Password</span>
                                                <input  name="confirmPassword" placeholder="confirm password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>
                                        

                                     <!--   <input type="hidden" class="hide" name="token" id="token">  -->
                                    </form>

                                </div><!-- Body-->

                                <h2>Please check your email</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

