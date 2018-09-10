
<!-- header -->
<?php include "includes/header.php"; ?>

<!--    navigation  -------->
<?php include "includes/navigation.php"; ?>
 

    <!-- Page Content -->
    <div class="container">

        <div class="row">
              <h1 class="page-header">
                    Main page
                    <small>blog example</small>
             </h1>
            
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
            <?php
                
                  $per_page = 5;  
                
                if(isset($_GET['page'])){
                    
                    $page_number = $_GET['page'];
                }else{
                    $page_number= "";
                }
                
                
                if($page_number == "" || $page_number == 1){
                    $page_1 = 0;
                }else{
                    $page_1 = ($page_number * $per_page) - $per_page;
                }
                
                
                
                $count_posts = "SELECT * FROM posts where post_status = 'published'";
                $select_count = mysqli_query($connection, $count_posts);
                
                $count = mysqli_num_rows($select_count);
                
                if($count < 1){
                    echo "<h1 class='text-center'>NO POSTS</h1>";
                }else{
                
                $count = ceil($count / $per_page) ;
                
                if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                     $query = "select * from posts LIMIT $page_1, $per_page";  
                  }else{
                     $query = "select * from posts WHERE post_status='published' LIMIT $page_1, $per_page";
                 }    
                
                // $query = "select * from posts LIMIT $page_1, $per_page";
                $select = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select)){
                        $post_id = $row['post_id'];
                        $title = $row['post_title'];
                        $author = $row['post_author'];
                        $image = $row['post_image'];
                        $content = $row['post_content'];
                        $date = $row['post_date'];
                        $post_status = $row['post_status'];
                        $post_comment_count = $row['post_comment_count'];
                        
                       
                       
            ?> 
            
                   

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $author; ?>"><?php echo $author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $date; ?></p>
                <p><span>Comments: <?php echo $post_comment_count; ?></span></p>
                <hr> 
                <img class="img-responsive" width="400" height="400" src="images/<?php echo $image; ?>" alt="">
                <hr>
                <p><?php echo $content; ?>.</p>
                <a class="btn btn-primary" href="post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <hr>         
                          
            <?php            
                        } }
                
                ?>

           </div>

            <!-- sidebar -->
            <?php include "includes/blogsidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <ul class="pager">
            <?php 
               for($i = 1; $i <= $count; $i++){
                   
                   if($i == $page_number){
                      echo "<li><a class='active_page' href='/cms-project/index.php?page=$i'>$i</a></li>";
                   }else{
                      echo "<li ><a  href='/cms-project/index.php?page=$i'>$i</a></li>";   
                   }
               }
            
            ?>
            
            
        </ul>
       <!-- footer including -->
       <?php include "includes/footer.php" ?>
