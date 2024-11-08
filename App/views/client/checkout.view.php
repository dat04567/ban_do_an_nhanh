<?= loadPartial("head") ?>

<link rel="stylesheet" href="/assets/css/custom.css" />

</head>
<!--  Header Start  -->

<!-- thanh danh  -->
<?= loadComponents('layout/nav-bar',  "client") ?>


<!--  Header End  -->




<!-- modal địa chỉ giao hàng -->
<?= loadComponents("modal/location-modal", 'client') ?>



<!--  Main Start  -->


<script src="/assets/js/vendors/validation.js"></script>

<main>
   <div class="mt-4">
      <div class="container">
         <!-- row -->
         <div class="row">
            <!-- col -->
            <div class="col-12">
               <!-- breadcrumb -->
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb mb-0">
                     <li class="breadcrumb-item"><a href="#!">Trang chủ</a></li>
                     <li class="breadcrumb-item"><a href="#!">Cửa hàng</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </div>
   <!-- section -->
   <section class="mb-lg-14 mb-8 mt-8">
      <div class="container">
         <!-- row -->
         <div class="row">
            <!-- col -->
            <div class="col-12">
               <div>
                  <div class="mb-8">
                     <!-- text -->
                     <h1 class="fw-bold mb-0">Thanh toán</h1>
                  </div>
               </div>
            </div>
         </div>
         <div>
            <!-- row -->
            <div class="row">
               <div class="col-xl-7 col-lg-6 col-md-12">
                  <!-- accordion -->
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                     <!-- accordion item -->
                     <div class="accordion-item py-4">
                        <div class="d-flex justify-content-between align-items-center">
                           <!-- heading one -->
                           <a
                              href="#"
                              class="fs-5 text-inherit collapsed h4"
                              data-bs-toggle="collapse"
                              data-bs-target="#flush-collapseOne"
                              aria-expanded="true"
                              aria-controls="flush-collapseOne">
                              <i class="feather-icon icon-map-pin me-2 text-muted"></i>
                              Thêm địa chỉ giao hàng
                           </a>
                           <!-- btn -->
                           <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAddressModal">Thêm địa chỉ mới</a>
                           <!-- collapse -->
                        </div>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                           <div class="mt-5">
                              <div class="row">
                                 <div class="col-xl-6 col-lg-12 col-md-6 col-12 mb-4">
                                    <!-- form -->
                                    <div class="card card-body p-6">
                                       <div class="form-check mb-4">
                                          <input class="form-check-input" type="radio" name="flexRadioDefault" id="homeRadio" checked />
                                          <label class="form-check-label text-dark" for="homeRadio">Nhà</label>
                                       </div>
                                       <!-- address -->
                                       <address>
                                          <strong>Nguyễn Văn A</strong>
                                          <br />
                                          123 Đường Lê Lợi,
                                          <br />
                                          Quận 1, TP. Hồ Chí Minh,
                                          <br />
                                          <abbr title="Phone">P: 0123-456-789</abbr>
                                       </address>
                                       <span class="text-danger">Địa chỉ mặc định</span>
                                    </div>
                                 </div>
                                 <div class="col-xl-6 col-lg-12 col-md-6 col-12 mb-4">
                                    <!-- input -->
                                    <div class="card card-body p-6">
                                       <div class="form-check mb-4">
                                          <input class="form-check-input" type="radio" name="flexRadioDefault" id="officeRadio" />
                                          <label class="form-check-label text-dark" for="officeRadio">Văn phòng</label>
                                       </div>
                                       <address>
                                          <strong>Trần Thị B</strong>
                                          <br />
                                          456 Đường Nguyễn Trãi,
                                          <br />
                                          Quận 5, TP. Hồ Chí Minh,
                                          <br />
                                          <abbr title="Phone">P: 0987-654-321</abbr>
                                       </address>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- accordion item -->
                     <div class="accordion-item py-4">
                        <a href="#" class="text-inherit h5" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                           <i class="feather-icon icon-credit-card me-2 text-muted"></i>
                           Phương thức thanh toán
                           <!-- collapse -->
                        </a>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                           <div class="mt-5">
                              <div>
                                 <div class="card card-bordered shadow-none mb-2">
                                    <!-- card body -->
                                    <div class="card-body p-6">
                                       <div class="d-flex">
                                          <div class="form-check">
                                             <!-- checkbox -->
                                             <input class="form-check-input" type="radio" name="flexRadioDefault" id="paypal" />
                                             <label class="form-check-label ms-2" for="paypal"></label>
                                          </div>
                                          <div>
                                             <!-- title -->
                                             <h5 class="mb-1 h6">Thanh toán bằng Momo</h5>
                                             <p class="mb-0 small">Bạn sẽ được chuyển hướng đến trang web của Momo để hoàn tất giao dịch một cách an toàn.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- card -->
                                 <div class="card card-bordered shadow-none">
                                    <div class="card-body p-6">
                                       <!-- check input -->
                                       <div class="d-flex">
                                          <div class="form-check">
                                             <input class="form-check-input" type="radio" name="flexRadioDefault" id="cashonDelivery" />
                                             <label class="form-check-label ms-2" for="cashonDelivery"></label>
                                          </div>
                                          <div>
                                             <!-- title -->
                                             <h5 class="mb-1 h6">Thanh toán khi nhận hàng</h5>
                                             <p class="mb-0 small">Thanh toán bằng tiền mặt khi đơn hàng của bạn được giao.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Button -->
                                 <div class="mt-5 d-flex justify-content-end">
                                    <a
                                       href="#"
                                       class="btn btn-outline-gray-400 text-muted"
                                       data-bs-toggle="collapse"
                                       data-bs-target="#flush-collapseOne"
                                       aria-expanded="false"
                                       aria-controls="flush-collapseOne">
                                       Trước
                                    </a>
                                    <a href="#" class="btn btn-primary ms-2">Đặt hàng</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-md-12 offset-xl-1 col-xl-4 col-lg-6">
                  <div class="mt-4 mt-lg-0">
                     <div class="card shadow-sm">
                        <h5 class="px-6 py-4 bg-transparent mb-0">Chi tiết đơn hàng</h5>
                        <ul class="list-group list-group-flush">
                           <!-- list group item -->
                           <li class="list-group-item px-4 py-3">
                              <div class="row align-items-center">
                                 <div class="col-2 col-md-2">
                                    <img src="../assets/images/products/product-img-1.jpg" alt="Ecommerce" class="img-fluid" />
                                 </div>
                                 <div class="col-5 col-md-5">
                                    <h6 class="mb-0">Sản phẩm a</h6>
                                    <span><small class="text-muted">.98 / lb</small></span>
                                 </div>
                                 <div class="col-2 col-md-2 text-center text-muted">
                                    <span>1</span>
                                 </div>
                                 <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                    <span class="fw-bold">5.000đ</span>
                                 </div>
                              </div>
                           </li>
                           <li class="list-group-item px-4 py-3">
                              <div class="d-flex align-items-center justify-content-between mb-2">
                                 <div>Tổng tiền hàng</div>
                                 <div class="fw-bold">70.000đ</div>
                              </div>

                              <div class="d-flex align-items-center justify-content-between">
                                 <div>
                                    Phí dịch vụ
                                    <i class="feather-icon icon-info text-muted" data-bs-toggle="tooltip" title="Default tooltip"></i>
                                 </div>
                                 <div class="fw-bold">0.000đ</div>
                              </div>
                           </li>
                           <!-- list group item -->
                           <li class="list-group-item px-4 py-3">
                              <div class="d-flex align-items-center justify-content-between fw-bold">
                                 <div>Tổng cộng</div>
                                 <div>70.000đ</div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>





<!-- Giỏ hàng -->

<?= loadComponents('modal/shop-cart', 'client') ?>

<?= loadComponents('layout/footer', 'client') ?>



<!-- Jquery -->
<!-- <script src="/assets/js/vendors/jquery.min.js"></script> -->


<script src="/assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- Bootstrap JS -->
<?= loadPartial("script") ?>





</body>

</html>