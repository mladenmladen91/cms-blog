 <?php 
     if(isset($_GET['user_id'])){
        $get_user_id = $_GET['user_id']; 
     }
     $query = "select * from users where user_id = $get_user_id";
                                     $select = mysqli_query($connection, $query);
                    
                                     while($row = mysqli_fetch_assoc($select)){
                                       $username = $row['username'];
                                       $user_firstname = $row['user_firstname'];
                                       $user_lastname = $row['user_lastname'];
                                       $user_password = $row['user_password'];
                                       $user_role = $row['user_role'];
                                       $user_image_name = $row['user_image'];
                                       $user_email = $row['user_email'];     
                                       
                                     }

   if(isset($_POST['edit_user'])){
      
       $username = $_POST['username'];
       $user_firstname = $_POST['user_firstname'];
       $user_lastname = $_POST['user_lastname'];
       $user_password = $_POST['user_password'];
       
       $user_image = $_FILES['user_image']['name'];
       $user_image_temp = $_FILES['user_image']['tmp_name'];
       
       $user_role = $_POST['user_role'];
       $user_email = $_POST['user_email'];
       
       move_uploaded_file($user_image_temp, "../images/$user_image");
       
       if(empty($user_image)){
             $query= "select * from users where user_id=$get_user_id";
           $select = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select)){
           $user_image = $row['user_image'];
       }
       }
       
       $query= "select * from users where user_id=$get_user_id";
       $result = mysqli_query($connection, $query);
       $row = mysqli_fetch_array($result);
        $db_password = $row['user_password'];
       
       if($user_password !== $db_password){
           $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>12));
       }else{
           $user_password = $db_password;
       }
       
       
       
       $query = "UPDATE users SET username='$username', user_password='$user_password', user_firstname='$user_firstname', user_lastname= '$user_lastname', user_role='$user_role', user_email='$user_email',user_image='$user_image' WHERE user_id = $get_user_id";
       
       
       $select = mysqli_query($connection, $query);
       
       confirm($select);
       
       header('location: users.php');
      
   }

 ?>
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
             <?php        
                 if($user_role == 'admin'){
                     echo "<option value='subscriber'>Subscriber</option>";
                 }else{
                     echo "<option value='admin'>Admin</option>";
                 }
             ?>
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
        <img src="../images/<?php echo $user_image_name; ?>" width="100" height="100">
        <input type="file" name="user_image">
    </div>
    <div class="form-group">
        <label for="user_email">E-mail</label>
        <input value="<?php echo $user_email; ?>" type="text" name="user_email" class="form-control">
    </div>
    
    <div class="form-group">
        <input type="submit"  name="edit_user" value="Edit User" class="btn btn-primary">
    </div>
    
</form>