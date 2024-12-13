<?= loadPartial("head") ?>

<link rel="stylesheet" href="/assets/css/custom.css" />

<!-- Toastr -->
<link rel="stylesheet" href="/assets/libs/toastr/toastr.min.css" />


</head>
<!--  Header Start  -->

<!-- Menu điều hướng -->
<?= loadComponents('layout/nav-bar',  "client") ?>


<!-- Modal đăng ký tài khoản -->
<?= loadComponents('modal/sign-up-modal', 'client') ?>
<!--  Header End  -->


<!-- Modal thông báo -->
<?= loadPartial('modal-alert') ?>

<!-- Modal địa chỉ giao hàng -->
<?= loadComponents("modal/location-modal", 'client') ?>



<main>

   <section>
      <div class="container">
         <!-- row -->
         <div class="row">
            <!-- col -->
            <div class="col-12">
               <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                  <!-- heading -->
                  <h3 class="fs-5 mb-0">Cài Đặt Tài Khoản</h3>
                  <!-- button -->
                  <button
                     class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3"
                     type="button"
                     data-bs-toggle="offcanvas"
                     data-bs-target="#offcanvasAccount"
                     aria-controls="offcanvasAccount">
                     <i class="bi bi-text-indent-left fs-3"></i>
                  </button>
               </div>
            </div>
            <!-- col -->
            <div class="col-lg-3 col-md-4 col-12 border-end d-none d-md-block">
               <div class="pt-10 pe-lg-10">
                  <!-- nav -->
                  <ul class="nav flex-column nav-pills nav-pills-dark">
                     <!-- nav item -->
                     <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="account-orders.html">
                           <i class="feather-icon icon-shopping-bag me-2"></i>
                           Đơn Hàng
                        </a>
                     </li>
                     <!-- nav item -->
                     <li class="nav-item">
                        <a class="nav-link" href="account-settings.html">
                           <i class="feather-icon icon-settings me-2"></i>
                           Cài Đặt
                        </a>
                     </li>
                     <!-- nav item -->
                     <li class="nav-item">
                        <a class="nav-link" href="account-address.html">
                           <i class="feather-icon icon-map-pin me-2"></i>
                           Địa Chỉ
                        </a>
                     </li>
                     <!-- nav item -->
                     <li class="nav-item">
                        <a class="nav-link" href="account-payment-method.html">
                           <i class="feather-icon icon-credit-card me-2"></i>
                           Phương Thức Thanh Toán
                        </a>
                     </li>
                     <!-- nav item -->
                     <li class="nav-item">
                        <a class="nav-link" href="account-notification.html">
                           <i class="feather-icon icon-bell me-2"></i>
                           Thông Báo
                        </a>
                     </li>
                     <!-- nav item -->
                     <li class="nav-item">
                        <hr />
                     </li>
                     <!-- nav item -->
                     <li class="nav-item">
                        <a class="nav-link" href="../index.html">
                           <i class="feather-icon icon-log-out me-2"></i>
                           Đăng Xuất
                        </a>
                     </li>
                  </ul>
               </div>
            </div>

            <?= loadComponents('orders/your-orders', 'client', ['orders' => $orders ?? []]) ?>
         
         </div>
      </div>
   </section>

</main>




<!-- Giỏ hàng -->

<?= loadComponents('modal/shop-cart', 'client') ?>

<?= loadComponents('layout/footer', 'client') ?>



<!-- Bootstrap JS -->
<?= loadPartial("script") ?>

<?= loadPartial("script-modal-alert") ?>
<script src="/assets/libs/toastr/toastr.min.js"></script>


<script type="module" src="/assets/js/client/pages/dashboard.js"></script>



</body>

</html>