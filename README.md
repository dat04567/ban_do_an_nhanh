# Bán đồ ăn nhanh 
## Bắt đầu


### Cài đặt Composer trên Windows và Mac

#### Trên Windows

1. Tải xuống trình cài đặt Composer từ [getcomposer.org](https://getcomposer.org/Composer-Setup.exe).
2. Chạy tệp `Composer-Setup.exe` và làm theo hướng dẫn để hoàn tất cài đặt.

#### Trên Mac

1. Mở Terminal.
2. Chạy lệnh sau để tải xuống và cài đặt Composer:

   ```sh
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   php composer-setup.php
   php -r "unlink('composer-setup.php');"
   sudo mv composer.phar /usr/local/bin/composer
   ```

#### Cài đặt PHP trên Windows

1. Tải xuống trình cài đặt PHP từ [php.net](https://windows.php.net/download/).
2. Chọn phiên bản PHP phù hợp với hệ điều hành của bạn và tải xuống tệp ZIP.
3. Giải nén tệp ZIP vào một thư mục trên máy tính của bạn, ví dụ: `C:\php`.
4. Thêm đường dẫn đến thư mục PHP vào biến môi trường `PATH`:
   - Mở Control Panel và chọn System and Security.
   - Chọn System và sau đó chọn Advanced system settings.
   - Trong tab Advanced, nhấp vào Environment Variables.
   - Trong phần System variables, tìm và chọn biến `Path`, sau đó nhấp vào Edit.
   - Thêm đường dẫn đến thư mục PHP của bạn, ví dụ: `C:\php`.
5. Mở Command Prompt và chạy lệnh `php -v` để kiểm tra cài đặt PHP.




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
