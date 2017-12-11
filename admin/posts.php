<?php
include "includes/admin_header.php";
?>
    <div id="wrapper">

      <!-- Navigation -->
      <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                      <h1 class="page-header">
                          Welcome Admin
                          <small>Author</small>
                      </h1>

                      <!--Create a table to display data-->
                      <table class='table table-bordered table-hover'>
                        <thead>
                          <tr>
                            <th>Post ID</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Comments</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        
                        <tbody>
                          <tr>
                            <td>10</td>
                            <td>Beans</td>
                            <td>Space Commets</td>
                            <td>rocks</td>
                            <td>cool</td>
                            <td>yeahs</td>
                            <td>none</td>
                            <td>ok </td>
                            <td>dates</td>
                          </tr>
                        </tbody>

                      </table>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php"; ?>
