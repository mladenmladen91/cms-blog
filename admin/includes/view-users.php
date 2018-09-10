<table class="table table-bordered table-hover">
                            <thead>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Change role</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                    
                                
                            </thead>
                            <tbody>
                              <?php
                                     $query = "select * from users";
                                     $select = mysqli_query($connection, $query);
                    
                                     while($row = mysqli_fetch_assoc($select)){
                                       $user_id = $row['user_id'];
                                       $username = $row['username'];
                                       $user_password = $row['user_password'];
                                       $user_firstname = $row['user_firstname'];
                                       $user_lastname = $row['user_lastname'];
                                       $user_role = $row['user_role'];
                                       $user_email = $row['user_email'];
                                       $user_image = $row['user_image'];
                                    
                                    echo "<tr>";
                                        echo "<td>$user_id</td>";
                                       echo "<td>$username</td>";
                                       echo "<td>$user_firstname</td>";     
                                       echo "<td>$user_lastname</td>";
                                       echo "<td>$user_email</td>";     
                                       echo "<td>$user_role</td>";
                                        echo "<td><img src='/cms-project/images/$user_image' height = '45' width= '45'></td>";
                                         if($user_role != 'subscriber'){
                                             echo "<td><a href='/cms-project/admin/users.php?role=subscriber&u_id=$user_id'>SUBSC</a></td>"; 
                                         }else{
                                             echo "<td><a href='/cms-project/admin/users.php?role=admin&u_id=$user_id'>ADMIN</a></td>";
                                         }
                                         
                                         echo "<td><a href='/cms-project/admin/users.php?delete=$user_id'>Delete</a></td>"; 
                                         echo "<td><a href='/cms-project/admin/users.php?source=edit_user&user_id=$user_id'>Edit</a></td>"; 
                                         
                                    echo "</tr>";
                                     }
                                ?> 
                            </tbody>
                        </table>
                                <?php
                             if(isset($_GET['delete'])){
                                 
                                 if(isset($_SESSION['role'])){
                                    if($_SESSION['role'] == 'admin'){ 
                                     $delete = $_GET['delete'];
                                     $query = "DELETE FROM users where user_id = $delete";
                                     $delete_post = mysqli_query($connection, $query);
                                     if(!$delete_post){
                                       die("error ".mysqli_error($connection));
                                      }
                                      header('location: /cms-project/admin/users.php');
                                    }else{
                                      header('location: /cms-project/index.php');  
                                    }
                                    
                                 }else{
                                    header('location: /cms-project/index.php'); 
                                 }
                                 
                             }
                           
                            if(isset($_GET['role'])){
                                 $role = $_GET['role'];
                                 $user_id = $_GET['u_id'];
                                 $query = "UPDATE users SET user_role = '$role' WHERE user_id=$user_id";
                                 $unapprove_post = mysqli_query($connection, $query);
                                 if(!$unapprove_post){
                                     die("error ".mysqli_error($connection));
                                 }
                                 header('location: /cms-project/admin/users.php');
                                 
                             }
              
                            

                        ?> 