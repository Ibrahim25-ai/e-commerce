<?php
include 'partials/header.php';

// fetch post data from database if id is set
if (isset($_GET['id']) && isset($_GET['cat_id'])) {
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $id_cat = filter_var($_GET['cat_id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM products WHERE id=$id";
  $result = mysqli_query($connection, $query);
  $product = mysqli_fetch_assoc($result);

  $query = "SELECT * FROM products WHERE category_id=$id_cat";
  $products3 = mysqli_query($connection, $query);
} else {
  die();
}

?>
<link rel="stylesheet" href="assets/css/docs.theme.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link src="<?= ROOT_URL ?>css/docs.theme.min.css"/>
<script src="<?= ROOT_URL ?>js/app.js"></script>
<script src="<?= ROOT_URL ?>js/jquery.min.js"></script>
<script src="<?= ROOT_URL ?>js/owl.carousel.js"></script>



<!-- Product section-->
<section>
  <div class="container-fluid">
    <div class="row  p-3">
      <div class="col-lg-6 col-12 p-2 ">
        <div class="position-relative m-5">

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


          <img style="height : 30rem;object-fit:contain;" src="<?= ROOT_URL ?>images/<?= $product['thumbnail'] ?>" class="menu-img img-fluid" alt="" width="250">

        </div>
      </div>
      <div class="col-lg-5 col-12 p-2" style="margin-top:3rem;">
        <div class="">
          <p class="fs-2 fw-bold " style="color:black;"><?= $product['title'] ?></p>
          <div class="row align-items-start">
            <div class="col-md-3 col-sm-6 text-start">
              <p class="fs-3 text-nowrap text-decoration-line-through fw-light"><?= $product['prix_org'] ?> DT</p>
            </div>
            <div class="col-md-3 col-sm-6 ">
              <p class="fs-3 text-nowrap fw-bolder" style="color:hsl(51, 91%, 60%);"><?= $product['prix_aft'] ?> DT</p>
            </div>
          </div>

          <p class="fs-6 fw-normal"><?= $product['body'] ?></p>
          <div class="row">
            <div class="nav__text">
              <span class="">+7DT livraison<i class="bi bi-truck"></i></span>
              <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
            </div>
            
          </div>
          <hr>
          <button href="#commande" data-toggle="modal" type="button" class="btn btn-dark btn-lg">Command</button>
        </div>
      </div>
    </div>
  </div>
</section>


<section>
  <div id="commande" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="https://www.massandmuscle.tn/add-command-logic.php" enctype="multipart/form-data" method="POST">
          <input type="hidden" name="id" value="<?= $product['id'] ?>">
          <div class="modal-header">
            <h4 class="modal-title">Add command</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input name="tel" class="form-control" required>
            </div>
            <div class="form-group">
              <label>email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Address</label>
              <textarea class="form-control" name="adr" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" name="submit" class="btn btn-dark" value="Command">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- body -->
<div class="home-demo   m-5">
  <div class="row">
    <div class="large-12 columns carousel-wrap ">
      <h3>PRODUITS APPARENTÉS</h3>
      <div class="owl-carousel owl-theme">

        <?php if (mysqli_num_rows($products3) > 0) : ?>


          <?php while ($product = mysqli_fetch_assoc($products3)) : ?>
            <div class="item ">
              <div class="col  menu-item">
                <div class="card border-0 text-center">
                  <div class="card-body position-relative m-5">
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
                      <a href="<?= ROOT_URL ?>images/<?= $product['thumbnail'] ?>" class="glightbox">
                        <img style="height : 15rem;" src="<?= ROOT_URL ?>images/<?= $product['thumbnail'] ?>" class="menu-img img-fluid" alt="" width="250">
                      </a>
                    </div>
                    <div class="card-inner ">
                      <span class="d-inline-block text-truncate fw-bolder" style="max-width: 150px;">
                        <?= $product['title'] ?>
                      </span>
                      <div class="row align-items-center">
                        <div class="col-6   text-end ">
                          <p class="text-nowrap text-decoration-line-through fw-lighter"><?= $product['prix_org'] ?> DT</p>
                        </div>
                        <div class="col-6  text-start" style="margin-right: -0.5rem;">
                          <p class=" text-nowrap fw-bolder " style="color:hsl(51, 91%, 60%);"><?= $product['prix_aft'] ?> DT</p>
                        </div>
                      </div>
                      <div class="d-flex justify-content-center">
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

<script>
  $('.owl-carousel').owlCarousel({
    margin: 10,
    stagePadding: 5,

    nav: true,
    navText: ["<div class='nav-button owl-prev'>‹</div>", "<div class='nav-button owl-next'>›</div>"],
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1000: {
        items: 4
      }
    }
  });
</script>

<?php
include 'partials/footer.php';


?>