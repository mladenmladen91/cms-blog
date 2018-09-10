<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <?php  if(isset($_GET['cat_id'])){
                  $cat_id = $_GET['cat_id'];          
                
                     $query = "SELECT * FROM posts WHERE post_category_id=$cat_id AND post_status='published'";
                  
                    $result = mysqli_query($connection, $query);
                     
                  $count = mysqli_num_rows($result);
    
    
                  if($count == 0){
                      echo "<h1 class='text-center'>NO POSTS</h1>";
                  }else{
    
                    while($row = mysqli_fetch_assoc($result)):
                       
                      $title = $row['post_title'];
                      $post_author = $row['post_author'];
                      $post_date = $row['post_date'];
                      $post_comment_count = $row['post_comment_count'];
                      $post_id = $row['post_id'];
                      $post_content = $row['post_content'];
                      $post_image = $row['post_image'];
                      $post_views = $row['post_views'];
                ?>
                <!-- Title -->
                <h1><?php echo $title ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="/cms-project/author_posts.php?author=<?php echo $post_author; ?>"><?php echo $post_author ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <p><span>Comments: <?php echo $post_comment_count; ?></span></p>
                <p class="lead">Number of views: <?php echo $post_views; ?></p>
                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="/cms-project/images/<?php echo $post_image ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="/cms-project/post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                 
                 <?php  
                   endwhile; }
                 }else{
                      
                      header('location: /cms-project/index.php');
                  }
                
                
                ?>
                 
                <hr>
         </div>

        <!-- sidebar -->
            <?php include "includes/blogsidebar.php" ?>
        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
