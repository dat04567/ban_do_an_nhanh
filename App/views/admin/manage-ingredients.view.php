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

            <?php


            loadComponents('ui/header-manage');

            // Định nghĩa các thông số cho header
            $title = "Nguyên liệu";
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => '/admin'],
               ['label' => 'Nguyên liệu', 'active' => true]
            ];
            $actionButton = '<a href="/admin/ingredients/create" class="btn btn-primary">Thêm nguyên liệu</a>';

            // Render header
            renderPageHeader($title, $breadcrumbs, $actionButton);


            // load alert modal
            loadPartial('modal-alert');


            ?>




            <!-- row -->
            <div class="row">
               <div class="col-xl-12 col-12 mb-5">
                  <!-- card -->
                  <div class="card h-100 card-lg">
                     <div class="px-6 py-6">
                        <div class="row justify-content-between">
                           <!-- form -->
                           <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
                              <form class="d-flex" role="search">
                                 <input class="form-control" type="search" placeholder="Search Products" aria-label="Search" />
                              </form>
                           </div>
                           <!-- select option -->

                        </div>
                     </div>

                     <!-- Modal -->
                     <?php
                     $message = 'Bạn có muốn xoá nguyên liệu này không ?';
                     loadComponents('layout/modal', 'admin', ['message' => $message]);

                     ?>

                     <!-- card body -->
                     <div class="card-body p-0">
                        <!-- table -->
                        <div class="table-responsive">
                           <table class="table table-centered table-hover text-nowrap table-borderless mb-0 table-with-checkbox">
                              <thead class="bg-light">
                                 <tr>
                                    <th class="text-center">
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="checkAll" />
                                          <label class="form-check-label" for="checkAll"></label>
                                       </div>
                                    </th>
                                    <th>Tên nguyên liệu</th>
                                    <th>Giá nguyên liệu </th>
                                    <th>Đơn vị</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody id="ingredients-table-body">
                                 <?php if (empty($ingredients)) : ?>
                                    <tr>
                                       <td colspan="5" class="text-center">Không có nguyên liệu nào</td>
                                    </tr>
                                 <?php else : ?>
                                    <?php foreach ($ingredients as $ingredient) : ?>
                                       <?php
                                       $classTrangThai = $ingredient['isDeleted'] == 0 ? 'bg-success' : 'bg-danger';
                                       ?>
                                       <tr>
                                          <td>
                                             <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="ingredient<?= $ingredient['idNguyenLieu'] ?>" />
                                                <label class="form-check-label" for="ingredient<?= $ingredient['idNguyenLieu'] ?>"></label>
                                             </div>
                                          </td>
                                          <td>
                                             <a href="/admin/ingredients/<?= $ingredient['idNguyenLieu'] ?>" class="text-reset"><?= $ingredient['tenNguyenLieu'] ?></a>
                                          </td>
                                          <td><?= number_format($ingredient['giaNguyenLieu'], 0, ',', '.') ?> VND</td>
                                          <td><?= $ingredient['donVi'] ?></td>
                                          <td>
                                             <span class="badge <?= $classTrangThai ?>">
                                                <?= $ingredient['isDeleted'] == 0 ? 'Còn sử dụng' : 'Đã xoá' ?>
                                             </span>
                                          </td>
                                          <td>
                                             <a href="/admin/ingredients/<?= $ingredient['idNguyenLieu'] ?>/edit" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square me-2"></i>Edit
                                             </a>
                                             <form action="/admin/ingredients/<?= $ingredient['idNguyenLieu'] ?>" class="d-inline-block ms-2 delete-form" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-danger mb-0">Delete</button>
                                             </form>
                                          </td>
                                       </tr>
                                    <?php endforeach; ?>
                                 <?php endif; ?>


                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="border-top d-md-flex justify-content-between align-items-center px-6 py-6">
                        <span>Showing 1 to 8 of 12 entries</span>
                        <nav class="mt-2 mt-md-0">
                           <ul class="pagination mb-0">
                              <li class="page-item disabled"><a class="page-link" href="#!">Previous</a></li>
                              <li class="page-item"><a class="page-link active" href="#!">1</a></li>
                              <li class="page-item"><a class="page-link" href="#!">2</a></li>
                              <li class="page-item"><a class="page-link" href="#!">3</a></li>
                              <li class="page-item"><a class="page-link" href="#!">Next</a></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>

   </div>



   <?= loadPartial('script') ?>
   <script src="/assets/js/submit-modal.js"></script>
   <?= loadPartial('script-modal-alert') ?>


</body>

</html>