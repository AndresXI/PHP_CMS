<?php
include "includes/admin_header.php";
?>

<?php

  if(isset($_SESSION["username"])) {

    $username = $_SESSION["username"];

    $query = "SELECT * FROM users WHERE username =  '{$username}' ";

    $select_user_profile_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_profile_query)) {

      $user_id = $row["user_id"];
      $username = $row["username"];
      $user_password = $row["user_password"];
      $user_first_name = $row["user_first_name"];
      $user_last_name= $row["user_last_name"];
      $user_email = $row["user_email"];
      $user_image = $row["user_image"];
      $user_role = $row["user_role"];

    }

  }


?>

<?php

  if(isset($_POST["edit_user"])) {

    //getting all the values from the form and then assiging them to
    //variables
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];

    // //for the post images we need the superglobal 'FILES'
    // $post_image = $_FILES['image']['name'];
    // //temporary location in server
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    //date function in php
    //$post_date = date('d-m-y');

    //function for the images, it uploads image to server and then relocates
    //to the images folder in our project cms
    //move_uploaded_file($post_image_temp, "../images/$post_image");

    //constructing the update query -- and updating the database
      $query = "UPDATE users SET ";
      $query .= "user_first_name = '{$user_first_name}', ";
      $query .= "user_last_name = '{$user_last_name}', ";
      $query .= "user_role = '{$user_role}', ";
      $query .= "username = '{$username}', ";
      $query .= "user_email = '{$user_email}', ";
      $query .= "user_password = '{$user_password}' ";
      $query .= "WHERE username = '{$username}' ";

      //sending the query
      $edit_user_query = mysqli_query($connection, $query);
      //making sure the query works
      confirm_query($edit_user_query);


  }


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
                  Welcome
                  <small><?php echo $_SESSION["username"] ?></small>
              </h1>


                <form action="" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">First Name</label>
                    <input type="text" class="form-control" value="<?php echo $user_first_name; ?>" name="user_first_name">
                  </div>

                  <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput">Last Name</label>
                    <input type="text" class="form-control" value="<?php echo $user_last_name; ?>" name="user_last_name">
                  </div>

                  <div class="form-group">
                    <select class="post_category" name="user_role">
                      <option value="subscriber"><?php echo $user_role ?></option>


                      <?php

                        if($user_role == 'admin') {
                          echo "<option value='subscriber'>subscriber</option>";
                        } else {
                          echo "<option value='admin'>admin</option>";

                        }
                      ?>


                    </select>
                  </div>

                  <!-- <div class="form-group">
                    <label class="col-form-label" for="post_image">Post Image</label>
                    <input type="file" class="form-control" id="formGroupExampleInput2" name="image">
                  </div> -->

                  <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Username</label>
                    <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
                  </div>

                  <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Email</label>
                    <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email" >
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Password</label>
                    <input type="password" class="form-control" value="<?php echo $user_password; ?>" name="user_password" >
                  </div>

                  <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="edit_user" value="Update Porfile">
                  </div>

                </form>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>
