    
    <?php include "includes/header.php"; ?>
    <?php 
       if(isset($_SESSION['username'])){
           $username = $_SESSION['username'];
           
           $query = "SELECT * FROM users WHERE username = '$username'";
           
           $select_user = mysqli_query($connection, $query);
           
           while($row = mysqli_fetch_array($select_user)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_role = $row['user_role'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
           }
           
           
       
       }

       if(isset($_POST['update_profile'])){
      
       $user_name = $_POST['username'];
       $user_firstname = $_POST['user_firstname'];
       $user_lastname = $_POST['user_lastname'];
       $user_password = $_POST['user_password'];
       
       $user_image = $_FILES['user_image']['name'];
       $user_image_temp = $_FILES['user_image']['tmp_name'];
       
       $user_role = $_POST['user_role'];
       $user_email = $_POST['user_email'];
       
       move_uploaded_file($user_image_temp, "../images/$user_image");
       
       if(empty($user_image)){
             $query= "select * from users where user_id=$user_id";
             $select = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select)){
             $user_image = $row['user_image'];
           }
       }
       
       $query = "UPDATE users SET username='$user_name', user_password='$user_password', user_firstname='$user_firstname', user_lastname= '$user_lastname', user_role='$user_role', user_email='$user_email',user_image='$user_image' WHERE user_id = $user_id";
       
       
       $select = mysqli_query($connection, $query);
       
       confirm($select);
       
       header('location: users.php');
      
   }
    ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin page
                            <small>Profile</small>
                        </h1>
                           <form action="" method="post" enctype="multipart/form-data">
   <h1 class="text-center">EDIT USER</h1>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input value="<?php echo $user_firstname; ?>" type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input value="<?php echo $user_lastname; ?>" type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role">
            <option value='<?php echo $user_role; ?>'>Select role:</option>
            <option value='admin'>Admin</option>
            <option value='subscriber'>Subscriber</option>  
        </select>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username; ?>" type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="username">Password</label>
        <input value="<?php echo $user_password; ?>" type="password" name="user_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_image">Image</label>
        <img src="../images/<?php echo $user_image; ?>" width="100" height="100">
        <input type="file" name="user_image">
    </div>
    <div class="form-group">
        <label for="user_email">E-mail</label>
        <input value="<?php echo $user_email; ?>" type="text" name="user_email" class="form-control">
    </div>
    
    <div class="form-group">
        <input type="submit"  name="update_profile" value="Update Profile" class="btn btn-primary">
    </div>
    
</form>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
 <?php include "includes/footer.php"; ?>