export function deleteStore(event, callback) {
   event.preventDefault();

   const form = event.target;
   const action = form.action;
   const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
   const confirmButton = document.getElementById('confirmDeleteButton');

   confirmButton.onclick = function () {
      $.ajax({
         type: 'DELETE',
         url: action,
         success: function (response) {
            modal.hide();
            const message = response.message;
            Alert.success(message, 'Success', {
               displayDuration: 3000,
               pos: 'top',
            });
            if (callback) {
               callback();
            }
         },
         error: function (response) {
            modal.hide();
            let errorMessage = 'Có lỗi xảy ra khi xóa!';

            const errorJson = response.responseJSON;
            errorMessage = errorJson ? errorJson.message : errorMessage;
            Alert.error(errorMessage, 'Error', {
               displayDuration: 3000,
               pos: 'top',
            });
         },
      });
   };
   modal.show();
}

export function deleteInventoryIngredient(event) {
   event.preventDefault();
   const form = event.target;
   const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
   const confirmButton = document.getElementById('confirmDeleteButton');
   confirmButton.onclick = function () {
      form.submit();
   };
   modal.show();
}
