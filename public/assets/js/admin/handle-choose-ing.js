import { insertProductIngredient } from './foods-api.js';

class IngredientsManager {
   constructor() {
      this.selectedIngredients = {};
      this.initializeEventListeners();
   }

   async updateIngredient(uuid, amount) {
      try {
         const currentAmount = this.selectedIngredients[uuid]?.soLuong || 0;
         const newAmount = currentAmount + amount;

         if (newAmount <= 0) {
            delete this.selectedIngredients[uuid];
         } else {
            const response = await insertProductIngredient({
               idNguyenLieu: uuid,
               soLuong: amount
            });

            if (response.error) throw new Error(response.error);

            this.selectedIngredients[uuid] = {
               ...response.data,
               soLuong: newAmount
            };
         }

         await this.updateUI();
      } catch (error) {
         console.error('Failed to update ingredient:', error);
         // Show error to user
      }
   }

   async updateUI() {
      const template = await this.renderIngredientsList();
      $('#selectedIngredients').html(template);
   }

   initializeEventListeners() {
      $('#ingredientList').on('click', 'button', async (e) => {
         const uuid = e.target.dataset.uuid;
         if (uuid) await this.updateIngredient(uuid, 1);
      });

      $('#selectedIngredients').on('click', 'button', async (e) => {
         const uuid = $(e.target).closest('.ingredient-item').data('uuid');
         if (!uuid) return;

         if (e.target.classList.contains('increase')) {
            await this.updateIngredient(uuid, 1);
         } else if (e.target.classList.contains('decrease')) {
            await this.updateIngredient(uuid, -1);
         }
      });
   }

   getSelectedIngredients() {
      return this.selectedIngredients;
   }
}

// Initialize
const ingredientsManager = new IngredientsManager();
export { ingredientsManager };
