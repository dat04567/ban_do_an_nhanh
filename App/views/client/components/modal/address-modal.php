<div class="modal fade" id="themDiaChiModal" tabindex="-1" aria-labelledby="themDiaChiModalNhan" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="addressForm" novalidate>
            <!-- Phần nội dung modal -->
            <div class="modal-body p-6">
               <div class="d-flex justify-content-between mb-5">
                  <!-- Tiêu đề -->
                  <div>
                     <h5 class="h6 mb-1" id="themDiaChiModalNhan">Địa Chỉ Giao Hàng Mới</h5>
                     <p class="small mb-0">Thêm địa chỉ giao hàng mới cho đơn hàng của bạn.</p>
                  </div>
                  <div>
                     <!-- Nút đóng -->
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                  </div>
               </div>
               <!-- Dòng nhập thông tin -->
               <div class="row g-3">
                  <!-- Cột -->
                  <div class="col-12">
                     <input type="text" class="form-control" placeholder="Họ và tên đệm" aria-label="Họ và tên đệm" name="firstName" />
                  </div>
                  <!-- Cột -->
                  <div class="col-12">
                     <input type="text" class="form-control" placeholder="Tên" aria-label="Tên"  name="lastName" />
                  </div>
                  <!-- Cột -->
                  <div class="col-12">
                     <input type="text" class="form-control" placeholder="Địa chỉ (Số nhà, đường)" name="address" />
                  </div>
                  <div class="col-12">
                     <input type="text" class="form-control" placeholder="Địa chỉ bổ sung (Phường/Xã, Quận/Huyện)" name="address2" />
                  </div>
                  <div class="col-12">
                     <input type="text" class="form-control" placeholder="Thành phố/Tỉnh" name="city" />
                  </div>

                  <div class="col-12">
                     <input type="number" class="form-control" placeholder="Số điện thoại" name="phone" />
                  </div>

                  <div class="col-12">
                     <input type="text" class="form-control" placeholder="Mã bưu chính" name="zip" />
                  </div>
                  <div class="col-12">
                     <input type="text" class="form-control" placeholder="Tên công ty (Nếu có)" name="company" />
                  </div>
                  <div class="col-12">
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="isDefault" id="macDinhDiaChi">
                        <label class="form-check-label" for="macDinhDiaChi">Đặt làm địa chỉ mặc định</label>
                     </div>
                  </div>
                  <!-- Nút -->
                  <div class="col-12 text-end">
                     <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Hủy</button>
                     <button class="btn btn-primary" type="submit" id="submitAddress">Lưu Địa Chỉ</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>