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
            $title = 'Cửa hàng';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => 'index.php'],
               ['label' => 'Cửa hàng', 'active' => true]
            ];


            $actionButton = '<a href="/admin/stores/create" class="btn btn-primary">Thêm cửa hàng</a>';

            // Render header
            renderPageHeader($title, $breadcrumbs, $actionButton);

            // load alert modal 
            loadPartial('modal-alert');

            ?>






            <!-- Modal delete -->
            <?php
            $message = 'Bạn có muốn xoá cửa hàng này không ?';
            loadComponents('layout/modal', 'admin', ['message' => $message]);

            ?>





            <div class="row">
               <div class="col-xl-12 col-12 mb-5">
                  <!-- card -->
                  <div class="card h-100 card-lg">
                     <div class="px-6 py-6">
                        <div class="row justify-content-between">
                           <div class="col-lg-4 col-md-6 col-12 mb-2 mb-md-0">
                              <!-- form -->
                              <form class="d-flex" role="search">
                                 <input class="form-control" type="search" placeholder="Tìm kiếm cửa hàng" aria-label="Search" />
                              </form>
                           </div>

                        </div>
                     </div>
                     <!-- card body -->
                     <div class="card-body p-0">
                        <!-- table -->
                        <div class="table-responsive">
                           <table class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
                              <thead class="bg-light">
                                 <tr>
                                    <th>
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="checkAll" />
                                          <label class="form-check-label" for="checkAll"></label>
                                       </div>
                                    </th>
                                    <th>Tên cửa hàng</th>
                                    <th>Email</th>
                                    <th>Tổng doanh thu</th>
                                    <th>Lợi nhuận</th>
                                    <th>Trạng thái</th>

                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody id="stores-table-body">

                                 <?php if (empty($stores)) : ?>
                                    <tr>
                                       <td colspan="7" class="text-center">Không có cửa hàng nào</td>
                                    </tr>
                                 <?php endif; ?>

                                 <?php if (!empty($stores)) : ?>
                                    <?php foreach ($stores as $store) : ?>

                                       <?php
                                       $classTrangThai = $store['isDeleted'] == 1 ? 'bg-danger' : 'bg-success';
                                       ?>
                                       <tr>
                                          <td>
                                             <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="store<?= $store['idCuaHang'] ?>" id="store<?= $store['idCuaHang'] ?>" />
                                                <label class="form-check-label" for="store<?= $store['idCuaHang'] ?>"></label>
                                             </div>
                                          </td>
                                          <td><?= $store['storeName'] ?></td>
                                          <td><?= $store['email'] ?></td>
                                          <td><?= number_format($store['tongDoanhThu'], 0, ',', '.') ?> VND</td>
                                          <td><?= number_format($store['loiNhuan'], 0, ',', '.') ?> VND</td>
                                          <td >
                                             <span class="badge <?= $classTrangThai ?>">
                                                <?= $store['isDeleted'] == 1 ? 'Đã xoá' : 'Hoạt động' ?>
                                             </span>
                                          </td>
                                          <td>
                                             <a href="/admin/stores/<?= $store['idCuaHang'] ?>/edit" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square me-2"></i>Edit
                                             </a>
                                             <form action="/admin/stores/<?= $store['idCuaHang'] ?>" class="d-inline-block ms-2 delete-form" method="POST">
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
                     <div class="border-top d-flex justify-content-between align-items-md-center px-6 py-6 flex-md-row flex-column gap-4">
                        <span>Showing 1 to 8 of 12 entries</span>
                        <nav>
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