import { getAllProductIngredients } from './foods-api.js';
import { addEventButtonIncreaseAndDecrease } from './handle-choose-ing.js';
$(document).ready(async function () {


   const flexSwitchStock = document.getElementById('flexSwitchStock');




   function getFlexSwitchStockState() {
      return localStorage.getItem('flexSwitchStockState') === 'true';
   }

   const chosseIngredient = document.getElementById('choose-ingredients');

   async function handleFlexSwitchStockChange(isChecked) {


      const response = await getAllProductIngredients(isChecked);
      chosseIngredient.innerHTML = response.data;

      if (isChecked) {
         addEventButtonIncreaseAndDecrease();
      }
   }



   flexSwitchStock.addEventListener('change', function (event) {

      handleFlexSwitchStockChange(event.target.checked);
   });

   // Execute on load

   handleFlexSwitchStockChange(flexSwitchStock.checked);


   // Search functionality
   // searchInput.addEventListener('input', function (e) {
   //    const searchTerm = e.target.value.toLowerCase();
   //    Array.from(ingredientList.children).forEach(button => {
   //       const ingredient = button.getAttribute('data-ingredient').toLowerCase();
   //       button.style.display = ingredient.includes(searchTerm) ? '' : 'none';
   //    });
   // });









});


