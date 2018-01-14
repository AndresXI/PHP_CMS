

<?php
// check if the array is available by using the name attribute
  if(isset($_POST['checkBoxArray'])) {

    //we use a loop to go through each item of the array and assign the
    //value to $checkBoxValue
    foreach($_POST['checkBoxArray'] as $postValueId) {

      // picking the value of the selected checkbox value
      $bulk_options = $_POST['bulk_options'];

      switch ($bulk_options) {
        case "publish":
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
          $update_to_published_status = mysqli_query($connection, $query);
          //confirm_query($update_to_published_status);
          break;

        case 'draft':
          $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $postValueId ";
          $update_to_draft_status = mysqli_query($connection, $query);
          break;

        case 'clone':
          $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
          $select_post_query = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_array($select_post_query)) {

            $post_author = $row["post_author"];
            $post_title = $row["post_title"];
            $post_category_id = $row["post_category_id"];
            $post_status = $row["post_status"];
            $post_image = $row["post_image"];
            $post_tags = $row["post_tags"];
            $post_date = $row["post_date"];
            $post_content = $row["post_content"];

          }

          $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
          $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
          $copy_query = mysqli_query($connection, $query);

          if (!$copy_query) {
              die("QUERY FAILED" . mysqli_error($connection));
          }
          break;

        case 'delete':
          $query = "DELETE FROM posts WHERE post_id = $postValueId ";
          $update_to_delete_status = mysqli_query($connection, $query);
          break;

        default:
          # code...
          break;
      }

    }

  }

?>

<form action="" method="post">

  <!--Create a table to display data-->
  <table class='table table-bordered table-hover'>

    <div id="bulkOptionsContainer" class="col-xs-4">

      <select class="form-control" name="bulk_options">
        <option value="">Select Options</option>
        <option value="publish">Publish</option>
        <option value="draft">Draft</option>
        <option value="clone">Clone</option>
        <option value="delete">Delete</option>

      </select>
    </div>

    <div class="col-xs-4">
      <input type="submit" name="submit" value="Apply" class="btn btn-success">
      <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>



    <thead>
      <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>Post ID</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>

      <?php

      //select all the data from the posts table
        $query = "SELECT * FROM posts ORDER BY post_id DESC ";
        $select_posts = mysqli_query($connection, $query);

            //to display all the values we use a while while loop
            while($row = mysqli_fetch_assoc($select_posts)) {
              //finding the name of the rows and displaying them
              $post_id = $row["post_id"];
              $post_author = $row["post_author"];
              $post_title = $row["post_title"];
              $post_category_id = $row["post_category_id"];
              $post_status = $row["post_status"];
              $post_image = $row["post_image"];
              $post_tags = $row["post_tags"];
              $post_comment_count = $row["post_comment_count"];
              $post_date = $row["post_date"];

              echo "<tr>";

      ?>

              <!-- giving the input field an array name and assigning the id for the value attribute -->
              <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

              <?php
              echo "<td>$post_id</td>";
              echo "<td>$post_author</td>";
              echo "<td>$post_title</td>";


              //select all the data from the categories table
              $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
              $select_categories_id = mysqli_query($connection, $query);
              //to display all the values we use a while while loop
              while($row = mysqli_fetch_assoc($select_categories_id)) {
                  //finding the name of the rows and displaying them
                  $cat_title = $row["cat_title"];
                  $cat_id = $row["cat_id"];
                  echo "<td>{$cat_title}</td>";

            }



            echo "<td>$post_status</td>";
            echo "<td><img src='../images/$post_image' width='100' height='100'</td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td>$post_date</td>";
            //we can divide values by using an ampersand (&)
            //here we pass 2 parameters the source to take us to the page and
            //the post ID to grab that especific post
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            //create link to delete post by grabing the post ID
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
      }

      ?>

    </tbody>

  </table>

</form><!-- end form -!>

<?php
//Delete query
  if(isset($_GET['delete'])) {

    $catch_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$catch_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");

  }



?>
