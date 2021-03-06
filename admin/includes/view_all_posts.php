

<?php
include("delete_modal.php");

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

            $post_users = $row["post_users"];
            $post_title = $row["post_title"];
            $post_category_id = $row["post_category_id"];
            $post_status = $row["post_status"];
            $post_author = $row["post_author"];
            $post_image = $row["post_image"];
            $post_tags = $row["post_tags"];
            $post_date = $row["post_date"];
            $post_content = $row["post_content"];

          }

          //inserting the values into the tables 
          $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_users, post_date, post_image, post_content, post_tags, post_status) ";
          $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', '{$post_users}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
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

<script>

$(document).ready(function() {

  $(".delete_link").on('click', function(){

    // get the id when the user clicks the delte link,
    var Id = $(this).attr("rel");
    var delete_url = "posts.php?delete=" + Id + "";

    // attr grabs the value for that specific attribute
    // the second argument changes the value of the href attribute
    $(".modal_delete_link").attr("href", delete_url);

    $("#myModal").modal("show");

  });

});

</script>

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
        <th>Users</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Post</th>
        <th>Post Views</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>

    <?php

    //select all the data from the posts table
    // $query = "SELECT * FROM posts ORDER BY post_id DESC ";

    //join talbes with dot notation and separate with commas 
    $query = "SELECT posts.post_id, posts.post_author, posts.post_users, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";
    $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views, categories.cat_id, categories.cat_title ";
    $query .= "FROM posts "; // this query comes from the posts because it is our main table 
    $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";

    $select_posts = mysqli_query($connection, $query);

        //to display all the values we use a while while loop
        while($row = mysqli_fetch_assoc($select_posts)) {
          //finding the name of the rows and displaying them
          $post_id = $row["post_id"];
          $post_author = $row["post_author"];
          $post_users = $row["post_users"];
          $post_title = $row["post_title"];
          $post_category_id = $row["post_category_id"];
          $post_status = $row["post_status"];
          $post_image = $row["post_image"];
          $post_tags = $row["post_tags"];
          $post_comment_count = $row["post_comment_count"];
          $post_date = $row["post_date"];
          $post_views = $row["post_views"];
          //items from the other table 
          $category_id = $row["cat_id"];
          $category_title = $row["cat_title"];

          echo "<tr>";

      ?>

              <!-- giving the input field an array name and assigning the id for the value attribute -->
              <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

              <?php
              echo "<td>$post_id</td>";

              if (!empty($post_author)) {

                echo "<td>$post_author</td>";

              } elseif (!empty($post_users)) {

                echo "<td>$post_users</td>";

              }

              echo "<td>$post_title</td>";


              // //select all the data from the categories table
              // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
              // $select_categories_id = mysqli_query($connection, $query);
              // //to display all the values we use a while while loop
              // while($row = mysqli_fetch_assoc($select_categories_id)) {
              //     //finding the name of the rows and displaying them
              //     $cat_title = $row["cat_title"];
              //     $cat_id = $row["cat_id"];

            echo "<td>$category_title</td>";

            

            echo "<td>$post_status</td>";
            echo "<td><img src='../images/$post_image' width='100' height='100'</td>";
            echo "<td>$post_tags</td>";

            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
            $send_comment_query = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($send_comment_query);
            $comment_id = $row['comment_id'];

            $count_comments = mysqli_num_rows($send_comment_query);
            //passing a parameter $comment_id to catch it using a GET request
            echo "<td><a href='post_comments.php?id=$post_id'>$count_comments (Click to View All Comments)</a></td>";
            echo "<td>$post_date</td>";
            //we can divide values by using an ampersand (&)
            //here we pass 2 parameters the source to take us to the page and
            //the post ID to grab that especific post
            echo "<td><a href='../post.php?p_id={$post_id}' class='btn btn-primary'>View Post</a></td>";
            echo "<td><a href='posts.php?reset={$post_id}'>$post_views</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' class='btn btn-info'>Edit</a></td>";


            ?>

            <form action="" method="post">
            
                <input type="hidden" value="<?php echo $post_id ?>" name="post_id">
                <?php
                  echo"<td><input type='submit' name='delete' value='delete' class='btn btn-danger'></td>";
                ?>
            
            </form>

            <?php 

            //create link to delete post by grabing the post ID
            // echo "<td><a href='javascript:void(0)' rel='$post_id' class='delete_link'>Delete</a></td>";
            //echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
      }

      ?>

    </tbody>

  </table>

</form><!-- end form -!>


<?php
//Delete query
  if (isset($_POST['delete'])) {

    $catch_post_id = $_POST['post_id'];

    $query = "DELETE FROM posts WHERE post_id = {$catch_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");

  }



//reset query for post views
  if (isset($_GET['reset'])) {

    $catch_post_id = $_GET['reset'];

    $query = "UPDATE posts SET post_views = 0 WHERE post_id = $catch_post_id ";
    $reset_query = mysqli_query($connection, $query);
    header("Location: posts.php");

  }

?>
