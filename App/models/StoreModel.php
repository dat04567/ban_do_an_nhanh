<?php

namespace App\Models;

use Framework\Database;

class StoreModel extends BaseModel
{

    protected $id;
    protected $storeName;

    protected $email;

    protected $totalRevenue;
    protected $profit;

    protected $pathImage;


    protected $rules = [
        'storeName' => [
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
    ];

    protected function validateUnique($attribute, $value): bool
    {
        // Example: Check if email is unique
        // global $db; // Assume we have a database connection
        // $sql = "SELECT COUNT(*) as count FROM users WHERE email = ? AND id != ?";
        // $result = $db->query($sql, [$value, $this->id ?? 0]);
        return true;
    }



    protected function getErrorMessages(): array
    {
        return [
            'storeName.required' => 'Tên cửa hàng không được để trống',
            'storeName.min' => 'Tên cửa hàng phải chứa ít nhất 2 ký tự',
            'storeName.max' => 'Tên cửa hàng không được vượt quá 50 ký tự',
            'storeName.regex' => 'Tên cửa hàng chỉ chứa chữ cái và khoảng trắng',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
        ];
    }

    public function save()
    {
     
        Database::getInstance()->insert('CuaHang', [
            'storeName' => $this->storeName,
            'email' => $this->email,
        ]);

    }


    public function getStoreName()
    {
        return $this->storeName;
    }

    public function setStoreName($storeName)
    {
        $this->storeName = $storeName;
        $this->attributes['storeName'] = $storeName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->attributes['email'] = $email;
    }
}
