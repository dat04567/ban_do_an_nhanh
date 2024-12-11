<?php
   use Framework\SessionManager;
   $session =  SessionManager::getInstance();

  
?>

<?php if ($session->has('success-modal')) : ?>
   <div class="modal fade " id="successModal">
      <div class="modal-dialog modal-dialog-custom">
         <div class="modal-content">
            <div class="modalbox success col-sm-8 col-md-6 col-lg-5 center animate">
               <div class="icon">
                  <i class="bi bi-check icon-success "></i>
               </div>
               <h1>Thành công!</h1>
               <p><?= $session->get('success-modal') ?>
               </p>
               <button type="button" class="redo btn" id="closeSuccess">Ok</button>
            </div>
         </div>
      </div>
   </div>

<?php endif; ?>



<?php if ($session->has('error-modal')) : ?>

   <div class="modal fade " id="errorModal">
      <div class="modal-dialog modal-dialog-custom">
         <div class="modal-content">

            <div class="modalbox error col-sm-8 col-md-6 col-lg-5 center animate">
               <div class="icon">
                  <i class="bi bi-exclamation icon-error"></i>
               </div>

               <h1>Oh no!</h1>
               <p><?= $session->get('error-modal') ?>
               </p>
               <button type="button" id="closeError" class="redo btn">Đóng</button>
            </div>
         </div>
      </div>
   </div>
<?php endif; ?>