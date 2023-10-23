<?php
ob_start();
include 'partials/header.php';
ob_end_flush();
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch category from database
    $query = "SELECT * FROM packs WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $pack = mysqli_fetch_assoc($result);
    }
} else {
    header('location: ' . ROOT_URL . 'admin/manage-packs');
    die();
}
?>


<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Pack</h2>
        <form action="https://www.massandmuscle.tn/admin/edit-pack-logic.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="hidden" name="id" value="<?= $pack['id'] ?>">
            <input type="text" name="title" value="<?= $pack['title'] ?>" placeholder="Title">
            <button type="submit" name="submit" class="btn">Update pack</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>