<?php
// Include config file
require_once "config\config.php"; 


// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["status"] == "creator")
    {
        header("location: Creator.php");
    }
    else{
        header("location: SimpleUser.php");
    }
    exit;
}


// Include Login Handler
require "includes\\form_handlers\login_handler.php"
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign In Page-Naturally Strong</title>
        <link rel="icon" href="images\page_images\Logo.jpg">
        <link rel="stylesheet" href="styles\SignIn.css">
        <script src="SignIn.js" defer></script>
    </head>
    <body>
        <div id="wrapper">
            <img src="images\page_images\SignIn.jpg" alt="SignIn">
            
            <div id="form-wrapper">
                <!-- If general error appears, display message -->
                <?php 
                if(!empty($login_err)){
                    echo '<span id="error">' . $login_err . '</span>';
                }        
                ?>
                <!--Sign In Form -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div id="text-fields">

                        <!-- Input Fields. They retain user input and show an error message if they are empty -->
                        <input id="usernameField" type="text" placeholder="Username" name="loging_username" value="<?php echo $username; ?>" required >
                        <span id="error"><?php echo $username_err; ?></span>
                        <input id="passwordField" type="password" placeholder="Password" name="loging_password" required>
                        <span id="error"><?php echo $password_err; ?></span>
                    </div>
                    <div id="remember-me-button">
                        <input type="checkbox" id="remember-me" name="remember-me" value="yes">
                        <!-- Learn how to utilize the remember me button -->
                        <label class="form-check-label" >
                            Remember Me
                        </label>
                        </div>
                        <!-- Reset password page -->
                        <div id="forgot-password-link">
                        <a href="PasswordReset.php" class="text-body">Forgot Password?</a>
                    </div>
                    <div id="button-wrapper">
                        <button id="submit-button" type="submit">Continue</button>
                    </div>
                </form>
            </div>
            <!-- end form-wrapper -->
        </div>
        <!-- end wrapper -->
    </body>
</html>