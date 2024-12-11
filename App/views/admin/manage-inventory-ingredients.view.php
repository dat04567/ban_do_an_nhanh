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
            $title = "Kho nguyên liệu";
            $breadcrumbs = [
               ['label' => 'Dashboard', 'href' => '/admin'],
               ['label' => 'Kho nguyên liệu', 'active' => true]
            ];

            $actionButton = '<a href="/admin/inventory-ingredients/import" class="btn btn-primary">Nhập kho</a>';

            // Render header
            renderPageHeader($title, $breadcrumbs, $actionButton);

            // load alert modal
            loadPartial('modal-alert');
            ?>

            <!-- modal -->
            <?php
            $message = 'Bạn có muốn xoá kho nguyên liệu này không ?';
            loadComponents('layout/modal', 'admin', ['message' => $message]);

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
                                 <option value="1">Còn hàng</option>
                                 <option value="2">Hết Hàng</option>
                                 <option value="3">Sấp hết</option>
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
                                    <th>Tên cửa hàng</th>
                                    <th>Tên Nguyên liệu </th>
                                    <th>Số lượng tồn kho</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody id="stock-ingredient-table-body">

                                 <?php if (empty($inventoryIngredients)) : ?>
                                    <tr>
                                       <td colspan="6" class="text-center">Không có dữ liệu nào</td>
                                    </tr>
                                 <?php else : ?>

                                    <?php foreach ($inventoryIngredients as $stockIngredient) : ?>
                                       <?php
                                       switch ($stockIngredient['trangThai']) {
                                          case 'Còn hàng':
                                             $badgeColor = 'bg-success';
                                             break;
                                          case 'Hết hàng':
                                             $badgeColor = 'bg-danger';
                                             break;
                                          case 'Sắp hết hàng':
                                             $badgeColor = 'bg-warning';
                                             break;
                                          default:
                                             $badgeColor = 'bg-secondary';
                                             break;
                                       }
                                       ?>
                                       <tr>
                                          <td>
                                             <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="stockIngredient${stockIngredient.id}" />
                                                <label class="form-check-label" for="stockIngredient${stockIngredient.id}"></label>
                                             </div>
                                          </td>
                                          <td> <?= $stockIngredient['storeName'] ?> </td>
                                          <td> <?= $stockIngredient['tenNguyenLieu'] ?> </td>
                                          <td> <?= $stockIngredient['soLuongTonKho'] ?> </td>
                                          <td>
                                             <span class="badge <?= $badgeColor ?>">
                                                <?= $stockIngredient['trangThai'] ?>
                                             </span>

                                          </td>

                                          <td>
                                             <a href="" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square me-2"></i>Edit
                                             </a>

                                             <form action="/admin/inventory-ingredients" class="d-inline-block ms-2 delete-form" method="POST">
                                                <input type="hidden" name="idNguyenLieu" value="<?= $stockIngredient['idNguyenLieu'] ?>">
                                                <input type="hidden" name="idCuaHang" value="<?= $stockIngredient['idCuaHang'] ?>">
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