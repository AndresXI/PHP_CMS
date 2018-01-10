

<?php

if(isset($_POST['create_post'])) {

    //getting all the values from the form and then assiging them to
    //variables
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    //for the post images we need the superglobal 'FILES'
    $post_image = $_FILES['image']['name'];
    //temporary location in server
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    //date function in php
    $post_date = date('d-m-y');

    //function for the images, it uploads image to server and then relocates
    //to the images folder in our project cms
    move_uploaded_file($post_image_temp, "../images/$post_image");

   $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";

   //the values are coming from the form
   $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

   $create_post_query = mysqli_query($connection, $query);

   //call to confirm query
   confirm_query($create_post_query);

   //finding the last id created, this function pulls out the last
   //created id in this table
   $the_post_id = mysqli_insert_id($connection);

   //notification link
   echo "<p class='bg-success'>Post Created! <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";


  }


?>




<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput">Post Title</label>
    <input type="text" class="form-control" id="formGroupExampleInput" name="title">
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
    <input type="text" class="form-control" id="formGroupExampleInput2" name="author">
  </div>


  <div class="form-group">
    <select class="" name="post_status">
      <option value="draft">Select Post Status</option>
      <option value="publish">Publish</option>
      <option value="draft">Draft</option>
    </select>
  </div>

  <div class="form-group">
    <label class="col-form-label" for="post_image">Post Image</label>
    <input type="file" class="form-control" id="formGroupExampleInput2" name="image">
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Post Tags</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="post_tags">
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Post Content</label>
    <textarea class="form-control" id="summernote" name="post_content" cols="30" rows="10"></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>

</form>
