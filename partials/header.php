<?php
require 'config/database.php';

$query = "SELECT * FROM packs";
$packs = mysqli_query($connection, $query);
$query = "SELECT * FROM products ORDER BY promo DESC Limit 0,4";
$products2 = mysqli_query($connection, $query);
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);
$categories1 = mysqli_query($connection, $query);



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mass And Muscle</title>
  <link rel="icon" type="image/x-icon" href="<?= ROOT_URL ?>images/mass.png">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/bootstrap.min.css">
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style1.css">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>


<body>

    <nav class=" nav megamenu nav__container navbar-expand-lg">

        <div class=" container-fluid nav__container ">
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
            <img class="logo__img " src="<?= ROOT_URL ?>images/mass.png">
            <div class="nav__text">
                <a href="https://www.massandmuscle.tn/index.php" class="nav__logo fw-bold fs-4">MASS<span style="color:hsl(51, 91%, 60%);">&</span>MUSCLE<span class="fs-4" style="color:hsl(51, 91%, 60%);">.</span></a>
                <span class="slogan text-nowrap ">The access of healthynutrition</span>
            </div>



            <ul class="nav__items">
                <ul class="megamenu-nav d-flex justify-content-center" role="menu">
                    <li class="nav-item d-none d-lg-block is-parent">
                        <a class="nav-link" href="<?= ROOT_URL ?>index.php" id="megamenu-dropdown-1" aria-haspopup="true" aria-expanded="false">
                            OUR PACKS<i class="fa fa-angle-down"></i>
                        </a>
                        <div class="megamenu-content" aria-labelledby="megamenu-dropdown-1">
                            <div class="container">
                                <div class="row">
                                    <div class="col-8 pr-5">
                                        <div class="row">
                                            <div class="col-6">
                                                <h3 class="cc">OUR PACKS</h3>
                                                <hr>
                                                <ul class="subnav">
                                                    <?php while ($pack = mysqli_fetch_assoc($packs)) : ?>
                                                        <?php if ($pack['id'] != 12) : ?>
                                                            <li class="subnav-item">
                                                                <a href="<?= ROOT_URL ?>/index2.php?id=<?= $pack['id'] ?>" class="subnav-link">> <?= $pack['title'] ?></a>
                                                            </li>
                                                        <?php endif ?>
                                                    <?php endwhile ?>
                                                </ul>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <img src="./images/1.jpg" class="img-fluid mb-3" alt="test image">
                                                <img src="./images/1ze.jpg" class="img-fluid mb-3" alt="test image">
                                            </div>
                                        </div>
                                        <hr>

                                    </div>
                                    <div class="col-4 mt-3">
                                        <img src="./images/45.jpg" class="img-fluid mb-3" style="max-height: 10rem;" alt="test image">
                                        <img src="./images/45.jpg" class="img-fluid mb-3" style="max-height: 10rem;" alt="test image">
                                        <p>
                                          
                                        </p>
                                        <a href="#">See more <i class="fa fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block is-parent">
                        <a class="nav-link" href="<?= ROOT_URL ?>index.php" id="megamenu-dropdown-2" aria-haspopup="true" aria-expanded="false">
                            CATEGORIES<i class="fa fa-angle-down"></i>
                        </a>
                        <div class="megamenu-content" aria-labelledby="megamenu-dropdown-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-8 pr-5">
                                        <div class="row">
                                            <div class="col-6">
                                                <h3 class="cc">Our Categories</h3>
                                                <hr>
                                                <ul class="subnav">

                                                    <?php while ($categ = mysqli_fetch_assoc($categories)) : ?>
                                                        <?php if ($categ['id'] != 19) : ?>
                                                            <li class="subnav-item">
                                                                <a class="subnav-link" href="<?= ROOT_URL ?>/index1.php?cat=<?= $categ['id'] ?>"><?= $categ['title'] ?></a>
                                                            </li>
                                                        <?php endif ?>

                                                    <?php endwhile ?>

                                                </ul>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <img src="./images/45.jpg" class="img-fluid mb-3" style="max-height: 10rem;" alt="test image">
                                                <img src="./images/45.jpg" class="img-fluid mb-3" style="max-height: 10rem;" alt="test image">
                                                <p>
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, expedita sint quis rem amet, a nihil, non sunt ea quasi.
                                                </p>
                                                <a href="#">See more <i class="fa fa-angle-double-right"></i></a>
                                            </div>

                                            <!--<div class="col-3 mt-3">
                                                <img src="./images/1.jpg" class="img-fluid mb-3" alt="test image">
                                                <img src="./images/1ze.jpg" class="img-fluid mb-3"  alt="test image">
                                            </div>-->
                                        </div>
                                        <hr>

                                    </div>
                                    <!--<div class="col-4 mt-3">
                                        <img src="./images/45.jpg" class="img-fluid mb-3" style="max-height: 10rem;" alt="test image">
                                        <img src="./images/45.jpg" class="img-fluid mb-3" style="max-height: 10rem;" alt="test image">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, expedita sint quis rem amet, a nihil, non sunt ea quasi.
                                        </p>
                                        <a href="#">See more <i class="fa fa-angle-double-right"></i></a>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block is-parent">
                        <a class="nav-link" href="<?= ROOT_URL ?>index.php" id="megamenu-dropdown-3" aria-haspopup="true" aria-expanded="true">
                            PROMOTIONS<span class="position top-0 start-100 text-align-center  badge rounded-pill bg-warning">
                                Promo</span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="megamenu-content" aria-labelledby="megamenu-dropdown-3">
                            <div class="container  text-center mt-5 mb-5">
                                <div class="row wrapper rounded fade show active" id="pills-home">
                                    <?php if (mysqli_num_rows($products2) > 0) : ?>


                                        <?php while ($product = mysqli_fetch_assoc($products2)) : ?>
                                            <!-- get category title of each post from categories table -->

                                            <div class="col-lg-3 col-md-4  p-4">
                                                <div class="col menu-item">
                                                    <div class="card border-0 text-center">
                                                        <div class="card-body ">
                                                            <?php if ($product['new'] && $product['promo'] == 0) : ?>
                                                                <div class=" notify-badge rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0">
                                                                    <span class="badge  badge-secondary " style="font-size: 0.9rem;">New</span>
                                                                </div>
                                                            <?php endif ?>
                                                            <?php if ($product['new'] && $product['promo'] != 0) : ?>
                                                                <div class=" notify-badge rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0 " style="margin-top: 3.5rem;">
                                                                    <span class="badge  badge-secondary " style="font-size: 0.9rem;">New</span>
                                                                </div>
                                                            <?php endif ?>
                                                            <?php if ($product['promo'] != 0) : ?>
                                                                <div class="notify-badge  rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0 ">
                                                                    <span class="badge badge-secondary " style="font-size: 0.9rem;">-<?= $product['promo'] ?>%</span>
                                                                </div>
                                                            <?php endif ?>

                                                            <div class="card-image">

                                                                <img src="<?= ROOT_URL ?>images/<?= $product['thumbnail'] ?>" class="menu-img prod_img" width="0">

                                                            </div>

                                                            <div class="card-inner prod__desc">
                                                                <p class="fw-bolder  text-truncate prod_title"><?= $product['title'] ?></h4>

                                                                <div class="row align-items-center">
                                                                    <div class="col-6   text-end ">

                                                                        <p class="text-nowrap text-decoration-line-through fw-lighter"><?= $product['prix_org'] ?> DT</p>
                                                                    </div>
                                                                    <div class="col-6  text-start prod_prix_aft">
                                                                        <p class=" text-nowrap fw-bolder " style="color:hsl(51, 91%, 60%);"><?= $product['prix_aft'] ?> DT</p>
                                                                    </div>
                                                                </div>

                                                                <div class=" d-flex justify-content-center">
                                                                    <a href="<?= ROOT_URL ?>/producttest.php?id=<?= $product['id'] ?>&cat_id=<?= $product['category_id'] ?>">
                                                                        <button class="button-86" role="button">Buy</button>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- Menu Item -->
                                            </div>
                                        <?php endwhile ?>
                                    <?php else : ?>
                                        <div class="alert__message error"><?= "No products found" ?></div>
                                    <?php endif ?>


                                </div>
                            
                        </div>
                    </li>

                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link text-black" href="<?= ROOT_URL ?>contact.php" aria-haspopup="true" aria-expanded="false">
                            CONTACT <i class="fa fa-angle-down"></i>
                        </a>
                    </li>




                </ul>
                <li class="nav-item d-lg-none">
                    <a class="nav-link text-black" href="index.php">Home</a>
                </li>
                <?php if (mysqli_num_rows($categories) > 0) : ?>
                    <?php while ($catega = mysqli_fetch_assoc($categories1)) : ?>
                        <?php if ($catega['id'] != 19) : ?>
                            <li class="nav-item  d-lg-none">
                                <a class="nav-link text-black" href="<?= ROOT_URL ?>/index1.php?cat=<?= $catega['id'] ?>"><?= $catega['title'] ?></a>
                            </li>
                        <?php endif ?>

                    <?php endwhile ?>
                <?php else : ?>
                    <div class="alert__message error"><?= "No categories found" ?></div>
                <?php endif ?>
                <div class="megamenu-background" id="megamenu-background"></div>
        

    </nav>
    <div class="megamenu-dim" id="megamenu-dim"></div>
    <!--====================== END OF NAV ====================-->