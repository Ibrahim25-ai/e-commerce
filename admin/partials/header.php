<?php
require '../partials/header.php';


if (!isset($_SESSION['user_is_admin']) || $_SESSION['user_is_admin'] !== true) {
    // redirect the user to the homepage or show an error message
    header('location: ' . ROOT_URL . 'index.php');
    
}


?>

