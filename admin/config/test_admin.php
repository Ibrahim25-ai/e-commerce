<?php 
include 'partials/header.php';

// check if the user is an admin
if (!isset($_SESSION['user_is_admin']) || $_SESSION['user_is_admin'] !== true) {
    // redirect the user to the homepage or show an error message
    header('location: ' . ROOT_URL . 'blog.php');
    
}