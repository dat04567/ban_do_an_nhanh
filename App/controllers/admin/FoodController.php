<?php

namespace App\Controllers\admin;

use App\Controllers\Controller;
use App\Models\FoodModel;
use Exception;
use Framework\ImageProcessor;
use Framework\Response;
use Framework\ValidationException;

class FoodController  extends Controller
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
            throw new Exception('Không thể kết nối dữ liệu');
         }
         $foods = $this->db->select("SELECT 
                                             SP.idSanPham,
                                             SP.tenSanPham AS tenSanPham, 
                                             SP.price AS gia ,
                                             SP.status AS trangThai,
                                             SP.createAt AS ngayTao,
                                             GROUP_CONCAT(HA.duongDan SEPARATOR ';') AS hinhAnh,
                                             DM.tenDanhMuc AS tenDanhMuc
                                             FROM 
                                                SanPham SP
                                             LEFT JOIN 
                                                SanPhamDanhMuc SPDM ON SP.idSanPham = SPDM.idSanPham
                                             LEFT JOIN 
                                                DanhMucCon DMC ON SPDM.idDanhMucCon = DMC.idDanhMucCon
                                             LEFT JOIN 
                                                DanhMuc DM ON DMC.idDanhMuc = DM.idDanhMuc
                                             LEFT JOIN 
                                                HinhAnh HA ON SP.idSanPham = HA.idSanPham
                                             WHERE 
                                                SP.isDeleted = FALSE
                                               AND (HA.isDeleted = FALSE OR HA.isDeleted IS NULL)
                                             GROUP BY    
                                                SP.idSanPham, SP.tenSanPham, DM.tenDanhMuc, SP.price, SP.status;", [], 1000   );

         $foods = array_map(function ($food) {
            $food['hinhAnh'] = explode(';', $food['hinhAnh']);
            return $food;
         }, $foods);

         Response::view('admin/manage-foods', ['foods' => $foods]);
      } catch (Exception $th) {
         inspectAndDie($th->getMessage());
         $this->session->set('error-modal', $th->getMessage());
      }
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

   private function getCommonData()
   {
      $subcategories = $this->db->select('SELECT idDanhMucCon, tenDanhMucCon FROM DanhMucCon WHERE isDeleted = 0', []);
      $ingredients = $this->db->select('SELECT * FROM NguyenLieu WHERE isDeleted = 0', []);
      $stores = $this->db->select('SELECT * FROM CuaHang WHERE isDeleted = 0', []);

      return [
         'subcategories' => $subcategories,
         'ingredients' => $ingredients,
         'stores' => $stores,
      ];
   }
   public function create()
   {
      try {
         if (!$this->db) {
            throw new Exception('Không thể kết nối dữ liệu');
         }
      
         // Remove all images
         $this->removeAllTempImages();
         $this->session->remove('recipe');
         $this->session->set('recipe', []);

         [$subcategories, $ingredients, $stores] = array_values($this->getCommonData());

         $data = [
            'ingredients' => $ingredients,
            'subcategories' => $subcategories,
            'stores' => $stores,
         ];
      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
      }

      Response::view('admin/create-food', $data);
   }

   public function store()
   {


      $nameProduct = $_POST['tenSanPham'] ?? '';
      $isProIng = $_POST['isProIng'] ?? 0;
      $idSubCategories = $_POST['danhMuc'] ?? [];
      $idStores = $_POST['cuaHang'] ?? [];
      $price = $_POST['gia'] ?? 0;
      $status = $_POST['trangThai'] ?? 'Active';


      try {
         if (!$this->db) {
            throw new Exception('Không thể kết nối dữ liệu');
         }

         [$subcategories, $ingredients, $stores] = array_values($this->getCommonData());

         $isProIng = $isProIng == 'on' ? 1 : 0;


         $data = [
            'ingredients' => $ingredients,
            'subcategories' => $subcategories,
            'isProIng' => $isProIng,
            'stores' => $stores,
         ];



         if (!$this->session->has('images')) {
            throw new Exception('Vui lòng chọn hình ảnh');
         }
         $data['images'] = $this->session->get('images');

         // Get product ingredients from JSON input
         $jsonData = file_get_contents('php://input');
         $requestData = json_decode($jsonData, true);
         $productIngredients = $requestData['ingredients'] ?? [];

         if ($isProIng) {
            if (empty($productIngredients)) {
               throw new Exception('Vui lòng chọn công thức nguyên liệu');
            } else {
               $data['productIngredients'] = $productIngredients;
            }
         }

         $foodModel = new FoodModel([
            'tenSanPham' => $nameProduct,
            'gia' => $price,
            'hinhAnh' => $data['images'],
            'danhMuc' => $idSubCategories,
            'cuaHang' => $idStores,
            'status' => $status,
            'productIngredients' => $productIngredients,
         ]);

         if (!$foodModel->validate()) {
            $errors = $foodModel->getErrors();
            throw new ValidationException($errors);
         }

         $foodModel->save();

         $this->session->set('success-modal', 'Thêm sản phẩm thành công');
         $this->session->set('url-redirect', '/admin/foods');

         $this->db->clearSingleCache('SanPham');

         $this->session->remove('images');
         $this->session->remove('recipe');
      } catch (Exception $th) {


         if ($th instanceof ValidationException) {
            $errors = $th->getErrors();
            $data['errors'] = $errors;

            $data = $this->handleValidationErrors($data, $errors, [
               'tenSanPham' => $nameProduct,
               'gia' => $price,
               'danhMuc' => $idSubCategories,
               'cuaHang' => $idStores,
            ]);
         } else {
            $data = $this->handleValidationErrors($data, [], [
               'tenSanPham' => $nameProduct,
               'gia' => $price,
               'danhMuc' => $idSubCategories,
               'cuaHang' => $idStores,
            ]);

            $this->session->set('error-modal', $th->getMessage());
         }
      }

      Response::view('admin/create-food', $data ?? []);
   }



   public function edit()
   {
      echo "Edit Page";
   }

   public function update()
   {
      echo "Update Page";
   }

   public function addIngredientProduct()
   {
      try {
         $data = $this->getRequestData();
         $ingredient = $this->validateIngredient($data);

         $recipe = $this->updateRecipe($ingredient);

         return Response::json([
            'success' => true,
            'data' => $recipe
         ]);
      } catch (Exception $e) {
         return Response::json([
            'error' => $e->getMessage()
         ], 400);
      }
   }

   public function updateIngredientProduct()
   {
      try {
         $data = $this->getRequestData();
         $ingredient = $this->validateIngredient($data);

         $recipe = $this->updateRecipe($ingredient);

         return Response::json([
            'success' => true,
            'data' => $recipe
         ]);
      } catch (Exception $e) {
         return Response::json([
            'error' => $e->getMessage()
         ], 400);
      }
   }
   private function getRequestData()
   {
      if (!empty($_POST)) {
         return $_POST;
      }

      $jsonData = file_get_contents('php://input');
      return json_decode($jsonData, true) ?? [];
   }

   private function validateIngredient($data)
   {
      $idNguyenLieu = $data['idNguyenLieu'] ?? '';
      $soLuong = $data['soLuong'] ?? 1;

      if (empty($idNguyenLieu)) {
         throw new Exception('Missing ingredient ID');
      }

      $ingredient = $this->db->select(
         'SELECT * FROM NguyenLieu WHERE idNguyenLieu = ? AND isDeleted = 0',
         [$idNguyenLieu]
      );

      if (empty($ingredient)) {
         throw new Exception('Invalid ingredient');
      }

      return [
         'id' => $idNguyenLieu,
         'amount' => $soLuong,
         'data' => $ingredient[0]
      ];
   }



   private function updateRecipe($ingredient)
   {
      $recipe = $this->session->get('recipe');

      if (isset($recipe[$ingredient['id']])) {
         $newAmount = $recipe[$ingredient['id']]['soLuong'] + $ingredient['amount'];

         if ($newAmount <= 0) {
            unset($recipe[$ingredient['id']]);
         } else {
            $recipe[$ingredient['id']]['soLuong'] = $newAmount;
         }
      } else {
         $recipe[$ingredient['id']] = [
            'idNguyenLieu' => $ingredient['id'],
            'soLuong' => $ingredient['amount'],
            'giaNguyenLieu' => $ingredient['data']['giaNguyenLieu'],
            'tenNguyenLieu' => $ingredient['data']['tenNguyenLieu']
         ];
      }

      $this->session->set('recipe', $recipe);
      return $recipe;
   }

   public function uploadTempProduct()
   {


      $uploadDir = basePath('/public/assets/images/products');
      try {
         if (!$this->db) {
            throw new Exception('Không thể kết nối dữ liệu');
         }

         $imageProcess = new ImageProcessor($uploadDir);
         $imagePath = $imageProcess->uploadImage($_FILES['file'], true);
         $imageSize = filesize($imagePath);
         $imagePath = str_replace(basePath('/public'), '', $imagePath);

         $fileName  = basename($imagePath);

         // Calculate the size of the uploaded image


         $images = [];
         // save seesion 
         if ($this->session->has('images')) {
            $images = $this->session->get('images');
            $images[] = [
               'fileName' => $fileName,
               'path' => $imagePath,
               'size' => $imageSize
            ];
         } else {
            $images[] = [
               'fileName' => $fileName,
               'path' => $imagePath,
               'size' => $imageSize
            ];
         }

         $this->session->set('images', $images);

         Response::json(['fileName' => $fileName, 'path' => $imagePath, 'size' => $imageSize]);
      } catch (Exception $th) {
         Response::json(['error' => $th->getMessage()], 500);
      }
   }




   public function getAllTempProductIngredients()
   {
      $isCheck = $_GET['isChecked'] ?? false;
      try {
         if (!$this->db) {
            throw new Exception('Không thể kết nối dữ liệu');
         }


         if ($isCheck == 'true') {
            $ingredients = $this->db->select('SELECT * FROM NguyenLieu WHERE isDeleted = 0', [], 100);
            $recipe = $this->session->get('recipe');

            return Response::view('admin/components/foods/choose-ingredients', ['ingredients' => $ingredients, 'productIngredients' => $recipe]);
         }

         return null;
      } catch (Exception $th) {
         Response::json(['error' => $th->getMessage()], 500);
      }
   }

   public function getAllImages()
   {
      if ($this->session->has('images')) {
         $images = $this->session->get('images');
         Response::json($images);
      } else {
         Response::json([]);
      }
   }

   private function removeAllTempImages()
   {

      if ($this->session->has('images')) {
         $images = $this->session->get('images');
         foreach ($images as $image) {
            $this->removeTempImage($image['path']);
         }
         $this->session->remove('images');
      }
   }





   private function removeTempImage($path)
   {
      $imagePath = basePath('/public') . $path;
      if (file_exists($imagePath)) {
         unlink($imagePath);
      }
   }











   public function destroy()
   {
      echo "Destroy Page";
   }
}
