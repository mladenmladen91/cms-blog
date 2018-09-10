   <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms-project/index">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                      
                     $query = "select * from categories";
                     $select = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select)){
                        $title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        
                        $category_class = '';
                        $registration_class = '';
                        $contact_class = '';
                        
                        $page_name = basename($_SERVER['PHP_SELF']);
                        $registration = 'registration.php';
                        $contact = 'contact.php';
                        
                        if(isset($_GET['cat_id']) && $_GET['cat_id']== $cat_id){
                            $category_class = 'active';
                        }else if($page_name == $contact){
                            $contact_class = 'active';
                        }
                        
                        echo "<li class='$category_class'><a href='/cms-project/category/$cat_id'>$title</a></li>";
                    }
                    
                    ?>
                    
                    
                    <li class="<?php echo $contact_class; ?>"><a href="/cms-project/contact">Contact</a></li>
                    <?php if(isLoggedIn()): ?>
                      <li><a href="/cms-project/includes/logout.php">Logout</a></li>
                    <?php else: ?>
                      <li class="<?php echo $registration_class; ?>"><a href="/cms-project/registration">Registration</a></li>
                    <?php endif; ?>
                    
                    <?php 
                       if(isset($_SESSION['role'])){
                           if(isset($_GET['p_id']) && $_SESSION['role'] == 'admin'){
                               $the_user_id = $_GET['p_id'];
                              echo "<li><a href='/cms-project/admin/posts.php?source=edit_post&post_id=$the_user_id'>Edit Post</a></li>"; 
                               
                           }
                       }
                    
                        if(isset($_SESSION['role'])){
                           if($_SESSION['role'] == 'admin'){
                               echo "<li><a href='/cms-project/admin/posts.php'>View Posts</a></li>";
                               echo '<li><a href="/cms-project/admin">Admin</a></li>';
                            }
                       }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>