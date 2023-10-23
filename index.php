<?php
include 'partials/header.php';


$perPage = 12;
$sqlQuery = "SELECT * FROM products where new = 1";
$result = mysqli_query($connection, $sqlQuery);
$totalRecords = mysqli_num_rows($result);
$totalPages = ceil($totalRecords / $perPage);

// fetch all posts from <posts table
$query = "SELECT * FROM products ORDER BY date_time DESC";
$products = mysqli_query($connection, $query);
$query = "SELECT * FROM products WHERE category_id=2 ORDER BY date_time DESC";
$products1 = mysqli_query($connection, $query);

$query = "SELECT * FROM products  LIMIT 0,12";
$products3 = mysqli_query($connection, $query);
//fat burner
$query = "SELECT * FROM products WHERE category_id=12 LIMIT 0,12";
$products6 = mysqli_query($connection, $query);
$query = "SELECT * FROM products ORDER BY promo DESC  ";
$products2 = mysqli_query($connection, $query);
//protein powder 
$query = "SELECT * FROM products WHERE category_id=7 LIMIT 0,12";
$products4 = mysqli_query($connection, $query);
//Mass Gainer 
$query = "SELECT * FROM products WHERE category_id=9 LIMIT 0,12";
$products5 = mysqli_query($connection, $query);

?>

<section class="search__bar">
  <form class="container search__bar-container" action="<?= ROOT_URL ?>search.php" method="GET">
    <div>
      <i class="uil uil-search"></i>
      <input type="search" name="search" placeholder="Search">
    </div>
    <button type="submit" name="submit" class="btn">Go</button>
  </form>
</section>

<section>
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" style="max-height :90vh;">
        <img src="./images/1.jpg" class="d-block"alt="...">
      </div>
      <div class="carousel-item" style="max-height :90vh;">
        <img src="./images/2.jpg" class="d-block " alt="...">
      </div>
      <div class="carousel-item" style="max-height :90vh;">
        <img src="./images/3.jpg" class="d-block w-100"  alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>
<section id="tabs">
  <div class="container-fluid p-5" data-aos="fade-up">
    <div class="section-header  text-center">
      <p class="fw-bold fs-4" style="color:hsl(51, 91%, 60%);">WELCOME TO MASS<span>&</span>MUSCLE</p>
      <p class="fw-bolder fs-2 text-black mt-5">OUR PRODUCTS</p>
    </div>

    <ul class="nav nav-tabs d-flex justify-content-center text-black mt-5" data-aos="fade-up" daqqwqwqqwta-aos-delay="200">
      <li class="nav-item">
        <button class="nav-link active show" id="pills-home-ab" data-bs-toggle="pill" data-bs-target="#NEWP" type="button" role="tab" aria-controls="pills-home" aria-selected="true">NEW PRODUCTS</button>
      </li><!-- End tab nav item -->
      <li class="nav-item">
        <button class="nav-link " id="pills-home-tb" data-bs-toggle="pill" type="button" data-bs-target="#TOPROM" role="tab" aria-controls="pills-home" aria-selected="true">TOP PROMOTIONS</button>
      </li>
      <li class="nav-item">
        <button class="nav-link " id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#TEST" type="button" role="tab" aria-controls="pills-home" aria-selected="true">BEST SALES</button>
      </li>
    </ul>

    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
      <div class="tab-pane fade active show" id="NEWP">
        <div class="container1 text-center mt-5 mb-5">
          <nav>
            <ul class="pagination navig justify-content-end ">
              <li class="page-item ">
                <a class="page-link link-prev text-dark" href="#">Previous</a>
              </li>
              <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item">
                  <a href="#" class="page-link pagination-link text-dark" data-page-number="<?= $i ?>"><?= $i ?></a>
                </li>
              <?php endfor ?>
              <li class="page-item">
                <a class="page-link link-next text-dark" href="#">Next</a>
              </li>
            </ul>
          </nav>
          <div id="product-list" class="row wrapper rounded fade show active">
          </div>
        </div>
      </div>
    </div>
    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
      <div class="tab-pane fade  " id="TOPROM">
        <div class="container1 text-center mt-5 mb-5 ">
          <div class="row wrapper rounded fade show active">
            <?php if (mysqli_num_rows($products2) > 0) : ?>
              <?php while ($product = mysqli_fetch_assoc($products2)) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 p-4">
                  <div class="col menu-item">
                    <div class="card border-0 text-center">
                      <div class="card-body ">
                        <?php if ($product['new'] && $product['promo'] == 0) : ?>
                          <div class=" notify-badge rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0">
                            <span class="badge  badge-secondary ">New</span>
                          </div>
                        <?php endif ?>
                        <?php if ($product['new'] && $product['promo'] != 0) : ?>
                          <div class=" notify-badge rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0 " style="margin-top: 3.5rem;">
                            <span class="badge  badge-secondary ">New</span>
                          </div>
                        <?php endif ?>
                        <?php if ($product['promo'] != 0) : ?>
                          <div class="notify-badge  rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0 ">
                            <span class="badge badge-secondary ">-<?= $product['promo'] ?>%</span>
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
      </div>
    </div>
    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
      <div class="tab-pane fade " id="TEST">
        <div class="container1 text-center mt-5 mb-5">

          <div class="row wrapper rounded fade show active">
            <?php if (mysqli_num_rows($products3) > 0) : ?>
              <?php while ($product = mysqli_fetch_assoc($products3)) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 p-4">
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
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container-fluid  mt-5 ">
    <div class="row g-0 justify-content-center ">
      <div class="col-lg-4    divimg"><img class="imgm rounded-start" src="<?= ROOT_URL ?>images/ts01.jpg"></div>
      <div class="col-lg-4  divimg"><img class="imgm" src="<?= ROOT_URL ?>images/ts02.jpg"></div>
      <div class="col-lg-4   divimg"><img class="imgm rounded-end" src="<?= ROOT_URL ?>images/ts26.jpg"></div>
    </div>
  </div>
