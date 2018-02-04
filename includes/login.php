
<?php session_start(); ?> <!-- function used to turn on sessions -->
<?php include "db.php"; ?>
<?php include "../admin/functions.php"; ?>

<?php

  if(isset($_POST["login"])) {

    login_user($_POST["username"], $_POST["password"]); 

} // end ifsset function

?>
