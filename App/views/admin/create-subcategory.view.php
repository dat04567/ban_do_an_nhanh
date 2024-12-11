<?= loadPartial('head') ?>

<link href="/assets/css/custom.css" rel="stylesheet" />
<link href="/assets/libs/dropzone/dropzone.min.css" rel="stylesheet" />

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
            $title = 'Thêm danh mục ';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => '/admin'],
               ['label' => 'Danh mục ', 'href' => '/admin/sub-categories'],
               ['label' => 'Thêm', 'active' => true]
            ];


            // Render header
            renderPageHeader($title, $breadcrumbs);

            // load alert modal
            loadPartial('modal-alert');


            ?>
            <div class="row">
               <div class="col-lg-12 col-12">
                  <!-- card -->
                  <div class="card mb-6 shadow border-0">
                     <!-- card body -->
                     <form class="card-body p-6" novalidate method="POST" id="" enctype="multipart/form-data">
                      

                        <h4 class="mb-4 h5   ">Thông tin danh mục</h4>

                        <div class="row ">
                           <!-- input -->
                           <div class="mb-3 col-lg-6">
                              <label class="form-label">Tên danh mục</label>
                              <input type="text" class="form-control <?= (isset($errors['tenDanhMuc'])) ?  'is-invalid' : '' ?> " name="tenDanhMuc" placeholder="Tên danh mục" value="<?= isset($tenDanhMuc) ? $tenDanhMuc : '' ?>" />

                              <?php if (isset($errors['tenDanhMuc'])) : ?>
                                 <div class="invalid-feedback">
                                    <?php foreach ($errors['tenDanhMuc'] as $error) : ?>
                                       <p class="m-0"> <?= $error ?> </p>
                                    <?php endforeach; ?>
                                 </div>
                              <?php endif; ?>
                           </div>


                           <div class="mb-3 col-lg-6">
                              <label class="form-label">Danh mục cha</label>
                              <select name="idDanhMucCha" class="form-select <?= (isset($errors['idDanhMuc'])) ?  'is-invalid' : '' ?>">
                                 <option value="" selected>Chọn danh mục</option>
                                 <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['idDanhMuc'] ?>" <?= isset($idDanhMuc) && $idDanhMuc == $category['idDanhMuc'] ? 'selected' : '' ?>><?= $category['tenDanhMuc'] ?></option>
                                 <?php endforeach; ?>
                              </select>
                              <?php if (isset($errors['idDanhMuc'])) : ?>
                                 <div class="invalid-feedback">
                                    <p style="margin : 0"><?= $errors['idDanhMuc'][0] ?></p>
                                 </div>
                              <?php endif; ?>
                           </div>






                           <!-- input -->
                           <div class="mb-3 col-lg-12">
                              <label class="form-label" id="productSKU">Trạng thái </label>
                              <br />
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="isActive" id="inlineRadio1" value="true" checked />
                                 <label class="form-check-label" for="inlineRadio1">Active</label>
                              </div>
                              <!-- input -->
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="isActive" id="inlineRadio2" value="false" <?= isset($isActive) && !$isActive  ? 'checked' : '' ?> />
                                 <label class="form-check-label" for="inlineRadio2">Disabled</label>
                              </div>
                              <!-- input -->
                           </div>

                           <div class="col-lg-12">
                              <button type="submit" class="btn btn-primary">Thêm danh mục</button>

                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>


         </div>

   </div>
   </main>

   </div>


   <?= loadPartial('script') ?>
   <script src="/assets/libs/dropzone/dropzone.min.js"></script>
   <script src="/assets/js/submit-modal.js"></script>
   <?= loadPartial('script-modal-alert') ?>




</body>

</html>