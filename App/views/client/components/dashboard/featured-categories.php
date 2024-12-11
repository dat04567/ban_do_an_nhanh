<section class="mb-lg-10 mt-lg-14 my-8">
   <div class="container">
      <div class="row">
         <div class="col-12 mb-6">
            <h3 class="mb-0">Danh mục nổi bật</h3>
         </div>
      </div>
      <div class="category-slider">

      <?php if ( isset($categories) ): ?>

            <?php foreach ($categories as $category): ?>
               <div class="item">
                  <a href="#" class="text-decoration-none text-inherit">
                     <div class="card card-product mb-lg-4">
                        <div class="card-body text-center py-8">
                           <img src="<?= $category['hinhAnh'] ?>" alt="Đồ ăn " class="mb-3 img-fluid" width="120" />
                           <div class="text-truncate"><?= $category['tenDanhMuc'] ?></div>
                        </div>
                     </div>
                  </a>
               </div>
            <?php endforeach; ?>
      <?php endif; ?>


      </div>
   </div>
</section>