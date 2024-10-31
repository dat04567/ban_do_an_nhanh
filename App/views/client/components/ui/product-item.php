<?php
function renderProductItem($product)
{
   $html = '
   <div class="col">
      <div class="card card-product">
         <div class="card-body">
            <div class="text-center position-relative">
               <a href="#">
                  <img src="' . htmlspecialchars($product['imageUrl']) . '" alt="' . htmlspecialchars($product['title']) . '" class="mb-3 img-fluid" />
               </a>
               <div class="card-product-action">
                  <a href="#" class="btn-action" data-bs-toggle="modal" data-bs-target="#' . htmlspecialchars($product['index']) . '" >
                     <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Xem nhanh"></i>
                  </a>
                  <a href="#" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Danh sách yêu thích"><i class="bi bi-heart"></i></a>
                  <a href="#" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="So sánh"><i class="bi bi-arrow-left-right"></i></a>
               </div>
            </div>
            <div class="text-small mb-1">
               <a href="#" class="text-decoration-none text-muted"><small>' . htmlspecialchars($product['category']) . '</small></a>
            </div>
            <h2 class="fs-6"><a href="#" class="text-inherit text-decoration-none">' . htmlspecialchars($product['title']) . '</a></h2>
            <div>
               <small class="text-warning">';

   for ($i = 0; $i < floor($product['rating']); $i++) {
      $html .= '<i class="bi bi-star-fill"></i>';
   }
   if (is_float($product['rating'])) {
      $html .= '<i class="bi bi-star-half"></i>';
   }

   $html .= '</small>
               <span class="text-muted small">' . htmlspecialchars($product['rating']) . '(' . htmlspecialchars($product['numReviews']) . ')</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
               <div>
                   <span class="text-dark">' . number_format($product['originalPrice'], 0, ',', '.') . ' ₫</span>
               </div>
               <div>
                  <a href="#" class="btn btn-primary btn-sm">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                     </svg>
                     Thêm
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>';

   return $html;
}
