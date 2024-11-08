<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use Framework\Response;

class UserController  extends Controller {

   public function index() {
   
    
   }

   public function signUp() {
      Response::view('shared/register');
   }

   public function signIn() {
      Response::view('shared/login');
   }

   public function forgotPassword() {
      Response::view('shared/forgotpassword');
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