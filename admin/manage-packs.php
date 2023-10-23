<?php
ob_start();
include 'partials/header.php';
ob_end_flush();
// fetch categories from database
$query = "SELECT * FROM packs ORDER BY title";
$packs = mysqli_query($connection, $query);
?>




<section class="dashboard">

    <?php if (isset($_SESSION['add-pack-success'])) : // shows if add pack was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['add-pack-success'];
                unset($_SESSION['add-pack-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['add-pack'])) : // shows if add pack was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['add-pack'];
                unset($_SESSION['add-pack']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-pack'])) : // shows if edit pack was NOT successful
    ?>
        <div class="alert__message error container">
            <p>
                <?= $_SESSION['edit-pack'];
                unset($_SESSION['edit-pack']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-pack-success'])) : // shows if edit pack was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['edit-pack-success'];
                unset($_SESSION['edit-pack-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-pack-success'])) : // shows if delete pack was successful
    ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION['delete-pack-success'];
                unset($_SESSION['delete-pack-success']);
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
            <h2>Manage Packs</h2>
            <?php if (mysqli_num_rows($packs) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($pack = mysqli_fetch_assoc($packs)) : ?>
                            <tr>
                                <td><?= $pack['title'] ?></td>
                                <td><a href="https://www.massandmuscle.tn/admin/edit-pack.php?id=<?= $pack['id'] ?>" class="btn sm">Edit</a></td>
                                <td> <form method="POST" action="https://www.massandmuscle.tn/admin/delete-pack.php">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <input type="hidden" name="id" value="<?= $pack['id'] ?>">
    <button type="submit" class="btn sm danger">Delete</button>
</form>              </td>      
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No packs found" ?></div>
            <?php endif ?>
        </main>
    </div>
</section>



<?php
include '../partials/footer.php';
?>