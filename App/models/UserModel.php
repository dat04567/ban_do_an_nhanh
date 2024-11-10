<?php


namespace App\Models;


class UserModel extends BaseModel
{
   protected $id;
   protected $lastName;
   protected $email;

   protected $firstName;

   protected $password;
   protected $created_at;
   protected $updated_at;

   // Define validation rules
   protected $rules = [
      'lastName' => [
         'required',
         ['min', 2],
         ['max', 50],
         ['regex', '/^[a-zA-Z\s]+$/']
      ],
      'firstName' => [
         'required',
         ['min', 2],
         ['max', 50],
         ['regex', '/^[a-zA-Z\s]+$/']
      ],
      'email' => [
         'required',
         'email',
         'unique'
      ],
      'password' => [
         'required',
         ['min', 8],
         'passwordComplexity'
      ]
   ];

   // Custom validation rules
   protected function validatePasswordComplexity($attribute, $value): bool
   {
      // Require at least one uppercase, one lowercase, one number
      return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $value) === 1;
   }

   protected function validateUnique($attribute, $value): bool
   {
      // Example: Check if email is unique
      // global $db; // Assume we have a database connection
      // $sql = "SELECT COUNT(*) as count FROM users WHERE email = ? AND id != ?";
      // $result = $db->query($sql, [$value, $this->id ?? 0]);
      return true;
   }

   // Custom error messages
   protected function getErrorMessages(): array
   {
      return [
          'lastName.required' => 'Họ là bắt buộc',
          'lastName.min' => 'Họ phải có ít nhất %d ký tự',
          'lastName.max' => 'Họ không được vượt quá %d ký tự',
          'lastName.regex' => 'Họ chỉ có thể chứa chữ cái và khoảng trắng',
          'firstName.required' => 'Tên là bắt buộc',
          'firstName.min' => 'Tên phải có ít nhất %d ký tự',
          'firstName.max' => 'Tên không được vượt quá %d ký tự',
          'firstName.regex' => 'Tên chỉ có thể chứa chữ cái và khoảng trắng',
          'email.required' => 'Email là bắt buộc',
          'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ',
          'email.unique' => 'Email này đã được đăng ký',
          'password.required' => 'Mật khẩu là bắt buộc',
          'password.min' => 'Mật khẩu phải có ít nhất %d ký tự',
          'password.passwordComplexity' => 'Mật khẩu phải chứa chữ hoa, chữ thường và số'
      ];
   }

   // Getters and Setters
   public function getId()
   {
      return $this->id;
   }

   public function setFirstName($name)
   {
      $this->firstName = $name;
      $this->attributes['name'] = $name;
   }

   public function getFirstName()
   {
      return $this->firstName;
   }

   public function setEmail($email)
   {
      $this->email = $email;
      $this->attributes['email'] = $email;
   }

   public function getEmail()
   {
      return $this->email;
   }

   public function setPassword($password)
   {
      $this->password = $password;
      $this->attributes['password'] = $password;
   }

   public function getPassword()
   {
      return $this->password;
   }

   public function getLastName()
   {
      return $this->lastName;
   }  

   public function setLastName($lastName)
   {
      $this->lastName = $lastName;
      $this->attributes['lastName'] = $lastName;
   }





}
