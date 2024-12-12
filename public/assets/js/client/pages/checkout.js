$(function () {
   // Configure Toastr
   toastr.options = {
      closeButton: true,
      progressBar: true,
      positionClass: "toast-top-right",
      timeOut: 3000
   };

   const $addressForm = $('#addressForm');
   const $submitBtn = $('#submitAddress');

   function showFieldErrors(errors) {
      // Clear previous errors
      $('.invalid-feedback').remove();
      $('.is-invalid').removeClass('is-invalid');

      // Display new errors
      Object.keys(errors).forEach(field => {
         const $field = $(`[name="${field}"]`);
         const errorMessages = errors[field].join('<br>');

         $field.addClass('is-invalid');
         $field.after(`<div class="invalid-feedback">${errorMessages}</div>`);
      });
   }

   let isSubmitting = false;

   $addressForm.on('submit', function (e) {
      e.preventDefault();

      if (isSubmitting) return;

      // Get form data
      const formData = {
         firstName: $.trim($('[name="firstName"]').val()),
         lastName: $.trim($('[name="lastName"]').val()),
         address: $.trim($('[name="address"]').val()),
         address2: $.trim($('[name="address2"]').val()),
         city: $.trim($('[name="city"]').val()),
         phone: $.trim($('[name="phone"]').val()),
         zip: $.trim($('[name="zip"]').val()),
         company: $.trim($('[name="company"]').val()),
         isDefault: $('[name="isDefault"]').is(':checked')
      };



      // Show loading state
      isSubmitting = true;
      $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">  </span> Đang xử lý...');

      // Submit form using AJAX with JSON
      $.ajax({
         url: '/address/add',
         method: 'POST',
         data: JSON.stringify(formData),
         contentType: 'application/json',
         dataType: 'json',
         cache: false,
         success: function (response) {
            if (response.success) {
               $('#themDiaChiModal').modal('hide');
               refreshAddressList();
               $addressForm[0].reset();
               toastr.success('Thêm địa chỉ mới thành công!');
            } else {

            }
         },
         error: function (xhr) {
            let errorMessage = 'Có lỗi xảy ra. Vui lòng thử lại.';

            try {
               const response = JSON.parse(xhr.responseText);
               if (response.errors) {
                  showFieldErrors(response.errors);
                  errorMessage = 'Vui lòng kiểm tra lại thông tin.';
               } else {
                  errorMessage = response.message || errorMessage;
               }
            } catch (e) { }

            toastr.error(errorMessage);
         },
         complete: function () {
            isSubmitting = false;
            $submitBtn.prop('disabled', false).text('Lưu Địa Chỉ');

         }
      });
   });

   const addressContainer = $('#flush-collapseOne .row');

   function refreshAddressList() {
      $.ajax({
         url: '/address/list',
         method: 'GET',
         dataType: 'json',
         success: function (response) {
            if (response.success) {
               const addressHTML = response.address.map(address => `
                  <div class="col-xl-6 col-lg-12 col-md-6 col-12 mb-4">
                     <div class="card card-body p-6 h-100">
                        <div class="form-check mb-4">
                           <input class="form-check-input" type="radio" name="flexRadioDefault" 
                              id="homeRadio${address.idDiaChi}" ${address.macDinh ? 'checked' : ''} />
                           <label class="form-check-label text-dark" for="homeRadio${address.idDiaChi}">Nhà</label>
                        </div>
                        <address>
                           <strong>${address.hoTen}</strong><br />
                           ${address.diaChi1},<br />
                           ${address.diaChi2}, ${address.thanhPho},<br />
                           <abbr title="Phone">P: ${address.soDienThoai}</abbr>
                        </address>
                        ${address.macDinh ? '<span class="text-danger">Địa chỉ mặc định</span>' : ''}
                     </div>
                  </div>
                `).join('');

               addressContainer.empty().append(addressHTML);
            } else {
               toastr.error('Không thể tải danh sách địa chỉ');
            }
         },
         error: function () {
            toastr.error('Có lỗi xảy ra khi tải danh sách địa chỉ');
         }
      });
   }


   // Optional: Reset form when modal is hidden
   $('#themDiaChiModal').on('hidden.bs.modal', function () {
      $addressForm[0].reset();
      $('.invalid-feedback').remove();
      $('.is-invalid').removeClass('is-invalid');
   });
});

