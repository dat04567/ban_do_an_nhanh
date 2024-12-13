<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use App\Services\CartService;
use Exception;
use Framework\Response;

class ProductController  extends Controller
{

   protected $cartService;

   public function index()
   {


      Response::view('client/shop');
   }



   public function getPrductDetail($argments)
   {
      $id = $argments['id'] ?? '';

      try {
         if (!$this->db) {
            throw new Exception("Kết nối database thất bại");
         }


         $user = $this->session->get('user');

         $userId = $user['id'] ?? '';

         $product = $this->db->select("SELECT 
                                             sp.idSanPham,
                                             sp.tenSanPham,
                                             sp.price,
                                             ch.storeName AS tenCuaHang,
                                             ctgh.soLuong AS soLuongTrongGio,
                                             ksp.soLuongTonKho,
                                             (
                                                SELECT JSON_ARRAYAGG(
                                                      JSON_OBJECT(
                                                         'idHinhAnh', ha.idHinhAnh,
                                                         'duongDan', ha.duongDan,
                                                         'laHinhChinh', ha.laHinhChinh
                                                      )
                                                )
                                                FROM HinhAnh ha
                                                WHERE ha.idSanPham = sp.idSanPham AND ha.isDeleted = FALSE
                                             ) AS hinhAnhArray,
                                             (
                                                SELECT JSON_ARRAYAGG(tenDanhMucCon)
                                                FROM SanPhamDanhMuc spdm
                                                JOIN DanhMucCon dmc ON spdm.idDanhMucCon = dmc.idDanhMucCon
                                                WHERE spdm.idSanPham = sp.idSanPham AND spdm.isDeleted = FALSE
                                             ) AS danhMucArray
                                          FROM 
                                             NguoiDung nd
                                          JOIN 
                                             GioHang gh ON nd.id = gh.idNguoiDung
                                          JOIN 
                                             ChiTietGioHang ctgh ON gh.idGioHang = ctgh.idGioHang
                                          JOIN 
                                             SanPham sp ON ctgh.idSanPham = sp.idSanPham
                                          JOIN 
                                             KhoSanPham ksp ON sp.idSanPham = ksp.idSanPham
                                          JOIN 
                                             CuaHang ch ON ksp.idCuaHang = ch.idCuaHang
                                          WHERE 
                                             nd.id = ?
                                             AND sp.isDeleted = FALSE ", [$userId]);
         inspectAndDie($product);
      } catch (Exception $th) {
         Response::json([
            'message' => $th->getMessage(),
            'success' => false
         ], 500);
      }
   }





   public function show() {}

   public function showId($argments)
   {
      inspect($argments);
      // echo "Show Page with ID: $id";
   }

   public function create()
   {

      echo "Create Page";
   }

   public function store()
   {
      echo "Store Page";
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
