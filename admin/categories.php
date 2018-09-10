    
    <?php include "includes/header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin page
                            <small>Add categories</small>
                        </h1>
                        <div class="col-xs-6">
                        <?php
                         insert_categories();    
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                               <label for="cat_title">Category title</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="add category">
                            </div>  
                       </form>
                        
                        <!-- including edit categories -->
                        <?php if(isset($_GET['update'])){
                                $cat_id = $_GET['update'];
                                include "includes/edit_categories.php";
                         }  ?>
                        
                         </div>
                         <div class="col-xs-6">
                            
                             <table class="table table-bordered table-hover">
                                 <thead>
                                     <tr>
                                         <th>Id</th>
                                         <th>Category title</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php showCat(); ?>
                            
                            <?php  deleteCat(); ?>        
                                 </tbody>
                             </table>
                         </div> 
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
 <?php include "includes/footer.php"; ?>