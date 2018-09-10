<form action="" method="post">
                            <div class="form-group">
                            <label for="cat_title">Edit category</label>  
                               <?php
                                
                                  if(isset($_GET['update'])){
                                      $update = $_GET['update'];
                                      $query = "SELECT * FROM categories WHERE cat_id = $update";
                                   $select = mysqli_query($connection, $query);
                    
                                    while($row = mysqli_fetch_assoc($select)){
                                       $title = $row['cat_title'];
                                   ?>
                                     <input type="text" class="form-control" value="<?php if(isset($_GET['update'])){ echo $title; } ?>" name="cat_title">  
                                   <?php } } ?>
                                   
                                   <?php 
                                       if(isset($_POST['update_cat'])){
                                           $cat_title = $_POST['cat_title'];
                                           $query = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $update ";
                                           $update_query = mysqli_query($connection, $query);
                                           if(!$update_query){
                                               die("error ".mysqli_error($connection));
                                           }
                                       }
                                   ?>
                               
                                
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_cat" value="Edit">
                            </div>  
                       </form>