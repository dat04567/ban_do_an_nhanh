<?php

namespace App\Controllers\admin;

use App\Controllers\Controller;
use App\Models\StoreModel;
use Exception;
use Framework\Response;
use Framework\ValidationException;

class StoreController extends Controller
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
            default:
               $whereCondition = 'isDeleted=FALSE';
               break;
         }


         $stores = $this->db->select(' SELECT  * FROM CuaHang WHERE ' . $whereCondition, [], 100);
      } catch (Exception $e) {
         $this->session->set('error-modal', $e->getMessage());
      }

      Response::view('admin/manage-stores', ["stores" => $stores ?? []]);
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
      Response::view('admin/create-store');
   }




   public function store()
   {

      try {
         $storeObject = new  StoreModel($_POST);

         if (!$storeObject->validate()) {
            throw new ValidationException($storeObject->getErrors());
         }

         $storeObject->save();

         $this->session->set('success-modal', 'Tạo cửa hàng thành công');

         Response::redirect('/admin/stores');
      } catch (Exception $th) {
         if ($th instanceof ValidationException) {
            return Response::view('admin/create-store', ['errors' => $th->getErrors()]);
         } else {
            $this->session->set('error-modal', 'Lỗi thể gửi vì không thể kết nối dữ liệu');
            return Response::view('admin/create-store');
         }
      }
   }

   public function destroy($params)
   {
      $id  = $params['id'];
      $method = $_POST['_method'] ?? 'POST';



      try {

         if (!$this->db) {
            throw new Exception('Không thể thể xoá cửa hàng');
         }

         if ($method == 'DELETE') {
            $this->db->query('CALL XoaCuaHang(?)', [$id]);
            $this->db->clearSingleCache('CuaHang');
            $this->db->clearSingleCache('KhoNguyenLieu');
            $this->session->set('success-modal', 'Xóa cửa hàng thành công');
         }

      } catch (Exception $e) {
         $errorMessage = $this->extractErrorMessage($e->getMessage());
         $this->session->set('error-modal', $errorMessage);
      }
      Response::redirect('/admin/stores');
   }


   private function extractErrorMessage($message)
   {
      // Tìm vị trí của thông báo lỗi cụ thể trong chuỗi thông báo
      $pattern = '/Lỗi kết nối dữ liệu|Không thể xóa cửa hàng có hóa đơn đang xử lý hoặc hoàn thành trong 30 ngày gần đây|Không thể xóa cửa hàng còn hàng tồn trong kho/';
      if (preg_match($pattern, $message, $matches)) {
         return $matches[0];
      }
      return 'Lỗi không xác định';
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
