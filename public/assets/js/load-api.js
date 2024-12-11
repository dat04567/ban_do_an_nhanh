import { deleteStore } from './delete-api.js';

export function loadStores() {
   $.ajax({
      url: '/api/stores',
      method: 'GET',
      success: function (data) {
         if (!data) {
            Alert.error('Có lỗi xảy ra khi tải danh sách cửa hàng!', 'Error', {
               displayDuration: 3000,
               pos: 'top',
            });
            return;
         }

         var tbody = $('#stores-table-body');
         tbody.html('');
         var rows = data?.map(function (store) {
            return `
            <tr>
              <td>
               <div class="form-check">
                 <input class="form-check-input" type="checkbox" value="store${
                    store.idCuaHang
                 }" id="" />

                 <label class="form-check-label" for="store${store.idCuaHang}"></label>
               </div>
              </td>
              <td>${store.storeName}</td>
              <td>${store.email}</td>
              <td>${Number(store.tongDoanhThu).toLocaleString('vi-VN')} VND</td>
              <td>${Number(store.loiNhuan).toLocaleString('vi-VN')} VND</td>
              <td class="text-center">${store.tongHoaDon}</td>
              <td>
               <a href="/api/stores/${store.idCuaHang}/edit" class="btn btn-sm btn-warning">
                 <i class="bi bi-pencil-square me-2"></i>Edit
               </a>
               <form action="/api/stores/${
                  store.idCuaHang
               }" class="d-inline-block ms-2 delete-form" method="DELETE">
                 <button type="submit" class="btn btn-sm btn-danger mb-0">Delete</button>
               </form>
              </td>
            </tr>
           `;
         });
         tbody.append(rows.join(''));
         // add sự kiện sau khi
         document.querySelectorAll('.delete-form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
               deleteStore(event, loadStores);
            });
         });
      },
   });
}

export function loadIngredients() {
   $.ajax({
      url: '/api/ingredients', // Your API endpoint for ingredients
      method: 'GET',
      success: function (data) {
         if (!data) {
            Alert.error('Có lỗi xảy ra khi tải danh sách nguyên liệu!', 'Error', {
               displayDuration: 3000,
               pos: 'top',
            });
            return;
         }

         var tbody = $('#ingredients-table-body');
         tbody.html('');
         var rows = data?.map(function (ingredient) {
            return `
            <tr>
               <td>
                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" value="" id="ingredient${
                        ingredient.idNguyenLieu
                     }" />
                     <label class="form-check-label" for="ingredient${
                        ingredient.idNguyenLieu
                     }"></label>
                  </div>
               </td>
               <td>
                  <a href="/admin/ingredients/${
                     ingredient.idNguyenLieu
                  }" class="text-reset">${ingredient.tenNguyenLieu}</a>
               </td>
               <td>${Number(ingredient.giaNguyenLieu).toLocaleString('vi-VN')} VND</td>
               <td>${ingredient.donVi}</td>
               <td>
                  <a href="/admin/ingredients/${
                     ingredient.idNguyenLieu
                  }/edit" class="btn btn-sm btn-warning">
                     <i class="bi bi-pencil-square me-2"></i>Edit
                  </a>
                  <form action="/api/ingredients/${
                     ingredient.idNguyenLieu
                  }" class="d-inline-block ms-2 delete-form" method="POST">
                     <input type="hidden" name="_method" value="DELETE">
                     <button type="submit" class="btn btn-sm btn-danger mb-0">Delete</button>
                  </form>
               </td>
            </tr>
            `;
         });
         tbody.append(rows.join(''));
         document.querySelectorAll('.delete-form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
               deleteStore(event, loadIngredients);
            });
         });
      },
   });
}

export function loadStockIngredients() {
   $.ajax({
      url: '/api/inventory-ingredients', // Your API endpoint for stock ingredients
      method: 'GET',
      success: function (data) {
         if (!data) {
            Alert.error('Có lỗi xảy ra khi tải danh sách nguyên liệu tồn kho!', 'Error', {
               displayDuration: 3000,
               pos: 'top',
            });
            return;
         }

         var tbody = $('#stock-ingredient-table-body');
         tbody.html('');
         var rows = data?.map(function (stockIngredient) {
            let classTrangThai;
            switch (stockIngredient.trangThai) {
               case 'Hết hàng':
                  classTrangThai = 'bg-danger';
                  break;
               case 'Còn hàng':
                  classTrangThai = 'bg-success';
                  break;
               case 'Sắp hết hàng':
                  classTrangThai = 'bg-warning';
                  break;
            }
            // set action is null
            return `
            <tr>
               <td>
                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" value="" id="stockIngredient${stockIngredient.id}" />
                     <label class="form-check-label" for="stockIngredient${stockIngredient.id}"></label>
                  </div>
               </td>
               <td>${stockIngredient.storeName}</td>
               <td>${stockIngredient.tenNguyenLieu}</td>
               <td>${stockIngredient.soLuongTonKho}</td>
               <td>
                  <span class="badge ${classTrangThai}">${stockIngredient.trangThai}</span>
               </td>
               <td>
                   <a href="" class="btn btn-sm btn-warning">
                     <i class="bi bi-pencil-square me-2"></i>Edit
                  </a>
                  
                  <form class="d-inline-block ms-2 delete-form" method="DELETE">
                     <input type="hidden" name="idNguyenLieu" value="123">
                     <input type="hidden" name="idCuaHang" value="${stockIngredient.idCuaHang}">
                     <button type="submit" class="btn btn-sm btn-danger mb-0">Delete</button>
                  </form>

               </td>
            </tr>
            `;
         });
         tbody.append(rows.join(''));
         // document.querySelectorAll('.delete-form').forEach(function (form) {
         //    form.addEventListener('submit', function (event) {
         //       event.preventDefault();
         //       console.log(form.action);

         //       // deleteStore(event, loadIngredients);
         //    });
         // });
      },
   });
}
