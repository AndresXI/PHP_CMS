<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
          <div class="input-group">
              <input type="text" class="form-control" name="search">
              <span class="input-group-btn">
                  <button class="btn btn-default" type="submit" name="submit">
                      <span class="glyphicon glyphicon-search"></span>
              </button>
              </span>
          </div>
       </form> <!--search form-->
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">

    <?php
      //select all the data from the categories table
        $query = "SELECT * FROM categories LIMIT 3";
        $select_categories_sidebar = mysqli_query($connection, $query);
    ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                <?php
                  //to display all the values we use a while while loop
                  while($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                    //finding the name of the rows and displaying them
                    $cat_title = $row["cat_title"];
                    echo "<li><a href='#'>{$cat_title}</a></li>";
                  }
                ?>

                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>
</div>
