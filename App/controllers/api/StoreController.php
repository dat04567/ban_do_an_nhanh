<?php

namespace App\Controllers\api;


use Framework\Database;
use Framework\Response;


// api 
class StoreController
{
   protected $db;
   public function __construct()
   {
      $this->db = Database::getInstance();
   }

   public function index()
   {
      try {
         // 1 câu truy vấn lấy thông tin cửa hàng
         $stores = $this->db->select('SELECT 
                                       ch.idCuaHang,
                                       ch.storeName,
                                       ch.email,
                                       ch.pathImage,
                                       ch.tongDoanhThu,
                                       ch.loiNhuan,
                                       COUNT(hdc.idHoaDon) AS tongHoaDon
                                    FROM 
                                       CuaHang ch
                                    LEFT JOIN 
                                       HoaDonCuaHang hdc ON ch.idCuaHang = hdc.idCuaHang AND hdc.isDeleted = false
                                    WHERE 
                                       ch.isDeleted = false
                                    GROUP BY 
                                       ch.idCuaHang,
                                       ch.storeName,
                                       ch.email,
                                       ch.pathImage,
                                       ch.tongDoanhThu,
                                       ch.loiNhuan;', [], 100);
         Response::json($stores);
      } catch (\Exception $th) {
         $message = $this->extractErrorMessage($th->getMessage());
         Response::json(['message' => $message], 500);
      }
   }

   public function destroy($params)
   {
      $id  = $params['id'];
      try {
         Database::getInstance()->query('CALL XoaCuaHang(?)', [$id]);

         Database::getInstance()->clearSingleCache('CuaHang');
         Response::json([
            'status' => 'success',
            'message' => 'Xóa cửa hàng thành công'
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
      $pattern = '/Cửa hàng không tồn tại hoặc đã bị xóa|Không thể xóa cửa hàng có hóa đơn trong 30 ngày gần đây/';
      if (preg_match($pattern, $message, $matches)) {
         return $matches[0];
      }
      return 'Lỗi không xác định';
   }
}
