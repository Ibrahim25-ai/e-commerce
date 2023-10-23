<?php
    require 'config/database.php';
    
if (isset($_POST['page'])) {
  $page = $_POST['page'];
}else{
    $page= 1;
}

$perPage = 12;
$startFrom = ($page - 1) * $perPage ;
$sqlQuery = "SELECT * FROM products where new = 1 ORDER BY id ASC LIMIT $startFrom, $perPage";
$result = mysqli_query($connection, $sqlQuery);

    $paginationHtml = '';

    while ($product = mysqli_fetch_assoc($result)) {  
      
            

          

              
      $paginationHtml.='
      
      <div class="col-lg-3 col-md-4  p-4">
                  <div class="col menu-item">
                    <div class="card border-0 text-center"><div class="card-body position-relative p-4">
                    ';
                    if ($product['new'] && $product['promo'] == 0){
                        $paginationHtml.='<div class=" notify-badge rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0" >
                          <span class="badge  badge-secondary ">New</span>
                        </div>';
                    }
                    if ($product['new'] && $product['promo'] != 0){
                        $paginationHtml.='<div class=" notify-badge rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0 " style="margin-top: 3.5rem;">
                          <span class="badge  badge-secondary " >New</span>
                        </div>';
                    }
                if ($product['promo'] != 0){
                    $paginationHtml.='<div class="notify-badge rounded-circle d-flex align-items-center justify-content-center vh-100 top-0 end-0">
                            <span class="badge badge-secondary ">-'.$product['promo'].'%</span>
                          </div>';
                }

                
                $paginationHtml.='<div class="card-image"><img src="images/'.$product['thumbnail'].'" class="menu-img prod_img" width="0"></div>
                <div class="card-inner prod__desc">
                  <h4 class="fw-bolder  text-truncate prod_title">'.$product['title'].'</h4>
                  <div class="row align-items-center">
                    <div class="col-6   text-end ">
                      <p class="text-nowrap text-decoration-line-through fw-lighter">'.$product['prix_org'].' DT</p>
                    </div>
                    <div class="col-6  text-start prod_prix_aft">
                      <p class=" text-nowrap fw-bolder " style="color:hsl(51, 91%, 60%);">'.$product['prix_aft'].' DT</p>
                    </div>
                  </div>
                  <div class=" d-flex justify-content-center">
                    <a href="producttest.php?id='.$product['id'].'&cat_id='.$product['category_id'].'">
                      <button class="button-86" role="button">Buy</button>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- Menu Item -->
        </div>
      ';

     
  }
  
  $jsonData = array(
      "html"  => $paginationHtml, 
  );
  
  echo json_encode($jsonData); 
?>

 