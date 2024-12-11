<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use App\Services\CartService;
use Exception;
use Framework\Response;

class HomeController  extends Controller
{
   public function __construct(){
      try {
         parent::__construct();
      } catch (Exception $th) {
         //throw $th;
      }
   }
   public function index()
   {

      try {
         if (!$this->db) {
            throw new Exception("Kết nối database thất bại");
         }

         $categories = $this->db->select('SELECT * FROM DanhMuc WHERE isDeleted = FALSE and isActive = TRUE', [], 1000);

         $foods = $this->db->select("SELECT 
                                          SP.idSanPham,
                                          SP.tenSanPham AS tenSanPham, 
                                          SP.price AS gia ,
                                          KSP.soLuongTonKho AS tonKho,
                                          GROUP_CONCAT(DISTINCT HA.duongDan SEPARATOR ';') AS hinhAnh,
                                          GROUP_CONCAT(DISTINCT DMC.tenDanhMucCon SEPARATOR ',') AS tenDanhMuc
                                          FROM 
                                             SanPham SP
                                          LEFT JOIN 
                                             SanPhamDanhMuc SPDM ON SP.idSanPham = SPDM.idSanPham
                                          LEFT JOIN 
                                             DanhMucCon DMC ON SPDM.idDanhMucCon = DMC.idDanhMucCon
                                          LEFT JOIN 
                                             HinhAnh HA ON SP.idSanPham = HA.idSanPham
                                          LEFT JOIN
                                             KhoSanPham KSP ON SP.idSanPham = KSP.idSanPham 
                                          WHERE 
                                             SP.isDeleted = FALSE
                                          GROUP BY    
                                             SP.idSanPham, SP.tenSanPham, SP.price, KSP.soLuongTonKho
                                          ORDER BY
                                             SP.createAt DESC
                                          LIMIT 10", [], 1000);

         $foods = array_map(function ($food) {
            $food['hinhAnh'] = explode(';', $food['hinhAnh']);
            return $food;
         }, $foods);


         $data = [
            'categories' => $categories,
            'foods' => $foods
         ];
         
      } catch (Exception $th) {

         $this->session->set('error-modal', $th->getMessage());
      }

      Response::view('client/dashboard', $data ?? []);
   }




   public function show()
   {
      echo "Show Page";
   }



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
