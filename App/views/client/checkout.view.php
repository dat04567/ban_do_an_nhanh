<?= loadPartial("head") ?>

<link rel="stylesheet" href="/assets/css/custom.css" />
<link rel="stylesheet" href="/assets/libs/toastr/toastr.min.css" />
</head>
<!--  Header Start  -->

<!-- thanh danh  -->
<?= loadComponents('layout/nav-bar',  "client") ?>


<!--  Header End  -->




<!-- modal địa chỉ giao hàng -->
<?= loadComponents("modal/location-modal", 'client') ?>

<?= loadComponents('modal/address-modal', 'client') ?>



<!--  Main Start  -->
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
                           <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#themDiaChiModal  ">Thêm địa chỉ mới</a>
                           <!-- collapse -->
                        </div>

                        <?= loadComponents('checkout/delivery-address', 'client', ['addresses' => $addresses ?? [] ]) ?>


                     
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
                                             <input class="form-check-input" type="radio" name="phuongThuc" id="paypal" value="momo" />
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
                                             <input class="form-check-input" type="radio" name="phuongThuc" id="cashonDelivery" value="cashonDelivery" />
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
                                    <button  type="submit" class="btn btn-primary ms-2">Đặt hàng</button>
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

                           <?php foreach ($carts as $item): ?>
                              <li class="list-group-item px-4 py-3">
                                 <div class="row align-items-center">
                                    <div class="col-2 col-md-2">
                                       <img src="<?= $item['hinhAnh'][0] ?>" alt="<?= $item['tenSanPham'] ?>" class="img-fluid" />
                                    </div>
                                    <div class="col-5 col-md-5">
                                       <h6 class="mb-0"><?= $item['tenSanPham'] ?></h6>
                                       <span><small class="text-muted"><?= number_format($item['totalPrice'], 0, ',', '.') ?>₫ </small> </span>
                                    </div>
                                    <div class="col-2 col-md-2 text-center text-muted">
                                       <span><?= $item['soLuong'] ?></span>
                                    </div>
                                    <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                       <span class="fw-bold"><?= number_format($item['totalPrice'], 0, ',', '.') ?>₫</span>
                                    </div>
                                 </div>
                              </li>
                           <?php endforeach; ?>

                           <li class="list-group-item px-4 py-3">
                              <div class="d-flex align-items-center justify-content-between mb-2">
                                 <div>Tổng tiền hàng</div>
                                 <div class="fw-bold"><?= number_format($totalPrice, 0, ',', '.') ?>₫</div>
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
                                 <div><?= number_format($totalPrice, 0, ',', '.') ?>₫</div>
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

<!-- Bootstrap JS -->
<?= loadPartial("script") ?>

<?= loadComponents('layout/footer', 'client') ?>
<script src="/assets/libs/toastr/toastr.min.js"></script>
<script src="/assets/libs/flatpickr/flatpickr.min.js"></script>

<script src="/assets/js/client/pages/checkout.js"></script>








</body>

</html>