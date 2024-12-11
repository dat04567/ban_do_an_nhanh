<?= loadPartial('head') ?>

<link href="/assets/css/custom.css" rel="stylesheet" />
<link href="/assets/libs/dropzone/dropzone.min.css" rel="stylesheet" />

<link rel="stylesheet" href="/assets/css/alert.css" />
<link rel="stylesheet" href="/assets/css/foods.css">
<link rel="stylesheet" href="/assets/libs/boostrap-select/bootstrap-select.min.css">


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
            $title = 'Thêm món ăn';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => '/admin'],
               ['label' => 'Món ăn', 'href' => '/admin/foods'],
               ['label' => 'Thêm', 'active' => true]
            ];

            $actionButton = '<a href="/admin/foods" class="btn  btn-light">Quay lại món ăn</a>';
            // Render header
            renderPageHeader($title, $breadcrumbs, $actionButton);

            // load alert modal
            loadPartial('modal-alert');


            ?>

            <!-- row -->
            <form class="row" method="POST" novalidate>
               <div class="col-lg-8 col-12">
                  <!-- card -->
                  <div class="card mb-6 card-lg">
                     <!-- card body -->
                     <div class="card-body p-6">
                        <h4 class="mb-4 h5">Thông tin món ăn</h4>
                        <div class="row">
                           <!-- input -->
                           <div class="mb-3 col-lg-6">
                              <label class="form-label">Tên món ăn</label>
                              <input type="text" name="tenSanPham" class="form-control <?= isset($errors['tenSanPham']) ? 'is-invalid' : '' ?>" placeholder="Nhập tên món ăn" value="<?= isset($tenSanPham) ? $tenSanPham : '' ?>" />
                              <?php if (isset($errors['tenSanPham'])) : ?>
                                 <?php foreach ($errors['tenSanPham'] as $error) : ?>
                                    <div class="invalid-feedback"><?= $error ?></div>
                                 <?php endforeach; ?>
                              <?php endif; ?>
                           </div>
                           <!-- input -->
                           <div class="mb-3 col-lg-6">
                              <label class="form-label">Danh mục</label>
                              <br />   
                              <select class="selectpicker <?= isset($errors['danhMuc']) ? 'is-invalid' : '' ?>" name="danhMuc[]" multiple title = "Chọn danh mục">
                                 <?php if (!empty($subcategories)) : ?>
                                    <?php foreach ($subcategories as $subcategory) : ?>
                                       <option value="<?= $subcategory['idDanhMucCon'] ?>" <?= isset($danhMuc) && in_array($subcategory['idDanhMucCon'], $danhMuc) ? 'selected' : '' ?>><?= $subcategory['tenDanhMucCon'] ?></option>
                                    <?php endforeach; ?>
                                 <?php endif; ?>
                              </select>
                              <?php if (isset($errors['danhMuc'])) : ?>
                                 <div class="invalid-feedback"><?= $errors['danhMuc'][0] ?></div>
                              <?php endif; ?>
                           </div>


                           <div class="mb-3 col-lg-6">
                              <label class="form-label">Cửa hàng</label>
                              <br />
                              <select class="selectpicker <?= isset($errors['cuaHang']) ? 'is-invalid' : '' ?>" name="cuaHang[]" title="Chọn cửa hàng" multiple>

                                 <?php if (!empty($stores)) : ?>
                                    <?php foreach ($stores as $store) : ?>
                                       <option value="<?= $store['idCuaHang'] ?>" <?= isset($cuaHang) && in_array($store['idCuaHang'], $cuaHang) ? 'selected' : '' ?>><?= $store['storeName'] ?></option>

                                    <?php endforeach; ?>
                                 <?php endif; ?>
                              </select>
                              <?php if (isset($errors['cuaHang'])) : ?>
                                 <div class="invalid-feedback"><?= $errors['cuaHang'][0] ?></div>
                              <?php endif; ?>
                           </div>


                           <div>
                              <div class="mb-3 col-lg-12 mt-5">
                                 <!-- heading -->
                                 <h4 class="mb-3 h5">Hình ảnh</h4>

                                 <!-- input -->
                                 <div id="my-dropzone" class="dropzone mt-4 border-dashed rounded-2 min-h-0"></div>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-12">
                  <!-- card -->
                  <div class="card mb-6 card-lg">
                     <!-- card body -->
                     <div class="card-body p-6">
                        <!-- input -->
                        <div class="form-check form-switch mb-4">
                           <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchStock" name="isProIng" <?= isset($isProIng) && $isProIng == 1 ? 'checked' : '' ?> />
                           <label class="form-check-label" for="flexSwitchStock">Nguyên liệu</label>
                        </div>
                      
                        <div id="choose-ingredients">

                        </div>




                        <!-- input -->
                        <div class="mb-3">
                           <label class="form-label" id="productSKU">Trạng thái</label>
                           <br />
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="trangThai" id="inlineRadio1" value="Active" checked />
                              <label class="form-check-label" for="inlineRadio1">Hoạt động</label>
                           </div>
                           <!-- input -->
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="trangThai" id="inlineRadio2" value="Deactive" />
                              <label class="form-check-label" for="inlineRadio2">Không hoạt động</label>
                           </div>
                        </div>


                     </div>
                  </div>
                  <!-- card -->
                  <div class="card mb-6 card-lg">
                     <!-- card body -->
                     <div class="card-body p-6">
                        <h4 class="mb-4 h5">Giá sản phẩm</h4>
                        <!-- input -->
                        <div class="mb-3">
                           <label class="form-label">Giá gốc</label>
                           <input type="number" id="giaGoc" name="gia" class="form-control <?= isset($errors['gia']) ? 'is-invalid' : '' ?>" placeholder="0.00₫" value="<?= isset($gia) ? $gia : '' ?>" />
                           <?php if (isset($errors['gia'])) : ?>
                              <?php foreach ($errors['gia'] as $error) : ?>
                                 <div class="invalid-feedback"><?= $error ?></div>
                              <?php endforeach; ?>
                           <?php endif; ?>
                        </div>
                        <!-- input -->
                        <div class="mb-3" id="sumIngredients">
                           <label class="form-label">Tổng giá nguyên liệu</label>
                           <input type="text" id="tongGiaNguyenLieu" class="form-control" placeholder="0.00₫" value="0" disabled />
                        </div>
                        <!-- input -->
                        <div class="mb-3">
                           <label class="form-label">Tổng giá</label>
                           <input type="text" id="tongGia" class="form-control" placeholder="0.00₫" value="0" disabled />
                        </div>

                     </div>
                  </div>

                  <!-- button -->
                  <div class="d-grid">
                     <button type="submit" class="btn btn-primary">Create Product</button>
                  </div>
               </div>
            </form>


         </div>

   </div>
   </main>

   </div>


   <?= loadPartial('script') ?>
   <script src="/assets/js/alert.js"></script>
   <script src="/assets/libs/dropzone/dropzone.min.js"></script>
   <script src="/assets/js/vendors/dropzone.js"></script>
   <script type="module" src="/assets/js/admin/foods.js"></script>
   <?= loadPartial('script-modal-alert') ?>
   <script src="/assets/libs/boostrap-select/bootstrap-select.min.js"></script>
   <script src="/assets/libs/boostrap-select/i18n/defaults-vi_VN.js"></script>


   <?php if (isset($images)): ?>
      <script>
         let images = <?= json_encode($images) ?>;
         images.forEach(image => {
            let mockFile = {
               name: image.fileName,
               size: image.size
            };
            myDropzone.emit("addedfile", mockFile);
            myDropzone.emit("thumbnail", mockFile, image.path);
            myDropzone.emit("complete", mockFile);
         });
      </script>
   <?php endif; ?>

   <script>
      $(document).ready(function() {
         $('#select').selectpicker();

      });
   </script>




</body>

</html>