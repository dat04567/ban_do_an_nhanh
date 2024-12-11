<?php

namespace App\Controllers\admin;

use App\Controllers\Controller;
use App\Controllers\ErrorController;
use App\Models\IngredientModel;
use Exception;
use Framework\Database;
use Framework\Response;
use Framework\ValidationException;
use PDOException;



class IngredientController  extends Controller
{

   public function __construct()
   {
      try {
         parent::__construct();
      } catch (Exception $th) {
      }
   }
   public function index()
   {
      try {
         if (!$this->db) {
            throw new Exception('Lỗi kết nối dữ liệu');
         }

       

         $filter = $_GET['filter'] ?? 'active';

   
         switch ($filter) {
            case 'active':
               $whereCondition = 'isDeleted=FALSE';
               break;
            case 'deleted':
               $whereCondition = 'isDeleted=TRUE';
               break;
            case 'all':
               $whereCondition = 1;
               break;
         }


         // Lấy danh sách nguyên liệu
         $ingredients = $this->db->select(' SELECT  * FROM NguyenLieu WHERE ' . $whereCondition, [], 100);
     
      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());

      }
      Response::view('admin/manage-ingredients', ['ingredients' => $ingredients ?? []]);

    
   }

   public function showListFoods() {}

   public function show()
   {
      echo "Show Page";
   }

   public function showId($argments)
   {
      inspect($argments);
      // echo "Show Page with ID: $id";
   }

   public function create()
   {
      Response::view('admin/create-ingredients');
   }



   public function store()
   {

      try {
         if (!$this->db) {
            throw new Exception('Lỗi kết nối dữ liệu');
         }


         $ingredientObject = new  IngredientModel($_POST);

         if (!$ingredientObject->validate()) {
            throw new ValidationException($ingredientObject->getErrors());
         }

         $ingredientObject->save();

         // Xóa cache
         $this->db->clearSingleCache('nguyenlieu');
         $this->db->clearSingleCache('KhoNguyenLieu');

         $this->session->set('success-modal', 'Thêm nguyên liệu thành công');

         Response::redirect('/admin/ingredients');
      } catch (Exception $th) {
         if ($th instanceof ValidationException) {
            Response::view('admin/create-ingredients', ['errors' => $th->getErrors()]);
         } else {
            $message = $this->extractErrorMessage($th->getMessage());

            $this->session->set('error-modal', $message);
            Response::redirect('/admin/ingredients/create');
         }
      }
   }


   public function destroy($params)
   {
      $id  = $params['id'];

      $this->db->clearSingleCache('nguyenlieu');
      $this->db->clearSingleCache('KhoNguyenLieu');
      try {

         if (!$this->db) {
            throw new Exception('Lỗi kết nối dữ liệu');
         }
       ;
         $this->db->query('CALL XoaNguyenLieu(?)', [$id]);

         // Xóa cache
         $this->db->clearSingleCache('NguyenLieu');

         $this->session->set('success-modal', 'Xóa nguyên liệu thành công');

         Response::redirect('/admin/ingredients');
      } catch (Exception $th) {
         
         $errorMessage = $this->extractErrorMessage($th->getMessage());
         $this->session->set('error-modal', $errorMessage);
         Response::redirect('/admin/ingredients');
      }
   }

   private function extractErrorMessage($message)
   {
      // Tìm vị trí của thông báo lỗi cụ thể trong chuỗi thông báo
      $pattern = '/Lỗi kết nối dữ liệu|Tên nguyên liệu đã tồn tại|Không thể xóa nguyên liệu đang được sử dụng trong sản phẩm đang bán|Không thể xóa nguyên liệu còn tồn kho|Nguyên liệu không tồn tại hoặc đã bị xóa/';
      if (preg_match($pattern, $message, $matches)) {
         return $matches[0];
      }
      return  $message;
   }




   public function edit()
   {
      echo "Edit Page";
   }

   public function update()
   {
      echo "Update Page";
   }
}
