<?php
require 'config/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
  
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['signin'] = "Couldn't sign in. Invalid CSRF token.";
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }

    // get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION['signin'] = "Username or Email required";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password Required";
    } else {
        // fetch user from database
        $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            // convert the record into assoc array
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['password'];
            // compare form password with database password
            if (password_verify($password, $db_password)) {
                // set session for access control
                $_SESSION['user-id'] = $user_record['id'];
                // set session if user is an admin
                if ($user_record['is_admin'] == 1) {
                   $_SESSION['user_is_admin'] = true;
                }
                header('location: ' . ROOT_URL . 'admin/index.php');
                 die();
            }
       
    
        }
        
    }
 $_SESSION['signin'] = "Incorrect Password";
    header('location: ' . ROOT_URL . 'signin.php');
    
}