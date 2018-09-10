<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>
    
<?php 

require 'vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->load();

$pusher = new Pusher\Pusher(getenv('APP_KEY'),getenv('APP_SECRET'), getenv('APP_ID'),array('cluster' => 'eu', 'useTLS' => true));



  if(isset($_POST['submit'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      
      if(!empty($username) && !empty($email) && !empty($password) && !empty($firstname) && !empty($lastname)){
             // checking if there is another username
             $query3 = "SELECT * FROM users WHERE username = '$username'";
             $select = mysqli_query($connection, $query3);
             $count = mysqli_num_rows($select);
          
            if($count > 0){
                 $message = "USERNAME already taken";
            }else{
             $username = mysqli_real_escape_string($connection, $username);
             $password = mysqli_real_escape_string($connection, $password);
             $email = mysqli_real_escape_string($connection, $email);
             $firstname = mysqli_real_escape_string($connection, $firstname);
             $lastname = mysqli_real_escape_string($connection, $lastname);
             
           $image = $_FILES['image']['name'];
           $image_tmp = $_FILES['image']['tmp_name'];        
    
          $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=> 12));      
       
          $query2 = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_role, user_email, user_image) ";
          $query2 .="VALUES('$username','$password','$firstname', '$lastname', 'subscriber', '$email', '$image')";
          
          move_uploaded_file($image_tmp, "images/$image");
          $insert = mysqli_query($connection, $query2);
          
          if(!$insert){
          die(mysqli_error($connection));
      }
          
          $message = "Form successfully filled";
             }
                 
      }else{
          $message = "You must fill all fields";
      }
     $data['message'] = $username; 
     $pusher->trigger('notifications','new_user',$data);
  }else{
      $message = "";
  }     

?>
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off" enctype="multipart/form-data">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="image" class="sr-only">Image</label>
                            <input type="file" name="image" id="image">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
