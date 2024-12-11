<?php


namespace App\Models;

use App\Models\BaseModel;
use Framework\Database;

class IngredientModel extends BaseModel
{

   protected $id;
   protected $tenNguyenLieu;
   protected $giaNguyenLieu;
   protected $donVi;

   protected $rules = [
      'tenNguyenLieu' => [
         'required',
         ['min', 2],
         ['max', 50]
      ],
      'giaNguyenLieu' => [
         'required',
         'numeric',
         ['min', 0]
      ],

   ];

   protected function validateNumeric($field, $value)
   {
      return is_numeric($value);
   }

   public function getErrorMessages(): array
   {
      return [
         'tenNguyenLieu.required' => 'Tên nguyên liệu không được để trống',
         'tenNguyenLieu.min' => 'Tên nguyên liệu phải chứa ít nhất 2 ký tự',
         'tenNguyenLieu.max' => 'Tên nguyên liệu không được vượt quá 50 ký tự',
         'giaNguyenLieu.required' => 'Giá nguyên liệu không được để trống',
         'giaNguyenLieu.numeric' => 'Giá nguyên liệu phải là số',
         'giaNguyenLieu.min' => 'Giá nguyên liệu phải lớn hơn hoặc bằng 0',
      ];
   }


   public function save()
   {
      Database::getInstance()->query('CALL ThemNguyenLieu(?,?,?)', [
         $this->tenNguyenLieu,
         $this->donVi,
         $this->giaNguyenLieu
      ]);
   }

   public function getTenNguyenLieu()
   {
      return $this->tenNguyenLieu;
   }

   public function getGiaNguyenLieu()
   {
      return $this->giaNguyenLieu;
   }

   public function getDonVi()
   {
      return $this->donVi;
   }

   public function setTenNguyenLieu($tenNguyenLieu)
   {
      $this->tenNguyenLieu = $tenNguyenLieu;
      $this->attributes['tenNguyenLieu'] = $tenNguyenLieu;
   }

   public function setGiaNguyenLieu($giaNguyenLieu)
   {
      $this->giaNguyenLieu = $giaNguyenLieu;
      $this->attributes['giaNguyenLieu'] = $giaNguyenLieu;
   }

   public function setDonVi($donVi)
   {
      $this->donVi = $donVi;
      
   }
}
