<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Check CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['edit-pack'] = "Couldn't update pack. Invalid CSRF token.";
        header('location: ' . ROOT_URL . 'admin/');
        die();
    }

    // validate input
    if (!$title) {
        $_SESSION['edit-pack'] = "Invalid form input on edit pack page";
    } else {
        $stmt = $connection->prepare("UPDATE packs SET title=? WHERE id=? LIMIT 1");
        $stmt->bind_param("si", $title, $id);
        $stmt->execute();

        if ($stmt->errno) {
            $_SESSION['edit-pack'] = "Couldn't update pack";
        } else {
            $_SESSION['edit-pack-success'] = "Pack $title updated successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-packs.php');
die();
