<?php

namespace App\Models;

use Exception;
use Framework\Database;

class AddressModel extends BaseModel
{
   protected string $firstName;
   protected string  $lastName;
   protected  $address;

   protected  $address2;
   protected  $city;

   protected  $phone;

   protected $isDefault;

   protected $idNguoiDung;

   protected $zip;

   protected $company;


   protected $rules = [

      'firstName' => [
         'required',
         ['min', 2],
         ['max', 50]
      ],
      'lastName' => [
         'required',
         ['min', 2],
         ['max', 50]
      ],
      'address' => [
         'required',
         ['min', 2],
         ['max', 50]
      ],
      'address2' => [
         'required',
         ['min', 2],
         ['max', 50]
      ],
      'city' => [
         ['min', 2],
         ['max', 50]
      ],
      'phone' => [
         'required',
         'number',
         ['min', 2],
         ['max', 50]
      ],
   ];

   public function validateNumber($field, $value)
   {
      return is_numeric($value);
   }

   public function setIdNguoiDung($idNguoiDung)
   {
      $this->idNguoiDung = $idNguoiDung;
   }


   public function getErrorMessages(): array
   {
      return [
         'firstName.required' => 'Vui lòng nhập họ và tên đệm',
         'firstName.min' => 'Họ và tên đệm phải chứa ít nhất 2 ký tự',
         'firstName.max' => 'Họ và tên đệm không được vượt quá 50 ký tự',
         'lastName.required' => 'Vui lòng nhập tên',
         'lastName.min' => 'Tên phải chứa ít nhất 2 ký tự',
         'lastName.max' => 'Tên không được vượt quá 50 ký tự',
         'address.required' => 'Vui lòng nhập địa chỉ',
         'address.min' => 'Địa chỉ phải chứa ít nhất 2 ký tự',
         'address.max' => 'Địa chỉ không được vượt quá 50 ký tự',
         'address2.required' => 'Vui lòng nhập địa chỉ bổ sung',
         'address2.min' => 'Địa chỉ bổ sung phải chứa ít nhất 2 ký tự',
         'address2.max' => 'Địa chỉ bổ sung không được vượt quá 50 ký tự',
         'city.min' => 'Thành phố/tỉnh phải chứa ít nhất 2 ký tự',
         'city.max' => 'Thành phố/tỉnh không được vượt quá 50 ký tự',
         'phone.required' => 'Vui lòng nhập số điện thoại',
         'phone.number' => 'Số điện thoại phải là số',
         'phone.min' => 'Số điện thoại phải chứa ít nhất 2 ký tự',
         'phone.max' => 'Số điện thoại không được vượt quá 50 ký tự'
      ];
   }

   public function save()
   {
      try {
         
         $db = Database::getInstance();

         $db->beginTransaction();


         if ($this->isDefault === '1') {
            $db->update('DiaChiGiaoHang', ['macDinh' => 0], 'idNguoiDung = ?', [$this->idNguoiDung]);
         }

         $fullName = $this->firstName . ' ' . $this->lastName;

         $db->insert('DiaChiGiaoHang', [
            'idNguoiDung' => $this->idNguoiDung,
            'hoTen' => $fullName,
            'diaChi1' => $this->address,
            'diaChi2' => $this->address2,
            'thanhPho' => $this->city,
            'zipcode' => $this->zip,
            'soDienThoai' => $this->phone,
            'congTy' => $this->company,
            'macDinh' => $this->isDefault === '1' ? 1 : 0
         ]);


         $db->commit();



      } catch (Exception $th) {
         $db->rollBack();
         throw $th;
      }
   }
}
