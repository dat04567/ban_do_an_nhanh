<?php if (isset($productIngredients) && !empty($productIngredients)) : ?>
   <?php foreach ($productIngredients as $ingredient) : ?>
      <?php

      $formattedPrice = number_format($ingredient['giaNguyenLieu'], 0, ',', '.');
      ?>
      <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center ingredient-item" data-uuid="<?= $ingredient['idNguyenLieu'] ?>">
         <div class="d-flex align-items-center justify-content-between w-100">
            <span class="name-ingredient fw-bold"><?= $ingredient['tenNguyenLieu'] ?></span>
            <div class="d-flex flex-row align-items-center">
               <button type="button" class="btn decrease">-</button>
               <input type="number" class="form-control number-ingredient" min="1" value="<?= $ingredient['soLuong'] ?>" />
               <button type="button" class="btn increase">+</button>
            </div>
            <span class="fw-bold price"><?= $formattedPrice ?></span>
            <button class="btn btn-sm remove-ingredient">
               <i class="bi bi-trash"></i>
            </button>
         </div>
      </div>

   <?php endforeach; ?>
<?php else: ?>
   <div class="alert alert-warning alert-default" style="display: block;">
      Không có nguyên liệu nào.
   </div>
<?php endif; ?>