<?php

   use Framework\SessionManager;

   $session =  SessionManager::getInstance();
   $message = $session->get('error');

   if ($session->has('error')) {
      echo "<script> showAlert('error','$message', 'Lỗi') </script>";
      $session->remove('error');
   }
?>

<?php

   $session =  SessionManager::getInstance();
   $message = $session->get('success');

   if ($session->has('success')) {
      echo "<script> showAlert('success','$message', 'Thành công') </script>";
      $session->remove('success');
   }
?>




