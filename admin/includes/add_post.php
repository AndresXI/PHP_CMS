

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
    $post_comment_count = 4;

    //function for the images, it uploads image to server and then relocates
    //to the images folder in our project cms
    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";

   //the values are coming from the form
   $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}' ) ";

   $create_post_query = mysqli_query($connection, $query);

   //call to confirm query 
   confirm_query($create_post_query);

  }


?>




<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput">Post Title</label>
    <input type="text" class="form-control" id="formGroupExampleInput" name="title">
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Post Category Id</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="post_category_id">
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Post Author</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="author">
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput">Post Status</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="post_status">
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
    <textarea class="form-control" id="" name="post_content" cols="30" rows="10"></textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>

</form>
