import CartTemplates from './templates/cart-templates.js';

const CartUtils = {
   config: {
      selectors: {
         cartCount: '.cart-count',
         cartItems: '#cartList',
         totalPrice: '.total-price',
         finalTotal: '.final-total'
      },
      templates: {
         price: {
            default: function (price) {
               return `${CartUtils.number_format(price)} VND`;
            },
            withCurrency: (price) => `${this.number_format(price)} VND`
         }
      }
   },

   updatePrices: function (data) {
      const { totalPrice = 0, serviceFee = 0 } = data;

      // Update all price elements
      $(this.config.selectors.totalPrice).each((_, el) => {
         $(el).text(this.config.templates.price.default(totalPrice));
      });

   },

   updateCartItems: function (items, templateName = 'default') {
      const cartList = $('#cartList');
      cartList.empty();

      items.forEach(item => {
         const increase = item.soLuongTon > 0 ? `<input type="button" value="-" class="button-minus btn btn-sm" data-id="${item.idSanPham}" data-store="${item.idCuaHang}" />` : '';
         const decrease = item.soLuongTon > 0 ? `<input type="button" value="+" class="button-plus btn btn-sm" data-id="${item.idSanPham}" data-store="${item.idCuaHang}" />` : '';

         const template = CartTemplates[templateName] || CartTemplates.default;
         cartList.append(template(item, items, increase, decrease));
      });

      this.initCartControls();
   },

   updateCartInfo: function () {
      $.ajax({
         url: '/cart/info',
         method: 'GET',
         success: (response) => {
            $('.cart-count').text(response.data.count);
            this.updateCartItems(response.data.cartDetail);
            this.updatePrices({
               totalPrice: response.data.totalPrice,
            });
         },
         error: function (error) {
            console.log(error);
            toastr.error(error.responseJSON, { timeOut: 2000 });
         }
      });
   },

   updateQuantity: function (productId, newQuantity, storeId) {
      $.ajax({
         url: '/cart/update',
         method: 'POST',
         data: {
            idSanPham: productId,
            soLuong: newQuantity,
            idCuaHang: storeId
         },
         beforeSend: function () {
            $('.button-plus, .button-minus').prop('disabled', true);
         },
         success: (response) => {
            this.updateCartInfo();
            toastr.options.timeOut = 200;
            toastr.success(response.message);
         },
         error: function (error) {
            toastr.error(error.responseJSON.error, { timeOut: 2000 });
         },
         complete: function () {
            $('.button-plus, .button-minus').prop('disabled', false);
         }
      });
   },

   initCartControls: function () {
      $('.button-plus').on('click', (e) => {
         const btn = $(e.currentTarget);
         const productId = btn.data('id');
         const storeId = btn.data('store');
         const input = btn.siblings('.quantity-field');
         const currentValue = parseInt(input.val());

         if (currentValue < 10) {
            this.updateQuantity(productId, currentValue + 1, storeId);
         }
      });

      $('.button-minus').on('click', (e) => {
         const btn = $(e.currentTarget);
         const productId = btn.data('id');
         const storeId = btn.data('store');
         const input = btn.siblings('.quantity-field');
         const currentValue = parseInt(input.val());

         if (currentValue > 1) {
            this.updateQuantity(productId, currentValue - 1, storeId);
         }
      });

      $('.delete-item').on('click', function (e) {
         e.preventDefault();
         const productId = $(this).data('id');
         deleteCartItem(productId);
      });
   },

   number_format: function (number) {
      return new Intl.NumberFormat('vi-VN').format(number);
   }
};


export default CartUtils;

