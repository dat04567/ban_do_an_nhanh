<?= loadPartial('head') ?>

</head>


<body>


   <main>
      <!-- section -->
      <section>
         <div class="container d-flex flex-column">
            <!-- row -->
            <div class="row min-vh-100 justify-content-center align-items-center">
               <!-- col -->
               <div class="offset-lg-1 col-lg-10 py-8 py-xl-0">
                  <div class="mb-10 mb-xxl-0">
                     <!-- img -->
                     <a href="/"><img src="/assets/images/food-icon.jpg" width="160" alt="" /></a>
                  </div>
                  <div class="row justify-content-center align-items-center">
                     <!-- content -->
                     <div class="col-md-6">
                        <div class="mb-6 mb-lg-0">
                           <h1>Có gì đó sai sai...</h1>
                           <p class="mb-8">
                              Chúng tôi không thể tìm thấy trang bạn đang tìm kiếm.
                              <br />
                              Kiểm tra trung tâm trợ giúp của chúng tôi hoặc quay lại trang chủ.
                           </p>
                           <!-- btn -->
                           <a href="#" class="btn btn-dark">
                              Trung tâm trợ giúp
                              <i class="feather-icon icon-arrow-right"></i>
                           </a>
                           <!-- btn -->
                           <a href="/" class="btn btn-primary ms-2">Quay lại trang chủ</a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div>
                           <!-- img -->
                           <img src="/assets/images/svg-graphics/error.svg" alt="" class="img-fluid" />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>
   <?= loadPartial('script') ?>


</body>