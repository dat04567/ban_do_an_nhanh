<?php


namespace App\Models;

use Exception;
use Framework\Database;

class StockProductModel  extends BaseModel
{
   protected $idCuaHang;
   protected $idSanPham;
   protected $soLuongTonKho;


   protected $rules = [
      'idCuaHang' => [
         'required',
         'UUID'
      ],
      'idSanPham' => [
         'required',
         'UUID'

      ],
      'soLuongTonKho' => [
         'required',
         'number',
         ['min', 1]
      ]
   ];

   public function  validateUUID($attribute, $value): bool
   {
      return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $value) === 1;
   }



   public function validateMin($attribute, $value, $min): bool
   {
      return $value >= $min;
   }


   public function  validateNumber($attribute, $value): bool
   {
      return is_numeric($value);
   }

   protected function getErrorMessages(): array
   {
      return [
         'idCuaHang.required' => 'Cửa hàng không được để trống',
         'idCuaHang.UUID' => 'ID cửa hàng không đúng định dạng UUID',
         'idSanPham.required' => 'Nguyên liệu không được để trống',
         'idSanPham.UUID' => 'ID nguyên liệu không đúng định dạng UUID',
         'soLuongTonKho.required' => 'Số lượng tồn không được để trống',
         'soLuongTonKho.number' => 'Số lượng tồn kho phải là số',
         'soLuongTonKho.min' => 'Số lượng tồn kho phải lớn hơn 0'
      ];
   }

   public function save()
   {
      try {
         $db = Database::getInstance();


         $db->beginTransaction();

         $stockProducts = $db->select('SELECT * FROM KhoSanPham WHERE idSanPham = ? AND idCuaHang = ?', [$this->idSanPham, $this->idCuaHang]);
         


         if (empty($stockProducts)) {
            $db->query('INSERT INTO KhoSanPham(idSanPham, idCuaHang, soLuongTonKho) VALUES(?, ?, ?)', [$this->idSanPham, $this->idCuaHang, $this->soLuongTonKho]);
         } else {
            // check if the product is deleted
            if ($stockProducts[0]['isDeleted']) {

               $db->query('UPDATE KhoSanPham SET soLuongTonKho = ?, isDeleted = false WHERE idSanPham = ? AND idCuaHang = ?', [$this->soLuongTonKho, $this->idSanPham, $this->idCuaHang]);
            } else {

               $db->query('UPDATE KhoSanPham SET soLuongTonKho = soLuongTonKho + ? WHERE idSanPham = ? AND idCuaHang = ?', [$this->soLuongTonKho, $this->idSanPham, $this->idCuaHang]);
            }
         }

         $db->commit();
      } catch (Exception $th) {
         $db->rollBack();
         throw $th;
      }
   }
}
