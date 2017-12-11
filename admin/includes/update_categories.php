<!--form to edit category-->
<form action="" method="post">
  <div class="form-group">
    <label for="cat_title">Edit Category</label>

    <?php
    if(isset($_GET["edit"])) {

      $cat_id = $_GET["edit"];
    //select all the data from the categories table
      $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
      $select_categories_id = mysqli_query($connection, $query);

    //to display all the values we use a while while loop
    while($row = mysqli_fetch_assoc($select_categories_id)) {
      //finding the name of the rows and displaying them
      $cat_id = $row["cat_id"];
      $cat_title = $row["cat_title"];

      ?>

      <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" name="cat_title" class='form-control'>

    <?php  } } ?>

    <?php //UPDATE QUERY

    if(isset($_POST['update_category'])) {
      $catch_cat_title = $_POST['cat_title'];
      $query = "UPDATE categories SET cat_title = '{$catch_cat_title}' WHERE cat_id = {$cat_id} ";
      //deletes the data from the database
      $updateQuery = mysqli_query($connection, $query);
        if(!$updateQuery) {
          die("Update Query failed" . mysqli_error($connection));
        }
    }


    ?>

  </div>
    <div class="form-group">
      <input type="submit" name="update_category" value="Update" class='btn btn-primary'>
    </div>
</form><!--Edit Category Form-->
