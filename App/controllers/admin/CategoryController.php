<?php

namespace App\Controllers\admin;

use App\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use Exception;
use Framework\Database;
use Framework\ImageProcessor;
use Framework\Response;
use Framework\ValidationException;

class CategoryController  extends Controller
{

   public function index()
   {

      try {
         if (!$this->db) {
            throw new Exception('Lỗi kết nối dữ liệu');
         }

         $categories = $this->db->select('SELECT * FROM DanhMuc WHERE isDeleted = 0', [], 100);
      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
      }
      Response::view('admin/manage-categories', ['categories' => $categories ?? []]);
   }

   public function showSubCategories()
   {
      try {
         if (!$this->db) {
            throw new Exception('Lỗi kết nối dữ liệu');
         }

         $subCategories = $this->db->select(
            'SELECT idDanhMucCon,tenDanhMucCon, hinhAnh, tenDanhMuc, DanhMucCon.isActive  FROM DanhMucCon 
                                                JOIN DanhMuc ON DanhMucCon.idDanhMuc = DanhMuc.idDanhMuc 
                                                WHERE DanhMucCon.isDeleted = 0 and DanhMuc.isDeleted = 0',
            [],
            100
         );
      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
      }

      Response::view('admin/manage-sub-categories', ['subCategories' => $subCategories ?? []]);
   }

   public function createSubCategory()
   {
      try {
         if (!$this->db) {
            throw new Exception('Lỗi kết nối dữ liệu');
         }

         $categories = $this->db->select('SELECT idDanhMuc,tenDanhMuc FROM DanhMuc WHERE isDeleted = 0', [], 100);

      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
      }

      Response::view('admin/create-subcategory', ['categories' => $categories ?? []]);
   }

