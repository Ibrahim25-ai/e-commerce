<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_is_admin'])) {
    // get and sanitize form data
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$title) {
        $_SESSION['add-pack'] = "Enter title";
    }
     // Check CSRF token
     if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['edit-product'] = "Couldn't update product. Invalid CSRF token.";
        header('location: ' . ROOT_URL . 'admin/');
        die();
    }

    // redirect back to add pack page with form data if there was invalid input
    if (isset($_SESSION['add-pack'])) {
        $_SESSION['add-pack-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-pack.php');
        exit();
    } else {
        // prepare and execute SQL statement to insert pack into database
        $stmt = mysqli_prepare($connection, "INSERT INTO packs (title) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "s", $title);
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            $_SESSION['add-pack'] = "Couldn't add pack";
            header('location: ' . ROOT_URL . 'admin/add-pack.php');
            exit();
        } else {
            $_SESSION['add-pack-success'] = "$title pack added successfully";
            header('location: ' . ROOT_URL . 'admin/manage-packs.php');
            exit();
        }
    }
}
?>