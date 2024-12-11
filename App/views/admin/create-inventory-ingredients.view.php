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
            $title = 'Nhập kho nguyên liệu';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => 'index.php'],
               ['label' => 'Nhập', 'active' => true]
            ];
            // Render header
            renderPageHeader($title, $breadcrumbs);

            // load alert modal
            loadPartial('modal-alert');




            ?>


            <div class="row">
               <div class="col-12">
                  <div class="card shadow border-0">
                     <div class="card-body d-flex flex-column gap-8 p-7">

                        <div class="d-flex flex-column gap-4">
                           <h3 class="mb-0 h6">Thông tin kho nguyên liệu</h3>
                           <form class="row g-3 needs-validation" method="POST" action="/admin/inventory-ingredients/import" novalidate>
                              <?php

                              use Framework\SessionManager;

                              $session =  SessionManager::getInstance();

                              if ($session->has('validation-errors')) {
                                 $validationErrors = $session->get('validation-errors');
                                 $oldInputs = $session->get('old-inputs');
                                 // inspectAndDie($oldInputs);
                                 // inspectAndDie($validationErrors);

                                 $session->remove('old-inputs');
                                 $session->remove('validation-errors');
                              }




                              ?>
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Cửa hàng</label>
                                 <select class="form-select <?= isset($validationErrors['idCuaHang']) ? 'is-invalid' : '' ?>" name="idCuaHang">
                                    <option value="" selected>Chọn cửa hàng</option>
                                    <?php foreach ($stores as $store) : ?>
                                       <option value="<?= $store['idCuaHang'] ? $store['idCuaHang'] : '' ?>" <?= isset($oldInputs['idCuaHang']) && $oldInputs['idCuaHang'] == $store['idCuaHang'] ? 'selected' : '' ?>><?= $store['storeName'] ?></option>
                                    <?php endforeach; ?>
                                 </select>
                                 <?php if (isset($validationErrors['idCuaHang'])) : ?>
                                    <div class="invalid-feedback">
                                       <p style="margin : 0"><?= $validationErrors['idCuaHang'][0] ?></p>
                                    </div>
                                 <?php endif; ?>

                              </div>
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Nguyên liệu</label>
                                 <select class="form-select <?= isset($validationErrors['idNguyenLieu']) ? 'is-invalid' : '' ?>" name="idNguyenLieu">
                                    <option value="" selected>Chọn nguyên liệu</option>
                                    <?php foreach ($ingredients as $ingredient) : ?>
                                       <option value="<?= $ingredient['idNguyenLieu'] ?>" <?= isset($oldInputs['idNguyenLieu']) && $oldInputs['idNguyenLieu'] == $ingredient['idNguyenLieu'] ? 'selected' : '' ?>><?= $ingredient['tenNguyenLieu'] ?></option>
                                    <?php endforeach; ?>

                        

                                 </select>

                                 <?php if (isset($validationErrors['idNguyenLieu'])) : ?>
                                    <div class="invalid-feedback">
                                       <p style="margin : 0"><?= $validationErrors['idNguyenLieu'][0] ?></p>
                                    </div>
                                 <?php endif; ?>

                              </div>

                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Số lượng kho</label>
                                 <input type="number" class="form-control <?= isset($validationErrors['soLuongTonKho']) ? 'is-invalid' : '' ?>" placeholder="Số lượng" name="soLuongTonKho" value="<?= $oldInputs['soLuongTonKho'] ?? "" ?>">

                                 <?php if (isset($validationErrors['soLuongTonKho'])) : ?>
                                    <?php foreach ($validationErrors['soLuongTonKho'] as $error) : ?>
                                       <div class="invalid-feedback">
                                          <p style="margin : 0"><?= $error ?></p>
                                       </div>
                                    <?php endforeach; ?>
                                 <?php endif; ?>
                              </div>


                              <div class="col-12 mt-3">
                                 <div class="d-flex flex-column flex-md-row gap-2">
                                    <button class="btn btn-primary" type="submit">Tạo kho nguyên liệu</button>
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