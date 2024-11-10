<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use Framework\Response;
use App\Models\UserModel;
use Framework\ValidationException;


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

   public function store() {
      // $lastName = $_POST['lastName'];
      // $firstName = $_POST['firstName'];
      // $email = $_POST['email'];
      // $password = $_POST['password'];

      try {
         $user = new UserModel($_POST);

         if (!$user->validate())
         {
            throw new ValidationException($user->getErrors());
         }

         inspect($user->getAttributes());
      
         // $user->lastName = $lastName;
         // $user->firstName = $firstName;
         // $user->email = $email;
         // $user->password = $password;
         // $user->save();
      } catch (ValidationException $e) {
         // inspect($e->getErrors());
         Response::view('shared/register', ['errors' => $e->getErrors()]);

      }

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