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
            $title = 'Nhập kho sản phẩm';
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
                           <h3 class="mb-0 h6">Thông tin kho sản phẩm</h3>
                           <form class="row g-3 needs-validation" method="POST" action="/admin/inventory-products/import" novalidate>

                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Cửa hàng</label>
                                 <select class="form-select  <?= isset($errors['idCuaHang']) ? 'is-invalid' : '' ?>" name="idCuaHang">
                                    <option value="" selected>Chọn cửa hàng</option>
                                    <?php foreach ($stores as $store) : ?>
                                       <option value="<?=  $store['idCuaHang'] ?>" <?= isset($idCuaHang) && $idCuaHang == $store['idCuaHang'] ? 'selected' : '' ?>><?= $store['storeName'] ?></option>
                                    <?php endforeach; ?>
                                 </select>
                                 <?php if (isset($errors['idCuaHang'])) : ?>
                                    <div class="invalid-feedback">
                                       <p style="margin : 0"><?= $errors['idCuaHang'][0] ?></p>
                                    </div>
                                 <?php endif; ?>

                              </div>
                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Sản phẩm</label>
                                 <select class="form-select <?= isset($errors['idSanPham']) ? 'is-invalid' : '' ?>" name="idSanPham">
                                    <option value="" selected>Chọn sản phẩm </option>

                                    <?php if (isset($products)) : ?>
                                       <?php foreach ($products as $product) : ?>
                                          <option value="<?= $product['idSanPham'] ?>" <?= isset($idSanPham) && $idSanPham == $product['idSanPham'] ? 'selected' : '' ?>><?= $product['tenSanPham'] ?></option>
                                       <?php endforeach; ?>
                                    <?php endif; ?>




                                 </select>

                                 <?php if (isset($errors['idNguyenLieu'])) : ?>
                                    <div class="invalid-feedback">
                                       <p style="margin : 0"><?= $errors['idNguyenLieu'][0] ?></p>
                                    </div>
                                 <?php endif; ?>

                              </div>

                              <div class="mb-3 col-lg-6">
                                 <label class="form-label">Số lượng kho</label>
                                 <input type="number" class="form-control <?= isset($errors['soLuongTonKho']) ? 'is-invalid' : '' ?>" placeholder="Số lượng" name="soLuongTonKho" value="<?= $soLuongTonKho ?>">

                                 <?php if (isset($errors['soLuongTonKho'])) : ?>
                                    <?php foreach ($errors['soLuongTonKho'] as $error) : ?>
                                       <div class="invalid-feedback">
                                          <p style="margin : 0"><?= $error ?></p>
                                       </div>
                                    <?php endforeach; ?>
                                 <?php endif; ?>
                              </div>


                              <div class="col-12 mt-3">
                                 <div class="d-flex flex-column flex-md-row gap-2">
                                    <button class="btn btn-primary" type="submit">Tạo kho sản phẩm</button>
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