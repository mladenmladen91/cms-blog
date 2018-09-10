 <?php 
     if(isset($_GET['post_id'])){
        $get_post_id = $_GET['post_id']; 
     }
     $query = "select * from posts where post_id = $get_post_id";
                                     $select = mysqli_query($connection, $query);
                    
                                     while($row = mysqli_fetch_assoc($select)){
                                       $post_title = $row['post_title'];
                                       $post_author = $row['post_author'];
                                       $cat_id = $row['post_category_id'];
                                       $post_status = $row['post_status'];
                                       $post_img = $row['post_image'];
                                       $post_tags = $row['post_tags'];
                                       $post_content = $row['post_content'];     
                                       $post_comment_count = $row['post_comment_count'];
                                       $post_date = $row['post_date'];
                                     }

   if(isset($_POST['update_post'])){
      
       $post_title = $_POST['post_title'];
       $post_author = $_POST['post_author'];
       $post_category_id = $_POST['post_category_id'];
       $post_status = $_POST['post_status'];
       
       $post_image = $_FILES['post_image']['name'];
       $post_image_temp = $_FILES['post_image']['tmp_name'];
       
       $post_tags = $_POST['post_tags'];
       $post_content = $_POST['post_content'];
       
       move_uploaded_file($post_image_temp, "../images/$post_image");
       
       if(empty($post_image)){
             $query= "select * from posts where post_id=$get_post_id";
           $select = mysqli_query($connection, $query);
           while($row = mysqli_fetch_assoc($select)){
           $post_image = $row['post_image'];
       }
       }
       
       
       
       $query = "UPDATE posts SET post_title='$post_title', post_category_id=$post_category_id, post_date= now(), post_author='$post_author', post_status='$post_status',post_tags='$post_tags',post_content='$post_content',post_image='$post_image' WHERE post_id = $get_post_id";
       
       
       $select = mysqli_query($connection, $query);
       
       confirm($select);
       
       echo "<p style='color:red;'>POST UPDATED</p><br>";
       echo "<a href='posts.php'>View all posts</a><br>";
       echo "<a href='../post.php?p_id=$get_post_id'>View post</a>";
       
       
      
   }

 ?>
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Title</label>
        <input value="<?php echo $post_title; ?>" type="text" name="post_title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_author">Author</label>
        <input value="<?php echo $post_author; ?>" type="text" name="post_author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category_id">Category id</label>
        <select name="post_category_id" id="">
            <option value="<?php echo $cat_id; ?>">Select category</option>
            <?php
                         $query = "SELECT * FROM categories";
                         $select = mysqli_query($connection, $query);
                    
                         while($row = mysqli_fetch_assoc($select)){
                                $id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                             echo "<option value=$id>$cat_title</option>";
                         }
             ?>
            
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Status</label>
        <select name="post_status" id="">
            <option value="<?php echo $post_status; ?>">Status</option>
            <?php
            if($post_status == 'published'){
               echo "<option value='draft'>Draft</option>"; 
            }else{
               echo "<option value='published'>Publish</option>"; 
            }
            ?>    
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Image</label>
        <img src="../images/<?php echo $post_img ?>" width="100" height="100">
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post content</label>
        <textarea id="editor2"  name="post_content" class="form-control"><?php echo str_replace("\  r\n","</br>",$post_content); ?></textarea>
         <script>
        ClassicEditor
            .create( document.querySelector( '#editor2' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    </div>
    <div class="form-group">
        <input type="submit"  name="update_post" value="Update" class="btn btn-primary">
    </div>
    
</form>