<?php

namespace App\Controllers\admin;

use App\Controllers\Controller;
use App\Models\StockIngredientModel;
use Framework\Response;
use Framework\ValidationException;
use PDOException;

class  InventoryIngredientController extends Controller
{

   public function __construct()
   {
      try {
         parent::__construct();
      } catch (\Exception $th) {
      }
   }

   public function fetchAllInventoryIngredients()
   {
      if (!$this->db) {
         throw new \Exception('Không thể kết nói dữ liệu');
      }

      $inventoryIngredients =  $this->db->select(' SELECT  c.storeName, nl.tenNguyenLieu, kl.soLuongTonKho, kl.trangThai, c.idCuaHang, nl.idNguyenLieu  FROM CuaHang c 
                                                         JOIN KhoNguyenLieu kl ON c.idCuaHang = kl.idCuaHang 
                                                         JOIN NguyenLieu nl ON kl.idNguyenLieu = nl.idNguyenLieu 
                                                         WHERE  c.isDeleted = false AND nl.isDeleted = false and kl.isDeleted = false
                                                         ', [], 100);

      return $inventoryIngredients;
   }

   public function index()
   {
      try {
         if (!$this->db) {
            throw new \Exception('Không thể kết nối dữ liệu');
         }

         $inventoryIngredients = $this->fetchAllInventoryIngredients();
    
      } catch (\Exception $e) {
         $this->session->set('Error', $e->getMessage());
      }
      
      Response::view('admin/manage-inventory-ingredients', ['inventoryIngredients' => $inventoryIngredients ?? []]);
   }

   public function create()
   {
      try {
         if (!$this->db) {
            throw new \Exception('Không thể kết nối dữ liệu');
         }
         
         // get all stores
         $stores = $this->db->select('SELECT  idCuaHang, storeName FROM CuaHang WHERE isDeleted = false', [], 100);

         // get all ingredients
         $ingredients = $this->db->select('SELECT  idNguyenLieu, tenNguyenLieu FROM NguyenLieu WHERE isDeleted = false', [], 100);

         Response::view('admin/create-inventory-ingredients', ['stores' => $stores, 'ingredients' => $ingredients]);

      } catch (\Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
         Response::view('admin/create-inventory-ingredients');
      }
   }

   public function store()
   {
      $idNguyenLieu = $_POST['idNguyenLieu'] ?? '';
      $idCuaHang = $_POST['idCuaHang'] ?? '';
      $soLuongTonKho = $_POST['soLuongTonKho'] ?? 0;


      try {
         if ($this->db == null) {
            throw new \Exception('Không thể kết nối dữ liệu');
         }

         $stockIngredient = new StockIngredientModel([
            'idNguyenLieu' => $idNguyenLieu,
            'idCuaHang' => $idCuaHang,
            'soLuongTonKho' => $soLuongTonKho
         ]);


         if (!$stockIngredient->validate()) {
            throw new ValidationException($stockIngredient->getErrors());
         }

         $stmt = $this->db->query('SELECT isDeleted FROM KhoNguyenLieu WHERE idNguyenLieu = ? AND idCuaHang = ?', [$idNguyenLieu, $idCuaHang]);
         $result = $stmt->fetch();


         //  nếu kho nguyên  liệu đã bị xóa thì cập nhật lại trạng thái
         if ($result && $result['isDeleted']) {
            $this->db->query('UPDATE KhoNguyenLieu SET isDeleted = false, soLuongTonKho = ? WHERE idNguyenLieu = ? AND idCuaHang = ?', [$soLuongTonKho, $idNguyenLieu, $idCuaHang]);
         } else {
            $this->db->query('UPDATE KhoNguyenLieu SET soLuongTonKho = soLuongTonKho + ? WHERE idNguyenLieu = ? AND idCuaHang = ?', [$soLuongTonKho, $idNguyenLieu, $idCuaHang]);
         }


         

         $this->db->clearSingleCache('KhoNguyenLieu');
         $this->session->remove('old-inputs');

         $this->session->set('success-modal', 'Nhập kho nguyên liệu thành công');
         $this->session->set('url-redirect', '/admin/inventory-ingredients');

      } catch (\Exception $e) {
         if ($e instanceof ValidationException) {
            $this->session->set('validation-errors', $e->getErrors());
            $this->session->set('old-inputs', $_POST);
         } else if ($e instanceof PDOException) {
            $this->session->set('error-modal', 'Kho nguyên liệu đã tồn tại trong cửa hàng');
         } else {
            $this->session->set('error-modal', 'Không thể thêm kho nguyên liệu');
         }
      }


      Response::redirect('/admin/inventory-ingredients/import');
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
