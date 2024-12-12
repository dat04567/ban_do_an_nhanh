<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use App\Models\AddressModel;
use App\Services\CartService;
use Exception;
use Framework\Response;
use Framework\SecurityFilter;
use Framework\ValidationException;

class AddressController extends Controller
{
   private CartService $cartService;

   public function __construct()
   {
      try {
         parent::__construct();
      } catch (Exception $th) {
         //throw $th;
      }
   }

   public function index()
   {
      try {

         if (!$this->db) {
            throw new Exception("Kết nối database thất bại");
         }




         // $user = $this->session->get('user');

         // $idUser = $user['id'] ?? '';  

         // $cart = $this->db->select('SELECT * FROM GioHang WHERE idNguoiDung = ?', [$idUser]);

         // $cartDetail = $this->cartService->getCartDetail($cart[0]['idGioHang']);


         // Response::view('client/checkout', [
         //    'carts' => $cartDetail['cartDetail'],
         //    'totalPrice' => $cartDetail['totalPrice']
         // ]);
      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
      }
   }





   public function show() {}

   public function store()
   {
      $json = file_get_contents('php://input');
      $sensitiveData = SecurityFilter::cleanJson($json);

      try {



         $addressModel = new AddressModel($sensitiveData);

         if (!$addressModel->validate()) {
            throw new ValidationException($addressModel->getErrors());
         }

         $user = $this->session->get('user');
         $userId = $user['id'] ?? '';


         $addressModel->setIdNguoiDung($userId);


         $addressModel->save();


         return Response::json([
            'success' => true,
            'message' => 'Địa chỉ giao hàng đã được thêm'
         ]);
      } catch (Exception $th) {
         if ($th instanceof ValidationException) {
            return Response::json([
               'errors' => $th->getErrors(),
               'suscess' => false
            ], 400);
         } else {
            return Response::json([
               'success' => false,
               'message' => $th->getMessage()
            ], 400);
         }
      }
   }


   public function getShippingAddress()
   {
      try {

         if (!$this->db) {
            throw new Exception("Kết nối database thất bại");
         }


         $user = $this->session->get('user');
         $userId = $user['id'] ?? '';

         $address = $this->db->select('SELECT idDiaChi, hoTen, diaChi1, diaChi2, thanhPho, zipCode, soDienThoai, congTy, macDinh  FROM DiaChiGiaoHang WHERE idNguoiDung = ?', [$userId]);


         return Response::json([
            'success' => true,
            'address' => $address
         ]);
      } catch (Exception $th) {
         return Response::json([
            'success' => false,
            'message' => $th->getMessage()
         ], 400);
      }
   }

   public function update() {}

   public function edit() {}
}
