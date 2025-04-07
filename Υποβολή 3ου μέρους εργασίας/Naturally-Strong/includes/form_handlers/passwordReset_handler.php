<?php
// Define variables and initialize with empty values
$new_password = $confirm_password = $email = "";
$new_password_err = $confirm_password_err = $email_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // validate Email
    $email = trim($_POST["email"]);
    if(empty($email)){
        $email_err= "Please enter an email";
    }
    /*
    elseif(filter_var($email, FILTER_VALIDATE_EMAIL )) {
        $email_err= "Please enter a valid email";
    }
    Come back to this later. Required command will suffice for now*/
    else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = filter_var($email, FILTER_VALIDATE_EMAIL );
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // store result 
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL );
                } else{
                    $email_err = "There is no account with this email";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_email);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: SignIn.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>