<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use Framework\Response;
use App\Models\UserModel;
use Exception;
use Framework\ValidationException;


class UserController  extends Controller
{

   public function index() {}

   public function signUp()
   {
      Response::view('shared/register');
   }

   public function signIn()
   {
      Response::view('shared/login');
   }

   public function forgotPassword()
   {
      Response::view('shared/forgotpassword');
   }


   public function show()
   {
      echo "Show Page";
   }

   public function login()
   {
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      try {

         $user  = $this->db->query('SELECT * FROM NguoiDung WHERE email = ? ', [$email])->fetchObject(UserModel::class);
         if (!$user) {
            throw new Exception('Email không tồn tại');
         }

         if (!password_verify($password, $user->getPassword())) {
            throw new Exception('Mật khẩu không chính xác');
         }

         
         $this->session->set('user', [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName()
         ]);
        
         return Response::redirect('/');
      } catch (Exception $e) {
         $errors = [$e->getMessage()];
         $data = ['errors' => $errors];
         if ($e->getMessage() === 'Email không tồn tại') {
            $data['password'] = $password;
         } else {
            $data['email'] = $email;
         }
         return Response::view('shared/login', $data);
      }
   }



   public function showId($argments)
   {
      inspect($argments);

      // echo "Show Page with ID: $id";
   }

   public function store()
   {

      try {
         $user = new UserModel($_POST);


         if (!$user->validate()) {
            throw new ValidationException($user->getErrors());
         }
         $user->save();

         $this->session->set('success-modal', 'Đăng ký thành công');
         $this->session->set('url-redirect', '/sign-in');
         Response::redirect('/sign-up');
      } catch (Exception $e) {
         if ($e instanceof ValidationException) {
            return Response::view('shared/register', ['errors' => $e->getErrors()]);
         } else {
            // $message = $this->extractErrorMessage($e->getMessage());
            $this->session->set('error-modal', $e->getMessage());
            Response::view('shared/register');
         }
      }
   }


   public function logout()
   {
      $this->session->destroy();
      Response::redirect('/');
   }

   public function edit()
   {
      echo "Edit Page";
   }

   public function update()
   {
      echo "Update Page";
   }

   public function destroy()
   {
      echo "Destroy Page";
   }
}
