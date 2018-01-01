
<?php session_start(); ?> <!-- function used to turn on sessions -->

<?php

//everytime the user comes to this page we are cancelling the session
//assign every value of null
$_SESSION['username'] = null;
$_SESSION['lastname'] = null;
$_SESSION['firstname'] = null;
$_SESSION['user_role'] = null;

//redirect user somewhere else
header("Location: ../index.php"); 

?>
