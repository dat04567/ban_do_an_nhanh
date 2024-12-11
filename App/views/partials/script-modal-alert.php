<?php

use Framework\SessionManager;

$session = SessionManager::getInstance();
?>
<?php if ($session->has('success-modal')) : ?>

   <script>
      const modal = new bootstrap.Modal(document.getElementById('successModal'), {
         keyboard: false
      });
      const closeSuccess = document.getElementById('closeSuccess');
      const successModalElement = document.getElementById('successModal');

      closeSuccess.addEventListener('click', () => {
         modal.hide();
         <?php if ($session->has('url-redirect')) : ?>
            window.location = '<?php echo $session->get('url-redirect'); ?>';
         <?php endif; ?>
      });

      successModalElement.addEventListener('hidden.bs.modal', () => {
         <?php if ($session->has('url-redirect')) : ?>
            window.location = '<?php echo $session->get('url-redirect'); ?>';
         <?php endif; ?>
      });

      <?php $session->remove('url-redirect'); ?>

      modal.show();
   </script>
   <?php $session->remove('success-modal'); ?>
<?php endif; ?>


<?php if ($session->has('error-modal')) : ?>

   <script>
      const errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {
         keyboard: false
      });
      const closeError = document.getElementById('closeError');
      closeError.addEventListener('click', () => {
         errorModal.hide();

      });

      errorModal.show();
   </script>
   <?php $session->remove('error-modal'); ?>
<?php endif; ?>