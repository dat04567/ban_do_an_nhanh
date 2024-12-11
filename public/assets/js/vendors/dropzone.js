

Dropzone.autoDiscover = !1;
const myDropzone = new Dropzone('#my-dropzone', {
   url: '/admin/foods/upload-temp-product-image',
   maxFilesize: 5,
   acceptedFiles: 'image/*',
   addRemoveLinks: true,
   autoProcessQueue: !0,
   dictDefaultMessage: 'Kéo thả hoặc click để upload',
   dictRemoveFile: 'Xóa',
   dictCancelUpload: 'Hủy',
});
myDropzone.on('addedfile', function (file) {
   // Tìm nút xóa
   const removeButton = file.previewElement.querySelector('.dz-remove');

   // Gắn sự kiện click tùy chỉnh
   removeButton.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();



      // Gửi yêu cầu AJAX để xóa file trên server
      // $.ajax({
      //    url: '/admin/foods/delete-temp-product-image',
      //    type: 'POST',
      //    data: { filename: file.newFileName },
      //    success: function (data) {
      //       // Xóa file khỏi Dropzone sau khi server xác nhận

      //       console.log('Đã xóa file thành công');
      //    },
      //    error: function (e) {
      //       // Thông báo lỗi nếu không xóa được trên server
      //       console.error('Lỗi khi xóa file');
      //       alert('Không thể xóa file trên server. Vui lòng thử lại.');
      //    }
      // });  
      myDropzone.removeFile(file);
   });

}),
   myDropzone.on('removedfile', function (o) {
      console.log('file removed');

   }),
   myDropzone.on('success', function (file, response) {
      // Giả sử server trả về JSON với tên file mớ
      const newFileName = response.fileName;

      // Gán tên file mới cho đối tượng file
      file.upload.filename = newFileName;
      file.name = newFileName;
      file.size = response.size;

      // Add thumbnail URL for preview
      console.log(response.path);

      myDropzone.emit('thumbnail', file, response.path);

      file.previewElement.querySelector('.dz-filename span').textContent = newFileName;



   }),
   myDropzone.on('sending', function (file, xhr, formData) {

   });

