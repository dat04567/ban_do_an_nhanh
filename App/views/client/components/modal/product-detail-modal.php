<?php

function renderProductModal($data)
{
?>
   <div class="modal fade" id="<?php echo htmlspecialchars($data['id']); ?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-body p-8">
               <div class="position-absolute top-0 end-0 me-3 mt-3">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <!-- img slide -->
                     <div class="product productModal" id="productModal">
                        <?php foreach ($data['images'] as $image): ?>
                           <div class="zoom" onmousemove="zoom(event)" style="background-image: url(<?php echo htmlspecialchars($image); ?>)">
                              <!-- img -->
                              <img src="<?php echo htmlspecialchars($image); ?>" alt="" />
                           </div>
                        <?php endforeach; ?>
                     </div>
                     <!-- product tools -->
                     <div class="product-tools">
                        <div class="thumbnails row g-3" id="productModalThumbnails">
                           <?php foreach ($data['images'] as $image): ?>
                              <div class="col-3">
                                 <div class="thumbnails-img">
                                    <!-- img -->
                                    <img src="<?php echo htmlspecialchars($image); ?>" alt="" />
                                 </div>
                              </div>
                           <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="ps-lg-8 mt-6 mt-lg-0">
                        <a href="#!" class="mb-4 d-block"><?php echo htmlspecialchars($data['category']); ?></a>
                        <h2 class="mb-1 h1"><?php echo htmlspecialchars($data['title']); ?></h2>
                        <div class="mb-4">
                           <small class="text-warning">
                              <?php for ($i = 0; $i < floor($data['rating']); $i++): ?>
                                 <i class="bi bi-star-fill"></i>
                              <?php endfor; ?>
                              <?php if (is_float($data['rating'])): ?>
                                 <i class="bi bi-star-half"></i>
                              <?php endif; ?>
                           </small>
                           <a href="#" class="ms-2">(<?php echo htmlspecialchars($data['reviews']); ?> reviews)</a>
                        </div>
                        <div class="fs-4">
                           <span class="fw-bold text-dark">$<?php echo htmlspecialchars($data['price']); ?></span>
                           <!-- <span class="text-decoration-line-through text-muted">$<?php echo htmlspecialchars($data['originalPrice']); ?></span> -->
                           <!-- <span><small class="fs-6 ms-2 text-danger"><?php echo htmlspecialchars($data['discount']); ?>% Off</small></span> -->
                        </div>
                        <hr class="my-6" />
                        <div class="mb-4">
                           <?php foreach ($data['sizes'] as $size): ?>
                              <button type="button" class="btn btn-outline-secondary"><?php echo htmlspecialchars($size); ?></button>
                           <?php endforeach; ?>
                        </div>
                        <div>
                           <!-- input -->
                           <div class="input-group input-spinner">
                              <input type="button" value="-" class="button-minus btn btn-sm" data-field="quantity" />
                              <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field form-control-sm form-input" />
                              <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity" />
                           </div>
                        </div>
                        <div class="mt-3 row justify-content-start g-2 align-items-center">
                           <div class="col-lg-4 col-md-5 col-6 d-grid">
                              <!-- button -->
                              <button type="button" class="btn btn-primary">
                                 <i class="feather-icon icon-shopping-bag me-2"></i>
                                 Thêm vào giỏ
                              </button>
                           </div>
                           <div class="col-md-4 col-5">
                              <!-- btn -->
                              <a class="btn btn-light" href="#" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Compare"><i class="bi bi-arrow-left-right"></i></a>
                              <a class="btn btn-light" href="#!" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Wishlist"><i class="feather-icon icon-heart"></i></a>
                           </div>
                        </div>
                        <hr class="my-6" />
                        <div>
                           <table class="table table-borderless">
                              <tbody>
                                 <tr>
                                    <td>Tình trạng:</td>
                                    <td><?php echo htmlspecialchars($data['status']); ?></td>
                                 </tr>
                                 <tr>
                                    <td>Loại:</td>
                                    <td><?php echo htmlspecialchars($data['type']); ?></td>
                                 </tr>
                                 <tr>
                                    <td>Giao hàng:</td>
                                    <td>
                                       <small>
                                          <?php echo htmlspecialchars($data['delivery']); ?>
                                          <span class="text-muted">( Miễn phí lấy hàng hôm nay)</span>
                                       </small>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php
}

?>