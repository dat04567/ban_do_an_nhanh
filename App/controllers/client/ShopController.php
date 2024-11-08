<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use Framework\Response;

class ShopController  extends Controller {

   public function index() {
      
      Response::view('client/shop');
   }

   public function checkout() {
         
      Response::view('client/checkout');
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