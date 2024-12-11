<?php

namespace App\Models;

use Framework\Database;

class FoodModel extends BaseModel
{
   protected $tenSanPham;
   protected $gia;

   protected $status;

   protected $hinhAnh;

   protected $danhMuc;

   protected $idSanPham;

   protected $nguyenLieu;

   protected $soLuongTonKho;

   protected $cuaHang;

 


   protected $rules = [
      'tenSanPham' => [
         'required',
         ['min', 2],
         ['max', 50]
      ],
      'gia' => [
         'required',
         'number',
         ['min', 2],
         ['max', 50], 
      ],
      'cuaHang' => [
         'required',
         'UUID'
      ],
      'danhMuc' => [
         'required',
         'UUID'
      ]

   ];


   public function  validateUUID($attribute, $value): bool
   {
      if($value == null) return false;
      return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $value) === 1;
   }

   public function validateNumber($attribute, $value): bool
   {
      return is_numeric($value) && $value > 0;
   }


   public function addImage($image)
   {
      $this->hinhAnh[] = $image;
   }


   public function setHinhAnh ($hinhAnh)
   {
      $this->hinhAnh = $hinhAnh;
   }


   public function getHinhAnh(){
      return $this->hinhAnh;
   }

   public function setCuaHang($cuaHang)
   {
      $this->cuaHang = $cuaHang;
   }

   protected function getErrorMessages(): array
   {
       return [
         'tenSanPham.required' => 'Tên sản phẩm không được để trống',
         'tenSanPham.min' => 'Tên sản phẩm phải chứa ít nhất 2 ký tự',
         'tenSanPham.max' => 'Tên sản phẩm không được vượt quá 50 ký tự',
         'gia.required' => 'Giá sản phẩm không được để trống',
         'gia.min' => 'Giá sản phẩm phải chứa ít nhất 2 ký tự',
         'gia.max' => 'Giá sản phẩm không được vượt quá 50 ký tự',
         'gia.number' => 'Giá sản phẩm phải là số và lớn hơn 0',
         'cuaHang.required' => 'Vui lòng chọn cửa hàng',
         'cuaHang.UUID' => 'Cửa hàng không hợp lệ',
         'danhMuc.required' => 'Vui lòng chọn danh mục',
         'danhMuc.UUID' => 'Danh mục không hợp lệ'
       ];
   }


   private function generateUUID()
   {
      return sprintf(
         '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff),
         mt_rand(0, 0x0fff) | 0x4000,
         mt_rand(0, 0x3fff) | 0x8000,
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff)
      );
   }


   public function setNguyenLieu($nguyenLieu)
   {
      $this->nguyenLieu = $nguyenLieu;
   }  


   public function save()
   {
      $db = Database::getInstance();
      $this->idSanPham = $this->generateUUID();

      // Start transaction
  

      try {
         $db->beginTransaction();
         // Insert into SanPham
         $db->insert('SanPham', [
            'idSanPham' => $this->idSanPham,
            'tenSanPham' => $this->tenSanPham,
            'price' => $this->gia,
            'status' => $this->status
         ]);

         // Insert into SanPhamDanhMuc
         foreach ($this->danhMuc as $idDanhMucCon) {
            $db->insert('SanPhamDanhMuc', [
               'idSanPham' => $this->idSanPham,
               'idDanhMucCon' => $idDanhMucCon
            ]);
         }

         // Insert into KhoSanPham
         foreach ($this->cuaHang as $idCuaHang) {
            $db->insert('KhoSanPham', [
               'idSanPham' => $this->idSanPham,
               'idCuaHang' => $idCuaHang,
               'soLuongTonKho' => 0
            ]);
         }
         // Handle nguyenLieu
         // foreach ($this->nguyenLieu as $item) {
         //    $db->insert('SanPhamNguyenLieu', [
         //       'idSanPham' => $this->idSanPham,
         //       'idNguyenLieu' => $item['idNguyenLieu'],
         //       'soLuong' => $item['soLuong']
         //    ]);
         // }

         // Handle hinhAnh
         foreach ($this->hinhAnh as $image) {
            $db->insert('HinhAnh', [
               'idSanPham' => $this->idSanPham,
               'duongDan' => $image['path'],
            ]);
         }

         // Commit transaction
         $db->commit();

         // Return new product ID
         return $this->idSanPham;

      } catch (\Exception $e) {
         // Rollback transaction on error
         $db->rollBack();
         throw $e;
      }
   }

}
