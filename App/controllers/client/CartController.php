<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use App\Services\CartService;
use Exception;
use Framework\Response;

class CartController  extends Controller
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

         if (empty($cart)) {
            $cartDetail = [
               'count' => 0,
               'cartDetail' => [],
               'totalPrice' => 0
            ];
         } else {
            $idCart = $cart[0]['idGioHang'] ?? '';
            $cartDetail = $this->cartService->getCartDetail($idCart);
            
         }
 
      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
      }
      Response::view('client/cart', ['carts' => $cartDetail['cartDetail'], 'totalPrice' => $cartDetail['totalPrice']]);
   }


   private function validateStock($idProduct, $quantity, $idStore)
   {
      $stock = $this->db->select(
         'SELECT * From KhoSanPham WHERE idSanPham = ? AND idCuaHang = ?',
         [$idProduct, $idStore]
      );


      if (empty($stock) || $stock[0]['soLuongTonKho'] < $quantity) {
         throw new Exception("Số lượng trong kho không đủ");
      }

      return $stock[0]['soLuongTonKho'];
   }


   public function addToCart()
   {
      try {
         $idProduct = $_POST['idSanPham'] ?? '';
         $idStore = $_POST['idCuaHang'] ?? '';
         $quantity = 1;

         if (!$this->db) throw new Exception("Kết nối database thất bại");


         $this->db->beginTransaction();

         // Validate stock
         $currentStock = $this->validateStock($idProduct, $quantity, $idStore);

         $user = $this->session->get('user');
         $cart = $this->db->select('SELECT * FROM GioHang WHERE idNguoiDung = ?', [$user['id']]);

         if (empty($cart)) {
            $this->db->insert('GioHang', ['idNguoiDung' => $user['id']]);
            $cart = $this->db->select('SELECT * FROM GioHang WHERE idNguoiDung = ?', [$user['id']]);
         }

         $existingItem = $this->db->select(
            'SELECT soLuong FROM ChiTietGioHang WHERE idGioHang = ? AND idSanPham = ? AND idCuaHang = ?',
            [$cart[0]['idGioHang'], $idProduct, $idStore]
         );
      

         if (!empty($existingItem)) {
            $newQuantity = $existingItem[0]['soLuong'] + $quantity;
            if ($newQuantity > $currentStock) {
               throw new Exception("Vượt quá số lượng tồn kho");
            }

            $this->db->query(
               'UPDATE ChiTietGioHang SET soLuong = ? WHERE idGioHang = ? AND idSanPham = ?',
               [$newQuantity, $cart[0]['idGioHang'], $idProduct]
            );
         } else {
            $this->db->insert('ChiTietGioHang', [
               'idGioHang' => $cart[0]['idGioHang'],
               'idSanPham' => $idProduct,
               'idCuaHang' => $idStore,
               'soLuong' => $quantity
            ]);
         }

         $this->db->commit();
         return Response::json(['success' => true, 'message' => 'Thêm vào giỏ hàng thành công']);
      } catch (Exception $e) {
         $this->db->rollBack();
         return Response::json(['success' => false, 'error' => $e->getMessage()], 400);
      }
   }

   public function updateCartQuantity()
   {
      try {
         $idProduct = $_POST['idSanPham'] ?? '';
         $quantity = $_POST['soLuong'] ?? 0;
         $idStore = $_POST['idCuaHang'] ?? '';

         if (!$this->db) throw new Exception("Kết nối database thất bại");



         $this->db->beginTransaction();


         // Validate stock
         $this->validateStock($idProduct, $quantity, $idStore);

         $user = $this->session->get('user');
         $cart = $this->db->select('SELECT * FROM GioHang WHERE idNguoiDung = ?', [$user['id']]);

         if (empty($cart)) {
            throw new Exception("Không tìm thấy giỏ hàng");
         }  

         if ($quantity <= 0) {
            $this->db->query(
               'DELETE FROM ChiTietGioHang WHERE idGioHang = ? AND idSanPham = ?',
               [$cart[0]['idGioHang'], $idProduct]
            );
         } else {
            $this->db->query(
               'UPDATE ChiTietGioHang SET soLuong = ? WHERE idGioHang = ? AND idSanPham = ?',
              [$quantity, $cart[0]['idGioHang'], $idProduct]
            );
         }

         $this->db->commit();
         return Response::json(['success' => true, 'message' => 'Cập nhật số lượng thành công']);
      } catch (Exception $e) {
         $this->db->rollBack();
         return Response::json(['success' => false, 'error' => $e->getMessage()], 400);
      }
   }



   public function getCartInfo()
   {
      try {
         if (!$this->db) {
            throw new Exception("Kết nối database thất bại");
         }

         if (!$this->session->has('user')) {
            return Response::json([
               'success' => true,
               'data' => [
                  'count' => 0,
                  'cartDetail' => [],
                  'totalPrice' => 0
               ]
            ]);
         }


         $user = $this->session->get('user');


         $idUser = $user['id'] ?? '';
         $cart = $this->db->select('SELECT * FROM GioHang WHERE idNguoiDung = ?', [$idUser]);

         if (empty($cart)) {
            return Response::json([
               'success' => true,
               'data' => [
                  'count' => 0,
                  'cartDetail' => [],
                  'totalPrice' => 0
               ]
            ]);
         }

         $idCart = $cart[0]['idGioHang'] ?? '';

         $cartDetail = $this->cartService->getCartDetail($idCart);

         

         Response::json([
            'success' => true,
            'data' => $cartDetail
         ]);
      } catch (Exception $e) {
         return Response::json([
            'success' => false,
            'error' => $e->getMessage()
         ], 500);
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

      echo "Create Page";
   }

   public function store()
   {
      echo "Store Page";
   }

   public function edit()
   {
      echo "Edit Page";
   }

   public function update()
   {
      echo "Update Page";
   }

   public function destroy()
   {
      echo "Destroy Page";
   }
}
