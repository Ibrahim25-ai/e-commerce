<?php
require 'config/database.php';

if (isset($_POST['id']) && isset($_SESSION['user_is_admin'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    // Check CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['delete-category'] = "Couldn't delete category. Invalid CSRF token.";
        header('location: ' . ROOT_URL . 'admin/manage-categories.php');
        die();
    }

    // update category_id of products that belong to this category to id of uncategorized category
    $update_query = "UPDATE products SET category_id=19 WHERE category_id=$id";
    $update_result = mysqli_query($connection, $update_query);

    if (!mysqli_errno($connection)) {
        // delete category
        $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        $_SESSION['delete-category-success'] = "Category deleted successfully";
    } else {
        $_SESSION['delete-category'] = "Couldn't delete category";
    }
}
header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
