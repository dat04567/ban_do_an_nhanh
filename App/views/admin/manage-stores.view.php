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
                                    <th>Cửa hàng ID</th>
                                    <th>Tên cửa hàng</th>
                                    <th>Email</th>
                                    <th>Tổng doanh thu</th>
                                    <th>Lợi nhuận</th>

                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach ($stores as $store) : ?>
                                    <tr>
                                       <td>
                                          <div class="form-check">
                                             <input class="form-check-input" type="checkbox" value="" id="categoryOne" />
                                             <label class="form-check-label" for="categoryOne"></label>
                                          </div>
                                       </td>

                                       <td class="text-truncate" style="max-width: 100px;">
                                          <span><?= $store['idCuaHang'] ?> </span>
                                       </td>
                                       <td><?= $store['storeName'] ?> </td>
                                       <td> <?= $store['email'] ?> </td>
                                          <td> <?= number_format($store['tongDoanhThu'], 0, ',', '.') ?> VND</td>
                                          <td> <?= number_format($store['loiNhuan'], 0, ',', '.') ?> VND</td>


                                       <td>
                                          <div class="dropdown">
                                             <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                             </a>
                                             <ul class="dropdown-menu">
                                                <li>
                                                   <a class="dropdown-item" href="#">
                                                      <i class="bi bi-trash me-3"></i>
                                                      Delete
                                                   </a>
                                                </li>
                                                <li>
                                                   <a class="dropdown-item" href="/admin/stores/<?= $store['idCuaHang'] ?> ">
                                                      <i class="bi bi-pencil-square me-3"></i>
                                                      Edit
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </td>
                                    </tr>
                                 <?php endforeach; ?>
                               

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
</body>

</html>