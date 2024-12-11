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
            $title = 'Danh mục';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => 'index.php'],
               ['label' => 'Danh mục', 'active' => true]
            ];


            $actionButton = '<a href="/admin/categories/create" class="btn btn-primary">Thêm Danh mục</a>';

            // Render header
            renderPageHeader($title, $breadcrumbs, $actionButton);


            $message = 'Bạn có muốn xoá danh mục này không ?';
            loadComponents('layout/modal', 'admin', ['message' => $message]);


            // load alert modal
            loadPartial('modal-alert');
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
                                 <input class="form-control" type="search" placeholder="Search Category" aria-label="Search" />
                              </form>
                           </div>
                           <!-- select option -->
                           <div class="col-xl-2 col-md-4 col-12">
                              <select class="form-select">
                                 <option selected>Trạng thái</option>
                                 <option value="active">Hoạt động</option>
                                 <option value="isActive">Không hoạt động </option>
                              </select>
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
                                    <th>Hình ảnh</th>
                                    <th>Tên</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>

                                 <?php if (!empty($categories)) : ?>
                                    <?php foreach ($categories as $category) : ?>
                                       <?php
                                       $badgeColor = $category['isActive'] == 1 ? 'bg-success' : 'bg-danger';
                                       ?>
                                       <tr>
                                          <td>
                                             <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="categoryOne" />
                                                <label class="form-check-label" for="categoryOne"></label>
                                             </div>
                                          </td>

                                          <td> <a href=""> <img src="<?= $category['hinhAnh'] ?>" alt="" class="icon-shape icon-sm"> </a> </td>
                                          <td> <?= $category['tenDanhMuc'] ?> </td>
                                          <td>
                                             <span class="badge <?= $badgeColor ?> "> <?= $category['isActive'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?> </span>
                                          </td>


                                          </td>
                                          <td>
                                             <a href="" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square me-2"></i>Edit
                                             </a>
                                             <form action="/admin/categories/<?= $category['idDanhMuc'] ?>" method="POST" class="d-inline delete-form">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-danger mb-0">Delete</button>
                                             </form>
                                          </td>
                                       </tr>
                                    <?php endforeach; ?>
                                 <?php else : ?>
                                    <tr>
                                       <td colspan="5" class="text-center">Không có danh mục nào</td>
                                    </tr>
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