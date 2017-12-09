<?php include "includes/admin_header.php"; ?>

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

                        <div class="col-xs-6">

                        <?php
                        //getting the post superglobal from the form
                          if(isset($_POST["submit"])) {
                            //grab user input from add categories
                            $cat_title = $_POST["cat_title"];
                            //catch error when field is left empty
                            if($cat_title == "" || empty($cat_title)) {
                              echo "This field should not be empty!";
                            } else {
                              //if everything is good sumbit data into our table(mysql)
                              $query = "INSERT INTO categories(cat_title) ";
                              $query .= "VALUE('{$cat_title}') ";

                              //send it
                              $create_category_query = mysqli_query($connection, $query);
                                //error handling
                                if(!$create_category_query) { //if the query is not true
                                  //kill all processes if query failed
                                  die("Query Failed" . mysqli_error($connection));
                                }
                            }
                          }

                        ?>


                          <form action="" method="post">
                            <div class="form-group">
                              <label for="cat_title">Add Category</label>
                              <input type="text" name="cat_title" class='form-control'>
                            </div>
                            <div class="form-group">
                              <input type="submit" name="submit" value="Add Category" class='btn btn-primary'>
                            </div>
                          </form><!--Add Category Form-->


                          <form action="" method="post">
                            <div class="form-group">
                              <label for="cat_title">Edit Category</label>

                              <?php
                              if(isset($_GET["edit"])) {

                                $cat_id = $_GET["edit"];
                              //select all the data from the categories table
                                $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
                                $select_categories_id = mysqli_query($connection, $query);

                              //to display all the values we use a while while loop
                              while($row = mysqli_fetch_assoc($select_categories_id)) {
                                //finding the name of the rows and displaying them
                                $cat_id = $row["cat_id"];
                                $cat_title = $row["cat_title"];

                                ?>

                                <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" name="cat_title" class='form-control'>

                              <?php  } } ?>




                            </div>
                            <div class="form-group">
                              <input type="submit" name="submit" value="Update" class='btn btn-primary'>
                            </div>
                          </form><!--Edit Category Form-->

                       </div><!--Add Category Form-->


                       <div class='col-xs-6'>



                         <table class='table table-bordered table-hover'>
                           <thead>
                             <tr>
                               <th>Id</th>
                               <th>Category Title</th>
                             </tr>
                           </thead>
                           <tbody>

                             <?php

                               //select all the data from the categories table
                                 $query = "SELECT * FROM categories";
                                 $select_categories = mysqli_query($connection, $query);

                               //to display all the values we use a while while loop
                               while($row = mysqli_fetch_assoc($select_categories)) {
                                 //finding the name of the rows and displaying them
                                 $cat_id = $row["cat_id"];
                                 $cat_title = $row["cat_title"];

                                 //displaying them on the page
                                 echo "<tr>";
                                 echo "<td>{$cat_id}</td>";
                                 echo "<td>{$cat_title}</td>";
                                 //we create a link and get the id
                                 echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                 echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                 echo "</tr>";
                               }

                             ?>

                             <?php
                             //we catch the id, Delete Query
                              if(isset($_GET['delete'])) {
                                $catch_cat_id = $_GET['delete'];
                                $query = "DELETE FROM categories WHERE cat_id = {$catch_cat_id} ";
                                //deletes the data from the database
                                $deleteQuery = mysqli_query($connection, $query);
                                //we then refresh the page to delete data instantly
                                header("Location: categories.php"); //this basically refreshes the page
                              }

                             ?>
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
        <?php include "includes/admin_footer.php"; ?>
