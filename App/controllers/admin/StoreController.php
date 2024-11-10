<?php

namespace App\Controllers\admin;

use App\Controllers\Controller;
use App\Controllers\ErrorController;
use Framework\Response;

class StoreController  extends Controller {

   public function index() {

      try {
         $stores = $this->db->select('SELECT * FROM CuaHang');
   

         Response::view('admin/manage-stores', ['stores' => $stores]);
      } catch (\Exception $e) {
         ErrorController::notFound();
      }



      
   }


   public function showListFoods() {

   }

   public function show() {
      echo "Show Page";
   }

   public function showId($argments ) {
      inspect($argments);
      // echo "Show Page with ID: $id";
   }

   public function create() {

      echo "Create Page";
   }

   public function store() {
      echo "Store Page";
   }

   public function edit() {
      echo "Edit Page";
   }

   public function update() {
      echo "Update Page";
   }

   public function destroy() {
      echo "Destroy Page";
   }

}