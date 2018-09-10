<!-- header -->
<?php include "includes/header.php"; ?>

<!--    navigation  -------->
<?php include "includes/navigation.php"; ?>
 

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
            <?php
                 
                if(isset($_POST['submit'])){  
                   $search = $_POST['search'];
                   $query = "select * from posts where post_tags like '%$search%'";
                   $result = mysqli_query($connection, $query);
                    
                    if(!$result){
                        die("query failed ".mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($result);
                    if($count == 0){
                        echo "<h1>NO RESULTS FOUND</h1>";
                    }else{
                         
                    
                    while($row = mysqli_fetch_assoc($result)){
                        $title = $row['post_title'];
                        $author = $row['post_author'];
                        $image = $row['post_image'];
                        $content = $row['post_content'];
                        $date = $row['post_date'];
                        $id = $row['post_id'];
                        
                       
            ?> 
            
                     <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                <hr>
                <p><?php echo $content ?>.</p>
                <a class="btn btn-primary" href="/cms-project/post.php?p_id=<?php echo $id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                          
            <?php            
                    }
                
                
                    }
                }
            ?>  
                
              

               

               

            </div>

            <!-- sidebar -->
            <?php include "includes/blogsidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

       <?php include "includes/footer.php" ?>
