<?php

namespace App\Controllers\admin;

use App\Controllers\Controller;
use App\Models\StockProductModel;
use Framework\Response;
use Framework\ValidationException;
use PDOException;

class  InventoryProductController extends Controller
{

   public function __construct()
   {
      try {
         parent::__construct();
      } catch (\Exception $th) {
      }
   }


   public function index()
   {
      try {
         if (!$this->db) {
            throw new \Exception('Không thể kết nối dữ liệu');
         }
      } catch (\Exception $e) {
         $this->session->set('Error', $e->getMessage());
      }

      Response::view('admin/manage-inventory-product');
   }

   public function create()
   {
      try {
         if (!$this->db) {
            throw new \Exception('Không thể kết nối dữ liệu');
         }

         // get all stores
         $stores = $this->db->select('SELECT  idCuaHang, storeName FROM CuaHang WHERE isDeleted = false', [], 100);
         // get all products
         $products = $this->db->select('SELECT  idSanPham, tenSanPham FROM SanPham WHERE isDeleted = false', [], 100);


         $data = [
            'stores' => $stores,
            'products' => $products
         ];
      } catch (\Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
      }
      Response::view('admin/create-inventory-products', $data  ?? []);
   }

   public function store()
   {
      $idSanPham = $_POST['idSanPham'] ?? '';
      $idCuaHang = $_POST['idCuaHang'] ?? '';
      $soLuongTonKho = $_POST['soLuongTonKho'] ?? 0;


      try {
         if ($this->db == null) {
            throw new \Exception('Không thể kết nối dữ liệu');
         }

         $stockProduct = new StockProductModel([
            'idSanPham' => $idSanPham,
            'idCuaHang' => $idCuaHang,
            'soLuongTonKho' => $soLuongTonKho
         ]);


         $stores = $this->db->select('SELECT  idCuaHang, storeName FROM CuaHang WHERE isDeleted = false', [], 100);
         $products = $this->db->select('SELECT  idSanPham, tenSanPham FROM SanPham WHERE isDeleted = false', [], 100);

         $data = [
            'stores' => $stores,
            'products' => $products
         ];

         if (!$stockProduct->validate()) {
            throw new ValidationException($stockProduct->getErrors());
         }


         $stockProduct->save();





         $this->session->set('success-modal', 'Nhập kho sản phẩm thành công');
         $this->session->set('url-redirect', '/admin/inventory-products');
      } catch (\Exception $e) {
         if ($e instanceof ValidationException) {
            $errors = $e->getErrors();
            $data['errors'] = $errors;

            $data = $this->handleValidationErrors($data, $errors, [
               'idSanPham' => $idSanPham,
               'idCuaHang' => $idCuaHang,
               'soLuongTonKho' => $soLuongTonKho
            ]);

         } else {
            $this->session->set('error-modal', $e->getMessage());
         }
      }


      Response::view('admin/create-inventory-products', $data ?? []);
   }







   function destroy()
   {
      $method = $_POST['_method'];
      $idNguyenLieu = $_POST['idNguyenLieu'];
      $idCuaHang = $_POST['idCuaHang'];


      try {
         if ($this->db == null) {
            throw new \Exception('Không thể kết nối dữ liệu');
         }

         if ($method == 'DELETE') {
            $stmt = $this->db->query('UPDATE KhoNguyenLieu SET isDeleted = true WHERE idNguyenLieu = ? AND idCuaHang = ?', [$idNguyenLieu, $idCuaHang]);



            $rowCountDeleted = $stmt->rowCount();

            if ($rowCountDeleted == 0) {
               throw new \Exception('Không thể xóa kho nguyên liệu');
            }

            $this->db->clearSingleCache('KhoNguyenLieu');

            $this->session->set('success-modal', 'Xóa kho nguyên liệu thành công');
         }
      } catch (\Exception $e) {
         $this->session->set('error-modal', $e->getMessage());
      }

      Response::redirect('/admin/inventory-ingredients');
   }






   function show() {}
   function edit() {}
   function update() {}
}
