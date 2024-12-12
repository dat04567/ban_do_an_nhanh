import CartUtils from '../cart-utils.js';

$(function () {
   // Add click handler to all cart buttons

   $('.btn-primary[data-uuid]').on('click', function (e) {
      e.preventDefault();


      const button = $(this);
      const productId = button.data('uuid');
      const storeId = button.data('uuid-store');

      console.log(button.data('uuid-store'));

      // Make AJAX call to add to cart
      $.ajax({
         url: '/cart/add',
         method: 'POST',
         data: {
            idSanPham: productId,
            idCuaHang: storeId
         },
         beforeSend: function () {
            // Show loading state
            button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang thêm...');
         },
         success: function (response) {
            // Update cart UI
            CartUtils.updateCartInfo();

            toastr.success(response.message, { timeOut: 500 });
         },
         error: function (error) {
            console.log(error);
            const message = error.responseJSON.error;

            toastr.error(message, { timeOut: 2000 });
         },
         complete: function () {
            button.prop('disabled', false).html('Thêm vào giỏ');
         }
      });
   });



   CartUtils.updateCartInfo();







});

