
import CartUtils from '../cart-utils.js';
$(function () {
   $('.button-plus').on('click', async (e) => {
      const btn = $(e.currentTarget);
      const productId = btn.data('id');
      const storeId = btn.data('store');
      const input = btn.siblings('.quantity-field');
      const currentValue = parseInt(input.val());



      if (currentValue < 10) {
         const data = CartUtils.updateQuantity(productId, currentValue + 1, storeId);
         console.log(data);
      }
   });

   $('.button-minus').on('click', (e) => {
      const btn = $(e.currentTarget);
      const productId = btn.data('id');
      const storeId = btn.data('store');
      const input = btn.siblings('.quantity-field');
      const currentValue = parseInt(input.val());

      if (currentValue > 1) {
         CartUtils.updateQuantity(productId, currentValue - 1, storeId);
      }
   });

   $('.delete-item').on('click', function (e) {
      e.preventDefault();
      const productId = $(this).data('id');
      deleteCartItem(productId);
   });



});