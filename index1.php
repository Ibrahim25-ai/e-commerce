<?php
include 'partials/header.php';
if (isset($_GET['cat'])) {
  $id = filter_var($_GET['cat'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM products WHERE category_id=$id";
  $products = mysqli_query($connection, $query);
} else {
}
?>
<section>
  <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

    <div class="tab-pane fade active show" id="NEWP">
      <div class="container1 text-center mt-5 mb-5">
        <img class="nos img-fluid mx-auto d-block mt-5 mb-5 p-2 h-20" style="max-height:25em;"src="images/noscats.png">
          <div class="row wrapper rounded fade show active">

          <?php if (mysqli_num_rows($products) > 0) : ?>


            <?php while ($product = mysqli_fetch_array($products)) : ?>
              <!-- get category title of each post from categories table -->

              <div class="col-lg-3 col-md-4 col-sm-6 p-4">
                <div class="col menu-item">
                  <div class="card border-0 text-center">
                    <div class="card-body position-relative p-4">

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
                        <div class="notify-badge rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0">
                          <span class="badge badge-secondary ">-<?= $product['promo'] ?>%</span>
                        </div>
                      <?php endif ?>


                      <div class="card-image"><img src="<?= ROOT_URL ?>images/<?= $product['thumbnail'] ?>" class="menu-img prod_img" width="0"></div>
                      <div class="card-inner prod__desc">
                        <h4 class="fw-bolder  text-truncate prod_title"><?= $product['title'] ?></h4>
                        <div class="row align-items-center">
                          <div class="col-6   text-end ">
                            <p class="text-nowrap text-decoration-line-through fw-lighter"><?= $product['prix_org'] ?> DT</p>
                          </div>
                          <div class="col-6  text-start prod_prix_aft">
                            <p class=" text-nowrap fw-bolder " style="color:hsl(51, 91%, 60%);"><?= $product['prix_aft'] ?> DT</p>
                          </div>
                        </div>
                        <div class=" d-flex justify-content-center">
                          <a href="<?= ROOT_URL ?>producttest.php?id=<?= $product['id'] ?>&cat_id=<?= $product['category_id'] ?>">
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
<?php
include 'partials/footer.php';

?>