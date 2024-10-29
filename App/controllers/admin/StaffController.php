<?php

namespace App\Controllers\admin;

use App\Controllers\Controller;

class StaffController  extends Controller {

   public function index() {
      loadView('admin/manage-staffs');
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