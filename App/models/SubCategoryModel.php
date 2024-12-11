<?php


namespace App\Models;

use Framework\Database;

class SubCategoryModel  extends BaseModel
{
   protected $idDanhMuc;
   protected $tenDanhMuc;

   protected $isActive;




   protected $rules = [
      'idDanhMuc' => [
         'required',
         'UUID'
      ],
      'tenDanhMuc' => [
         'required',
         ['min', 3],
         ['max', 255]
      ],
   ];


   public function  validateUUID($attribute, $value): bool
   {
      return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $value) === 1;
   }


   public function getErrorMessages(): array
   {
      return [
         'idDanhMuc.required' => 'ID danh mục không được để trống',
         'idDanhMuc.UUID' => 'ID danh mục không đúng định dạng UUID',
         'tenDanhMuc.required' => 'Tên danh mục không được để trống',
         'tenDanhMuc.min' => 'Tên danh mục phải có ít nhất 3 ký tự',
         'tenDanhMuc.max' => 'Tên danh mục không được vượt quá 255 ký tự'
      ];
   }

   public function save()
   {
      $db = Database::getInstance();
      $db->insert('DanhMucCon', [
         'idDanhMuc' => $this->idDanhMuc,
         'tenDanhMucCon' => $this->tenDanhMuc,
         'isActive' => $this->isActive,
      ]);
   }

   public function setTenDanhMuc($tenDanhMuc)
   {
      $this->tenDanhMuc = $tenDanhMuc;
      $this->attributes['tenDanhMuc'] = $tenDanhMuc;
   }

   
 

   public function setIsActive($isActive)
   {
      $this->isActive = $isActive;
   }



}
