<?php
// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = $status = $date = "";
$username_err = $email_err = $password_err = $confirm_password_err = $status_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["reg_username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["reg_username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["reg_username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // store result 
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["reg_username"]);
                    $_SESSION["reg_username"] = $username;
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }   
    }

    // validate Email
    $email = trim($_POST["reg_email"]);
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
                    $email_err = "This email has been used before.";
                } else{
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL );
                    $_SESSION["reg_email"] = $email;
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    
    // Validate password
    if(empty(trim($_POST["reg_password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["reg_password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["reg_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["repeat-reg_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["repeat-reg_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // validate status
    if (empty($_POST["reg_user-type"])) {
        $status_err = "Please choose an account type";
    } else {
        $status = $_POST["reg_user-type"];
    }

    // validate date
    $date = date("Y-m-d");

    // validate pdf existence
    
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($status_err)){

        $rand = rand(1,16);
        $randomly_assigned_profile_pic = "images/profile_pic/default/head_" . $rand. "png";
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password, profile_pic, status) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username,$param_email,$param_password, $param_profile_pic, $param_status); //I FOUND IT YOU NEED TO HAVE THE SAME NUMBER of s in the second argument
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_profile_pic = $randomly_assigned_profile_pic;
            $param_status = $status;

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                session_unset();
                session_destroy();
                // Redirect to login page
                header("location: SignIn.php");
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