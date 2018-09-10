<?php
function confirm($result){
    global $connection;
    if(!$result){
        die('error '.mysqli_error($connection));
    }
}

function insert_categories(){
     global $connection;
     
      if(isset($_POST['submit'])){
                               $cat_title = $_POST['cat_title'];
                              if($cat_title == '' || empty($cat_title)){
                                   echo "Thise fiels shouldn't be empty";
                              }else{
                                  $stmt = mysqli_prepare($connection,"insert into categories(cat_title) values (?)");
                                  mysqli_stmt_bind_param($stmt,"s",$cat_title);
                                  mysqli_stmt_execute($stmt);
                                 
                                  if(!$stmt){
                                      die("wrong query ".mysqli_error($connection));
                                  }
                              }
                               
                           }
}



function showCat(){
                 global $connection;
                 $query = "select * from categories";
                 $select = mysqli_query($connection, $query);
                    
                 while($row = mysqli_fetch_assoc($select)){
                                       $title = $row['cat_title'];
                                        $id = $row['cat_id'];
                                        echo "<tr>";
                                       echo "<td>$id</td>";
                                       echo "<td>$title</td>";
                                        echo "<td><a href='categories.php?delete=$id'>&times;</a></td>";
                                        echo "<td><a href='categories.php?update=$id'>UPDATE</a></td>";
                                        echo "</tr>";
                                     }
}


function deleteCat(){
    global $connection;
    if(isset($_GET['delete'])){
                                    $cat_id = $_GET['delete'];
                                    
                                    $query = "delete from categories where cat_id = $cat_id";
                                    $delete = mysqli_query($connection, $query);
                                     header('location: categories.php');
                                    
                                }
}


function user_online(){
    
    if(isset($_GET['onlineusers'])){
     global $connection;
        if(!$connection){
            session_start();
            include("../includes/db.php");
            
            $session = session_id();
     $time = time();
     $time_out_sec = 60;
     $time_out = $time - $time_out_sec;
        
     $query = "SELECT * FROM users_online WHERE session = '$session'";
     $send_query = mysqli_query($connection, $query);  
     $count = mysqli_num_rows($send_query);
        
        if($count == null){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
        }else{
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }
        
        $user_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_users = mysqli_num_rows($user_online);
        }
     
     
}

}

user_online();

function recordCount($table){
    global $connection;
    $query = "SELECT * from ".$table;
    $select = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select);
    confirm($result);
    return $result;
}


function isAdmin($username= ""){
    global $connection;
    $query = "SELECT user_role FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $query);
    confirm($result);
    
    $row = mysqli_fetch_array($result);
    
    if($row['user_role']== 'admin'){
        return true;
    }else{
        return false;
    }
}

function redirect($location){
    header('location:'.$location);
    exit;
}

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    
    return false;
}


function isLoggedIn(){
    if(isset($_SESSION['role'])){
        return true;
    }
    
    return false;
}


function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
     if(isLoggedIn()){
         redirect($redirectLocation);
     }
}

function login($username, $password){
      global $connection;
    
      $username = mysqli_real_escape_string($connection, $username);
      $password = mysqli_real_escape_string($connection, $password);
      
     
      
      $query = "SELECT * FROM users WHERE username='$username'";
      
      $result = mysqli_query($connection, $query);
      if(!$result){
          die('error '.mysqli_error($connection));
      }
      while($row = mysqli_fetch_array($result)){
          $db_user_id = $row['user_id'];
          $db_username = $row['username'];
          $db_user_password = $row['user_password'];
          $db_user_firstname = $row['user_firstname'];
          $db_user_lastname = $row['user_lastname'];
          $db_user_role = $row['user_role'];
          $db_user_email = $row['user_email'];
          $db_user_image = $row['user_image'];
          
      }
       
      if(password_verify($password, $db_user_password) && $username===$db_username){
          $_SESSION['id'] = $db_user_id;
          $_SESSION['username'] = $db_username; 
          $_SESSION['firstname'] = $db_user_firstname; 
          $_SESSION['lastname'] = $db_user_lastname; 
          $_SESSION['role'] = $db_user_role; 
          $_SESSION['image'] = $db_user_image;
          $_SESSION['email'] = $db_user_email;
          
          header('location: /cms-project/admin/');
      }else{
          header('location: /cms-project/index.php');
      }
}

function mail_exists($email){
    global $connection;
    $query = "SELECT * FROM users WHERE user_email='$email'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    if($count > 0){
        return true;
    }
      return false;
}

function imagePlaceholder($image=null){
    if(!$image){
        return 'jasar.jpg';
    }else{
        return $image;
    }
}



function userId(){
    global $connection;
    if(isLoggedIn()){
        $result = mysqli_query($connection,"SELECT * FROM users WHERE username ='".$_SESSION['username']."'");
        $row = mysqli_fetch_array($result);
        if(mysqli_num_rows($result) >= 1){
          return $row['user_id'];
        }
        
        
    }
    return false;
}

function userLiked($post_id = ''){
    global $connection;
   $result = mysqli_query($connection, "select * from likes where user_id =".userId()." and post_id= $post_id");
   return mysqli_num_rows($result) >=1 ? true : false;   
}




?>