   public function storeSubCategory()
   {


      $tenDanhMuc = $_POST['tenDanhMuc'] ?? '';
      $idDanhMucCha = $_POST['idDanhMucCha'] ?? '';
      $isActive = $_POST['isActive'] == 'true' ? 1 : 0;


      try {


         if (!$this->db) {
            throw new Exception('Lỗi kết nối dữ liệu');
         }


         $categories = $this->db->select('SELECT idDanhMuc,tenDanhMuc FROM DanhMuc WHERE isDeleted = 0', [], 100);
         $subCategoryModel = new SubCategoryModel([
            'tenDanhMuc' => $tenDanhMuc,
            'idDanhMuc' => $idDanhMucCha,
         ]);



         // Kiểm tra tính hợp lệ dữ liệu
         if (!$subCategoryModel->validate()) {
            throw new ValidationException($subCategoryModel->getErrors());
         }


         $subCategoryModel->setIsActive($isActive);

         $subCategoryModel->save();

         $this->db->clearSingleCache('DanhMucCon');

         $this->session->set('success-modal', 'Thêm danh mục con thành công');
         $this->session->set('url-redirect', '/admin/sub-categories');
         Response::view('admin/create-subcategory', ['categories' => $categories]);
      } catch (Exception $e) {
         $data = [
            'isActive' => $isActive,
            'categories' => $categories ?? []
         ];

         if ($e instanceof ValidationException) {
            $errors = $e->getErrors();
            $data['errors']  = $errors;

            // Nếu có lỗi thì trả về dữ liệu cũ
            if (isset($errors['idDanhMuc'])) {
               $data['tenDanhMuc'] = $tenDanhMuc;
            } else if (isset($errors['tenDanhMuc'])) {
               $data['idDanhMuc'] = $idDanhMucCha;
            }
         } else {
            // Nếu có lỗi thì trả về dữ liệu cũ
            $data['tenDanhMuc'] = $tenDanhMuc;
            $data['idDanhMuc'] = $idDanhMucCha;


            $this->session->set('error-modal', $e->getMessage());
         }

         Response::view('admin/create-subcategory', $data);
      }
   }



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
      Response::view('admin/create-category');
   }



   public function store()
   {

      $nameCategory = $_POST['tenDanhMuc'] ?? '';
      $isActive = $_POST['isActive'] == 'true' ? 1 : 0;
      $oldImage = $_POST['savedFile'] ?? '';
      $uploadDir = basePath('/public/assets/images/categories');

      try {

         if (!$this->db) {
            throw new Exception('Lỗi kết nối dữ liệu');
         }


         if (!isset($_FILES['image']) || (empty($oldImage) && $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE)) {
            throw new Exception("Vui lòng chọn ảnh");
         }

         $path = $oldImage; // Mặc định sử dụng hình ảnh cũ nếu có

         if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {

            // Nếu có ảnh mới và có ảnh cũ, xóa ảnh cũ
            if (!empty($oldImage)) {;
               $fullOldPath = basePath('/public' . $oldImage);
               if (file_exists($fullOldPath)) {
                  unlink($fullOldPath);
               }
            }


            $imageProcessor = new ImageProcessor($uploadDir);
            $fullPath =  $imageProcessor->uploadImage($_FILES['image'], true);

            $path = str_replace(basePath('/public'), '', $fullPath);
         }



         $categoryModel = new CategoryModel([
            'tenDanhMuc' => $nameCategory,
            'isActive' => $isActive
         ]);



         // Kiểm tra tính hợp lệ dữ liệu
         if (!$categoryModel->validate()) {
            throw new ValidationException($categoryModel->getErrors());
         }

         $categoryModel->setHinhAnh($path);


         $this->db->clearSingleCache('DanhMuc');

         $categoryModel->save();


         $this->session->set('success-modal', 'Thêm danh mục thành công');
         $this->session->set('url-redirect', '/admin/categories');
         Response::view('admin/create-category');
      } catch (Exception $e) {
         $data = [
            'isActive' => $isActive,
            'pathImage' => $path ?? '',
         ];
         if ($e instanceof ValidationException) {
            $data['errors'] = $e->getErrors();
         } else {
            $data['tenDanhMuc'] = $nameCategory;
            $this->session->set('error-modal', $e->getMessage());
         }
         Response::view('admin/create-category', $data);
      }
   }


   public function edit()
   {
      echo "Edit Page";
   }

   public function update()
   {
      echo "Update Page";
   }




   public function destroy($params)
   {
      $id = $params['id'] ?? '';
      $method = $_POST['_method'] ?? 'POST';

      try {
         if (!$this->db) {
            throw new Exception('Lỗi kết nối dữ liệu');
         }
        
         if ($method == 'DELETE') {
            $this->db->query('CALL XoaDanhMuc(?)', [$id]);

            $this->db->clearSingleCache('DanhMuc');
            $this->session->set('success-modal', 'Xoá danh mục thành công');
         }

      } catch (Exception $th) {
         $message = $this->extractErrorMessage($th->getMessage());
         $this->session->set('error-modal', $message);
      }

      Response::redirect('/admin/categories');
      
   }

   
   private function extractErrorMessage($message)
   {
      // Tìm vị trí của thông báo lỗi cụ thể trong chuỗi thông báo
      $pattern = '/Lỗi kết nối dữ liệu|Danh mục không tồn tại hoặc đã bị xóa/';
      if (preg_match($pattern, $message, $matches)) {
         return $matches[0];
      }
      return 'Lỗi không xác định';
   }



   public function destroySubCategory($params)
   {
      $id = $params['id'];
      $method = $_POST['_method'] ?? 'POST';


      try {
         if (!$this->db) {
            throw new Exception('Lỗi kết nối dữ liệu');
         }

         if ($method == 'DELETE') {
            $this->db->update('DanhMucCon', ['isDeleted' => 1], 'idDanhMucCon = ?', [$id]);
            $this->db->clearSingleCache('DanhMucCon');
            $this->session->set('success-modal', 'Xoá danh mục con thành công');
         }       

      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
      }
      Response::redirect('/admin/sub-categories');
   }



}
