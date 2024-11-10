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
            $title = "Sản phẩm";
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => 'index.php'],
               ['label' => 'Sản phẩm', 'active' => true]
            ];
            $actionButton = '<a href="add-product.php" class="btn btn-primary">Thêm sản phẩm</a>';

            // Render header
            renderPageHeader($title, $breadcrumbs, $actionButton);
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
                           <div class="col-lg-2 col-md-4 col-12">
                              <select class="form-select">
                                 <option selected>Status</option>
                                 <option value="1">Hoạt động</option>
                                 <option value="2">Deactive</option>
                                 <option value="3">Draft</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <!-- card body -->
                     <div class="card-body p-0">
                        <!-- table -->
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
                                    <th>Tên sản phẩm</th>
                                    <th>Loại</th>
                                    <th>Trạng thái</th>
                                    <th>Tiền</th>
                                    <th>Ngày tạo</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>

                                 <tr>
                                    <td>
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="productOne" />
                                          <label class="form-check-label" for="productOne"></label>
                                       </div>
                                    </td>
                                    <td>
                                       <a href="#!"><img src="../assets/images/products/product-img-1.jpg" alt="" class="icon-shape icon-md" /></a>
                                    </td>
                                    <td><a href="#" class="text-reset">Snack khoai tây</a></td>
                                    <td>Đồ ăn vặt & Snack</td>
                                    <td>
                                       <span class="badge bg-light-primary text-dark-primary">Hoạt động</span>
                                    </td>
                                    <td>418.000đ</td>
                                    <td>24/11/2022</td>
                                    <td>
                                       <div class="dropdown">
                                          <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                             <i class="feather-icon icon-more-vertical fs-5"></i>
                                          </a>
                                          <ul class="dropdown-menu">
                                             <li>
                                                <a class="dropdown-item" href="#">
                                                   <i class="bi bi-trash me-3"></i>
                                                   Xóa
                                                </a>
                                             </li>
                                             <li>
                                                <a class="dropdown-item" href="#">
                                                   <i class="bi bi-pencil-square me-3"></i>
                                                   Sửa
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </td>
                                 </tr>

                                 <tr>
                                    <td>
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="productOne" />
                                          <label class="form-check-label" for="productOne"></label>
                                       </div>
                                    </td>
                                    <td>
                                       <a href="#!"><img src="../assets/images/products/product-img-1.jpg" alt="" class="icon-shape icon-md" /></a>
                                    </td>
                                    <td><a href="#" class="text-reset">Snack khoai tây</a></td>
                                    <td>Đồ ăn vặt & Snack</td>
                                    <td>
                                       <span class="badge bg-light-primary text-dark-primary">Hoạt động</span>
                                    </td>
                                    <td>418.000đ</td>
                                    <td>24/11/2022</td>
                                    <td>
                                       <div class="dropdown">
                                          <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                             <i class="feather-icon icon-more-vertical fs-5"></i>
                                          </a>
                                          <ul class="dropdown-menu">
                                             <li>
                                                <a class="dropdown-item" href="#">
                                                   <i class="bi bi-trash me-3"></i>
                                                   Xóa
                                                </a>
                                             </li>
                                             <li>
                                                <a class="dropdown-item" href="#">
                                                   <i class="bi bi-pencil-square me-3"></i>
                                                   Sửa
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="productOne" />
                                          <label class="form-check-label" for="productOne"></label>
                                       </div>
                                    </td>
                                    <td>
                                       <a href="#!"><img src="../assets/images/products/product-img-1.jpg" alt="" class="icon-shape icon-md" /></a>
                                    </td>
                                    <td><a href="#" class="text-reset">Snack khoai tây</a></td>
                                    <td>Đồ ăn vặt & Snack</td>
                                    <td>
                                       <span class="badge bg-light-primary text-dark-primary">Hoạt động</span>
                                    </td>
                                    <td>418.000đ</td>
                                    <td>24/11/2022</td>
                                    <td>
                                       <div class="dropdown">
                                          <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                             <i class="feather-icon icon-more-vertical fs-5"></i>
                                          </a>
                                          <ul class="dropdown-menu">
                                             <li>
                                                <a class="dropdown-item" href="#">
                                                   <i class="bi bi-trash me-3"></i>
                                                   Xóa
                                                </a>
                                             </li>
                                             <li>
                                                <a class="dropdown-item" href="#">
                                                   <i class="bi bi-pencil-square me-3"></i>
                                                   Sửa
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </td>
                                 </tr>

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
</body>

</html>