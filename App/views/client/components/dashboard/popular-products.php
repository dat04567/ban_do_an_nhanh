<section class="my-lg-14 my-8">
   <div class="container">
      <div class="row">
         <div class="col-12 mb-6">
            <h3 class="mb-0">Sản phẩm phổ biến</h3>
         </div>
      </div>

      <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">

         <?php
         loadComponents('ui/product-item', "client");
         for ($i = 0; $i < 10; $i++) {
            $product = [
               'index' => 'product' . $i,
               'title' => 'Bánh Snack Khoai tây',
               'rating' => 4.5,
               'numReviews' => 149,
               'originalPrice' => 18000,
               'imageUrl' => 'https://www.claudeusercontent.com/api/placeholder/220/220',
               'category' => 'Đồ ăn vặt'
            ];
            echo renderProductItem($product);
         }
         ?>
         


      </div>
   </div>
</section>