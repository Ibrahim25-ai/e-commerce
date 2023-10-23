<?php
ob_start();
include 'partials/header.php';
ob_end_flush();
// check if the user is an admin
if (!isset($_SESSION['user_is_admin']) || $_SESSION['user_is_admin'] !== true) {
    // redirect the user to the homepage or show an error message
    header('Location: index.php');
    exit;
}
// fetch categories from database
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

$query = "SELECT * FROM packs";
$packs = mysqli_query($connection, $query);

// get back form data if form was invalid
$title = $_SESSION['add-product-data']['title'] ?? null;
$body = $_SESSION['add-product-data']['body'] ?? null;

// delete form data session
unset($_SESSION['add-product-data']);
?>



<section>
    <div class="container-fluid form__section-container mb-5 ">
        <h2>Add Product</h2>
        <?php if (isset($_SESSION['add-product'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-product'];
                    unset($_SESSION['add-product']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="https://www.massandmuscle.tn/admin/add-product-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <textarea rows="10" name="body" placeholder="Body"><?= $body ?></textarea>
            <label for="category">Add Category</label>
            <select name="category">

                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <div class="form__control">
                <label>Add Price</label>
                <input type="int" name="prix_org" id="prix_org">
            </div>
            <div class="form__control">
                <label>New Price</label>
                <input type="int" name="prix_aft" id="prix_aft">
            </div>
            <label for="pack">Add To Pack</label>
            <select name="pack">
                <?php while ($pack = mysqli_fetch_assoc($packs)) : ?>
                    <option value="<?= $pack['id'] ?>"><?= $pack['title'] ?></option>
                <?php endwhile ?>
            </select>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <div class="form__control inline">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                    <label for="is_featured">Featured</label>
                </div>
            <?php endif ?>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <div class="form__control">
                <label>Add promo</label>
                <input type="int" name="promo" id="promo">
            </div>
            <label>New</label>
            <select name="new">
                <option value="1">True</option>
                <option value="0">False</option>
            </select>
            <button type="submit" name="submit" class="btn">Add product</button>
        </form>
    </div>
</section>


<?php
include '../partials/footer.php';
?>