<?php
ob_start();
include 'partials/header.php';
ob_end_flush();
// fetch categories from database
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $category_query);

$query = "SELECT * FROM packs";
$packs = mysqli_query($connection, $query);

// fetch post data from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $product = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
}
?>



<section>
    <?php if (isset($_SESSION['edit-product'])) : ?>
        <div class="alert__message error">
            <p>
                <?= $_SESSION['edit-product'];
                unset($_SESSION['edit-product']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <div class="container-fluid form__section-container">
        <h2>Edit Product</h2>
        <form action="https://www.massandmuscle.tn/admin/edit-product-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <input type="text" name="title" value="<?= $product['title'] ?>" placeholder="Title">
            <textarea rows="10" name="body" placeholder="Body"><?= $product['body'] ?></textarea>
            <label>Update Category</label>
            <select name="category" value="<?= $product['category_id'] ?>">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <?php if ($category['id'] == $product['category_id']) : ?>
                        <option value="<?= $category['id'] ?>" selected><?= $category['title'] ?></option>
                    <?php else : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                    <?php endif ?>

                <?php endwhile ?>
            </select>
            <div class="form__control">
                <label>Update Old Price</label>
                <input type="int" value="<?= $product['prix_org'] ?>" name="prix_org" id="prix_org">
            </div>
            <div class="form__control">
                <label>Update New Price</label>
                <input type="int" value="<?= $product['prix_aft'] ?>" name="prix_aft" id="prix_aft">
            </div>
            <label for="pack">Edit Pack</label>
            <select name="pack">

                <?php while ($pack = mysqli_fetch_assoc($packs)) : ?>
                    <?php if ($pack['id'] == $product['pack_id']) : ?>
                        <option value="<?= $pack['id'] ?>" selected><?= $pack['title'] ?></option>
                    <?php else : ?>
                        <option value="<?= $pack['id'] ?>"><?= $pack['title'] ?></option>
                    <?php endif ?>
                <?php endwhile ?>
            </select>
            <div class="form__control inline">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" checked>
                <label for="is_featured">Featured</label>
            </div>
            <input type="hidden" name="previous_thumbnail_name" value="<?= $product['thumbnail'] ?>">
            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <div class="form__control">
                <label>Update promo</label>
                <input type="int" value="<?= $product['promo'] ?>" name="promo" id="promo">
            </div>
            <label>New</label>
            <select name="new">
                <option value="1">True</option>
                <option value="0">False</option>
            </select>
            <button type="submit" name="submit" class="btn">Update Product</button>
        </form>
    </div>
</section>


<?php
include '../partials/footer.php';
?>