<?php
//connecting to the online database

$db["db_host"] = "us-cdbr-iron-east-05.cleardb.net";
$db["db_user"] = "b4528cfdbfca45";
$db["db_pass"] = "f1bbd1d9";
$db["db_name"] = "heroku_d52aa83a8f80e95";

//create the value of the array into constants
foreach($db as $key => $value) {
  define(strtoupper($key), $value);
}


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//
// if($connection) {
//   echo "We are connected";
// } else {
//   die("ERROR" . mysqli_error($connection));
// }

// //connceting to the local databse
// $db["db_host"] = "localhost";
// $db["db_user"] = "root";
// $db["db_pass"] = "root";
// $db["db_name"] = "CMS";
//
// //create the value of the array into constants
// foreach($db as $key => $value) {
//   define(strtoupper($key), $value);
// }
//
//
// $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if($connection) {
//   echo "We are connected";
// } else {
//   die("ERROR" . mysqli_error($connection));
// }

?>
