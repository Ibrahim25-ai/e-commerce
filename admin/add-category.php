<?php
ob_start();
include 'partials/header.php';
ob_end_flush();

// check if the user is an admin
if (!isset($_SESSION['user_is_admin']) || $_SESSION['user_is_admin'] !== true) {
    // redirect the user to the homepage or show an error message
    header('Location: blog.php');
    exit;
}
// get back form data if invalid
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <?php if (isset($_SESSION['add-category'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']) ?>
                </p>
            </div>
        <?php endif ?>
        <form action="https://www.massandmuscle.tn/admin/add-category-logic.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="text" value="<?= $title ?>" name="title" placeholder="Title">
            <textarea rows="4" value="<?= $description ?>" name="description" placeholder="Description"></textarea>
            <button type="submit" name="submit" class="btn">Add Category</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>