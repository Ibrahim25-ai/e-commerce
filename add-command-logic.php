<?php
require 'config/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $adresse = filter_var($_POST['adr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $tel =   filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);


    // set is_featured to 0 if unchecked
    $is_featured =  0;

    // validate form data
    if (!$name) {
        $_SESSION['add-command'] = "Enter command title";
    } elseif (!$tel) {
        $_SESSION['add-command'] = "Select command category";
    } elseif (!$adresse) {
        $_SESSION['add-command'] = "Enter command body";
    }

        // set is_featured of all psots to 0 if is_featured for this post is 1
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE command SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }
    
        // insert post into database
        $query = "INSERT INTO commande (name, email, tel,product_id,adresse) VALUES ('$name', '$email', $tel,$id,'$adresse')";

        $result = mysqli_query($connection, $query);
        
        if (!mysqli_errno($connection)) {
            $_SESSION['add-command-success'] = "New command added successfully";
            header('location: ' . ROOT_URL. 'index.php' );
            die();
    }
}
die();
