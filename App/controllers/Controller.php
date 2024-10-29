<?php

namespace App\Controllers;


abstract class Controller {

   protected $db;

   public function __construct()
   {
   //   $config = require basePath('config/db.php');
   //   $this->db = new Database($config);
   }
   abstract function index();
   abstract function show();
   abstract function create();
   abstract function store();
   abstract function edit();
   abstract function update();
   abstract function destroy();
}