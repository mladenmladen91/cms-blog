<?php 
   if(isset($_POST['checkBoxArray'])){
       foreach($_POST['checkBoxArray'] as $checkBoxValue){
           $bulk_options = $_POST['bulk_options'];
            switch($bulk_options){
                case 'published':
                 $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id= $checkBoxValue";
                 $update_publish = mysqli_query($connection, $query); 
                 confirm($update_publish);    
                break;
                    
                case 'draft':
                 $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id= $checkBoxValue";
                 $update_draft = mysqli_query($connection, $query);  
                 confirm($update_draft);    
                break;
                    
                case 'delete':
                 $query = "DELETE FROM posts WHERE post_id = $checkBoxValue";
                 $delete_post = mysqli_query($connection, $query);
                 confirm($delete_post);    
                 header('location: posts.php');    
                break;  
                    
                case 'clone':
                $query = "select * from posts where post_id = $checkBoxValue";
                    $select1 = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select1)){
                        $post_title = $row['post_title'];
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $cat_id = $row['post_category_id'];
                        $post_status = $row['post_status'];
                        $post_img = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        
                    }
                    
                    $query= "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags,  post_status) VALUES($cat_id, '$post_title', '$post_author', now(), '$post_img', '$post_content', '$post_tags',  '$post_status')";
       
                     $insert_post = mysqli_query($connection, $query);
       
                     confirm($insert_post);
                    header('location: posts.php');
                            
                break;    
            }
          }
               
       } 
   


?>
<form action="" method="post">                           

<table class="table table-bordered table-hover">
                        
                        <div id="bulkOptionsContainer" class="col-xs-4">
                            <select name="bulk_options" id="">
                                <option value="">Select Options</option>
                                <option value="published">Publish</option>
                                <option value="draft">Draft</option>
                                <option value="delete">Delete</option>
                                <option value="clone">Clone</option>    
                            </select>
                        </div>     
                          <div class="col-xs-4">
                              <input type="submit" name="submit" class="btn btn-success" value="Apply">
                              <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
                          </div>    
                            
                                     
                                   
                        <thead>     
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>View Posts</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    
                                
                            </thead>
                            <tbody>
                              <?php
                                   //  $query = "select * from posts ORDER BY post_id DESC";
                                $query = "SELECT posts.post_id, posts.post_title, posts.post_author, posts.post_category_id, posts.post_status, posts.post_image, posts.post_tags, posts.post_date, posts.post_content, posts.post_comment_count, posts.post_views, categories.cat_id, categories.cat_title FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id  ORDER BY post_id DESC";
                                     
                                     $selecto = mysqli_query($connection, $query);
                    
                                     while($row = mysqli_fetch_assoc($selecto)){
                                       $post_title = $row['post_title'];
                                       $post_id = $row['post_id'];
                                       $post_author = $row['post_author'];
                                       $cat_id = $row['post_category_id'];
                                       $post_status = $row['post_status'];
                                       $post_img = $row['post_image'];
                                       $post_tags = $row['post_tags'];
                                       $post_date = $row['post_date'];
                                       $post_comment_count = $row['post_comment_count'];
                                            
                                    echo "<tr>";
                                ?>
                                     <td><input class="checkBoxes" value="<?php echo $post_id; ?>" name="checkBoxArray[]" type="checkbox"></td>
                                      
                                <?php                        
                                       echo "<td>$post_id</td>";
                                       echo "<td>$post_author</td>";
                                       echo "<td>$post_title</td>";   
                                           
                    
                                           
                                           $title = $row['cat_title'];
                                           
                                              echo "<td>$title</td>";
                                           
                                         
                                         
                                       echo "<td>$post_status</td>";
                                       echo "<td><img width='50' height='50' src='../images/$post_img'</td>";
                                       echo "<td>$post_tags</td>";
                                       echo "<td><a href='../post.php?p_id=$post_id'>View post</a></td>";  
                                       // improving comments
                                        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id"; 
                                         $query_result = mysqli_query($connection, $query);
                                         $row = mysqli_fetch_array($query_result);
                                         $count = mysqli_num_rows($query_result);
                                         
                                       echo "<td>$count</td>";
                                       echo "<td>$post_date</td>";
                                        echo "<td><a href='posts.php?source=edit_post&post_id=$post_id'>EDIT</a></td>"; 
                                         
                                    ?>
                                    
                                    <form  method="post" action="">
                                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                        <td><input type="submit" class='btn btn-primary' value="delete" name="delete"></td>
                                    </form>
                                    
                                    <?php              
                                    echo "</tr>";
                                     }
                                ?> 
                            </tbody>
                        </table>
</form>                        
                        
                        <?php
                             if(isset($_POST['delete'])){
                                 $post_id = $_POST['post_id'];
                                 $query = "DELETE FROM posts where post_id = $post_id";
                                 $delete_post = mysqli_query($connection, $query);
                                 confirm($delete_post);
                                 header('location: posts.php');
                                 
                             }
                        ?> 