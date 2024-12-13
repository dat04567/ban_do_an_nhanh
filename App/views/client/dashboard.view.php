<?= loadPartial("head") ?>

<link rel="stylesheet" href="/assets/css/custom.css" />

<!-- Toastr -->
<link rel="stylesheet" href="/assets/libs/toastr/toastr.min.css" />


</head>
<!--  Header Start  -->

<!-- thanh danh  -->
<?= loadComponents('layout/nav-bar',  "client") ?>


<!-- đăng ký modal  -->
<?= loadComponents('modal/sign-up-modal', 'client') ?>
<!--  Header End  -->


<!-- load  modal alert  -->
<?= loadPartial('modal-alert') ?>

<!-- modal địa chỉ giao hàng -->
<?= loadComponents("modal/location-modal", 'client') ?>



<main>

  <!-- Thành phần banner -->
  <?= loadComponents("dashboard/banner", "client") ?>

  <!-- Thành phần danh mục nổi bật -->
  <?= loadComponents("dashboard/featured-categories", "client", ['categories' => $categories]) ?>
  <!-- quảng cáo -->
  <?= loadComponents("dashboard/promotional-banner", "client") ?>
  
  <!-- sản phẩm nổi bật -->
  <?php if (isset($foods)) : ?>
    <?= loadComponents("dashboard/popular-products", "client", ['foods' => $foods]) ?>
    <?= loadComponents("modal/product-detail-modal", "client", ['foods' => $foods]) ?>
  <?php endif; ?>

  <!-- Sản phẩm best sell -->
  <?= loadComponents("dashboard/best-sells", "client") ?>

  <?= loadComponents("dashboard/feature-section", "client") ?>

</main>




<!-- Giỏ hàng -->

<?= loadComponents('modal/shop-cart', 'client') ?>

<?= loadComponents('layout/footer', 'client') ?>



<!-- Jquery -->
<!-- <script src="/assets/libs/jquery/jquery.min.js"></script> -->
<!-- Bootstrap JS -->
<?= loadPartial("script") ?>

<?= loadPartial("script-modal-alert") ?>
<script src="/assets/libs/toastr/toastr.min.js"></script>

<script type="module" src="/assets/js/client/pages/dashboard.js"></script>
<script src="/assets/js/client/product-detail-modal.js"></script>


<!-- Theme JS -->
<script src="/assets/js/vendors/countdown.js"></script>
<script src="/assets/libs/slick-carousel/slick.min.js"></script>
<script src="/assets/js/vendors/slick-slider.js"></script>
<script src="/assets/libs/tiny-slider/tiny-slider.js"></script>
<script src="/assets/js/vendors/tns-slider.js"></script>
<script src="/assets/js/vendors/zoom.js"></script>



</body>

</html>