<div class="col">
   <div class="card card-product">
      <div class="card-body">
         <div class="text-center position-relative">
            <div class="position-absolute top-0 start-0">
               <!-- <span class="badge bg-danger">Sale</span> -->
            </div>
            <a href="#!"><img src="<?= $food['hinhAnh'][0] ?>" alt="product" class="img-fluid" /></a>

            <div class="card-product-action">
               <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                  <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"></i>
               </a>
               <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
               <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Compare"><i class="bi bi-arrow-left-right"></i></a>
            </div>
         </div>
         <div class="text-small mb-1">
            <a href="#!" class="text-decoration-none text-muted">
               <small> <?= $food['tenDanhMuc'] ?></small>
            </a>
         </div>
         <h2 class="fs-6"><a href="./pages/shop-single.html" class="text-inherit text-decoration-none"> <?= $food['tenSanPham'] ?></a></h2>
         <div>
            <small class="text-warning">
               <i class="bi bi-star-fill"></i>
               <i class="bi bi-star-fill"></i>
               <i class="bi bi-star-fill"></i>
               <i class="bi bi-star-fill"></i>
               <i class="bi bi-star-half"></i>
            </small>
            <span class="text-muted small">4.5(149)</span>
         </div>
         <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
               <span class="text-dark"><?= number_format($food['gia'], 0, ',', '.') ?>đ</span>
            </div>
            <div>

               <?php if ($food['tonKho'] <= 0) : ?>
                  <span class="text-danger">Hết hàng</span>
               <?php else : ?>
                  <button type="button" class="btn btn-primary btn-sm" data-uuid="<?= $food['idSanPham'] ?>" >
                     <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="rond"
                        stroke-linejoin="round"
                        class="feather feather-plus">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                     </svg>
                     Thêm vào giỏ
                  </button>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
</div>