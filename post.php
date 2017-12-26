<?php
include "includes/header.php";
include "includes/db.php";
?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->

            <div class="col-md-8">

              <?php


              if(isset($_GET["p_id"])) {
                $catch_post_id = $_GET['p_id'];
              }



              $query = "SELECT * FROM posts WHERE post_id = {$catch_post_id} ";
              $select_all_posts_query = mysqli_query($connection, $query);

                //to display all the values we use a while while loop
                while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                //finding the name of the rows and displaying them
                $post_title = $row["post_title"];
                $post_author = $row["post_author"];
                $post_date = $row["post_date"];
                $post_image = $row["post_image"];
                $post_content = $row["post_content"];
                ?>


                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

            <?php  }     ?>


            <!-- Blog Comments -->

            <?php

             if(isset($_POST["create_comment"])) {
               // get post id from the url
               $catch_post_id = $_GET['p_id'];

               // get all data from the email
               $comment_author = $_POST["comment_author"];
               $comment_email = $_POST["comment_email"];
               $comment_content = $_POST["comment_content"];

               // inserting data into the comments database
               $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
               $query .= "VALUES ($catch_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

               $create_comment_query = mysqli_query($connection, $query);
               if(!$create_comment_query) {
                 die("QUERY FAILED" . mysqli_error($connection));
               }

               $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
               $query .= "WHERE post_id = {$catch_post_id} ";

               $update_comment_count = mysqli_query($connection, $query);


             }//end ifsset statement query



            ?>





            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">

                  <div class="form-group">
                    <label for="Author">Author</label>
                    <input type="text" class="form-control" name="comment_author" value="">
                  </div>

                  <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" name="comment_email" value="">
                  </div>

                    <div class="form-group">
                      <label for="Comment">Comment</label>
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                    </div>

                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php
            //query to display the selected comment on the blog
            $query = "SELECT * FROM comments WHERE comment_post_id = {$catch_post_id} ";
            $query .= "AND comment_status = 'approve' ";
            $query .= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($connection, $query);
            if(!$select_comment_query) {
              die("Query Failed" . mysqli_error($connection));
            }
            while($row = mysqli_fetch_array($select_comment_query)) {
              $comment_date = $row["comment_date"];
              $comment_content = $row["comment_content"];
              $comment_author = $row["comment_author"];

            ?>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small> <?php echo $comment_date;  ?> </small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>


          <?php } ?>


        </div> <!--Column md 8 div-->

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>



        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>
