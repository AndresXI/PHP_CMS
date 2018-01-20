

<?php

if (isset($_GET['edit_user'])) {

  $catch_user_id = $_GET['edit_user'];

  // retreiving data from that specific user
  $query = "SELECT * FROM users WHERE user_id = {$catch_user_id}";
  $select_users_query = mysqli_query($connection, $query);

  //to display all the values we use a while while loop
  while ($row = mysqli_fetch_assoc($select_users_query)) {

    //finding the name of the rows and displaying them
    $user_id = $row["user_id"];
    $username = $row["username"];
    $user_password = $row["user_password"];
    $user_first_name = $row["user_first_name"];
    $user_last_name= $row["user_last_name"];
    $user_email = $row["user_email"];
    $user_image = $row["user_image"];
    $user_role = $row["user_role"];

  }// end while loop




//updating the user
if (isset($_POST['edit_user'])) {

    //getting all the values from the form and then assiging them to
    //variables
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    //date function in php
    $post_date = date('d-m-y');

    //function for the images, it uploads image to server and then relocates
    //to the images folder in our project cms
    //move_uploaded_file($post_image_temp, "../images/$post_image");

    //going inside the database to get the result back
    if (!empty($user_password)) {

        $query_password = "SELECT user_password FROM users WHERE user_id = $catch_user_id ";
        $get_user_query  = mysqli_query($connection, $query_password);
        confirm_query($get_user_query);

        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row['user_password'];

        if ($db_user_password != $user_password) {

            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

        }

        //constructing the update query -- and updating the database
        $query = "UPDATE users SET ";
        $query .= "user_first_name = '{$user_first_name}', ";
        $query .= "user_last_name = '{$user_last_name}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$hashed_password}' ";// the new update hashed password
        $query .= "WHERE user_id = {$catch_user_id} ";

        //sending the query
        $edit_user_query = mysqli_query($connection, $query);
        //making sure the query works
        confirm_query($edit_user_query);

        //notification link
        echo "User Updated" . "<a href='users.php'>View Users?</a>";

    }

  }

} else {

  header("Location: index.php");

}

?>

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
      <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

      <?php

        if ($user_role == 'admin') {

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
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
  </div>

</form>
