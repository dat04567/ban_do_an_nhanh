<?php
// Lấy đường dẫn hiện tại
$currentPath = $_SERVER['REQUEST_URI'];

// Kiểm tra xem có hiển thị nav bar không
$listPath = ["/admin", "/admin/foods", "/admin/categories", "/admin/orders", "/reviews", "/admin/customers", "/admin/staffs"];


$isShow = in_array($currentPath,  $listPath) ? true : false;


function checkIsShow($paths, $currentPath)
{
   return in_array($currentPath, $paths) ?  'show' : '';
}


function renderNavItem($href, $iconClass, $text, $currentPath, $isDisabled = null)
{
   $activeClass = ($currentPath == $href) ? 'active' : '';

   return "
   <li class='nav-item '>
       <a class='nav-link $activeClass $isDisabled' href='$href'>
           <div class='d-flex align-items-center'>
               <span class='nav-link-icon'><i class='$iconClass'></i></span>
               <span class='nav-link-text'>$text</span>
           </div>
       </a>
   </li>
   ";
}





?>

<nav class="navbar-vertical-nav d-none d-xl-block">
   <div class="navbar-vertical">
      <div class="px-4 py-5 d-flex justify-content-center">
         <a href="/" class="navbar-brand">
            <img src="/assets/images/food-icon.jpg" alt="FoodFashion" class="navbar-brand-logo" width="160" />
         </a>
      </div>
      <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
         <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
               <?= renderNavItem('/admin', 'bi bi-house', 'Dashboard', $currentPath); ?>

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

               <div id="navProducts" class="collapse <?= checkIsShow(['/admin/foods', '/admin/categories'], $currentPath) ?> " data-bs-parent="#sideNavbar">
                  <ul class="nav flex-column ">
                     <?= renderNavItem('/admin/foods', 'bi bi-list', 'Danh sách sản phẩm', $currentPath); ?>
                     <?= renderNavItem('/admin/categories', 'bi bi-tags', 'Danh mục', $currentPath); ?>
                     <?= renderNavItem('/admin/sub-categories', 'bi bi-tags', 'Danh mục con ', $currentPath); ?>
                  </ul>
               </div>
            </li>





            <!-- Quản lý đơn hàng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navOrders" aria-expanded="false" aria-controls="navOrders">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
                     <span class="nav-link-text">Quản lý đơn hàng</span>
                  </div>
               </a>
               <div id="navOrders" class="collapse  <?= checkIsShow(["/admin/orders", "/admin/reviews"], $currentPath) ?>  " data-bs-parent="#sideNavbar">
                  <ul class="nav flex-column">
                     <?= renderNavItem('/admin/orders', 'bi bi-list', 'Danh sách đơn hàng', $currentPath); ?>
                     <?= renderNavItem('/reviews', 'bi bi-star', 'Đánh giá đơn hàng', $currentPath); ?>

                  </ul>
               </div>
            </li>

            <!-- Quản lý người dùng -->

            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navUsers" aria-expanded="false" aria-controls="navUsers">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                     <span class="nav-link-text">Quản lý người dùng</span>
                  </div>
               </a>
               <div id="navUsers" class="collapse <?= checkIsShow(["/admin/customers", "/admin/staffs"], $currentPath) ?>" data-bs-parent="#sideNavbar">
                  <ul class="nav flex-column">
                     <?= renderNavItem('/admin/customers', 'bi bi-people', 'Khách hàng', $currentPath); ?>
                     <?= renderNavItem('/admin/staffs', 'bi bi-person', 'Nhân viên', $currentPath); ?>
                  </ul>
               </div>
            </li>

            <!-- Quản lý kho -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navInventory" aria-expanded="false" aria-controls="navInventory">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-box-seam"></i></span>
                     <span class="nav-link-text">Quản lý kho hàng</span>
                  </div>
               </a>
               <div id="navInventory" class="collapse <?= checkIsShow(["/admin/inventory", "/admin/ingredients"], $currentPath) ?> " data-bs-parent="#sideNavbar">
                  <ul class="nav flex-column">
                     <?= renderNavItem('/admin/inventory', 'bi bi-box-seam', 'Kho', $currentPath); ?>
                     <?= renderNavItem('/admin/ingredients', 'bi bi-box-seam', 'Nguyên liệu', $currentPath); ?>

                  </ul>
               </div>
            </li>

            <!-- Quản lý cửa hàng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#navStores" aria-expanded="false" aria-controls="navStores">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-shop"></i></span>
                     <span class="nav-link-text">Quản lý chuỗi cửa hàng </span>
                  </div>
               </a>
               <div id="navStores" class="collapse" data-bs-parent="#sideNavbar">
                  <ul class="nav flex-column">
                     <?= renderNavItem('/admin/stores', 'bi bi-shop', 'Cửa hàng', $currentPath); ?>
                     <?= renderNavItem('/schedules', 'bi bi-calendar', 'Lịch làm việc', $currentPath); ?>
                  </ul>
               </div>
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
      <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
         <ul class="navbar-nav flex-column" id="mobileSideNavbar">

            <!-- Dashboard -->
            <li class="nav-item">
               <?= renderNavItem('/admin', 'bi bi-house', 'Dashboard', $currentPath); ?>
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
               <div id="mobileNavProducts" class="collapse <?= checkIsShow(['/admin/foods', '/admin/categories'], $currentPath) ?>" data-bs-parent="#mobileSideNavbar">
                  <ul class="nav flex-column">
                     <?= renderNavItem('/admin/foods', 'bi bi-list', 'Danh sách món ăn', $currentPath); ?>
                     <?= renderNavItem('/admin/categories', 'bi bi-tags', 'Danh mục món ăn', $currentPath); ?>
                  </ul>
               </div>
            </li>

            <!-- Quản lý đơn hàng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mobileNavOrders" aria-expanded="false" aria-controls="mobileNavOrders">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
                     <span class="nav-link-text">Quản lý đơn hàng</span>
                  </div>
               </a>
               <div id="mobileNavOrders" class="collapse <?= checkIsShow(["/admin/orders", "/admin/reviews"], $currentPath) ?> " data-bs-parent="#mobileSideNavbar">
                  <ul class="nav flex-column">
                     <?= renderNavItem('/admin/orders', 'bi bi-list', 'Danh sách đơn hàng', $currentPath); ?>

                     <?= renderNavItem('/reviews', 'bi bi-star', 'Đánh giá đơn hàng', $currentPath, 'disabled'); ?>
                  </ul>
               </div>
            </li>

            <!-- Quản lý người dùng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mobileNavUsers" aria-expanded="false" aria-controls="mobileNavUsers">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                     <span class="nav-link-text">Quản lý người dùng</span>
                  </div>
               </a>
               <div id="mobileNavUsers" class="collapse <?= checkIsShow(["/admin/customers", "/admin/staffs"], $currentPath) ?>" data-bs-parent="#mobileSideNavbar">
                  <ul class="nav flex-column">
                     <?= renderNavItem('/admin/customers', 'bi bi-people', 'Khách hàng', $currentPath); ?>
                     <?= renderNavItem('/admin/staffs', 'bi bi-person', 'Nhân viên', $currentPath); ?>
                  </ul>
               </div>
            </li>

            <!-- Quản lý kho -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mobileNavInventory" aria-expanded="false" aria-controls="mobileNavInventory">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-box-seam"></i></span>
                     <span class="nav-link-text">Quản lý kho hàng</span>
                  </div>
               </a>
               <div id="mobileNavInventory" class="collapse" data-bs-parent="#mobileSideNavbar">
                  <ul class="nav flex-column">
                     <?= renderNavItem('/inventory', 'bi bi-box-seam', 'Kho', $currentPath); ?>
                     <?= renderNavItem('/ingredients', 'bi bi-box-seam', 'Nguyên liệu', $currentPath); ?>
                  </ul>
               </div>
            </li>

            <!-- Quản lý cửa hàng -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mobileNavStores" aria-expanded="false" aria-controls="mobileNavStores">
                  <div class="d-flex align-items-center">
                     <span class="nav-link-icon"><i class="bi bi-shop"></i></span>
                     <span class="nav-link-text">Quản lý chuỗi cửa hàng</span>
                  </div>
               </a>
               <div id="mobileNavStores" class="collapse" data-bs-parent="#mobileSideNavbar">
                  <ul class="nav flex-column">
                     <?= renderNavItem('/stores', 'bi bi-shop', 'Cửa hàng', $currentPath); ?>
                     <?= renderNavItem('/schedules', 'bi bi-calendar', 'Lịch làm việc', $currentPath); ?>
                  </ul>
               </div>
            </li>
         </ul>
      </div>
   </div>
</nav>