</section>

<section id="tabs">
  <div class="container-fluid p-5" data-aos="fade-up">


    <ul class="nav nav-tabs d-flex justify-content-center text-black mt-5" data-aos="fade-up" daqqwqwqqwta-aos-delay="200">

      <li class="nav-item">
        <button class="nav-link active show" id="pills-home-b" data-bs-toggle="pill" data-bs-target="#T1" type="button" role="tab" aria-controls="pills-home" aria-selected="true">PROTEIN POWDER</button>
      </li><!-- End tab nav item -->
      <li class="nav-item">
        <button class="nav-link " id="pills-homeb" data-bs-toggle="pill" type="button" data-bs-target="#T2" role="tab" aria-controls="pills-home" aria-selected="true">MASS GAINER</button>
      </li>
      <li class="nav-item">
        <button class="nav-link " id="pills-homb" data-bs-toggle="pill" type="button" data-bs-target="#T3" role="tab" aria-controls="pills-home" aria-selected="true">FAT BURNER</button>
      </li><!-- End tab nav item -->

      <!-- End tab nav item -->

    </ul>

    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

      <div class="tab-pane fade active show" id="T1">
        <div class="container1 text-center mt-5 mb-5">
          <div class="row wrapper rounded fade show active">

            <?php if (mysqli_num_rows($products4) > 0) : ?>


              <?php while ($product = mysqli_fetch_assoc($products4)) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 p-4">
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
      </div>
    </div>

    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
      <div class="tab-pane fade  " id="T2">
        <div class="container1 text-center mt-5 mb-5 ">
          <div class="row wrapper rounded fade show active">

            <?php if (mysqli_num_rows($products5) > 0) : ?>


              <?php while ($product = mysqli_fetch_assoc($products5)) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 p-4">
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
      </div>
    </div>

    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
      <div class="tab-pane fade  " id="T3">
        <div class="container1 text-center mt-5 mb-5 ">
          <div class="row wrapper rounded fade show active">

            <?php if (mysqli_num_rows($products6) > 0) : ?>


              <?php while ($product = mysqli_fetch_assoc($products6)) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 p-4">
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
      </div>



</section>

