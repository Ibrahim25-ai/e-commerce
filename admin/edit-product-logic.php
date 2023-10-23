<?php
require 'config/database.php';

// Make sure edit product button was clicked and user is admin
if (isset($_POST['submit']) && isset($_SESSION['user_is_admin'])) {
    // Sanitize input data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];
    $prix_org = filter_var($_POST['prix_org'], FILTER_SANITIZE_NUMBER_INT);
    $prix_aft = filter_var($_POST['prix_aft'], FILTER_SANITIZE_NUMBER_INT);
    $pack_id = filter_var($_POST['pack'], FILTER_SANITIZE_NUMBER_INT);
    $promo = filter_var($_POST['promo'], FILTER_SANITIZE_NUMBER_INT);
    $new = filter_var($_POST['new'], FILTER_SANITIZE_NUMBER_INT);

    // Set is_featured to 0 if it was unchecked
    $is_featured = $is_featured == 1 ?: 0;

    // Check and validate input values
    if (!$title || !$category_id || !$body) {
        $_SESSION['edit-product'] = "Couldn't update product. Invalid form data on edit product page.";
        header('location: ' . ROOT_URL . 'admin/');
        die();
    }

    // Check CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['edit-product'] = "Couldn't update product. Invalid CSRF token.";
        header('location: ' . ROOT_URL . 'admin/');
        die();
    }

    // Validate thumbnail file
    if ($thumbnail['name']) {
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = pathinfo($thumbnail['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($extension), $allowed_files)) {
            $_SESSION['edit-product'] = "Couldn't update product. Thumbnail should be png, jpg or jpeg.";
            header('location: ' . ROOT_URL . 'admin/');
            die();
        }

        if ($thumbnail['size'] > 2000000) {
            $_SESSION['edit-product'] = "Couldn't update product. Thumbnail size too big. Should be less than 2mb.";
            header('location: ' . ROOT_URL . 'admin/');
            die();
        }
    }

    // Delete existing thumbnail if new thumbnail is available
    if ($thumbnail['name']) {
        $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;

        if (file_exists($previous_thumbnail_path)) {
            unlink($previous_thumbnail_path);
        }

        // Work on new thumbnail
        $time = time(); // make each image name upload unique using current timestamp
       
        $thumbnail_name = $time . '_' . $thumbnail['name'];
        $thumbnail_path = '../images/' . $thumbnail_name;
            // Upload new thumbnail
    if (!move_uploaded_file($thumbnail['tmp_name'], $thumbnail_path)) {
        $_SESSION['edit-product'] = "Couldn't update product. Error uploading thumbnail.";
        header('location: ' . ROOT_URL . 'admin/');
        die();
    }
} else {
    // Use previous thumbnail
    $thumbnail_name = $previous_thumbnail_name;
}

// Update product in the database
$sql = 'UPDATE products SET title = ?, body = ?, category_id = ?, is_featured = ?, thumbnail = ?, prix_org = ?, prix_aft = ?, pack_id = ?, promo = ?, new = ? WHERE id = ?';
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, 'ssiisddiiii', $title, $body, $category_id, $is_featured, $thumbnail_name, $prix_org, $prix_aft, $pack_id, $promo, $new, $id);
mysqli_stmt_execute($stmt);


$_SESSION['edit-product'] = "Product updated successfully.";
header('location: ' . ROOT_URL . 'admin/');
die();
}