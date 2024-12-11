<?php

namespace App\Controllers;

use Exception;
use Framework\Database;
use Framework\SessionManager;

abstract class Controller
{

   protected $db;
   protected $session;

   public function __construct()
   {
      try {
         $this->session = SessionManager::getInstance();
         $this->db = Database::getInstance();
      } catch (\Exception $th) {
      }
   }
   protected function handleValidationErrors($data, $errors, $fields)
   {
      foreach ($fields as $field => $value) {
         if (isset($errors[$field])) {
            unset($data[$field]);
         } else {
            $data[$field] = $value;
         }
      }
      return $data;
   }



   abstract function index();
   abstract function show();
   abstract function edit();
   abstract function update();
}
