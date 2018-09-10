<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>
    
<?php 
  if(isset($_POST['submit'])){
      if(empty($_POST['subject']) || empty($_POST['email']) || empty($_POST['body'])){
          echo "<h4 class='text-center'>*Morate ispuniti sva polja</h4>";
      }else{
      $to = "jelovacmladen@gmail.com";
      $body =wordwrap($_POST['body'],70);
      $subject = $_POST['subject'];
      $header = "From:".$_POST['email'];
      
      
         mail($to, $subject, $body, $header);
      }
  }

?>
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Message</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                        </div>
                        
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
