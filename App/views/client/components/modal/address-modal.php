<div class="modal fade" id="themDiaChiModal" tabindex="-1" aria-labelledby="themDiaChiModalNhan" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
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
                  <input type="text" class="form-control" placeholder="Họ và tên đệm" aria-label="Họ và tên đệm" required="" />
               </div>
               <!-- Cột -->
               <div class="col-12">
                  <input type="text" class="form-control" placeholder="Tên" aria-label="Tên" required="" />
               </div>
               <!-- Cột -->
               <div class="col-12">
                  <input type="text" class="form-control" placeholder="Địa chỉ (Số nhà, đường)" />
               </div>
               <div class="col-12">
                  <input type="text" class="form-control" placeholder="Địa chỉ bổ sung (Phường/Xã, Quận/Huyện)" />
               </div>
               <div class="col-12">
                  <input type="text" class="form-control" placeholder="Thành phố/Tỉnh" />
               </div>
               <div class="col-12">
                  <select class="form-select">
                     <option selected="">Việt Nam</option>
                     <option value="1">Quốc gia khác</option>
                  </select>
               </div>
               <div class="col-12">
                  <select class="form-select">
                     <option selected="">Chọn Tỉnh/Thành phố</option>
                     <option value="1">Hà Nội</option>
                     <option value="2">Hồ Chí Minh</option>
                     <option value="3">Đà Nẵng</option>
                     <!-- Thêm các tỉnh/thành phố khác -->
                  </select>
               </div>
               <div class="col-12">
                  <input type="text" class="form-control" placeholder="Mã bưu chính" />
               </div>
               <div class="col-12">
                  <input type="text" class="form-control" placeholder="Tên công ty (Nếu có)" />
               </div>
               <div class="col-12">
                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" value="" id="macDinhDiaChi" />
                     <label class="form-check-label" for="macDinhDiaChi">Đặt làm địa chỉ mặc định</label>
                  </div>
               </div>
               <!-- Nút -->
               <div class="col-12 text-end">
                  <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Hủy</button>
                  <button class="btn btn-primary" type="button">Lưu Địa Chỉ</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>