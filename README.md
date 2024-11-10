# Bán đồ ăn nhanh

## Bắt đầu

### Cài đặt Composer trên Windows và Mac

#### Cài đặt PHP trên Windows

1. Tải xuống trình cài đặt PHP từ [php.net](https://windows.php.net/download/).
2. Chọn phiên bản PHP phù hợp với hệ điều hành của bạn và tải xuống tệp ZIP.
3. Giải nén tệp ZIP vào một thư mục trên máy tính của bạn, ví dụ: `C:\php`.
4. Thêm đường dẫn đến thư mục PHP vào biến môi trường `PATH`:
   -  Mở Control Panel và chọn System and Security.
   -  Chọn System và sau đó chọn Advanced system settings.
   -  Trong tab Advanced, nhấp vào Environment Variables.
   -  Trong phần System variables, tìm và chọn biến `Path`, sau đó nhấp vào Edit.
   -  Thêm đường dẫn đến thư mục PHP của bạn, ví dụ: `C:\php`.
5. Mở Command Prompt và chạy lệnh `php -v` để kiểm tra cài đặt PHP.

#### Cấu hình XAMPP để chạy dự án

#### Cấu hình XAMPP để chạy dự án trên Windows

1. Mở tệp cấu hình Apache của XAMPP. Tệp này thường nằm ở: `C:\xampp\apache\conf\httpd.conf`.
2. Tìm dòng `DocumentRoot` và thay đổi nó thành đường dẫn đến thư mục dự án của bạn:

   ```apache
   DocumentRoot "C:/xampp/htdocs/food_order"
   <Directory "C:/xampp/htdocs/food_order">
   ```

3. Lưu tệp cấu hình và khởi động lại Apache từ bảng điều khiển XAMPP.

Bây giờ bạn đã sẵn sàng để chạy dự án của mình trên XAMPP.

Bây giờ bạn đã sẵn sàng để chạy dự án của mình trên XAMPP.

### Cài đặt gói Composer

Sử dụng PSR-4 để tự động tải các lớp.

### Cài đặt

Chạy lệnh sau để cài đặt các gói Composer:

```sh
composer install
```

### Chạy lệnh

```sh
php -S localhost:8000 -t public
```

### Cấu hình môi trường PHP

#### Cấu hình tệp `/config/_db.php`

1. Mở tệp `/config/_db.php` trong trình soạn thảo văn bản của bạn.
2. Cập nhật các thông tin cấu hình cơ sở dữ liệu như sau:

   ```php
   <?php
      $_ENV['DB_HOST'] = '127.0.0.1';
      $_ENV['DB_NAME'] = 'bandoanDB'; // tên database 
      $_ENV['DB_USER'] = 'root'; // tên user name 
      $_ENV['DB_PASS'] = '123456789'; // password
      $_ENV['DB_PORT'] = '3306'; // port bao nhiêu 
   ```

3. Lưu tệp và đảm bảo rằng các thông tin cấu hình là chính xác và phù hợp với môi trường của bạn.

Bây giờ bạn đã sẵn sàng để kết nối với cơ sở dữ liệu của mình.