<!-- ======= Services Section ======= -->
<section id="nosservice"class="services">
   <div class="container-fluid p-5 " data-aos="fade-up">

    <div class="section-header  text-center " style="margin-top: 2rem;">

      <p class="fw-bolder fs-2 text-black" style="margin-top:2rem;">CHECK OUR SERVICES</p>
    </div>

    <div class="row justify-content-center ">
      <div class="col-lg-3  " data-aos="zoom-in" data-aos-delay="100">
        <div class="icon-box">
          <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 640 512">
              <path d="M624 352h-16V243.9c0-12.7-5.1-24.9-14.1-33.9L494 110.1c-9-9-21.2-14.1-33.9-14.1H416V48c0-26.5-21.5-48-48-48H112C85.5 0 64 21.5 64 48v48H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h272c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H40c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H8c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h208c4.4 0 8 3.6 8 8v16c0 4.4-3.6 8-8 8H64v128c0 53 43 96 96 96s96-43 96-96h128c0 53 43 96 96 96s96-43 96-96h48c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zM160 464c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm320 0c-26.5 0-48-21.5-48-48s21.5-48 48-48 48 21.5 48 48-21.5 48-48 48zm80-208H416V144h44.1l99.9 99.9V256z" />
            </svg></div>
          <h4><a href="">Fast Delivery</a></h4>
          <h5>24-Hours Delivery</h5>
        </div>
      </div>
      <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="200">
        <div class="icon-box">
          <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg></div>
          <h4><a href="">Paiment on delivery</a></h4>
          <h5>Secure Paiment.</h5>
        </div>
      </div>
      <div class="col-lg-3" data-aos="zoom-in" data-aos-delay="200">
        <div class="icon-box">
          <div class="icon"><img class="h-100" src="<?= ROOT_URL ?>images/cert.png"></div>
          <h4><a href="">Certified Products</a></h4>
          <h5>Certified by the Health Ministry.</h5>
        </div>
      </div>

      <div class="col-lg-3  " data-aos="zoom-in" data-aos-delay="300">
        <div class="icon-box">
          <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 512 512">
              <path d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zM117.5 1.4c19.4-5.3 39.7 4.6 47.4 23.2l40 96c6.8 16.3 2.1 35.2-11.6 46.3L144 207.3c33.3 70.4 90.3 127.4 160.7 160.7L345 318.7c11.2-13.7 30-18.4 46.3-11.6l96 40c18.6 7.7 28.5 28 23.2 47.4l-24 88C481.8 499.9 466 512 448 512C200.6 512 0 311.4 0 64C0 46 12.1 30.2 29.5 25.4l88-24z" />
            </svg></div>
          <h4><a href="">Customer Service</a></h4>
          <h5>Tél: +21655999066 </h5>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Services Section -->
<section id="nosservice"class="services">
  <div class="container-fluid p-5 " data-aos="fade-up">

    <div class="section-header  text-center ">

      <p class="fw-bolder fs-2 text-black">ABOUT US</p>
    </div>
  <p class="p-1 fs-6">Mass & Muscle is a brand dedicated to the sale of food supplements.
From multivitamins, proteins powders, and standard health products to high-quality sportswear and accessories, we are your partner in achieving your goal, whether it's increasing your muscle mass, losing weight and living a healthy life  do not hesitate, we are the best address.</p>
  </div>
    </section>
<!-- <section>
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" style="max-height :70vh;">
        <img src="./images/1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item" style="max-height :70vh;">
        <img src="./images/2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item" style="max-height :70vh;">
        <img src="./images/3.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section> -->
<section class="sponsors">
  <div class="container-fluid">
    <div class="section-header  text-center ">

      <p class="fw-bolder fs-2 text-black">OUR BRANDS</p>
    </div>
    <div class="row spo_img justify-content-center align-items-center text-center p-3">
      <div class="col-lg-2 col-md-4 "><img src="<?= ROOT_URL ?>images/logo1.png"></div>
      <div class="col-lg-2 col-md-4"><img src="<?= ROOT_URL ?>images/logo3.png"></div>
      <div class="col-lg-2 col-md-4"><img src="<?= ROOT_URL ?>images/logo2.png"></div>
      <div class="col-lg-2 col-md-4"><img src="<?= ROOT_URL ?>images/logo4.png"></div>
      <div class="col-lg-2 col-md-4"><img src="<?= ROOT_URL ?>images/logo5.png"></div>
    </div>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    var page = 1; // initial page
    load_data(page); // load initial data

    function load_data(page) {
      $.ajax({
        url: 'load_data.php',
        method: 'POST',
        data: {
          page: page
        },
        dataType: 'json',
        success: function(data) {
          $('#product-list').html(data.html); // update HTML of container element
        }
      });
    }
    $(document).on('click', '.link-next', function(event) {
      event.preventDefault();
      page = (page + 1) % (<?= $totalPages ?> + 1);
      if (page == 0) {
        page = 1;
      }
      load_data(page); // load data for clicked page
    });
    $(document).on('click', '.link-prev', function(event) {
      event.preventDefault();
      page = page - 1;
      if (page == 0) {
        page = <?= $totalPages ?>;
      }
      load_data(page); // load data for clicked page
    });
    $(document).on('click', '.pagination-link', function(event) {
      event.preventDefault();
      page = $(this).data('page-number');
      load_data(page); // load data for clicked page
    });
  });
</script>
<?php
include 'partials/footer.php';

?>