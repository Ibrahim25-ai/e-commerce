<?php
ob_start();
include 'partials/header.php';
ob_end_flush();
// fetch categories from database
$query = "SELECT * FROM commande ORDER BY date_time DESC";
$Commands = mysqli_query($connection, $query);
?>




<section class="dashboard">

    <?php if (isset($_SESSION['add-command-success'])) : // shows if add command was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-command-success'];
                unset($_SESSION['add-command-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['add-command'])) : // shows if add command was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['add-command'];
                unset($_SESSION['add-command']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-command'])) : // shows if edit command was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-command'];
                unset($_SESSION['edit-command']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-command-success'])) : // shows if edit command was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-command-success'];
                unset($_SESSION['edit-command-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-command-success'])) : // shows if delete command was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-command-success'];
                unset($_SESSION['delete-command-success']);
                ?>
            </p>
        </div>

    <?php endif ?>
    <div class="container dashboard__container">
        
            <ul>
                <li>
                    <a href="add-product.php"><i class="uil uil-pen"></i>
                        <h5>Add Product</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php"><i class="uil uil-postcard"></i>
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
                        <a href="add-category.php"><i class="uil uil-edit"></i>
                            <h5>Add Category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php" class="active"><i class="uil uil-list-ul"></i>
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
            <h2>Manage Commands</h2>
            <?php if (mysqli_num_rows($Commands) > 0) : ?>
          <div style="overflow-x:auto;">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tel</th>
                            <th>Adr</th>
                            <th>Email</th>
                            <th>Product</th>
                            <th>image</th>
                            <th>Prix</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($Commande = mysqli_fetch_assoc($Commands)) : ?>
                            <tr>
                                <td><?= $Commande['name'] ?></td>
                                <td><?= $Commande['tel'] ?></td>
                                <td><?= $Commande['adresse'] ?></td>
                                <td><?= $Commande['email'] ?></td>
                                <?php
                                $a = $Commande['product_id'];
                                $query = "SELECT * FROM products where id = $a";
                                $products = mysqli_query($connection, $query);
                                ?>
                                <?php while ($product = mysqli_fetch_assoc($products)) : ?>
                                <td><?= $product['title'] ?></td>
                                <td><img src="<?= ROOT_URL ?>images/<?= $product['thumbnail'] ?>" class="menu-img prod_img" width="0"></td>
                                <td><?= $product['prix_aft'] ?></td>
                                <?php endwhile ?>
                                <td> <form method="POST" action="https://www.massandmuscle.tn/admin/delete-command.php">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <input type="hidden" name="id" value="<?= $Commande['id'] ?>">
    <button type="submit" class="btn sm danger">Delete</button>
</form>              </td>      
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
          </div>
            <?php else : ?>
                <div class="alert__message error"><?= "No categories found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>



<?php
include '../partials/footer.php';
?>