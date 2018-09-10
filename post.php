<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

<?php 
   if(isset($_POST['liked'])){
       // select post
       $post_id = $_POST['post_id'];
       $user_id = $_POST['user_id'];
       $search = "SELECT * FROM posts WHERE post_id= $post_id";
       $result = mysqli_query($connection, $search);
       $row = mysqli_fetch_array($result);
       $likes = $row['likes'];
       
     //update post table with likes
       mysqli_query($connection, "UPDATE posts SET likes= $likes+1 WHERE post_id= $post_id");
       
    //creating first post
      mysqli_query($connection,"INSERT INTO likes(user_id, post_id) VALUES ($user_id, $post_id)"); 
      exit();
       
   }


 if(isset($_POST['unliked'])){
       // select post
       $post_id = $_POST['post_id'];
       $user_id = $_POST['user_id'];
       $search = "SELECT * FROM posts WHERE post_id= $post_id";
       $result = mysqli_query($connection, $search);
       $row = mysqli_fetch_array($result);
       $likes = $row['likes'];
       
     //deleting likes
      mysqli_query($connection,"DELETE FROM likes WHERE user_id =$user_id AND post_id = $post_id"); 
      
     
     //update post table with likes
       mysqli_query($connection, "UPDATE posts SET likes= $likes-1 WHERE post_id= $post_id");
       exit();
    
       
   }

?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <?php  if(isset($_GET['p_id'])){
                      $the_post_id = $_GET['p_id'];          
                       
                   $query2 = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $the_post_id";
                   $views = mysqli_query($connection, $query2);
     
                   if(!$views){
                       die(mysqli_error($connection));
                   }
    
                  if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                     $query = "SELECT * FROM posts WHERE post_id= $the_post_id";  
                  }else{
                     $query = "SELECT * FROM posts WHERE post_id= $the_post_id AND post_status='published'"; 
                  }
                
                  
                  $result = mysqli_query($connection, $query);
                  while($row = mysqli_fetch_assoc($result)){
                        $title = $row['post_title'];
                        $author = $row['post_author'];
                        $post_image = $row['post_image'];
                        $date = $row['post_date'];
                        $post_content = $row['post_content'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_views = $row['post_views'];
                        $likes = $row['likes'];
                ?>
                <!-- Title -->
                <h1><?php echo $title ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $author; ?>"><?php echo $author ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date ?></p>
                <p><span><a href="#comment_area">Comments: <?php echo $post_comment_count; ?></a></span></p>
                <p class="lead">Number of views: <?php echo $post_views; ?></p>
                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="/cms-project/images/<?php echo imagePlaceholder($post_image); ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content ?></p>
                
            <?php if(isLoggedIn()):  ?>
                <div class="row">
                   <p class="pull-right"><a class="<?php echo userLiked($the_post_id)? 'unlike': 'like'; ?>" href=""><span class="glyphicon <?php echo userLiked($the_post_id)? 'glyphicon-thumbs-down': 'glyphicon-thumbs-up'?>"></span><?php echo userLiked($the_post_id)? 'unlike': 'like'; ?></a></p>
                </div>
            <?php endif;  ?>    
                <div class="row">
                    <p class="pull-right">Likes : <?php echo $likes; ?></p>
                </div>
                <div class="clearfix"></div>
                 
                 <?php 
                  
                  }
                 }else{
                      
                      header('location: index.php');
                  }
               ?>
                 
                <hr>

                <!-- Blog Comments -->
                <?php 
                  if(isset($_POST['add_comment'])){
                       $post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        $author_image = $_SESSION['image'];
                       
                        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date, author_image) VALUES ($post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved' , now(), '$author_image')";
                      if(empty($comment_content)){
                          echo "<script>alert('You must write something')</script>";
                      }else{
                      
                      $insert_comment = mysqli_query($connection, $query);
                       
                          if(!$insert_comment){
                              die("error ".mysqli_error($connection));
                          }
                      
                       $query2 = "UPDATE posts SET post_comment_count = post_comment_count +1 WHERE post_id =$post_id";
                      $update_count = mysqli_query($connection, $query2);
                      if(!$update_count){
                          die("error ".mysqli_error($connection));
                      }       
                          
                      }
                  
                  }
                
                ?>

                <!-- Comments Form -->
                <div id="comment_area" class="well">
                   <?php    
                        if(isset($_SESSION['role'])) { 
                   ?>
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                           <div class="form-group">
                          <!--  <label for="comment_author">Author</label>
                             <input type="text" placeholder="author" name="comment_author" class="form-control">
                           </div>  -->
                            <input type="hidden" placeholder="author" value="<?php echo $_SESSION['firstname']; ?>" name="comment_author" class="form-control">
                            <input type="hidden" placeholder="author" value="<?php echo $_SESSION['email']; ?>" name="comment_email" class="form-control">
                         <!--  <div class="form-group">
                            <label for="comment_email">E-mail</label>
                             <input type="text" placeholder="email" name="comment_email" class="form-control">
                           </div>  -->
                           <div class="form-group">
                            <img style="border-radius:50%;margin: 10px;" height="30"; width="30" src="/cms-project/images/<?php echo $_SESSION['image']; ?>" alt=""><textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="add_comment" class="btn btn-primary">Submit</button>
                    </form>
                <?php
                        }else{
                            echo "<h4>You have to login to leave comment</h4>"; 
                            echo "<p><a href='/cms-project/registration.php'>Register</a> or <a href='/cms-project/index.php'>Sign up</a> </p>"; 
                        }  
                ?>
                           
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                 <?php
                                      $get_post_id = $_GET['p_id'];
                                     $query = "select * from comments where comment_post_id = $get_post_id and comment_status = 'approved' ";
                                     $select = mysqli_query($connection, $query);
                    
                                     while($row = mysqli_fetch_assoc($select)){
                                       
                                       $comment_email = $row['comment_email'];
                                       
                                       $comment_author = $row['comment_author'];
                                       $comment_post_id = $row['comment_post_id'];
                                       $comment_status = $row['comment_status'];
                                       $comment_content = $row['comment_content'];
                                       $comment_date = $row['comment_date'];
                                       $author_image = $row['author_image'];     
                    ?>
                <div class="media">
                                       
                    <a class="pull-left" href="#">
                        <img class="media-object" height="64" width="64" alt="image" src="/cms-project/images/<?php echo $author_image; ?>" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                    
                </div>
                  <?php }
                    
                    ?>
                

            </div>


        <hr>

        

    </div>
    
    <!-- footer including -->
       <?php include "includes/footer.php" ?>
    

    <!-- jQuery -->
    <script src="/cms-project/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<script>
 $(document).ready(function(){
      
      var post_id = <?php echo $the_post_id; ?>;
      var user_id = <?php echo userId(); ?>;
     
      $(".like").click(function(){
             
             $.ajax({
                 url: "/cms-project/post.php?p_id=<?php echo $the_post_id; ?>",
                 type: 'post',
                 data:{
                     'liked': 1,
                     'post_id': post_id,
                     'user_id': user_id,
                     
                 }
             });
       });
     
     $(".unlike").click(function(){
             
             $.ajax({
                 url: "/cms-project/post.php?p_id=<?php echo $the_post_id; ?>",
                 type: 'post',
                 data:{
                     'unliked': 1,
                     'post_id': post_id,
                     'user_id': user_id,
                     
                 }
             });
       });
})
</script>

