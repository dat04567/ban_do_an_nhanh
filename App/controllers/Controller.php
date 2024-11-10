<?php

namespace App\Controllers;
use Framework\Database;

abstract class Controller
{

   protected $db;

   public function __construct()
   {
      try {
         $this->db = Database::getInstance();
      } catch (\Exception $e) {
         inspectAndDie( $e->getMessage());
      }
   
   }


   abstract function index();
   abstract function show();
   abstract function edit();
   abstract function update();
   abstract function destroy();
}
