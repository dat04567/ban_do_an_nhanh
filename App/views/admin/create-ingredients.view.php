<?= loadPartial('head') ?>

<?= loadComponents('layout/script', 'admin') ?>

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
            $title = 'Thêm nguyên liệu';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => 'index.php'],
               ['label' => 'Thêm', 'active' => true]
            ];
            // Render header
            renderPageHeader($title, $breadcrumbs);
            // load alert modal

            loadPartial('modal-alert');
            loadPartial('alert');
            ?>
         

            <div class="row">
               <div class="col-12">
                  <div class="card shadow border-0">
                     <div class="card-body d-flex flex-column gap-8 p-7">

                        <div class="d-flex flex-column gap-4">
                           <h3 class="mb-0 h6">Thông tin nguyên liệu</h3>
                           <form class="row g-3 needs-validation" method="POST" action="/admin/ingredients/create" novalidate>
                              <div class="col-lg-6 col-12">
                                 <div>
                                    <!-- input -->
                                    <label for="createIngredientName" class="form-label">
                                       Tên nguyên liệu
                                       <span class="text-danger">*</span>
                                    </label>

                                    <input type="text"
                                       class="form-control <?= (isset($errors['tenNguyenLieu'])) ?  'is-invalid' : '' ?> "
                                       value="<?= isset($_POST['tenNguyenLieu']) ? htmlspecialchars($_POST['tenNguyenLieu']) : '' ?>"
                                       name="tenNguyenLieu" id="createIngredientName" placeholder="Tên nguyên liệu" required />

                                    <?php if (isset($errors['tenNguyenLieu'])): ?>
                                       <div class="invalid-feedback">
                                          <?php foreach ($errors['tenNguyenLieu'] as $error): ?>
                                             <p style="margin : 0"><?php echo htmlspecialchars($error); ?></p>
                                          <?php endforeach; ?>
                                       </div>
                                    <?php endif; ?>

                                 </div>
                              </div>
                              <div class="col-lg-6 col-12">
                                 <div>
                                    <!-- input -->
                                    <label for="createIngredientUnit" class="form-label">
                                       Đơn vị

                                    </label>

                                    <select class="form-select <?= (isset($errors['donVi'])) ? 'is-invalid' : '' ?>"
                                       name="donVi" id="createIngredientUnit">
                                       <option value="kg" <?= (isset($_POST['donVi']) && $_POST['donVi'] == 'kg') ? 'selected' : '' ?>>Kg</option>
                                       <option value="g" <?= (isset($_POST['donVi']) && $_POST['donVi'] == 'g') ? 'selected' : '' ?>>G</option>
                                       <option value="chai" <?= (isset($_POST['donVi']) && $_POST['donVi'] == 'chai') ? 'selected' : '' ?>>Chai</option>
                                       <option value="Lon" <?= (isset($_POST['donVi']) && $_POST['donVi'] == 'Lon') ? 'selected' : '' ?>>Lon</option>
                                       <option value="Thùng" <?= (isset($_POST['donVi']) && $_POST['donVi'] == 'Thùng') ? 'selected' : '' ?>>Thùng</option>
                                       <option value="Hộp" <?= (isset($_POST['donVi']) && $_POST['donVi'] == 'Hộp') ? 'selected' : '' ?>>Hộp</option>
                                    </select>




                                 </div>
                              </div>
                              <div class="col-lg-6 col-12">
                                 <div>
                                    <!-- input -->
                                    <label for="createIngredientPrice" class="form-label">
                                       Giá nguyên liệu
                                       <span class="text-danger">*</span>
                                    </label>

                                    <input type="number"
                                       class="form-control <?= (isset($errors['giaNguyenLieu'])) ?  'is-invalid' : '' ?> "
                                       value="<?= isset($_POST['giaNguyenLieu']) ? htmlspecialchars($_POST['giaNguyenLieu']) : '' ?>"
                                       name="giaNguyenLieu" id="createIngredientPrice" placeholder="Giá nguyên liệu" required />

                                    <?php if (isset($errors['giaNguyenLieu'])): ?>
                                       <div class="invalid-feedback">
                                          <?php foreach ($errors['giaNguyenLieu'] as $error): ?>
                                             <p style="margin : 0"><?php echo htmlspecialchars($error); ?></p>
                                          <?php endforeach; ?>
                                       </div>
                                    <?php endif; ?>
                                 </div>
                              </div>

                              <div class="col-12 mt-3">
                                 <div class="d-flex flex-column flex-md-row gap-2">
                                    <button class="btn btn-primary" type="submit">Tạo nguyên liệu</button>
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