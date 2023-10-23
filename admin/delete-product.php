<?php
require 'config/database.php';

if (isset($_POST['id']) && isset($_SESSION['user_is_admin'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch product from database in order to delete thumbnail from images folder
    $query = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($connection, $query);
  // Check CSRF token
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['edit-product'] = "Couldn't update product. Invalid CSRF token.";
    header('location: ' . ROOT_URL . 'admin/');
    die();
}
    // make sure only 1 record/product was fetched
    if (mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
        $thumbnail_name = $product['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        if ($thumbnail_path && file_exists($thumbnail_path)) {
            unlink($thumbnail_path);

            // delete product from database
            $delete_product_query = "DELETE FROM products WHERE id=$id LIMIT 1";
            $delete_product_result = mysqli_query($connection, $delete_product_query);

            if (!mysqli_errno($connection)) {
                $_SESSION['delete-product-success'] = "Product deleted successfully";
            }
        } else {
            $_SESSION['delete-product'] = "Error: thumbnail not found";
        }
    } else {
        $_SESSION['delete-product'] = "Error: product not found";
    }
}

header('location: ' . ROOT_URL . '/admin/index.php');
die();
