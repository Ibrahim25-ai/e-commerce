<?php


$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);


?>
<footer class="justify-content-center">
  <!-- Grid container -->
  <div class="container p-4 pb-0 bg-light text-center text-white mb-5">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn text-white btn-floating m-1" style="background-color: #3b5998;" href="https://www.facebook.com/profile.php?id=100087920626151" role="button"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
          <style>
            svg {
              fill: #ffffff
            }
          </style>
          <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
        </svg></a>

      <!-- Instagram -->
      <a class="btn text-white btn-floating m-1" style="background-color: #ac2bac;" href="https://www.instagram.com/mass_and_muscle/" role="button"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
          <style>
            svg {
              fill: #ffffff
            }
          </style>
          <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
        </svg></a>


    </section>
    <!-- Section: Social media -->
  </div>


  <div class="container footer__container mx-auto">
    <article>
      <h4>Categories</h4>
      <ul>

        <?php while ($categ = mysqli_fetch_assoc($categories)) : ?>
          <?php if ($categ['id'] != 5) : ?>
            <li><a href="<?= ROOT_URL ?>/index1.php?cat=<?= $categ['id'] ?>"><?= $categ['title'] ?></a></li>

          <?php endif ?>

        <?php endwhile ?>
      </ul>
    </article>
    <article>
      <h4>Support</h4>
      <ul>
        <li><a href="<?= ROOT_URL ?>/contact.php">Online Support</a></li>
        <li><a href="<?= ROOT_URL ?>/contact.php">Call Numbers</a></li>
        <li><a href="<?= ROOT_URL ?>/contact.php">Emails</a></li>
        <li><a href="<?= ROOT_URL ?>/contact.php">Social Support</a></li>
        <li><a href="<?= ROOT_URL ?>/contact.php">Location</a></li>
      </ul>
    </article>

    <article>
      <h4>Permalinks</h4>
      <ul>
        <li><a href="<?= ROOT_URL ?>/index.php">Home</a></li>
        <li><a href="">About</a></li>
        <li><a href="#nosservice">Services</a></li>
        <li><a href="<?= ROOT_URL ?>/contact.php">Contact</a></li>
      </ul>
    </article>
  </div>
  <div class="footer__copyright">
    <small>Copyright &copy; 2023 </small>
  </div>
</footer>
<script src='<?= ROOT_URL ?>js/bootstrap.bundle.min.js' ></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src='<?= ROOT_URL ?>js/bootstrap.min.js'></script>
<script src='<?= ROOT_URL ?>js/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.hoverintent/1.9.0/jquery.hoverIntent.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js'></script>
<script src="<?= ROOT_URL ?>js/index.js"></script>
<script src="<?= ROOT_URL ?>js/main.js"></script>

</body>

</html>