<?php

namespace App\Controllers;
use Framework\Database;

abstract class Controller
{

   protected $db;

   public function __construct()
   {
      $this->db = Database::getInstance();
   }


   abstract function index();
   abstract function show();
   abstract function edit();
   abstract function update();
   abstract function destroy();
}
