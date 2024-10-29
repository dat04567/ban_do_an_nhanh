<?= loadPartial('head') ?>

<link href="/assets/css/custom.css" rel="stylesheet" />
</head>

<body id="">

   <?= loadPartial('nav-bar') ?>
   <div class="main-wrapper">
      <?= loadPartial('nav-bar-vertical') ?>
      <!-- main wrapper -->
      <main class="main-content-wrapper">

         <div class="container">
            <!-- row -->
            <?php
            loadPartial('header-manage');

            // Định nghĩa các thông số cho header
            $title = 'Khách hàng';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => 'index.php'],
               ['label' => 'Khách hàng', 'active' => true]
            ];


            $actionButton = '<a href="add-category.php" class="btn btn-primary">Thêm Khách Hàng</a>';

            // Render header
            renderPageHeader($title, $breadcrumbs, $actionButton);
            ?>

            <div class="row">
               <div class="col-xl-12 col-12 mb-5">
                  <div class="card h-100 card-lg">
                     <div class="p-6">
                        <div class="row justify-content-between">
                           <div class="col-md-4 col-12">
                              <form class="d-flex" role="search">
                                 <label for="searchCustomers" class="visually-hidden">Search Customers</label>
                                 <input class="form-control" type="search" id="searchCustomers" placeholder="Search Customers" aria-label="Search" />
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="card-body p-0">
                        <div class="table-responsive">
                           <table class="table table-centered table-hover table-borderless mb-0 table-with-checkbox text-nowrap">
                              <thead class="bg-light">
                                 <tr>
                                    <th>
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="checkAll" />
                                          <label class="form-check-label" for="checkAll"></label>
                                       </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Ngày mua</th>
                                    <th>Số Điện thoại</th>
                                    <th>Số tiền đã chi</th>

                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="customerOne" />
                                          <label class="form-check-label" for="customerOne"></label>
                                       </div>
                                    </td>

                                    <td>
                                       <div class="d-flex align-items-center">
                                          <img src="../assets/images/avatar/avatar-1.jpg" alt="" class="avatar avatar-xs rounded-circle" />
                                          <div class="ms-2">
                                             <a href="#!" class="text-inherit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Hồ Tấn Đạt</a>
                                          </div>
                                       </div>
                                    </td>
                                    <td>bonniehowe@gmail.com</td>

                                    <td>17 Tháng 5, 2023 lúc 15:18</td>
                                    <td>-</td>
                                    <td>49.000₫</td>

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
                                                <a class="dropdown-item" href="../dashboard/customers-edits.html">
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
         </div>
      </main>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
         <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Customer Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <div class="offcanvas-body d-flex flex-column gap-4">
            <div class="d-flex flex-row align-items-center gap-4 w-100">
               <div class="flex-shrink-0">
                  <img src="../assets/images/avatar/avatar-1.jpg" alt="avatar" class="avatar avatar-xl rounded-circle" />
               </div>

               <div class="d-flex flex-column gap-1 flex-grow-1">
                  <h3 class="mb-0 h5 d-flex flex-row gap-3">
                     Hồ Tấn Đạt
                     <span class="badge bg-light-success text-dark-success">Verified</span>
                  </h3>

                  <div class="d-md-flex align-items-center justify-content-between">
                     <div class="">#CU001</div>
                     <div class="text-black-50">
                        Last Active:
                        <span class="text-dark">31 May, 2025 3:24PM</span>
                     </div>
                  </div>
               </div>
            </div>
            <div class="d-flex flex-md-row flex-column gap-md-6 gap-2">
               <div class="d-flex flex-row gap-2">
                  <span class="text-dark fw-semibold">Email</span>
                  <span class="text-black-50">anitaparmar@example.com</span>
               </div>
               <div class="d-flex flex-row gap-2">
                  <span class="text-dark fw-semibold">Phone Number</span>
                  <span class="text-black-50">123-456-7890</span>
               </div>
            </div>
            <div class="card rounded">
               <div class="card-body">
                  <div class="row">
                     <div class="border-end col-4">
                        <div class="d-flex flex-column gap-1">
                           <span class="text-black-50">Join Date</span>
                           <span class="text-dark">31 May, 2024</span>
                        </div>
                     </div>
                     <div class="border-end col-4">
                        <div class="d-flex flex-column gap-1">
                           <span class="text-black-50">Total Spent</span>
                           <span class="text-dark">$105</span>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="d-flex flex-column gap-1">
                           <span class="text-black-50">Total Order</span>
                           <span class="text-dark">3</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="border-bottom p-4">
                  <h3 class="mb-0 h6">Details</h3>
               </div>
               <div class="card-body p-4 d-flex flex-column gap-5">
                  <div class="d-flex flex-column gap-2 lh-1">
                     <div class="h6 mb-0">Email</div>
                     <span class="text-black-50">anitaparmar@example.com</span>
                  </div>
                  <div class="d-flex flex-column gap-2 lh-1">
                     <div class="h6 mb-0">Phone Number</div>
                     <span class="text-black-50">123-456-7890</span>
                  </div>

                  <div class="d-flex flex-column gap-2">
                     <div class="h6 mb-0">Address</div>
                     <div>
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked />
                           <label class="form-check-label" for="flexRadioDefault1">123 Apple St., Springfield, IL, 62701, USA</label>
                        </div>
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                           <label class="form-check-label" for="flexRadioDefault2">456 Banana St., Metropolis, NY, 10001, USA</label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="bg-light rounded-top px-4 py-3">
                  <a
                     href="#"
                     class="d-flex align-items-center justify-content-between text-inherit"
                     data-bs-toggle="collapse"
                     data-bs-target="#collapseOne"
                     aria-expanded="true"
                     aria-controls="collapseOne">
                     <div class="d-flex flex-row align-items-center gap-2">
                        <h3 class="mb-0 h5">Orders</h3>
                        <span class="text-black-50 lh-1">#001</span>
                     </div>
                     <div class="d-flex flex-row gap-6 align-items-center">
                        <div>
                           <span class="text-inherit">
                              Date:
                              <span class="text-dark">31 May, 2025</span>
                           </span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down chevron-down" viewBox="0 0 16 16">
                           <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                        </svg>
                     </div>
                  </a>
               </div>
               <div class="card-body py-0 px-4">
                  <div class="accordion d-flex flex-column" id="accordionExample1">
                     <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample1">
                        <ul class="list-group list-group-flush mb-0">
                           <li class="list-group-item px-0 py-1">
                              <a href="#!" class="text-inherit d-flex flex-row align-items-center justify-content-between">
                                 <div class="d-flex flex-row justify-content-between gap-3 align-items-center">
                                    <img src="../assets/images/products/product-img-18.jpg" class="icon-shape icon-xxl" alt="product img" />

                                    <span class="h6 mb-0">Organic Banana</span>
                                 </div>
                                 <span class="text-black-50">$35.00</span>
                              </a>
                           </li>
                           <li class="list-group-item px-0 py-1">
                              <a href="#!" class="text-inherit d-flex flex-row align-items-center justify-content-between">
                                 <div class="d-flex flex-row justify-content-between gap-3 align-items-center">
                                    <img src="../assets/images/products/product-img-15.jpg" class="icon-shape icon-xxl" alt="product img" />

                                    <span class="h6 mb-0">Fresh Apple</span>
                                 </div>
                                 <span class="text-black-50">$70.00</span>
                              </a>
                           </li>
                           <li class="list-group-item px-0 py-1">
                              <a href="#!" class="text-inherit d-flex flex-row align-items-center justify-content-between">
                                 <div class="d-flex flex-row justify-content-between gap-3 align-items-center">
                                    <img src="../assets/images/products/product-img-19.jpg" class="icon-shape icon-xxl" alt="product img" />

                                    <span class="h6 mb-0">BeetRoot</span>
                                 </div>
                                 <span class="text-black-50">$29.00</span>
                              </a>
                           </li>
                           <li class="list-group-item px-0 py-3">
                              <div class="d-flex flex-row justify-content-between">
                                 <span class="text-dark fw-semibold">Total Order Amount</span>
                                 <span class="text-dark fw-semibold">$134.00</span>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>

            <div class="card">
               <div class="bg-light rounded-top px-4 py-3">
                  <a
                     href="#"
                     class="d-flex align-items-center justify-content-between text-inherit"
                     data-bs-toggle="collapse"
                     data-bs-target="#collapseTwo"
                     aria-expanded="false"
                     aria-controls="collapseTwo">
                     <div class="d-flex flex-row align-items-center gap-2">
                        <h3 class="mb-0 h5">Orders</h3>
                        <span class="text-black-50 lh-1">#002</span>
                     </div>
                     <div class="d-flex flex-row gap-6 align-items-center">
                        <div>
                           <span class="text-inherit">
                              Date:
                              <span class="text-dark">12 May, 2025</span>
                           </span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down chevron-down" viewBox="0 0 16 16">
                           <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                        </svg>
                     </div>
                  </a>
               </div>
               <div class="card-body py-0 px-4">
                  <div class="accordion d-flex flex-column" id="accordionExample2">
                     <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                        <ul class="list-group list-group-flush mb-0">
                           <li class="list-group-item px-0 py-1">
                              <a href="#!" class="text-inherit d-flex flex-row align-items-center justify-content-between">
                                 <div class="d-flex flex-row justify-content-between gap-3 align-items-center">
                                    <img src="../assets/images/products/product-img-18.jpg" class="icon-shape icon-xxl" alt="product img" />

                                    <span class="h6 mb-0">Organic Banana</span>
                                 </div>
                                 <span class="text-black-50">$35.00</span>
                              </a>
                           </li>
                           <li class="list-group-item px-0 py-1">
                              <a href="#!" class="text-inherit d-flex flex-row align-items-center justify-content-between">
                                 <div class="d-flex flex-row justify-content-between gap-3 align-items-center">
                                    <img src="../assets/images/products/product-img-15.jpg" class="icon-shape icon-xxl" alt="product img" />

                                    <span class="h6 mb-0">Fresh Apple</span>
                                 </div>
                                 <span class="text-black-50">$70.00</span>
                              </a>
                           </li>
                           <li class="list-group-item px-0 py-1">
                              <a href="#!" class="text-inherit d-flex flex-row align-items-center justify-content-between">
                                 <div class="d-flex flex-row justify-content-between gap-3 align-items-center">
                                    <img src="../assets/images/products/product-img-19.jpg" class="icon-shape icon-xxl" alt="product img" />

                                    <span class="h6 mb-0">BeetRoot</span>
                                 </div>
                                 <span class="text-black-50">$29.00</span>
                              </a>
                           </li>
                           <li class="list-group-item px-0 py-3">
                              <div class="d-flex flex-row justify-content-between">
                                 <span class="text-dark fw-semibold">Total Order Amount</span>
                                 <span class="text-dark fw-semibold">$134.00</span>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>


   <script src="/assets/libs/bootstrap/bootstrap.bundle.min.js"></script>
   <script src="/assets/libs/simplebar/simplebar.min.js"></script>
   <script src="/assets/js/theme.min.js"></script>
</body>

</html>