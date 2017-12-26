
<!--Create a table to display data-->
<table class='table table-bordered table-hover'>
  <thead>
    <tr>
      <th>Post ID</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Status</th>
      <th>In Response to</th>
      <th>Date</th>
      <th>Approve</th>
      <th>Unapprove</th>
      <th>Delete</th>
    </tr>
  </thead>

  <tbody>

    <?php

    //select all the data from the comments table
      $query = "SELECT * FROM comments ";
      $select_comments = mysqli_query($connection, $query);

          //to display all the values we use a while while loop
          while($row = mysqli_fetch_assoc($select_comments)) {
            //finding the name of the rows and displaying them
            $comment_id = $row["comment_id"];
            $comment_post_id = $row["comment_post_id"];
            $comment_author = $row["comment_author"];
            $comment_content = $row["comment_content"];
            $comment_email = $row["comment_email"];
            $comment_status = $row["comment_status"];
            $comment_date = $row["comment_date"];

            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";


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



          echo "<td>$comment_email</td>";
          echo "<td>$comment_status</td>";


          $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
          $select_post_id_query = mysqli_query($connection, $query);
          //loop used to bring all the data from the comments table
          while($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row["post_id"];
            $post_title = $row["post_title"];

          echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

          }


          echo "<td>$comment_date</td>";
          echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
          //create link to delete post by grabing the post ID
          echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
          //create link to delete post by grabing the post ID
          echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
          echo "</tr>";
    }

    ?>

  </tbody>

</table>

<?php

//approve query
if(isset($_GET['approve'])) {

  $catch_comment_id = $_GET['approve'];

  $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = {$catch_comment_id} ";
  $approve_comment_query = mysqli_query($connection, $query);
  //refresh everytime it is submitted
  header("Location: comments.php");

}


//unapprove query
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
