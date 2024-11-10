(() => {
   'use strict';
   var a = document.querySelectorAll('.needs-validation');
   Array.from(a).forEach((e) => {
      e.addEventListener(
         'submit',
         (a) => {
            // a.preventDefault(), a.stopPropagation();
            // e.checkValidity() || (a.preventDefault(), a.stopPropagation()),
            //    e.classList.add('was-validated');
         },
         !1
      );
   });
})();
