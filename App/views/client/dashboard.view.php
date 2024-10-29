<?= loadPartial("head") ?>

<!--  Header Start  -->
  <!-- thanh danh  -->
<?= loadComponents('layout/nav-bar',  "client") ?>

<!-- giỏ hàng -->
<?= loadComponents("modal/shop-cart",  "client") ?>
<!-- đăng ký modal  -->
<?= loadComponents('modal/sign-up-modal', 'client') ?>
<!--  Header End  -->




<!-- modal địa chỉ giao hàng -->
<?= loadComponents("modal/location-modal", 'client') ?>



<script src="/assets/js/vendors/validation.js"></script>

<main>
   <!-- Thành phần banner -->
   <?= loadComponents("dashboard/banner","client") ?>

   <!-- Thành phần danh mục nổi bật -->
   <?= loadComponents("dashboard/featured-categories","client") ?>
   <!-- quảng cáo -->
  <?= loadComponents("dashboard/promotional-banner","client") ?>
   <!-- sản phẩm nổi bật -->
   <?= loadComponents("dashboard/popular-products","client") ?>
   <!-- Sản phẩm best sell -->
   <?= loadComponents("dashboard/best-sells","client") ?>
   <?= loadComponents("dashboard/feature-section","client") ?>

</main>


<!-- -->
<!-- mở chi tiết sản phẩm Modal -->
 <?= loadComponents("dashboard/product-detail-modal","client") ?>
 


<?= loadComponents('layout/footer', 'client') ?>



<!-- Jquery -->
<script src="/assets/js/vendors/jquery.min.js"></script>

<!-- Bootstrap JS -->
<?= loadPartial("script") ?>




<!-- Theme JS -->
<script src="/assets/js/vendors/countdown.js"></script>
<script src="/assets/libs/slick-carousel/slick.min.js"></script>
<script src="/assets/js/vendors/slick-slider.js"></script>
<script src="/assets/libs/tiny-slider/tiny-slider.js"></script>
<script src="/assets/js/vendors/tns-slider.js"></script>
<script src="/assets/js/vendors/zoom.js"></script>


</body>

</html>