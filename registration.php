<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
<?php include "admin/functions.php"; ?>


<?php

  // to retrieve data we use a superglobal POST
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $error = [

        "username"=> "",
        "email"=> "",
        "password"=> ""

    ]; 

// username validation 
    if(strlen($username) < 4) {

        $error["username"] = "Username needs to be longer than 4 characters!"; 
        
    }

    if($username == "") {

        $error["username"] = "Username cannot be empty!"; 
        
    }

    if(username_exists($username)) {

        $error["username"] = "Username already exists!"; 
        
    }

// email validation 
    if($email == "") {

        $error["email"] = "Email cannot be empty!"; 
        
    }

    if(username_exists($email)) {

        $error["eamil"] = "Email already exists, <a href='index.php'>Login</a>"; 
        
    }

// password validation 
    if($password == "") {

        $error["password"] = "Password cannot be empty!"; 

    }

    // going through the array of errors 
    foreach ($error as $key => $value) {

        if(empty($value)) {

            // if empty unset that key, to clean it up 
            unset($error[$key]); 

        }

    } // end foreach 

    if (empty($error)) {

        //if there are no errors the register user 
        resgister_user($username, $password, $email);

        // login the user and redirect them to the admin page 
        login_user($username, $password);
    } 

  } //end ifsset function

?>

<!-- Page Content -->
<div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 id="register">Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username"

                            autocomplete="on"

                            value="<?php echo isset($username) ? $username : '' ?>" >

                            <!-- Displays the error based on the username function -->
                            <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>

                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"
                            
                            autocomplete="on"

                            value="<?php echo isset($email) ? $email  : '' ?>" >

                            <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>

                        </div>

                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password"

                            value="<?php echo isset($password) ? $password  : '' ?>" >

                            <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>


                        </div>
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<?php include "includes/footer.php";?>
