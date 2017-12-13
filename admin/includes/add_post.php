<?php

  if(isset($_POST['create_post'])) {
    echo $_POST['title'];
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
