<?php
require 'partials/header.php';

if (isset($_GET['search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM products WHERE title LIKE '%$search%' ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
    
} else {
    header('location: ' . ROOT_URL . 'index.php');
    die();
}
?>
<?php
// Fonction pour trouver les produits avec des titres similaires
function trouverProduits($motEntre, $produits) {
$titreProduit = '';

    $produitsSimilaires = array();
    foreach ($produits as $produit) {
       
        $lettresCommunes = array_intersect(str_split($titreProduit), str_split($motEntre));
        if (count($lettresCommunes) >= 3) {
            $produitsSimilaires[] = $produit;
        }
    }
    return $produitsSimilaires;
}?>


<?php     $produits[]="SELECT * FROM products"; 
$produitsSimilaires = trouverProduits($search, $produits);
?>



<div class="tab-content" data-aos="fade-up" data-aos-delay="300">

<div class="tab-pane fade active show" id="NEWP">
  <div class="container1 text-center mt-5 mb-5">
    <div class="row wrapper rounded fade show active">
    
  
      <?php if (mysqli_num_rows($posts) > 0) : ?>


        <?php while ($product = mysqli_fetch_array($posts)) : ?>
          <!-- get category title of each post from categories table -->

          <div class="col-lg-3 col-md-4  p-4">
            <div class="col menu-item">
              <div class="card border-0 text-center">
                <div class="card-body position-relative p-4">
                <?php if ($product['new'] && $product['promo'] == 0): ?>
                <div class=" notify-badge rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0" >
                  <span class="badge  badge-secondary " style="font-size: 0.9rem;">New</span>
                </div>
              <?php endif ?>
              <?php if ($product['new'] && $product['promo'] != 0): ?>
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

                    <img style="height : 17rem;" src="<?= ROOT_URL ?>images/<?= $product['thumbnail'] ?>" class="menu-img " width="0">

                  </div>

                  <div class="card-inner prod__desc">
                    <p style="height:1rem;margin-top:0.5rem;" class="fw-bolder  text-truncate "><?= $product['title'] ?></h4>

                    <div class="row align-items-center">
                      <div class="col-6   text-end ">

                        <p class="text-nowrap text-decoration-line-through fw-lighter"><?= $product['prix_org'] ?> DT</p>
                      </div>
                      <div class="col-6  text-start" style="margin-right: -0.5rem;">
                        <p class=" text-nowrap fw-bolder " style="color:hsl(51, 91%, 60%);"><?= $product['prix_aft'] ?> DT</p>
                      </div>
                    </div>

                    <div class=" d-flex justify-content-center">
                      <a href="<?= ROOT_URL ?>/producttest.php?id=<?= $product['id'] ?>">
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
      <div class="col-lg-3 col-md-4  p-4">
        <!-- Menu Item -->
      </div>

    </div>
  </div>
</div>



<?php include 'partials/footer.php' ?>