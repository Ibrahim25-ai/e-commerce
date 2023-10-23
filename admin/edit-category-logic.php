<?php
require_once 'config/database.php';

if (isset($_POST['submit'], $_SESSION['user_is_admin'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $_SESSION['edit-category'] = "Couldn't update category. Invalid CSRF token.";
        header('location: ' . ROOT_URL . 'admin/');
        exit();
    }

    // Validate input
    if (empty($title)) {
        $_SESSION['edit-category'] = "Invalid form input on edit category page";
    } else {
        // Prepare and execute the update query
        $query = "UPDATE categories SET title=? WHERE id=? LIMIT 1";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "si", $title, $id);
        $result = mysqli_stmt_execute($stmt);
var_dump($result);
        if (!$result) {
            $_SESSION['edit-category'] = "Couldn't update category";
        } else {
            $_SESSION['edit-category-success'] = "Category $title updated successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-categories.php');
exit();
