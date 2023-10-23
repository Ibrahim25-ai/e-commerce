<?php
ob_start();
include 'partials/header.php';
ob_end_flush();
// check if the user is an admin
if (!isset($_SESSION['user_is_admin']) || $_SESSION['user_is_admin'] !== true) {
    // redirect the user to the homepage or show an error message
    header('location: ' . ROOT_URL . 'blog.php');
    
}
// get back form data if invalid
$title = $_SESSION['add-pack-data']['title'] ?? null;


unset($_SESSION['add-pack-data']);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Pack</h2>
        <?php if (isset($_SESSION['add-pack'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-pack'];
                    unset($_SESSION['add-pack']) ?>
                </p>
            </div>
        <?php endif ?>
        <form action="https://www.massandmuscle.tn/admin/add-pack-logic.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="text" value="<?= $title ?>" name="title" placeholder="Title">

            <button type="submit" name="submit" class="btn">Add pack</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>