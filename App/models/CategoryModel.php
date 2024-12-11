<?php

namespace App\Models;

use Framework\Database;

class CategoryModel extends BaseModel
{
   protected $idDanhMuc;
   protected $tenDanhMuc;

   protected $isActive;

   protected $hinhAnh;

  
   protected $rules = [
      'tenDanhMuc' => [
         'required',
         ['min', 2],
         ['max', 50]
      ],
   ];




   protected function getErrorMessages(): array
   {
      return [
         'tenDanhMuc.required' => 'Tên danh mục không được để trống',
         'tenDanhMuc.min' => 'Tên danh mục phải chứa ít nhất 2 ký tự',
         'tenDanhMuc.max' => 'Tên danh mục không được vượt quá 50 ký tự',
         'tenDanhMuc.regex' => 'Tên danh mục chỉ chứa chữ cái và khoảng trắng',
      ];
   }

   public function save()
   {
      $db = Database::getInstance();
      $db->insert('DanhMuc', [
         'tenDanhMuc' => $this->tenDanhMuc,
         'isActive' => $this->isActive,
         'hinhAnh' => $this->hinhAnh,
      ]);
   }

   public function setTenDanhMuc($tenDanhMuc)
   {
      $this->tenDanhMuc = $tenDanhMuc;
      $this->attributes['tenDanhMuc'] = $tenDanhMuc;
   }


   public function setHinhAnh($hinhAnh)
   {
      $this->hinhAnh = $hinhAnh;
   }





   



}
