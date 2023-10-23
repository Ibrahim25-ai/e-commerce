<?php
ob_start();
include 'partials/header.php';
ob_end_flush();
// check if the user is an admin
// fetch current user's posts from database
$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title,thumbnail, category_id FROM products ORDER BY id DESC";
$products = mysqli_query($connection, $query);
?>




<section class="dashboard">
    <?php if (isset($_SESSION['add-product-success'])) : // shows if add post was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-product-success'];
                unset($_SESSION['add-product-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-product-success'])) : // shows if edit product was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-product-success'];
                unset($_SESSION['edit-product-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-product'])) : // shows if edit product was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-product'];
                unset($_SESSION['edit-product']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-product-success'])) : // shows if delete product was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-product-success'];
                unset($_SESSION['delete-product-success']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <div class="container dashboard__container">
        
            <ul>
                <li>
                    <a href="add-product.php" ><i class="uil uil-pen "></i>
                        <h5>Add Product</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php" class="active"><i class="uil uil-postcard"></i>
                        <h5>Manage Products</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="add-user.php"><i class="uil uil-user-plus"></i>
                            <h5>Add User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Manage User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-pack.php"><i class="uil uil-edit"></i>
                            <h5>Add Pack</h5>
                        </a>
                    </li>

                    <li>
                        <a href="manage-packs.php"><i class="uil uil-list-ul"></i>
                            <h5>Manage packs</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php"><i class="uil uil-edit"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php"><i class="uil uil-list-ul"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-commands.php"><i class="uil uil-list-ul"></i>
                            <h5>Manage Commands</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
       
        <main>
            <h2>Manage Products</h2>
            <?php if (mysqli_num_rows($products) > 0) : ?>
          <div style="overflow-x:auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($product = mysqli_fetch_assoc($products)) : ?>
                            <!-- get category title of each post from categories table -->
                            <?php
                            $category_id = $product['category_id'];
                            $category_query = "SELECT title FROM categories WHERE id=$category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                            ?>
                            <tr>
                                <td><?= $product['title'] ?></td>
                                <td><?= $category['title'] ?></td>
                                <td><img src="<?= ROOT_URL ?>images/<?= $product['thumbnail'] ?>" class="menu-img prod_img" width="0"></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-product.php?id=<?= $product['id'] ?>" class="btn sm">Edit</a></td>
                                <td> <form method="POST" action="https://www.massandmuscle.tn/admin/delete-product.php">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <button type="submit" class="btn sm danger">Delete</button>
</form>              </td>              </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
          </div>
            <?php else : ?>
                <div class="alert__message error"><?= "No products found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>


<?php
include '../partials/footer.php';
?>