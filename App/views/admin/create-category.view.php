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
            $title = 'Thêm danh mục';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => '/admin'],
               ['label' => 'Danh mục', 'href' => '/admin/categories'],
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
                     <form class="card-body p-6" novalidate method="POST" enctype="multipart/form-data">
                        <h4 class="mb-5 h5">Hình ảnh </h4>
                        <div class="mb-4 d-flex">

                           <div class="position-relative">
                              <img class="image icon-shape icon-xxxl bg-light rounded-4" src="<?= !empty($pathImage) ? $pathImage : '/assets/images/icons/bakery.svg' ?>" alt="Image Description" />

                              <div class="file-upload position-absolute end-0 top-0 mt-n2 me-n1">
                                 <input type="file" class="file-input" name="image" id="fileInput" />
                                 <input type="hidden" name="savedFile" value="<?= !empty($pathImage) ? $pathImage : '' ?>" />
                                 <span class="icon-shape icon-sm rounded-circle bg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil-fill text-muted" viewBox="0 0 16 16">
                                       <path
                                          d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                    </svg>
                                 </span>
                              </div>


                           </div>

                        </div>
                        <h4 class="mb-4 h5   ">Thông tin danh mục</h4>
                        <div class="row align-items-center">
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
                                 <input class="form-check-input" type="radio" name="isActive" id="inlineRadio2" value="false"  <?= isset($isActive) && !$isActive  ? 'checked' : '' ?> />
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
  
   <?= loadPartial('script-modal-alert') ?>


</body>

</html>