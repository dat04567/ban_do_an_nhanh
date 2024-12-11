


const insertProductIngredient = async (data) => {
   try {
      const response = await $.ajax({
         url: '/admin/foods/insert-product-ingredient',
         method: 'POST',
         data: {
            idNguyenLieu: data.idNguyenLieu,
            soLuong: data.soLuong,
         }
      });


      return {
         data: response
      };
   } catch (error) {
      console.error(error);
   }
};



const getAllProductIngredients = async (isChecked) => {
   try {

      const response = await $.ajax({
         url: `/admin/foods/get-all-products-ingredients?isChecked=${isChecked}`,
         method: 'GET',
         headers: {
            'Cache-Control': 'no-cache',
            'Pragma': 'no-cache'
         }
      });
      return {
         data: response
      };
   } catch (error) {
      console.error(error);
   }
};




export { insertProductIngredient, getAllProductIngredients };