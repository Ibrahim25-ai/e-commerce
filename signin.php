<?php
require 'config/constants.php';

$username_email = isset($_SESSION['signin-data']['username_email']) ? $_SESSION['signin-data']['username_email'] : '';
$password = isset($_SESSION['signin-data']['password']) ? $_SESSION['signin-data']['password'] : '';
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mass And Muscle</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body>


    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign In</h2>
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['signin'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form method="POST" action="https://www.massandmuscle.tn/signin-logic.php" >
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username or Email">
                <input type="password" name="password" value="<?= $password ?>" placeholder="Password">
                <button type="submit" name="submit" class="btn">Sign In</button>
                <small>Don't have account? <a href="signup.php">Sign Up</a></small>
            </form>
        </div>
    </section>


</body>

</html>