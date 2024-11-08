<?= loadPartial('head') ?>

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
      <!-- section -->
      <section class="my-lg-14 my-8">
         <!-- container -->
         <div class="container">
            <!-- row -->
            <div class="row justify-content-center align-items-center">
               <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                  <!-- img -->
                  <img src="/assets/images/svg-graphics/fp-g.svg" alt="" class="img-fluid" />
               </div>
               <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1 d-flex align-items-center">
                  <div>
                     <div class="mb-lg-9 mb-5">
                        <!-- heading -->
                        <h1 class="mb-2 h2 fw-bold">Quên mật khẩu của bạn?</h1>
                        <p>Vui lòng nhập địa chỉ email liên kết với tài khoản của bạn và chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu.</p>
                     </div>
                     <!-- form -->
                     <form class="needs-validation" novalidate>
                        <!-- row -->
                        <div class="row g-3">
                           <!-- col -->
                           <div class="col-12">
                              <!-- input -->
                              <label for="formForgetEmail" class="form-label visually-hidden">Địa chỉ email</label>
                              <input type="email" class="form-control" id="formForgetEmail" placeholder="Email" required />
                              <div class="invalid-feedback">Vui lòng nhập đúng mật khẩu.</div>
                           </div>

                           <!-- btn -->
                           <div class="col-12 d-grid gap-2">
                              <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
                              <a href="/sign-in" class="btn btn-light">Quay lại</a>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>


   <?= loadComponents('layout/footer', 'client') ?>
   <?= loadPartial('script') ?>

   <script src="/assets/js/vendors/validation.js"></script>
</body>