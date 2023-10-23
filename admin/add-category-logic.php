<?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && isset($_SESSION['user_is_admin'])) {
    // get form data
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate form data
    if (empty($title)) {
        $_SESSION['add-category'] = "Enter title";
    } elseif (empty($description)) {
        $_SESSION['add-category'] = "Enter description";
    }
     // Check CSRF token
     if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['edit-product'] = "Couldn't update product. Invalid CSRF token.";
        header('location: ' . ROOT_URL . 'admin/');
        die();
    }


    // redirect back to add category page with form data if there was invalid input
    if (isset($_SESSION['add-category'])) {
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        exit;
    } else {
        // prepare and execute query
        $stmt = $connection->prepare("INSERT INTO categories (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);
        $stmt->execute();

        // check for errors
        if ($stmt->errno) {
            $_SESSION['add-category'] = "Couldn't add category";
            header('location: ' . ROOT_URL . 'admin/add-category.php');
            exit;
        } else {
            $_SESSION['add-category-success'] = "$title category added successfully";
            header('location: ' . ROOT_URL . 'admin/manage-categories.php');
            exit;
        }
    }
}
?>