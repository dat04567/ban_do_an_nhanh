const formAll = document.querySelectorAll('.delete-form');

formAll.forEach((form) => {
   form.addEventListener('submit', function (event) {
      event.preventDefault();
      const formTarget = event.target;

      const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
      const confirmButton = document.getElementById('confirmDeleteButton');
      const cancelButton = document.getElementsByClassName('cancel');

      for (let button of cancelButton) {
         button.onclick = function () {
            modal.hide();
         };
      }

      confirmButton.onclick = function () {
         formTarget.submit();
      };

      modal.show();
   });
});
