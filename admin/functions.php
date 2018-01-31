
<?php

function redirect($location) {

  return header("Location:" . $location);

}// end redirect function 



  function escape($string) {

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));

  }
  

  function users_online() {

    if (isset($_GET["onlineusers"])) {

    global $connection;

    if (!$connection) {

        session_start();
        include("../includes/db.php");

        //this function catches the id of that specific session
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session' ";
        $send_query = mysqli_query($connection, $query);
        //getting the number of users
        $count = mysqli_num_rows($send_query);

        if ($count == NULL) {

            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");

        } else {

            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");

        }

        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
        echo mysqli_num_rows($users_online_query);

      } //end not connection

    } // end get request isset()

  } // end users_online function

  users_online();




  function confirm_query($result) {

    global $connection;

    if(!$result) {
      die("QUERY FAILED" . mysqli_error($connection));
    }

  } // end confirm_query function





  function insert_categories() {

    global $connection;

    //getting the post superglobal from the form
      if(isset($_POST["submit"])) {
        //grab user input from add categories
        $cat_title = $_POST["cat_title"];
        //catch error when field is left empty
        if($cat_title == "" || empty($cat_title)) {
          echo "This field should not be empty!";
        } else {
          //if everything is good sumbit data into our table(mysql)
          $query = "INSERT INTO categories(cat_title) ";
          $query .= "VALUE('{$cat_title}') ";

          //send it
          $create_category_query = mysqli_query($connection, $query);
            //error handling
            if(!$create_category_query) { //if the query is not true
              //kill all processes if query failed
              die("Query Failed" . mysqli_error($connection));
            }
        }
      }
  } // end insert_categories function




  function find_all_categories() {
    global $connection;

    //select all the data from the categories table
      $query = "SELECT * FROM categories";
      $select_categories = mysqli_query($connection, $query);

      //to display all the values we use a while while loop
      while($row = mysqli_fetch_assoc($select_categories)) {
      //finding the name of the rows and displaying them
      $cat_id = $row["cat_id"];
      $cat_title = $row["cat_title"];

      //displaying them on the page
      echo "<tr>";
      echo "<td>{$cat_id}</td>";
      echo "<td>{$cat_title}</td>";
      //we create a link and get the id
      echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
      echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
      echo "</tr>";
    }

  }// end find_all_categories function




  function delete_categories() {

    global $connection;

    //we catch the id, Delete Query
     if(isset($_GET['delete'])) {
       $catch_cat_id = $_GET['delete'];
       $query = "DELETE FROM categories WHERE cat_id = {$catch_cat_id} ";
       //deletes the data from the database
       $deleteQuery = mysqli_query($connection, $query);
       //we then refresh the page to delete data instantly
       header("Location: categories.php"); //this basically refreshes the page
     }
  }// end delete_categories function



  //functoin record count, counts the items in a talbe row 
  function recordCount($table) {

    global $connection;

    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_posts);
    //making sure our query works 
    confirm_query($result); 

    return $result;

  }



  // checking the status
  function checkStatus($table, $column, $status) {

    global $connection; 

    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $result = mysqli_query($connection, $query);

    confirm_query($result); 

    return mysqli_num_rows($result);

  }


// veryfing the user is an admin 
  function is_admin($username) {

    global $connection; 

    $query = "SELECT user_role FROM users WHERE username = '$username'"; 
    $result = mysqli_query($connection, $query); 
    confirm_query($result); 

    $row = mysqli_fetch_array($result);

    if($row['user_role'] == 'admin') {

        return true; 

    } else {

        return false; 

    }

  }// end admin function 



 function username_exists($username) {

    global $connection; 

    $query = "SELECT username FROM users WHERE username = '$username'"; 
    $result = mysqli_query($connection, $query); 
    confirm_query($result); 
    
    if(mysqli_num_rows($result) > 0) {

        return true; 

    } else {

        return false; 

    }

 }// end username function 



 function email_exists($email) {

    global $connection; 

    $query = "SELECT user_email FROM users WHERE user_email = '$email'"; 
    $result = mysqli_query($connection, $query); 
    confirm_query($result); 
    
    if(mysqli_num_rows($result) > 0) {

        return true; 

    } else {

        return false; 

    }

 }// end email function 



function resgister_user($username, $password, $email) {

    global $connection; 

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if(username_exists($username)) {

        $confirm_message = "user exists"; 

    }


    if (!empty($username) && !empty($email) && !empty($password)) {

      // sanitizing data
      $username = mysqli_real_escape_string($connection, $username);
      $email = mysqli_real_escape_string($connection, $email);
      $password = mysqli_real_escape_string($connection, $password);

      $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

      $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
      $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber' )";
      $register_user_query = mysqli_query($connection, $query);

      confirm_query($register_user_query);

      $confirm_message = "Your Registration has been submitted!";

    } 

}



function login_user($username, $email) {

    global $connection; 

    $username = trim($username); 
    $password = trim($password); 

    // function used to clean data (sanitize)
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    // pull all data from selected user
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    if(!$select_user_query) {

        die("QUERY FAILED" . mysqli_error($connection));

    }

    // pulling information from the database
    while ($row = mysqli_fetch_array($select_user_query)) {

        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_first_name = $row['user_first_name'];
        $db_last_name = $row['user_last_name'];
        $db_user_role = $row['user_role'];
    }

    // validating the user password 
    if(password_verify($password, $db_password)) {

        //setting a session
        $_SESSION['username'] = $db_username;
        $_SESSION['lastname'] = $db_last_name;
        $_SESSION['firstname'] = $db_first_name;
        $_SESSION['user_role'] = $db_user_role;

        //receive the session at admin/index.php
        header("Location: ../admin/index.php");

    } else {

      header("Location: ../index.php");

    }

}


?>
