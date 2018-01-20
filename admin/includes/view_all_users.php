
<!--Create a table to display data-->
<table class='table table-bordered table-hover'>

  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Role</th>
    </tr>
  </thead>

  <tbody>

    <?php

    //select all the data from the comments table
      $query = "SELECT * FROM users ";
      $select_users = mysqli_query($connection, $query);

          //to display all the values we use a while while loop
          while($row = mysqli_fetch_assoc($select_users)) {
            
              //finding the name of the rows and displaying them
              $user_id = $row["user_id"];
              $username = $row["username"];
              $user_password = $row["user_password"];
              $user_first_name = $row["user_first_name"];
              $user_last_name= $row["user_last_name"];
              $user_email = $row["user_email"];
              $user_image = $row["user_image"];
              $user_role = $row["user_role"];

              echo "<tr>";
              echo "<td>$user_id</td>";
              echo "<td>$username</td>";
              echo "<td>$user_first_name</td>";

              //   //select all the data from the categories table
              //   $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
              //   $select_categories_id = mysqli_query($connection, $query);
              //   //to display all the values we use a while while loop
              //   while($row = mysqli_fetch_assoc($select_categories_id)) {
              //       //finding the name of the rows and displaying them
              //       $cat_title = $row["cat_title"];
              //       $cat_id = $row["cat_id"];
              //       echo "<td>{$cat_title}</td>";
              //
              // }

              echo "<td>$user_last_name</td>";
              echo "<td>$user_email</td>";
              echo "<td>$user_role</td>";

              // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
              // $select_post_id_query = mysqli_query($connection, $query);
              // //loop used to bring all the data from the comments table
              // while($row = mysqli_fetch_assoc($select_post_id_query)){
              //   $post_id = $row["post_id"];
              //   $post_title = $row["post_title"];
              //
              // echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
              //
              // }

              echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
              //create link to delete post by grabing the users ID
              echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
              //create link to delete post by grabing the users ID
              echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
              echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
              echo "</tr>";

    } // end while loop

    ?>

  </tbody>

</table>

<?php

// change to admin query
if(isset($_GET['change_to_admin'])) {

  $catch_user_id = $_GET['change_to_admin'];

  $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$catch_user_id} ";
  $change_admin_query = mysqli_query($connection, $query);
  //refresh everytime it is submitted
  header("Location: users.php");

}

// change to subscriber query
if(isset($_GET['change_to_sub'])) {

  $catch_user_id = $_GET['change_to_sub'];

  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$catch_user_id} ";
  $change_to_sub_query = mysqli_query($connection, $query);
  //refresh everytime it is submitted
  header("Location: users.php");

}

//DELETE QUERY FOR USERS
  if(isset($_GET['delete'])) {

    //validating the session
    if (isset($_SESSION['user_role'])) {

    if ($_SESSION['user_role'] == 'admin') {

    $catch_user_id = mysqli_real_escape_string($connection, $_GET['delete']);

    $query = "DELETE FROM users WHERE user_id = {$catch_user_id} ";
    $delete_user_query = mysqli_query($connection, $query);
    //refresh everytime it is submitted
    header("Location: users.php");

    }

  }

}


?>
