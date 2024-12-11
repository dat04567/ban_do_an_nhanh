<?= loadPartial('head') ?>

<link href="/assets/css/custom.css" rel="stylesheet" />


</head>

<body id="">

   <?= loadComponents('layout/nav-bar') ?>
   <div class="main-wrapper">
      <?= loadComponents('layout/nav-bar-vertical') ?>
      <!-- main wrapper -->
      <main class="main-content-wrapper">

         <div class="container">
            <!-- row -->
            <?php
            loadComponents('ui/header-manage');

            // Định nghĩa các thông số cho header
            $title = 'Thêm cửa hàng';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => '/admin'],
               ['label' => 'Cửa hàng', 'href' => '/admin/stores'],
               ['label' => 'Thêm', 'active' => true]
            ];
            $actionButton = ' <a href="/admin/stores" class="btn btn-light">Quay lại cửa hàng</a>';
            // Render header
            renderPageHeader($title, $breadcrumbs, $actionButton);

            // load alert modal
            loadPartial('modal-alert');


            ?>
            <div class="row">
               <div class="col-12">
                  <div class="card shadow border-0">
                     <div class="card-body d-flex flex-column gap-8 p-7">

                        <div class="d-flex flex-column gap-4">
                           <h3 class="mb-0 h6">Thông tin cửa hàng</h3>
                           <form class="row g-3 needs-validation" method="POST" action="/admin/stores/create" novalidate>
                              <div class="col-lg-6 col-12">
                                 <div>
                                    <!-- input -->
                                    <label for="createStoreName" class="form-label">
                                       Tên cửa hàng
                                       <span class="text-danger">*</span>
                                    </label>

                                    <input type="text"
                                       class="form-control <?= (isset($errors['storeName'])) ?  'is-invalid' : '' ?> "
                                       value="<?= isset($_POST['storeName']) ? htmlspecialchars($_POST['storeName']) : '' ?>"
                                       name="storeName" id="createStoreName" placeholder="Customer Name" />

                                    <?php if (isset($errors['storeName'])): ?>
                                       <div class="invalid-feedback">
                                          <?php foreach ($errors['storeName'] as $error): ?>
                                             <p style="margin : 0"><?php echo htmlspecialchars($error); ?></p>
                                          <?php endforeach; ?>
                                       </div>
                                    <?php endif; ?>

                                 </div>
                              </div>
                              <div class="col-lg-6 col-12">
                                 <div>
                                    <!-- input -->
                                    <label for="creatCustomerEmail" class="form-label">
                                       Email
                                       <span class="text-danger">*</span>
                                    </label>

                                    <input type="email"
                                       class="form-control <?= (isset($errors['email'])) ?  'is-invalid' : '' ?> "
                                       value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                                       name="email" id="creatCustomerEmail" placeholder="Email Address" />


                                    <?php if (isset($errors['email'])): ?>
                                       <div class="invalid-feedback">
                                          <?php foreach ($errors['email'] as $error): ?>
                                             <p style="margin : 0"><?php echo htmlspecialchars($error); ?></p>
                                          <?php endforeach; ?>
                                       </div>
                                    <?php endif; ?>
                                 </div>
                              </div>

                              <div class="col-12 mt-3">
                                 <div class="d-flex flex-column flex-md-row gap-2">
                                    <button class="btn btn-primary" type="submit">Tạo cửa hàng</button>
                                 </div>
                              </div>
                           </form>
                        
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>



   </div>
   </main>

   </div>


   <?= loadPartial('script') ?>
   <?= loadPartial('script-modal-alert') ?>


</body>

</html>