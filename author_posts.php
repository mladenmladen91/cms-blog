<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <?php  if(isset($_GET['author'])){
                      $post_author = $_GET['author'];          
                
                
                  $query = "SELECT * FROM posts WHERE post_author= '$post_author' ";
                  $result = mysqli_query($connection, $query);
                  while($row = mysqli_fetch_assoc($result)){
                        $post_id = $row['post_id'];
                        $title = $row['post_title'];
                        $author = $row['post_author'];
                        $post_image = $row['post_image'];
                        $date = $row['post_date'];
                        $post_content = $row['post_content'];
                        $post_comment_count = $row['post_comment_count'];
                ?>
                <!-- Title -->
                <h1><?php echo $title ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <?php echo $author ?>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date ?></p>
                <p><span>Comments: <?php echo $post_comment_count; ?></span></p>
                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="/cms-project/post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                 <?php  }  } ?>
                 
                <hr>

                <hr>
           


        </div>
        <!-- /.row -->

        <hr>

    </div>
    <!-- footer including -->
    <?php include "includes/footer.php" ?>

</body>

</html>
