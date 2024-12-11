<?php

namespace App\Controllers\api;

use Framework\Database;
use Framework\Response;

class InventoryIngredientController
{
   protected $db;

   public function __construct()
   {
      $this->db = Database::getInstance();
   }
   public function index()
   {
      // thông tin nguyên liệu trong kho
      try {
         $inventoryIngredients =  $this->db->select(' SELECT  c.storeName, nl.tenNguyenLieu, kl.soLuongTonKho, kl.trangThai  FROM CuaHang c 
                                                      JOIN KhoNguyenLieu kl ON c.idCuaHang = kl.idCuaHang 
                                                      JOIN NguyenLieu nl ON kl.idNguyenLieu = nl.idNguyenLieu 
                                                      WHERE c.isDeleted = false AND kl.isDeleted = false AND nl.isDeleted = false;', [], 100);

                                             
         Response::json($inventoryIngredients);
      } catch (\Exception $e) {
         Response::json(['message' => 'Lỗi không xác định'], 500);
      }
   }
}
