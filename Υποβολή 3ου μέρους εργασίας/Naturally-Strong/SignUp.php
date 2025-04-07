<?php
require_once "config/config.php";

require 'includes/form_handlers/register_handler.php'  
?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Page-Naturally Strong</title>
        <link rel="icon" href="images/page_images/Logo.jpg">
        <link rel="stylesheet" href="styles/SignUp.css">
        <script src="SignUp.js" defer></script>
    </head>


    <body>
        <!-- Page Wrapper-->
        <div id="wrapper">
            <!-- Registration Form-->
            <form id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
             	
                <!-- Logo Image -->
                <div id="logo-wrapper">
                    <p>Please fill this form to create an account. </p>
                    <img src="images/page_images/Logo.jpg" alt="Logo">
                </div>
                <!-- Textfields -->
                <div id="text-fields">
                    <div id="username-field">
                        <p>New Username:</p>
                        <input type="text" placeholder="Username" name="reg_username" value ="<?php if (isset($_SESSION["reg_username"])){
                            echo $_SESSION["reg_username"];
                        } ?>" required >
                        <span id="error">* <br> <?php echo $username_err;?> </span>
                    </div>
                    <div id="email-field">
                        <p>Email:</p>
                        <input type="email" placeholder="Email" name="reg_email" value ="<?php if (isset($_SESSION["reg_email"])){
                            echo $_SESSION["reg_email"];
                         } ?>" required>
                         <span id="error">* <br> <?php echo $email_err;?> </span>
                    </div>
                    <div id="password-field">
                        <p>New Password:</p>
                        <input type="password" placeholder="Password" name="reg_password" required>
                        <span id="error">* <br> <?php echo $password_err;?> </span>
                    </div>
                    <div id="repeat-password-field">
                        <p>Repeat Password:</p>
                        <input type="password" placeholder="Repeat Password" name="repeat-reg_password" required>
                        <span id="error">* <br> <?php echo $confirm_password_err;?> </span>
                    </div>
                </div>
                <!-- Account type selection -->
                <div id="form-bottom">
                    <div id="user-type-box">
                        <input type="radio" id="creator" name="reg_user-type" value="creator" required>
                        <label for="creator">Creator</label><br>
                        <input type="radio" id="simple-user" name="reg_user-type" value="user" required>
                        <label for="simple-user">Simple User</label>
                        <br><span id="error"> <?php echo $status_err;?> </span>
                    </div>
                </div>
                <!-- Submit Button -->
                <div id="submit-box">
                    <input type="submit" name="submit_button" value="Register">
                </div>
            </form>
            <?php echo $email_err ?>
            <!-- end signup-form -->
        </div>
        <!-- end wrapper -->
    </body>
</html>