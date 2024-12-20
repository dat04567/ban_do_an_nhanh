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
            $title = 'Đơn Hàng';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => '/admin'],
               ['label' => 'Đơn hàng', 'active' => true]
            ];

            // Render header
            renderPageHeader($title, $breadcrumbs);
            ?>

            <div class="row">
               <div class="col-xl-12 col-12 mb-5">
                  <!-- card -->
                  <div class="card h-100 card-lg">
                     <div class="p-6">
                        <div class="row justify-content-between">
                           <div class="col-md-4 col-12 mb-2 mb-md-0">
                              <!-- form -->
                              <form class="d-flex" role="search">
                                 <input class="form-control" type="search" placeholder="Search" aria-label="Search" />
                              </form>
                           </div>
                           <div class="col-lg-2 col-md-4 col-12">
                              <!-- select -->
                              <select class="form-select">
                                 <option selected>Status</option>
                                 <option value="Success">Success</option>
                                 <option value="Pending">Pending</option>
                                 <option value="Cancel">Cancel</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <!-- card body -->
                     <div class="card-body p-0">
                        <!-- table responsive -->
                        <div class="table-responsive">
                           <table class="table table-centered table-hover text-nowrap table-borderless mb-0 table-with-checkbox">
                              <thead class="bg-light">
                                 <tr>
                                    <th>
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="checkAll" />
                                          <label class="form-check-label" for="checkAll"></label>
                                       </div>
                                    </th>
                                    <th>Hình ảnh</th>
                                    <th>Tên đơn hàng</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày & Giờ</th>
                                    <th>Thanh toán</th>
                                    <th>Trạng thái</th>
                                    <th>Số tiền</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php if (isset($orders) && count($orders) > 0) : ?>
                                    <?php foreach ($orders as $order) : ?>
                                       <tr>
                                          <td>
                                             <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?= $order['maDonHang'] ?>" id="order<?= $order['maDonHang'] ?>" />
                                                <label class="form-check-label" for="order<?= $order['maDonHang'] ?>"></label>
                                             </div>
                                          </td>
                                          <td>
                                             <a href="#!"><img src="<?= $order['hinhAnh'][0] ?>" alt="" class="icon-shape icon-md" /></a>
                                          </td>
                                          <td><a href="#" class="text-reset"><?= $order['tenSanPham'] ?></a></td>
                                          <td><?= $order['hoKhachHang'] . ' ' . $order['tenKhachHang'] ?></td>
                                          <td><?= date('d M Y (h:i a)', strtotime($order['ngayGio'])) ?></td>
                                          <td><?= $order['phuongThucThanhToan'] ?></td>
                                          <td>
                                             <span class="badge bg-light-primary text-dark-primary"><?= $order['trangThai'] ?></span>
                                          </td>
                                          <td>$<?= number_format($order['soTien'], 2) ?></td>
                                          <td>
                                             <div class="dropdown">
                                                <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                   <i class="feather-icon icon-more-vertical fs-5"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                   <li>
                                                      <a class="dropdown-item" href="#">
                                                         <i class="bi bi-trash me-3"></i>Delete
                                                      </a>
                                                   </li>
                                                   <li>
                                                      <a class="dropdown-item" href="#">
                                                         <i class="bi bi-pencil-square me-3"></i>Edit
                                                      </a>
                                                   </li>
                                                </ul>
                                             </div>
                                          </td>
                                       </tr>
                                    <?php endforeach; ?>
                                 <?php else : ?>
                                    <tr>
                                       <td colspan="8" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                 <?php endif; ?>

                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="border-top d-md-flex justify-content-between align-items-center p-6">
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


   <?= loadPartial('script') ?>>
</body>

</html>