
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

    <?php

    //select all the data from the posts table
      $query = "SELECT * FROM posts ";
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
          echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
          //create link to delete post by grabing the post ID
          echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
          echo "</tr>";
    }

    ?>

  </tbody>

</table>

<?php

  if(isset($_GET['delete'])) {

    $catch_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$catch_post_id} ";
    $delete_query = mysqli_query($connection, $query);

  }



?>
