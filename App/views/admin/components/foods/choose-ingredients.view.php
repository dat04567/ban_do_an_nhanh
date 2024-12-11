<!-- input -->
<div class="mb-3" id="ingredients">
   <label for="">Chọn công thức</label>
   <div id="ingredientList" class="d-flex flex-wrap fs-1 ">
      <?php if (!empty($ingredients)) : ?>
         <?php foreach ($ingredients as $ingredient) : ?>
            <button
               type="button"
               data-uuid="<?= $ingredient['idNguyenLieu'] ?>"
               class="btn btn-primary rounded-pill m-1 py-0 px-3">
               <?= $ingredient['tenNguyenLieu'] ?>
            </button>
         <?php endforeach; ?>
      <?php endif; ?>

   </div>
   <input type="text" class="form-control mt-1" placeholder="Tìm kiếm nguyên liệu" />

   <div id="selectedIngredients" class="list-group mt-3">

      <?= loadComponents('/foods/ingredients-list.view', 'admin', ['productIngredients' => $productIngredients ?? []]) ?>
   </div>

</div>