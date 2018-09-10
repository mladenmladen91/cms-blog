<table class="table table-bordered table-hover">
                            <thead>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In response to</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                    <th>Date</th>
                                
                            </thead>
                            <tbody>
                              <?php
                                     $query = "select * from comments";
                                     $select = mysqli_query($connection, $query);
                    
                                     while($row = mysqli_fetch_assoc($select)){
                                       $comment_email = $row['comment_email'];
                                       $comment_id = $row['comment_id'];
                                       $comment_author = $row['comment_author'];
                                       $comment_post_id = $row['comment_post_id'];
                                       $comment_status = $row['comment_status'];
                                       $comment_content = $row['comment_content'];
                                       $comment_date = $row['comment_date'];
                                    
                                    echo "<tr>";
                                       echo "<td>$comment_id</td>";
                                       echo "<td>$comment_author</td>";
                                       echo "<td>$comment_content</td>";     
                                       echo "<td>$comment_email</td>";
                                       echo "<td>$comment_status</td>";     
                                          
                                           $query2 = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                          $select2 = mysqli_query($connection, $query2);
                    
                                           while($row = mysqli_fetch_assoc($select2)){
                                           $title = $row['post_title'];
                                           $id = $row['post_id'];       
                                           
                                        echo "<td><a href='../post.php?p_id=$id'>$title</a></td>";
                                           }
                                        echo "<td><a href='comments.php?approve=$comment_id'>APPROVE</a></td>";
                                        echo "<td><a href='comments.php?unapprove=$comment_id'>UNAPPROVE</a></td>"; 
                                        echo "<td><a href='comments.php?remove=$comment_id'>Delete</a></td>"; 
                                        echo "<td>$comment_date</td>"; 
                                    echo "</tr>";
                                     }
                                ?> 
                            </tbody>
                        </table>
                                <?php
                             if(isset($_GET['remove'])){
                                 $delete = $_GET['remove'];
                                 $query = "DELETE FROM comments where comment_id = $delete";
                                 $delete_post = mysqli_query($connection, $query);
                                 if(!$delete_post){
                                     die("error ".mysqli_error($connection));
                                 }
                                 header('location: comments.php');
                                 
                             }
                           
                            if(isset($_GET['unapprove'])){
                                 $unapprove = $_GET['unapprove'];
                                 $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id=$unapprove";
                                 $unapprove_post = mysqli_query($connection, $query);
                                 if(!$unapprove_post){
                                     die("error ".mysqli_error($connection));
                                 }
                                 header('location: comments.php');
                                 
                             }
              
                             if(isset($_GET['approve'])){
                                 $approve = $_GET['approve'];
                                 $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id=$approve";
                                 $approve_post = mysqli_query($connection, $query);
                                 if(!$approve_post){
                                     die("error ".mysqli_error($connection));
                                 }
                                 header('location: comments.php');
                                 
                             }

                        ?> 