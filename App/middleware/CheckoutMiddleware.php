<?php

namespace App\middleware;

use App\Services\CartService;
use Exception;
use Framework\Database;
use Framework\MiddlewareInterface;
use Framework\SessionManager;

class CheckoutMiddleware implements MiddlewareInterface
{


   private CartService $cartService;
   private Database $db;

   public function __construct()
   {
      $this->cartService = new CartService();
      $this->db = Database::getInstance();
   }
   public function handle($request, $next)
   {

      try {
         $session = SessionManager::getInstance();
         $user = $session->get('user');
         $idUser = $user['id'];
         $cart = $this->db->select('SELECT * FROM GioHang WHERE idNguoiDung = ?', [$idUser]);


         if (empty($cart)) {
            $count = 0;
         } else {
            $idCart = $cart[0]['idGioHang'];
            $cartService = $this->cartService->getCartDetail($idCart);
            $count = $cartService['count'];
         }

         if ($count === 0) {
            header('Location: /cart');
            exit;
         }

         return $next($request);
      } catch (Exception $th) {
         $session->set('error-modal', $th->getMessage());
         header('Location: /cart');
         exit;
      }
   }
}
