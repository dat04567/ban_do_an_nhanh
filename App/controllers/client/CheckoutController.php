<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use App\Services\CartService;
use Exception;
use Framework\Response;

class CheckoutController extends Controller
{
   private CartService $cartService;

   public function __construct()
   {
      try {
         parent::__construct();
         $this->cartService = new CartService();
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

         $user = $this->session->get('user');
     
         $idUser = $user['id'] ?? '';  

         $cart = $this->db->select('SELECT * FROM GioHang WHERE idNguoiDung = ?', [$idUser]);

         $cartDetail = $this->cartService->getCartDetail($cart[0]['idGioHang']);

         $addresses = $this->db->select('SELECT * FROM DiaChiGiaoHang WHERE idNguoiDung = ? AND isDeleted = 0', [$idUser]);



         Response::view('client/checkout', [
            'carts' => $cartDetail['cartDetail'],
            'totalPrice' => $cartDetail['totalPrice'],
            'addresses' => $addresses
         ]);
      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
         Response::redirect('/cart');
      }

      
   }

   public function processCheckout()
   {
      try {
         if (!$this->db) {
            throw new Exception("Kết nối database thất bại");
         }

         $this->db->beginTransaction();

         // Validate đầu vào
         $address = $_POST['address'] ?? '';
         $phone = $_POST['phone'] ?? '';
         $paymentMethod = $_POST['paymentMethod'] ?? '';

         if (!$address || !$phone || !$paymentMethod) {
            throw new Exception("Vui lòng điền đầy đủ thông tin");
         }

         // Xử lý đặt hàng và thanh toán
         // TODO: Implement order processing logic here

         $this->db->commit();
         $this->session->set('success-modal', 'Đặt hàng thành công');
         Response::redirect('/orders');
      } catch (Exception $th) {
         $this->db->rollBack();
         $this->session->set('error-modal', $th->getMessage());
         Response::redirect('/checkout');
      }
   }



   public function show() {}

   public function store() {}

   public function update() {}

   public function edit() {}
}
