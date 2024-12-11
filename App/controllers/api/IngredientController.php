<?php

namespace App\Controllers\api;


use Framework\Database;
use Framework\Response;


// api 
class IngredientController
{
   protected $db;
   public function __construct()
   {
      $this->db = Database::getInstance();
   }

   public function index()
   {
      try {
         $ingredients = $this->db->select('SELECT * FROM NguyenLieu WHERE isDeleted = FALSE', [], 100);
         Response::json($ingredients);
      } catch (\Exception $th) {

         Response::json(['message' => 'Lỗi không xác định'], 500);
      }
   }


   public function destroy($params)
   {
      $id  = $params['id'];
      try {
         Database::getInstance()->query('CALL XoaNguyenLieu(?)', [$id]);

         Database::getInstance()->clearSingleCache('nguyenlieu');


         Response::json([
            'status' => 'success',
            'message' => 'Xóa nguyên liệu thành công'
         ], 200);
      } catch (\Exception $th) {

         $errorMessage = $this->extractErrorMessage($th->getMessage());
         
         Response::json([
            'status' => 'error',
            'message' => $errorMessage
         ], 400);
      }
   }

   private function extractErrorMessage($message)
   {
      // Tìm vị trí của thông báo lỗi cụ thể trong chuỗi thông báo
      $pattern = '/Nguyên liệu vẫn còn tồn kho|Nguyên liệu đang được sử dụng trong sản phẩm/';
      if (preg_match($pattern, $message, $matches)) {
         return $matches[0];
      }
      return 'Lỗi không xác định';
   }
}
