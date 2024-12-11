<div class="modal fade " id="confirmModal">
   <div class="modal-dialog modal-confirm">
      <div class="modal-content">
         <div class="modal-header flex-column">
            <div class="icon-box error">
               <i class="bi bi-trash"></i>
            </div>
            <h4 class="modal-title w-100">Bạn có muốn xoá không ? </h4>
            <button type="button" class="close cancel" data-dismiss="modal" aria-hidden="true">&times;</button>
         </div>
         <div class="modal-body">
            <p> <?php if (isset($message)) {
                     echo $message;
                  } ?> </p>
         </div>
         <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Hủy</button>
            <button type="button" id="confirmDeleteButton" class="btn btn-danger">Xóa</button>
         </div>
      </div>
   </div>
</div>