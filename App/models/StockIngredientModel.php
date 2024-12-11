<?php


namespace App\Models;



class StockIngredientModel  extends BaseModel
{
   protected $idCuaHang;
   protected $idNguyenLieu;
   protected $soLuongTonKho;


   protected $rules = [
      'idCuaHang' => [
         'required',
         'UUID'
      ],
      'idNguyenLieu' => [
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
         'idNguyenLieu.required' => 'Nguyên liệu không được để trống',
         'idNguyenLieu.UUID' => 'ID nguyên liệu không đúng định dạng UUID',
         'soLuongTonKho.required' => 'Số lượng tồn không được để trống',
         'soLuongTonKho.number' => 'Số lượng tồn kho phải là số',
         'soLuongTonKho.min' => 'Số lượng tồn kho phải lớn hơn 0'
      ];
   }




   



}
