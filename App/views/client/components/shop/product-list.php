  <section class="col-lg-9 col-md-12">
     <!-- card -->
     <div class="card mb-4 bg-light border-0">
        <!-- card body -->
        <div class="card-body p-9">
           <h2 class="mb-0 fs-1">Snacks & Munchies</h2>
        </div>
     </div>
     <!-- list icon -->
     <div class="d-lg-flex justify-content-between align-items-center">
        <div class="mb-3 mb-lg-0">
           <p class="mb-0">
              <span class="text-dark">24</span>
              sản phẩm được tìm thấy
           </p>
        </div>

        <!-- icon -->
        <div class="d-md-flex justify-content-between align-items-center">
           <div class="d-flex align-items-center justify-content-between">
              <div>
                 <a href="shop-list.html" class="text-muted me-3"><i class="bi bi-list-ul"></i></a>
                 <a href="/shop" class="me-3 active"><i class="bi bi-grid"></i></a>
                 <a href="shop-grid-3-column.html" class="me-3 text-muted"><i class="bi bi-grid-3x3-gap"></i></a>
              </div>
              <div class="ms-2 d-lg-none">
                 <a class="btn btn-outline-gray-400 text-muted" data-bs-toggle="offcanvas" href="#offcanvasCategory" role="button" aria-controls="offcanvasCategory">
                    <svg
                       xmlns="http://www.w3.org/2000/svg"
                       width="14"
                       height="14"
                       viewBox="0 0 24 24"
                       fill="none"
                       stroke="currentColor"
                       stroke-width="2"
                       stroke-linecap="round"
                       stroke-linejoin="round"
                       class="feather feather-filter me-2">
                       <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                    Filters
                 </a>
              </div>
           </div>

           <div class="d-flex mt-2 mt-lg-0">
              <div class="me-2 flex-grow-1">
                 <!-- select option -->
                 <select class="form-select">
                    <option selected>Hiển thị: 50</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                 </select>
              </div>
              <div>
                 <!-- select option -->
                 <select class="form-select">
                    <option selected>Sắp xếp theo: Nổi bật</option>
                    <option value="Low to High">Giá: Thấp đến Cao</option>
                    <option value="High to Low">Giá: Cao đến Thấp</option>
                    <option value="Release Date">Ngày phát hành</option>
                    <option value="Avg. Rating">Đánh giá trung bình</option>
                 </select>
              </div>
           </div>
        </div>
     </div>
     <!-- row -->
     <div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
        <!-- col -->
        <?php
         loadComponents('ui/product-item', "client");
         loadComponents("modal/product-detail-modal", "client");

         
         $product = [
            'index' => 'id1',
            'title' => 'Bánh Snack Khoai tây',
            'rating' => 4.5,
            'numReviews' => 149,
            'originalPrice' => 18000,
            'imageUrl' => 'https://www.claudeusercontent.com/api/placeholder/220/220',
            'category' => 'Đồ ăn vặt'
         ];

         echo renderProductItem($product);


         $data = [
            'id' => 'id1',
            'images' => [
               'https://www.claudeusercontent.com/api/placeholder/220/220',
               'https://www.claudeusercontent.com/api/placeholder/220/220',
               'https://www.claudeusercontent.com/api/placeholder/220/220'
            ],
            'category' => 'Electronics',
            'title' => 'Sample Product',
            'rating' => 4.5,
            'reviews' => 120,
            'price' => 299.99,
            'originalPrice' => 399.99,
            'discount' => 25,
            'sizes' => ['S', 'M', 'L', 'XL'],
            'status' => 'In Stock',
            'type' => 'Gadget',
            'delivery' => '2-3 business days'
         ];

         renderProductModal($data);



         ?>


     </div>
     <div class="row mt-8">
        <div class="col">
           <!-- nav -->
           <nav>
              <ul class="pagination">
                 <li class="page-item disabled">
                    <a class="page-link mx-1" href="#" aria-label="Previous">
                       <i class="feather-icon icon-chevron-left"></i>
                    </a>
                 </li>
                 <li class="page-item"><a class="page-link mx-1 active" href="#">1</a></li>
                 <li class="page-item"><a class="page-link mx-1" href="#">2</a></li>

                 <li class="page-item"><a class="page-link mx-1" href="#">...</a></li>
                 <li class="page-item"><a class="page-link mx-1" href="#">12</a></li>
                 <li class="page-item">
                    <a class="page-link mx-1" href="#" aria-label="Next">
                       <i class="feather-icon icon-chevron-right"></i>
                    </a>
                 </li>
              </ul>
           </nav>
        </div>
     </div>
  </section>