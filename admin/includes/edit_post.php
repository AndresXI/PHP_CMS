
<?php

  if(isset($_GET['p_id'])) {
//the post id from the url
    $the_post_id = $_GET['p_id'];

  }



//select all the data from the posts table
  $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
  $select_posts_by_id = mysqli_query($connection, $query);

  //to display all the values we use a while while loop
  while($row = mysqli_fetch_assoc($select_posts_by_id)) {
  //finding the name of the rows from the database and displaying them
  $post_id = $row["post_id"];
  $post_author = $row["post_author"];
  $post_title = $row["post_title"];
  $post_category_id = $row["post_category_id"];
  $post_status = $row["post_status"];
  $post_image = $row["post_image"];
  $post_tags = $row["post_tags"];
  $post_content = $row["post_content"];
  $post_comment_count = $row["post_comment_count"];
  $post_date = $row["post_date"];

}

//when the user hits the publish post button,
//we update all the fields in the form
if(isset($_POST["update_post"])) {

  $post_author = $_POST["author"];
  $post_title = $_POST["title"];
  $post_category_id = $_POST["post_category_id"];
  $post_status = $_POST["post_status"];
  $post_image = $_FILES["post_image"]["name"];
  //post image temporary location
  $post_image_temp = $_FILES["post_image"]["tmp_name"];
  $post_tags = $_POST["post_tags"];
  $post_content = $_POST["post_content"];

//moving the image from a temporary location to a permanent location
  // move_uploaded_file($post_image_temp, "../images/$post_image");

//making sure the "$post_image" is not empty
  if(empty($post_image)) {
    $query = "SELECT * FROM p osts WHERE post_id = $the_post_id ";
    //getting the image from the database
    $select_image = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_image)) {
      $post_image = $row["post_image"];
    }
  }

//constructing the update query -- and updating the database
  $query = "UPDATE posts SET ";
  $query .= "post_title = '{$post_title}', ";
  $query .= "post_category_id = '{$post_category_id}', ";
  $query .= "post_date = now(), ";
  $query .= "post_author = '{$post_author}', ";
  $query .= "post_status = '{$post_status}', ";
  $query .= "post_tags = '{$post_tags}', ";
  $query .= "post_content = '{$post_content}', ";
  $query .= "post_image = '{$post_image}' ";
  $query .= "WHERE post_id = {$the_post_id} ";

  //sending the query
  $update_post = mysqli_query($connection, $query);
  //making sure the query works
  confirm_query($update_post);


}



?>





<!-- Update Form -->
<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput">Post Title</label>
    <input value="<?php echo $post_title; ?>" type="text" class="form-control" id="formGroupExampleInput" name="title">
  </div>

  <div class="form-group">
    <select class="post_category" name="post_category_id">

      <?php

      //select all the data from the categories table
        $query = "SELECT * FROM categories ";
        $select_categories = mysqli_query($connection, $query);

        confirm_query($select_categories);

      //to display all the values we use a while while loop
      while($row = mysqli_fetch_assoc($select_categories)) {
        //finding the name of the rows and displaying them
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];

        //display it in an options dropdown menu
        echo "<option selected value='$cat_id'>{$cat_title}</option>";
      }


      ?>


    </select>
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Post Author</label>
    <input value="<?php echo $post_author; ?>" type="text" class="form-control" id="formGroupExampleInput2" name="author">
  </div>

  <div class="form-group">
    <select name="post_status">
      <option value="<?php echo $post_status ?>"><?php echo $post_status; ?></option>

      <?php
        if($post_status == 'publish') {
          echo "<option value='draft'>draft</option>";
        } else {
          echo "<option value='publish'>publish</option>";
        }
      ?>

    </select>
  </div>


  <div class="form-group">
    <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
    <input type="file" name="post_image">
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" id="formGroupExampleInput2" name="post_tags">
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Post Content</label>
    <textarea class="form-control" id="summernote" name="post_content" cols="30" rows="10">
      <?php echo $post_content; ?>
    </textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Publish Post">
  </div>

</form>
