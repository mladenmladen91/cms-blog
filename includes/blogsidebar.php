
           <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
              
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" type="submit" class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                
                <!-- LOGIN -->
                <?php   
                   if(!isset($_SESSION['username'])){
                ?>
                 
                <div class="well">
                    <h4>Login</h4>
                    <form action="/cms-project/login.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login"  class="btn btn-primary" value="login">
                    </div>
                    <div class="form-group">
                        <a href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot password?</a>
                    </div>
                    </form>
                    <!-- /.input-group -->
                    <?php }else{ ?>
                      <h4>Welcome <?php echo $_SESSION['username']; ?></h4>
                      <p><a href="/cms-project/includes/logout.php">Odjavi me</a></p>
                    <?php } ?>
                </div>

            </div>