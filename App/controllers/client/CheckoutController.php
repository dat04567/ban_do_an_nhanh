<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use App\Services\CartService;
use Exception;
use Framework\Response;
use Framework\SecurityFilter;

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

         $paymentMethods = $this->db->select('SELECT * FROM PhuongThucThanhToan WHERE isDeleted = 0');


          $paymentMethods = array_column($paymentMethods, 'idPhuongThuc', 'tenPhuongThuc');



         Response::view('client/checkout', [
            'carts' => $cartDetail['cartDetail'],
            'totalPrice' => $cartDetail['totalPrice'],
            'addresses' => $addresses,
            'paymentMethods' => $paymentMethods

         ]);
      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
         Response::redirect('/cart');
      }

      
   }


   


   public function show() {
      
   }

   public function store() {
      $json = file_get_contents('php://input');
      $data  = SecurityFilter::cleanJson($json);

      inspectAndDie($data);
      
   }

   public function update() {}

   public function edit() {}
}
