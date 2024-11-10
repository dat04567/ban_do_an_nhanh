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
   <!-- section-->
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
                     <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
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
            <div class="col-12">
               <!-- card -->
               <div class="card py-1 border-0 mb-8">
                  <div>
                     <h1 class="fw-bold">Giỏ hàng</h1>
                     <p class="mb-0">Mã đơn hàng: 382480</p>
                  </div>
               </div>
            </div>
         </div>
         <!-- row -->
         <div class="row">
            <div class="col-lg-8 col-md-7">
               <div class="py-3">
                  <!-- alert -->
                  <div class="alert alert-danger p-2" role="alert">
                     Bạn được MIỄN PHÍ vận chuyển. Bắt đầu
                     <a href="#!" class="alert-link">thanh toán ngay!</a>
                  </div>
                  <ul class="list-group list-group-flush">
                     <!-- list group -->
                     <li class="list-group-item py-3 ps-0 border-top">
                        <!-- row -->
                        <div class="row align-items-center">
                           <div class="col-6 col-md-6 col-lg-7">
                              <div class="d-flex">
                                 <img src="../assets/images/products/product-img-1.jpg" alt="Ecommerce" class="icon-shape icon-xxl" />
                                 <div class="ms-3">
                                    <!-- title -->
                                    <a href="../pages/shop-single.html" class="text-inherit">
                                       <h6 class="mb-0">Sản phẩm a</h6>
                                    </a>
                                    <span><small class="text-muted">.98 / lb</small></span>
                                    <!-- text -->
                                    <div class="mt-2 small lh-1">
                                       <a href="#!" class="text-decoration-none text-inherit">
                                          <span class="me-1 align-text-bottom">
                                             <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="14"
                                                height="14"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="feather feather-trash-2 text-success">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                             </svg>
                                          </span>
                                          <span class="text-muted">Remove</span>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- input group -->
                           <div class="col-4 col-md-3 col-lg-3">
                              <!-- input -->
                              <!-- input -->
                              <div class="input-group input-spinner">
                                 <input type="button" value="-" class="button-minus btn btn-sm" data-field="quantity" />
                                 <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field form-control-sm form-input" />
                                 <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity" />
                              </div>
                           </div>
                           <!-- price -->
                           <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                              <span class="fw-bold">69.000đ</span>
                           </div>
                        </div>
                     </li>
                     <!-- list group -->
                     <li class="list-group-item py-3 ps-0">
                        <!-- row -->
                        <div class="row align-items-center">
                           <div class="col-6 col-md-6 col-lg-7">
                              <div class="d-flex">
                                 <img src="../assets/images/products/product-img-2.jpg" alt="Ecommerce" class="icon-shape icon-xxl" />
                                 <div class="ms-3">
                                    <a href="../pages/shop-single.html" class="text-inherit">
                                       <h6 class="mb-0">Sản phẩm a</h6>
                                    </a>
                                    <span><small class="text-muted">250g</small></span>
                                    <!-- text -->
                                    <div class="mt-2 small lh-1">
                                       <a href="#!" class="text-decoration-none text-inherit">
                                          <span class="me-1 align-text-bottom">
                                             <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="14"
                                                height="14"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="feather feather-trash-2 text-success">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                             </svg>
                                          </span>
                                          <span class="text-muted">Remove</span>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <!-- input group -->
                           <div class="col-4 col-md-3 col-lg-3">
                              <!-- input -->
                              <!-- input -->
                              <div class="input-group input-spinner">
                                 <input type="button" value="-" class="button-minus btn btn-sm" data-field="quantity" />
                                 <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field form-control-sm form-input" />
                                 <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity" />
                              </div>
                           </div>
                           <!-- price -->
                           <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                              <!-- <span class="fw-bold text-danger">$20.00</span>
                              <div class="text-decoration-line-through text-muted small">$26.00</div> -->
                              <span class="fw-bold">69.000đ</span>
                           </div>
                        </div>
                     </li>
                     <!-- list group -->
                     
                     <li class="list-group-item py-3 ps-0 border-bottom">
                        <!-- row -->
                        <div class="row align-items-center">
                           <div class="col-6 col-md-6 col-lg-7">
                              <div class="d-flex">
                                 <img src="../assets/images/products/product-img-5.jpg" alt="Ecommerce" class="icon-shape icon-xxl" />
                                 <div class="ms-3">
                                    <!-- title -->
                                    <a href="../pages/shop-single.html" class="text-inherit">
                                       <h6 class="mb-0">Sản phẩm a</h6>
                                    </a>
                                    <span><small class="text-muted">100g</small></span>
                                    <!-- text -->
                                    <div class="mt-2 small lh-1">
                                       <a href="#!" class="text-decoration-none text-inherit">
                                          <span class="me-1 align-text-bottom">
                                             <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="14"
                                                height="14"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="feather feather-trash-2 text-success">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                             </svg>
                                          </span>
                                          <span class="text-muted">Remove</span>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <!-- input group -->
                           <div class="col-4 col-md-3 col-lg-3">
                              <!-- input -->
                              <!-- input -->
                              <div class="input-group input-spinner">
                                 <input type="button" value="-" class="button-minus btn btn-sm" data-field="quantity" />
                                 <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field form-control-sm form-input" />
                                 <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity" />
                              </div>
                           </div>
                           <!-- price -->
                           <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                              <!-- <span class="fw-bold">$15.00</span>
                              <div class="text-decoration-line-through text-muted small">$25.00</div> -->
                              <span class="fw-bold">69.000đ</span>
                           </div>
                        </div>
                     </li>
             
                  </ul>
                  <!-- btn -->
                  <div class="d-flex justify-content-between mt-4">
                     <a href="#!" class="btn btn-primary">Tiếp tục mua sắm</a>

                  </div>
               </div>
            </div>

            <!-- sidebar -->
            <div class="col-12 col-lg-4 col-md-5">
               <!-- card -->
               <div class="mb-5 card mt-6">
                  <div class="card-body p-6">
                     <!-- heading -->
                     <h2 class="h5 mb-4">Tổng quan đơn hàng</h2>
                     <div class="card mb-2">
                        <!-- list group -->
                        <ul class="list-group list-group-flush">
                           <!-- list group item -->
                           <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="me-auto">
                                 <div>Tổng tiền hàng</div>
                              </div>
                              <span>1.610.000đ</span>
                           </li>
                           <!-- list group item -->
                           <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="me-auto">
                                 <div>Phí dịch vụ</div>
                              </div>
                              <span>69.000đ</span>
                           </li>
                           <!-- list group item -->
                           <li class="list-group-item d-flex justify-content-between align-items-start">
                              <div class="me-auto">
                                 <div class="fw-bold">Tổng thanh toán</div>
                              </div>
                              <span class="fw-bold">1.541.000đ</span>
                           </li>
                        </ul>
                     </div>
                     <div class="d-grid mb-1 mt-4">
                        <!-- btn -->
                        <a class="btn btn-primary btn-lg d-flex justify-content-between align-items-center" href="/checkout">
                           Thanh toán
                           <span class="fw-bold">1.541.000đ</span>
                        </a>
                     </div>
                     <!-- text -->
                     <p>
                        <small>
                           Khi đặt hàng, bạn đồng ý với
                           <a href="#!">Điều khoản dịch vụ</a>
                           và
                           <a href="#!">Chính sách bảo mật</a>
                           của Freshcart.
                        </small>
                     </p>

                     <!-- heading -->
                     <div class="mt-8">
                        <h2 class="h5 mb-3">Thêm mã giảm giá hoặc thẻ quà tặng</h2>
                        <form>
                           <div class="mb-2">
                              <!-- input -->
                              <label for="giftcard" class="form-label sr-only">Mã giảm giá</label>
                              <input type="text" class="form-control" id="giftcard" placeholder="Nhập mã giảm giá hoặc thẻ quà tặng" />
                           </div>
                           <!-- btn -->
                           <div class="d-grid">
                              <button type="submit" class="btn btn-outline-dark mb-1">Áp dụng</button>
                           </div>
                           <p class="text-muted mb-0">
                              <small>Áp dụng theo điều khoản & điều kiện</small>
                           </p>
                        </form>
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