<?php


namespace App\Models;

use Framework\Database;
#[\AllowDynamicProperties]
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

   public function __construct(array $attributes = [])
   {
      parent::__construct($attributes);
   }

   // Custom validation rules
   protected function validatePasswordComplexity($attribute, $value): bool
   {
      // Require at least one uppercase, one lowercase, one number
      return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $value) === 1;
   }

   protected function validateUnique($attribute, $value): bool
   {
      $stmt = Database::getInstance()->query('SELECT COUNT(*) FROM NguoiDung WHERE email = ?', [
         $value
      ]);
      return $stmt->fetchColumn()  == 0;
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


   public function save()
   {
      // Hash the password before saving
      $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
      $this->id = $this->generateUUID();
      // Example: Save user to database
      Database::getInstance()->insert('NguoiDung', [
         'id' => $this->id,
         'lastName' => $this->lastName,
         'firstName' => $this->firstName,
         'email' => $this->email,
         'password' => $hashedPassword
      ]);

      // add khach hang

      Database::getInstance()->insert('KhachHang', [
         'idNguoiDung' => $this->id
      ]);

      
      
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
