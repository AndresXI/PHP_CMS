<?php
//connecting to the database
//
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
// }


$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["us-cdbr-iron-east-05.cleardb.net"];
$username = $url["b4528cfdbfca45"];
$password = $url["f1bbd1d9"];
$db = substr($url["heroku_d52aa83a8f80e95"], 1);

$connection = new mysqli($server, $username, $password, $db);





?>
