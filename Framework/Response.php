<?php
namespace Framework;

class Response
{
   // Phương thức để render view
   public static function view($viewName, $data = [])
   {
      // Chuyển các phần tử của mảng $data thành các biến riêng lẻ
      extract($data);

      // Đường dẫn đến thư mục views
      $viewPath =  basePath("App/views/{$viewName}.view.php");
    

      // Kiểm tra file view có tồn tại không
      if (file_exists($viewPath)) {
         // Nếu tồn tại thì include view

         require_once $viewPath;
      } else {
         // Nếu không tìm thấy view, báo lỗi
         die("View $viewName không tồn tại!");
      }
   }

   // Phương thức trả về JSON
   public static function json($data, $statusCode = 200)
   {
      // Đặt header JSON
      header('Content-Type: application/json');

      // Đặt mã trạng thái HTTP
      http_response_code($statusCode);

      // Chuyển đổi mảng sang JSON và in ra
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      exit;
   }

  


   // Phương thức chuyển hướng
   public static function redirect($url)
   {
      header("Location: $url");
      exit;
   }

   // Phương thức trả về dữ liệu dạng văn bản
   public static function text($content, $statusCode = 200)
   {
      header('Content-Type: text/plain');
      http_response_code($statusCode);
      echo $content;
      exit;
   }
}
