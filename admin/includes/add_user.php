<?php 
   if(isset($_POST['add_user'])){
       $user_firstname = $_POST['firstname'];
       $user_lastname = $_POST['lastname'];
       $username = $_POST['username'];
       $user_password = $_POST['password'];
       
       $user_image = $_FILES['image']['name'];
       $user_image_temp = $_FILES['image']['tmp_name'];
       
       $user_email = $_POST['email'];
       $user_role = $_POST['role'];
       
       
       $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=> 12));
       
       
       move_uploaded_file($user_image_temp, "../images/$user_image");
       
       $query= "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_role, user_email, user_image) VALUES('$username', '$user_password','$user_firstname', '$user_lastname','$user_role', '$user_email', '$user_image')";
       
       $insert_user = mysqli_query($connection, $query);
       
       confirm($insert_user);
       
       
                                      
   }

?>
   

   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">First Name</label>
        <input type="text" name="firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_author">Last Name</label>
        <input type="text" name="lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category_id">Username</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category_id">Role</label>
        <select name="role">
            <option value='admin'>ADMIN</option>
            <option value='subscriber'>SUBSCRIBER</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" name="image" >
    </div>
    <div class="form-group">
        <input type="submit"  name="add_user" value="Add User" class="btn btn-primary">
    </div>
    
</form>