<div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
   <div class="mt-5">
      <div class="row">
         <?php if (!empty($addresses)): ?>

            <?php foreach ($addresses as $address): ?>
                  <div class="col-xl-6 col-lg-12 col-md-6 col-12 mb-4">
                    <!-- form -->
                    <div class="card card-body p-6 h-100">
                      <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="homeRadio" <?= $address['macDinh'] ? 'checked' : ''; ?> data-id-dia-chi="<?= $address['idDiaChi']; ?>">
                        <label class="form-check-label text-dark" for="homeRadio<?= $address['idDiaChi']; ?>">Nhà</label>
                      </div>
                      <!-- address -->
                      <address>
                        <strong><?= $address['hoTen'] ?></strong>
                        <br />
                        <?= $address['diaChi1'] ?>,
                        <br />
                        <?= $address['diaChi2'] ?>, <?= $address['thanhPho'] ?>,
                        <br />
                        <abbr title="Phone">P: <?= $address['soDienThoai'] ?></abbr>
                      </address>
                      <?php if ($address['macDinh']): ?>
                        <span class="text-danger">Địa chỉ mặc định</span>
                      <?php endif; ?>
                    </div>
                  </div>
            <?php endforeach; ?>
         <?php endif; ?>



      </div>
   </div>
</div>