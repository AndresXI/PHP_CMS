
<?php

// check if the array is available by using the name attribute
  if(isset($_POST['checkBoxArray'])) {

    //we use a loop to go through each item of the array and assign the
    //value to $checkBoxValue
    foreach($_POST['checkBoxArray'] as $comment_value_id) {

      // picking the value of the selected checkbox value
      $bulk_options = $_POST['bulk_options'];

      switch ($bulk_options) {
        case "approve":
          $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$comment_value_id} ";
          $update_to_approved_status = mysqli_query($connection, $query);
          confirm_query($update_to_approved_status);
          break;

        case 'unapprove':
          $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$comment_value_id} ";
          $update_to_unapprove_status = mysqli_query($connection, $query);
          break;
          
        case 'delete':
          $query = "DELETE FROM comments WHERE comment_id = $comment_value_id ";
          $update_to_delete_status = mysqli_query($connection, $query);
          break;

        default:
          # code...
          break;
      }

    }

  }

?>


<!-- this from action makes sures the apply button submits!!-->
<form action="" method='post'>
    <!--Create a table to display data-->
    <table class='table table-bordered table-hover'>

      <div id="bulkOptionsContainer" class="col-xs-4">

        <select class="form-control" name="bulk_options">
          <option value="">Select Options</option>
          <option value="approve">Approve</option>
          <option value="unapprove">Unapprove</option>
          <option value="delete">Delete</option>
        </select>
      </div>

      <div class="col-xs-4">
        <input type="submit" name="submit" value="Apply" class="btn btn-success">
      </div>

  <thead>
    <tr>
      <th><input id="selectAllBoxes" type="checkbox"></th>
      <th>Comment ID</th>
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
          ?>

            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id; ?>'></td>

            <?php


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

</form>

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
