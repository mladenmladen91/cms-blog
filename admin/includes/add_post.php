<?php 
   if(isset($_POST['add_post'])){
       $post_title = $_POST['post_title'];
       $post_author = $_SESSION['username'];
       $post_category_id = $_POST['post_category_id'];
       $post_status = $_POST['post_status'];
       
       $post_image = $_FILES['post_image']['name'];
       $post_image_temp = $_FILES['post_image']['tmp_name'];
       
       $post_tags = $_POST['post_tags'];
       $post_content = $_POST['post_content'];
       $post_date = date('d-m-y');
     //  $post_comment_count = 4;
       
       
       
       
       move_uploaded_file($post_image_temp, "../images/$post_image");
       
       $query= "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags,  post_status) VALUES($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags',  '$post_status')";
       
       $insert_post = mysqli_query($connection, $query);
       
       confirm($insert_post);
       
       echo "<p>Post successfully created</p>";
       echo "<p><a href='posts.php'>View all posts</a></p>";
                                      
   }

?>
   

   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="post_category_id">Category id</label>
        <select name="post_category_id" id="">
            <?php 
               $query = "SELECT * FROM categories";
               $result = mysqli_query($connection, $query);
               while($row = mysqli_fetch_assoc($result)){
                   $cat_id = $row['cat_id'];
                   $cat_title = $row['cat_title'];
                   echo "<option value='$cat_id'>$cat_title</option>";
               }
            
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Status</label>
        <select name="post_status" >
           <option value="published">Publish</option>
           <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post content</label>
        <textarea name="post_content" id="editor" class="form-control"></textarea>
         <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    </div>
    <div class="form-group">
        <input type="submit"  name="add_post" value="Add" class="btn btn-primary">
    </div>
    
</form>