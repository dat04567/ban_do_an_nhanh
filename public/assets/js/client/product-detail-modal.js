$(function () {
   const modal = $('#quickViewModal');
   const modalInstance = new bootstrap.Modal(modal[0]);


   // Quick view button click handler
   $(document).on('click', '[data-bs-target="#quickViewModal"]', function (e) {
      e.preventDefault();
      const $btn = $(this);
      const productId = $btn.data('uuid');

      // Show loading state
      modal.addClass('loading');
      // Fetch product data
      $.ajax({
         url: `/products/${productId}`,
         method: 'GET',
         success: function (product) {
            // updateModalContent(product);
            modalInstance.show();
         },
         error: function (err) {
            toastr.error('Có lỗi xảy ra khi tải sản phẩm vui lòng thử lại sau');
         },
         complete: function () {
            modal.removeClass('loading');

         }
      });
   });

   function updateModalContent(product) {
      // Update images
      const imagesHtml = product.images.map(img => `
            <div class="zoom" onmousemove="zoom(event)" 
                 style="background-image: url(${img})">
                <img src="${img}" alt="${product.name}" />
            </div>
        `).join('');

      const thumbnailsHtml = product.images.map((img, index) => `
            <div class="col-3 ${index === 0 ? 'tns-nav-active' : ''}">
                <div class="thumbnails-img">
                    <img src="${img}" alt="" />
                </div>
            </div>
        `).join('');

      $('#productModal').html(imagesHtml);
      $('#productModalThumbnails').html(thumbnailsHtml);

      // Update product details
      modal.find('h2.h1').text(product.name);
      modal.find('.fs-4 .fw-bold').text(`${product.price}đ`);

      // Update table info
      modal.find('table tbody').html(`
            <tr>
                <td>Mã sản phẩm:</td>
                <td>${product.id}</td>
            </tr>
            <tr>
                <td>Trạng thái:</td>
                <td>${product.stock > 0 ? 'Còn hàng' : 'Hết hàng'}</td>
            </tr>
            <tr>
                <td>Loại:</td>
                <td>${product.category}</td>
            </tr>
        `);
   }
});

// Zoom function remains the same
function zoom(e) {
   const zoomer = e.currentTarget;
   const offsetX = e.offsetX;
   const offsetY = e.offsetY;
   const x = (offsetX / zoomer.offsetWidth) * 100;
   const y = (offsetY / zoomer.offsetHeight) * 100;
   zoomer.style.backgroundPosition = `${x}% ${y}%`;
}
