<?php

namespace App\Controllers\client;

use App\Controllers\Controller;
use App\Models\OrderModel;
use App\Services\CartService;
use Exception;
use Framework\Response;
use Framework\SecurityFilter;
use Framework\ValidationException;


class OrderController extends Controller
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




         $orders = $this->db->select(' SELECT 
                                             sp.tenSanPham AS sanPham, 
                                             hd.idHoaDon AS maDonHang, 
                                             hd.ngayTaoHoaDon AS ngayDat, 
                                             cthd.soLuong AS soLuong, 
                                             hd.trangThaiHoaDon AS trangThai, 
                                             hd.tongTien AS tongTien,
                                             (
                                                SELECT JSON_ARRAYAGG(ha.duongDan)
                                                FROM HinhAnh ha
                                                WHERE ha.idSanPham = sp.idSanPham AND ha.isDeleted = FALSE
                                             ) AS hinhAnh
                                             FROM 
                                                HoaDon hd 
                                             JOIN 
                                                ChiTietHoaDon cthd ON hd.idHoaDon = cthd.idHoaDon 
                                             JOIN 
                                                SanPham sp ON cthd.idSanPham = sp.idSanPham 
                                             WHERE 
                                                hd.idNguoidung = ? 
                                             ORDER BY 
                                                hd.ngayTaoHoaDon DESC', [$idUser]);
         $orders = array_map(function ($order) {
            $order['hinhAnh'] = json_decode($order['hinhAnh']);
            return $order;
         }, $orders);

         Response::view('client/order', ['orders' => $orders]);
      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());
      }
   }





   public function show() {}

   public function store()
   {
      $json = file_get_contents('php://input');
      
      $data = json_decode($json, true);


     
      try {

         if (!$this->db) {
            throw new Exception("Kết nối database thất bại");
         }

         $orderModel = new OrderModel($data);



         if (!$orderModel->validate()) {
            throw new ValidationException($orderModel->getErrors());
         }

         $user = $this->session->get('user');
         $userId = $user['id'] ?? '';


         $orderModel->setIdNguoiDung($userId);

         $orderModel->save();


         return Response::json([
            'message' => 'Order successfully',
            'success' => true
         ]);
      } catch (Exception $th) {
         if ($th instanceof ValidationException) {
            return Response::json([
               'message' => $th->getErrors(),
               'success' => false
            ], 400);
         }
         return Response::json([
            'message' => $th->getMessage(),
            'success' => false
         ]);
      }
   }

   public function update() {}

   public function edit() {}
}
