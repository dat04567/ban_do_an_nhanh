<?= loadPartial('head') ?>

<link href="/assets/css/custom.css" rel="stylesheet" />
</head>


<body>
   <div class="border-bottom shadow-sm">
      <nav class="navbar navbar-light py-2">
         <div class="container justify-content-center justify-content-lg-between">
            <a class="navbar-brand" href="/">
               <img src="/assets/images/food-icon.jpg" alt="" width="160" class="d-inline-block align-text-top" />
            </a>
            <span class="navbar-text">
               Đã có tài khoản?
               <a href="/sign-in">Đăng nhập</a>
            </span>
         </div>
      </nav>
   </div>


   <main>


      <!-- modal  -->
      <?php
      loadPartial('modal-alert');
      ?>
      <!-- section -->
      <section class="my-lg-14 my-8">
         <div class="container">
            <!-- row -->
            <div class="row justify-content-center align-items-center">
               <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                  <!-- img -->
                  <img src="/assets/images/svg-graphics/signin-g.svg" alt="" class="img-fluid" />
               </div>
               <!-- col -->
               <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                  <div class="mb-lg-9 mb-5">
                     <h1 class="mb-1 h2 fw-bold">Đăng nhập vào FoodFashion</h1>
                     <p>Chào mừng trở lại FoodFashion! Nhập email của bạn để bắt đầu.</p>
                  </div>

                  <form class="needs-validation" novalidate method="POST" action="/sign-in">
                     <div class="row g-3">
                        <!-- row -->

                        <div class="col-12">
                           <!-- input -->
                           <label for="formSigninEmail" class="form-label visually-hidden">Địa chỉ email</label>
                           <input type="email" name="email" class="form-control" id="formSigninEmail" placeholder="Email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" />
                        </div>
                        <div class="col-12">
                           <!-- input -->
                           <div class="password-field position-relative">
                              <label for="formSigninPassword" class="form-label visually-hidden">Mật khẩu</label>
                              <div class="password-field position-relative">
                                 <input type="password" name="password" class="form-control fakePassword" id="formSigninPassword" placeholder="*****" value="<?= isset($password) ? htmlspecialchars($password) : '' ?>" />
                                 <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="d-flex justify-content-between">
                           <!-- form check -->
                           <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                              <!-- label -->
                              <label class="form-check-label" for="flexCheckDefault">Ghi nhớ</label>
                           </div>
                           <div>
                              Quên mật khẩu?
                              <a href="/forgot-password">Đặt lại</a>
                           </div>
                        </div>
                        <!-- btn -->
                        <div class="col-12 d-grid"><button type="submit" class="btn btn-primary">Đăng nhập</button></div>

                        <!-- errors -->
                        <?php if (isset($errors)) : ?>
                           <div class="col-12">
                              <div class="alert alert-danger mt-3" role="alert">
                                 <?php echo implode('<br>', $errors); ?>
                              </div>
                           </div>
                        <?php endif; ?>
                        <!-- link -->
                        <div>
                           Chưa có tài khoản?
                           <a href="/sign-up">Đăng ký</a>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>
   </main>

   <?= loadComponents('layout/footer', 'client') ?>
   <?= loadPartial('script') ?>
   <?= loadPartial('script-modal-alert') ?>
   <script src="/assets/js/vendors/password.js"></script>

</body>