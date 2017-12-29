
<?php include "db.php"; ?>

<?php

  if(isset($_POST["login"])) {

    //retrieving data from the database
    $username = $_POST["username"];
    $password = $_POST["password"];

    // function used to clean data (sanitize)
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    // pull all data from selected user
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    if(!$select_user_query) {
      die("QUERY FAILED" . mysqli_error($connection));
    }

  } // end ifsset function


  // pulling information from the database
  while ($row = mysqli_fetch_array($select_user_query)) {

    $db_id = $row['user_id'];
    $db_username = $row['username'];
    $db_password = $row['user_password'];
    $db_first_name = $row['user_first_name'];
    $db_last_name = $row['user_last_name'];
    $db_user_role = $row['user_role'];
  }

  // validation logic
  if($username !== $db_username && $password !== $db_password) {
    //redirect user somewhere else
    header("Location: ../index.php");
  } else if($username == $db_username && $password == $db_password) {

    header("Location: ../admin/index.php");
  } else {
    header("Location: ../index.php");

  }

?>
