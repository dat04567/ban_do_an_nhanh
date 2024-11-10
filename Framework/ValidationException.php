<?php


namespace Framework;


use Exception;

class ValidationException extends Exception
{
   // Lưu trữ các lỗi validation
   private $errors = [];

   // Constructor nhận vào mảng các lỗi
   public function __construct($errors)
   {
      // Lưu trữ mảng lỗi vào thuộc tính riêng
      $this->errors = $errors;

      // Gọi constructor của lớp cha (Exception) 
      // với một thông báo mặc định
      parent::__construct("Validation failed");
   }

   // Phương thức để lấy ra các lỗi
   public function getErrors()
   {
      return $this->errors;
   }
}
