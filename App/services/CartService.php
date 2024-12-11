<?php
// CartService.php
namespace App\Services;

use Exception;
use Framework\Database;

class CartService
{
   private Database $db;

   public function __construct(Database $db = null)
   {
      $this->db = $db ?? Database::getInstance();
   }

   public function getCartDetail(string $idCart): array
   {
      try {
         $query = '
                  SELECT 
                  SP.tenSanPham,
                  CTGH.soLuong,
                  SP.price,
                  SP.idSanPham,
                  KSP.soLuongTonKho as soLuongTon,
                  GROUP_CONCAT(DISTINCT HA.duongDan) as hinhAnh,
                  COUNT(*) OVER() as totalCount,
                  (CTGH.soLuong * SP.price) as totalPrice,
                  KSP.idCuaHang  -- Thêm ID của cửa hàng
                  FROM ChiTietGioHang CTGH
                  JOIN SanPham SP ON CTGH.idSanPham = SP.idSanPham 
                  LEFT JOIN HinhAnh HA ON SP.idSanPham = HA.idSanPham
                  LEFT JOIN (
                     -- Truy vấn con để chọn cửa hàng phù hợp nhất cho mỗi sản phẩm
                     SELECT 
                        idSanPham, 
                        idCuaHang, 
                        soLuongTonKho,
                        ROW_NUMBER() OVER (
                              PARTITION BY idSanPham 
                              ORDER BY 
                                 soLuongTonKho DESC,  -- Ưu tiên kho có nhiều hàng
                                 idCuaHang  -- Thứ tự phụ để đảm bảo tính nhất quán
                        ) as store_rank
                     FROM KhoSanPham
                     WHERE soLuongTonKho > 0  -- Chỉ chọn kho còn hàng
                  ) KSP ON SP.idSanPham = KSP.idSanPham AND KSP.store_rank = 1
                  WHERE CTGH.idGioHang = ? 
                     AND SP.isDeleted = FALSE
                  GROUP BY 
                     SP.idSanPham, 
                     SP.tenSanPham, 
                     CTGH.soLuong, 
                     SP.price, 
                     KSP.soLuongTonKho,
                     KSP.idCuaHang
            ';

         $cartDetail = $this->db->select($query, [$idCart]);

         if (empty($cartDetail)) {
            return [
               'count' => 0,
               'cartDetail' => []
            ];
         }

         return [
            'count' => $cartDetail[0]['totalCount'],
            'cartDetail' => array_map(function ($item) {
               // Split image paths and remove total count from individual items
               $item['hinhAnh'] = explode(',', $item['hinhAnh']);
               unset($item['totalCount']);
               return $item;
            }, $cartDetail)
         ];
      } catch (Exception $th) {
         // Consider logging the exception
         throw $th;
      }
   }
}
