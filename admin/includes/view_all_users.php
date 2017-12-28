
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

          echo "<td><a href='comments.php?approve='>Approve</a></td>";
          //create link to delete post by grabing the post ID
          echo "<td><a href='comments.php?unapprove='>Unapprove</a></td>";
          //create link to delete post by grabing the post ID
          echo "<td><a href='comments.php?delete='>Delete</a></td>";
          echo "</tr>";

    } // end while loop

    ?>

  </tbody>

</table>

<?php

//approve query comments
if(isset($_GET['approve'])) {

  $catch_comment_id = $_GET['approve'];

  $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = {$catch_comment_id} ";
  $approve_comment_query = mysqli_query($connection, $query);
  //refresh everytime it is submitted
  header("Location: comments.php");

}


//unapprove query for comments
if(isset($_GET['unapprove'])) {

  $catch_comment_id = $_GET['unapprove'];

  $query = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id = {$catch_comment_id} ";
  $unapprove_comment_query = mysqli_query($connection, $query);
  //refresh everytime it is submitted
  header("Location: comments.php");

}





//DELETE QUERY FOR COMMENTS
  if(isset($_GET['delete'])) {

    $catch_comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$catch_comment_id} ";
    $delete_query = mysqli_query($connection, $query);
    //refresh everytime it is submitted
    header("Location: comments.php");

  }



?>
