<?= loadPartial("head") ?>
<link rel="stylesheet" href="/assets/css/custom.css" />
</head>
   <!--  Header Start  -->
   <!-- thanh danh  -->
   <?= loadComponents('layout/nav-bar',  "client") ?>

   <!-- đăng ký modal  -->
   <?= loadComponents('modal/sign-up-modal', 'client') ?>
   <!--  Header End  -->


   <!-- model giỏ hàng -->
   <?= loadComponents('modal/shop-cart', 'client') ?>


   <!-- modal địa chỉ giao hàng -->
   <?= loadComponents("modal/location-modal", 'client') ?>



   <script src="/assets/js/vendors/validation.js"></script>


   <main>
      <!-- section -->
      <div class="mt-4">
         <div class="container">
            <!-- row -->
            <div class="row">
               <!-- col -->
               <div class="col-12">
                  <!-- breadcrumb -->
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="/shop">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Snacks </li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <!-- section -->
      <div class="mt-8 mb-lg-14 mb-8">
         <!-- container -->
         <div class="container">
            <!-- row -->
            <div class="row gx-10">
               <!-- col -->
               <?= loadComponents('shop/filter-sidebar', 'client') ?>

               <?= loadComponents('shop/product-list', 'client') ?>


            </div>
         </div>
      </div>
   </main>






   <?= loadComponents('layout/footer', 'client') ?>



   <!-- Jquery -->
   <!-- <script src="/assets/js/vendors/jquery.min.js"></script> -->

   <script src="/assets/libs/nouislider/nouislider.min.js"></script>
   <script src="/assets/libs/wnumb/wNumb.min.js"></script>

   <!-- Bootstrap JS -->
   <?= loadPartial("script") ?>




   <!-- Theme JS -->
   <script src="/assets/libs/tiny-slider/tiny-slider.js"></script>
   <script src="/assets/js/vendors/tns-slider.js"></script>
   <script src="/assets/js/vendors/zoom.js"></script>


   </body>

   </html>