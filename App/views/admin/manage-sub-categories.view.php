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
            $title = 'Danh mục con';
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => '/'],
               ['label' => 'Danh mục con', 'active' => true]
            ];


            $actionButton = '<a href="/admin/sub-categories/create" class="btn btn-primary">Thêm Danh mục con</a>';

            // Render header
            renderPageHeader($title, $breadcrumbs, $actionButton);

            // load alert modal 
            loadPartial('modal-alert');


            $message = 'Bạn có muốn xoá danh mục này không ?';
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
                                 <input class="form-control" type="search" placeholder="Search Category" aria-label="Search" />
                              </form>
                           </div>
                           <!-- select option -->
                           <div class="col-xl-2 col-md-4 col-12">
                              <select class="form-select">
                                 <option selected>Status</option>
                                 <option value="Published">Published</option>
                                 <option value="Unpublished">Unpublished</option>
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
                                    <th>Tên danh mục con</th>
                                    <th>Tên danh mục cha</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>

                                 <?php if (!empty($subCategories)) : ?>
                                    <?php foreach ($subCategories as $subCategory) : ?>
                                       <?php
                                       $badgeColor = $subCategory['isActive'] == 1 ? 'bg-success' : 'bg-danger';

                                       ?>
                                       <tr>
                                          <td>
                                             <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="stockIngredient${stockIngredient.id}" />
                                                <label class="form-check-label" for="stockIngredient${stockIngredient.id}"></label>
                                             </div>
                                          </td>
                                          <td> <?= $subCategory['tenDanhMucCon'] ?> </td>
                                          <td> <?= $subCategory['tenDanhMuc'] ?> </td>
                                          <td>
                                             <span class="badge <?= $badgeColor ?>">
                                                <?= $subCategory['isActive'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?>
                                             </span>

                                          </td>

                                          <td>
                                             <a href="" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square me-2"></i>Edit
                                             </a>

                                             <form action="/admin/sub-categories/<?= $subCategory['idDanhMucCon'] ?>" class="d-inline-block ms-2 delete-form" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm btn-danger mb-0">Delete</button>
                                             </form>


                                          </td>
                                       </tr>
                                    <?php endforeach; ?>
                                 <?php else : ?>
                                    <tr>
                                       <td colspan="5" class="text-center">Không có danh mục con nào</td>
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