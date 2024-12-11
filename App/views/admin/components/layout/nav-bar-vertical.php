<?php
// Lấy đường dẫn hiện tại
$currentPath = $_SERVER['REQUEST_URI'];

function checkIsShow($paths, $currentPath)
{
   return in_array($currentPath, $paths) ?  'show' : '';
}

?>



<nav class="navbar-vertical-nav d-none d-xl-block">
   <div class="navbar-vertical">
      <div class="px-4 py-5 d-flex justify-content-center">
         <a href="/" class="navbar-brand">
            <img src="/assets/images/food-icon.jpg" alt="FoodFashion" class="navbar-brand-logo" width="160" />
         </a>
      </div>
      <div class="navbar-vertical-content flex-grow-1" data-bs-simplebar="">
         <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
               <?= loadComponents('/layout/nav-item', 'admin', [
                  'href' => '/admin',
                  'iconClass' => 'bi bi-house',
                  'text' => 'Dashboard',
                  'active' => $currentPath == '/admin'
               ]) ?>

            </li>

            <!-- Quản lý cửa hàng -->
            <li class="nav-item mt-6 mb-3">
               <span class="nav-label">Quản lý cửa hàng</span>
            </li>

            <!-- Quản lý sản phẩm -->

            <li class="nav-item">
               <a class="nav-link collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#navProducts" aria-expanded="false" aria-controls="navProducts">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-cart"></i></span>
                     <span class="nav-link-text">Quản lý sản phẩm</span>
                  </div>
               </a>

               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'navProducts',
                  'items' => [
                     ['href' => '/admin/foods', 'iconClass' => 'bi bi-list', 'text' => 'Danh sách món ăn'],
                     ['href' => '/admin/foods/create', 'iconClass' => 'bi bi-plus-square', 'text' => 'Thêm món ăn'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>



            </li>


            <!-- Quản lý danh mục -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navCategories" aria-expanded="false" aria-controls="navCategories">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-tags"></i></span>
                     <span class="nav-link-text">Quản lý danh mục</span>
                  </div>
               </a>
               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'navCategories',
                  'items' => [
                     ['href' => '/admin/categories', 'iconClass' => 'bi bi-list', 'text' => 'Danh mục cha'],
                     ['href' => '/admin/sub-categories', 'iconClass' => 'bi bi-list', 'text' => 'Danh mục con'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>

            </li>



            <!-- Quản lý đơn hàng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navOrders" aria-expanded="false" aria-controls="navOrders">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
                     <span class="nav-link-text">Quản lý đơn hàng</span>
                  </div>
               </a>
               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'navOrders',
                  'items' => [
                     ['href' => '/admin/orders', 'iconClass' => 'bi bi-list', 'text' => 'Danh sách đơn hàng'],
                     ['href' => '/admin/reviews', 'iconClass' => 'bi bi-star', 'text' => 'Đánh giá đơn hàng'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>

            </li>


            <!-- Quản lý người dùng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navUsers" aria-expanded="false" aria-controls="navUsers">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                     <span class="nav-link-text">Quản lý người dùng</span>
                  </div>
               </a>
               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'navUsers',
                  'items' => [
                     ['href' => '/admin/customers', 'iconClass' => 'bi bi-people', 'text' => 'Khách hàng'],
                     ['href' => '/admin/staffs', 'iconClass' => 'bi bi-person', 'text' => 'Nhân viên'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>

            </li>

            <!-- Quản lý kho -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navInventory" aria-expanded="false" aria-controls="navInventory">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-box-seam"></i></span>
                     <span class="nav-link-text">Quản lý kho</span>
                  </div>
               </a>

               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'navInventory',
                  'items' => [
                     ['href' => '/admin/inventory-products', 'iconClass' => 'bi bi-box-seam', 'text' => 'Kho sản phẩm'],
                     ['href' => '/admin/inventory-ingredients', 'iconClass' => 'bi bi-box-seam', 'text' => 'Kho nguyên liệu'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>


            </li>


            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navIngredients" aria-expanded="false" aria-controls="navIngredients">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-egg"></i></span>
                     <span class="nav-link-text">Quản lý nguyên liệu</span>
                  </div>
               </a>
               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'navIngredients',
                  'items' => [
                     ['href' => '/admin/ingredients', 'iconClass' => 'bi bi-list', 'text' => 'Danh sách nguyên liệu'],
                     ['href' => '/admin/ingredients/create', 'iconClass' => 'bi bi-plus-square', 'text' => 'Thêm nguyên liệu'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>

            </li>



            <!-- Quản lý cửa hàng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navStores" aria-expanded="false" aria-controls="navStores">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-shop"></i></span>
                     <span class="nav-link-text">Quản lý chuỗi cửa hàng </span>
                  </div>
               </a>
               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'navStores',
                  'items' => [
                     ['href' => '/admin/stores', 'iconClass' => 'bi bi-shop', 'text' => 'Cửa hàng'],
                     ['href' => '/admin/schedules', 'iconClass' => 'bi bi-calendar', 'text' => 'Lịch làm việc'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>

            </li>


         </ul>
      </div>
   </div>
</nav>


<!-- mobile phone navigation -->
<nav class="navbar-vertical-nav offcanvas offcanvas-start navbar-offcanvac" tabindex="-1" id="offcanvasExample">
   <div class="navbar-vertical">
      <div class="px-4 py-5 d-flex justify-content-between align-items-center">
         <a href="/" class="navbar-brand">
            <img src="/assets/images/food-icon.jpg" alt="FoodFashion" class="navbar-brand-logo" width="160" />
         </a>
         <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="navbar-vertical-content flex-grow-1" data-bs-simplebar="">
         <ul class="navbar-nav flex-column" id="mobileSideNavbar">

            <!-- Dashboard -->
            <li class="nav-item">
               <?= loadComponents('/layout/nav-item', 'admin', [
                  'href' => '/admin',
                  'iconClass' => 'bi bi-house',
                  'text' => 'Dashboard',
                  'active' => $currentPath == '/admin'
               ]) ?>

            </li>



            <!-- Quản lý cửa hàng -->
            <li class="nav-item mt-6 mb-3">
               <span class="nav-label">Quản lý cửa hàng</span>
            </li>

            <!-- Quản lý sản phẩm -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mobileNavProducts" aria-expanded="false" aria-controls="mobileNavProducts">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-cart"></i></span>
                     <span class="nav-link-text">Quản lý món ăn</span>
                  </div>
               </a>
               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'mobileNavProducts',
                  'items' => [
                     ['href' => '/admin/foods', 'iconClass' => 'bi bi-list', 'text' => 'Danh sách món ăn'],
                     ['href' => '/admin/foods/create', 'iconClass' => 'bi bi-plus-square', 'text' => 'Thêm món ăn'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>

            </li>

            <!-- Quản lý đơn hàng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mobileNavOrders" aria-expanded="false" aria-controls="mobileNavOrders">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
                     <span class="nav-link-text">Quản lý đơn hàng</span>
                  </div>
               </a>
               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'mobileNavOrders',
                  'items' => [
                     ['href' => '/admin/orders', 'iconClass' => 'bi bi-list', 'text' => 'Danh sách đơn hàng'],
                     ['href' => '/admin/reviews', 'iconClass' => 'bi bi-star', 'text' => 'Đánh giá đơn hàng'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>

            </li>

            <!-- Quản lý người dùng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mobileNavUsers" aria-expanded="false" aria-controls="mobileNavUsers">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                     <span class="nav-link-text">Quản lý người dùng</span>
                  </div>
               </a>
               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'mobileNavUsers',
                  'items' => [
                     ['href' => '/admin/customers', 'iconClass' => 'bi bi-people', 'text' => 'Khách hàng'],
                     ['href' => '/admin/staffs', 'iconClass' => 'bi bi-person', 'text' => 'Nhân viên'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>

            </li>

            <!-- Quản lý kho -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mobileNavInventory" aria-expanded="false" aria-controls="mobileNavInventory">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-box-seam"></i></span>
                     <span class="nav-link-text">Quản lý kho hàng</span>
                  </div>
               </a>
               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'mobileNavInventory',
                  'items' => [
                     ['href' => '/inventory', 'iconClass' => 'bi bi-box-seam', 'text' => 'Kho sản phẩm'],
                     ['href' => '/admin/inventory-ingredients', 'iconClass' => 'bi bi-box-seam', 'text' => 'Kho nguyên liệu'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>

            </li>

            <!-- Quản lý cửa hàng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mobileNavStores" aria-expanded="false" aria-controls="mobileNavStores">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-shop"></i></span>
                     <span class="nav-link-text">Quản lý chuỗi cửa hàng</span>
                  </div>
               </a>
               <?= loadComponents('/layout/nav-collapse', 'admin', [
                  'id' => 'mobileNavStores',
                  'items' => [
                     ['href' => '/admin/stores', 'iconClass' => 'bi bi-shop', 'text' => 'Cửa hàng'],
                     ['href' => '/admin/schedules', 'iconClass' => 'bi bi-calendar', 'text' => 'Lịch làm việc'],
                  ],
                  'currentPath' => $currentPath
               ]) ?>

            </li>
         </ul>
      </div>
   </div>
</nav>