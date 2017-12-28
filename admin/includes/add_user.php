

<?php

if(isset($_POST['create_user'])) {

    //getting all the values from the form and then assiging them to
    //variables
    echo $user_first_name = $_POST['user_first_name'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];

    // //for the post images we need the superglobal 'FILES'
    // $post_image = $_FILES['image']['name'];
    // //temporary location in server
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    //date function in php
    //$post_date = date('d-m-y');

    //function for the images, it uploads image to server and then relocates
    //to the images folder in our project cms
    //move_uploaded_file($post_image_temp, "../images/$post_image");
   //
   // $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
   //
   // //the values are coming from the form
   // $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
   //
   // $create_post_query = mysqli_query($connection, $query);
   //
   // //call to confirm query
   // confirm_query($create_post_query);

  }


?>




<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">First Name</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="user_first_name">
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput">Last Name</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="user_last_name">
  </div>

  <div class="form-group">
    <select class="post_category" name="user_role">
      <option value="subscriber">Select Options</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>

  <!-- <div class="form-group">
    <label class="col-form-label" for="post_image">Post Image</label>
    <input type="file" class="form-control" id="formGroupExampleInput2" name="image">
  </div> -->

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Username</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="username">
  </div>

  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Email</label>
    <input type="email" class="form-control" name="user_email" >
  </div>
  <div class="form-group">
    <label class="col-form-label" for="formGroupExampleInput2">Password</label>
    <input type="password" class="form-control" name="user_password" >
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
  </div>

</form>
