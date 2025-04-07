<?php
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err =  "";
$login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["loging_username"]))){
        $username_err = "*Name is required.";
    } else{
        $username = trim($_POST["loging_username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["loging_password"]))){
        $password_err = "*Password is required.";
    } else{
        $password = trim($_POST["loging_password"]);
    }

    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password, status FROM users WHERE username = ?";
        
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $status);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
                                // session hasn't started
                                session_start();
                            }
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;   
                            $_SESSION["status"] = $status;                        
                            // Redirect user to appropriate profile page
                            if($_SESSION["status"] == "creator")
                            {
                                header("location: Creator.php");
                            }
                            else{
                                header("location: SimpleUser.php");
                            }
                            
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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