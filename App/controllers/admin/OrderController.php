<?php

namespace App\Controllers\admin;

use App\Controllers\Controller;
use Exception;
use Framework\Response;

class OrderController  extends Controller {

   public function index() {

      try {
         if (!$this->db) {
            throw new Exception("Kết nối database thất bại");
         }

         $orders = $this->db->select('SELECT 
                                          h.idHoaDon AS maDonHang,
                                          JSON_ARRAYAGG(ha.duongDan) AS hinhAnh,
                                          s.tenSanPham AS tenSanPham,
                                          nd.firstName AS hoKhachHang,
                                          nd.lastName AS tenKhachHang,
                                          h.ngayTaoHoaDon AS ngayGio,
                                          pt.tenPhuongThuc AS phuongThucThanhToan,
                                          h.trangThaiHoaDon AS trangThai,
                                          h.tongTien AS soTien
                                          FROM 
                                             HoaDon h
                                          LEFT JOIN 
                                             ChiTietHoaDon chiTietDonHang ON h.idHoaDon = chiTietDonHang.idHoaDon
                                          LEFT JOIN 
                                             SanPham s ON chiTietDonHang.idSanPham = s.idSanPham
                                          LEFT JOIN 
                                             NguoiDung nd ON h.idNguoidung = nd.id
                                          LEFT JOIN 
                                             PhuongThucHoaDon phuongThucDonHang ON h.idHoaDon = phuongThucDonHang.idHoaDon
                                          LEFT JOIN 
                                             PhuongThucThanhToan pt ON phuongThucDonHang.idPhuongThuc = pt.idPhuongThuc
                                          LEFT JOIN 
                                             HinhAnh ha ON s.idSanPham = ha.idSanPham
                                          WHERE 
                                             h.isDeleted = FALSE
                                          GROUP BY 
                                             h.idHoaDon, s.tenSanPham, nd.firstName, nd.lastName, 
                                             h.ngayTaoHoaDon, pt.tenPhuongThuc, h.trangThaiHoaDon, h.tongTien;', [],);
         $orders = array_map(function($order) {
            $order['hinhAnh'] = json_decode($order['hinhAnh']);
            return $order;
         }, $orders);

         Response::view('admin/manage-orders', [
            'orders' => $orders
         ]);
      } catch (Exception $th) {
         $this->session->set('error-modal', $th->getMessage());   
      }
     
   }


   public function showListFoods() {

   }

   public function show() {
      echo "Show Page";
   }

   public function showId($argments ) {
      inspect($argments);
      // echo "Show Page with ID: $id";
   }

   public function create() {

      echo "Create Page";
   }

   public function store() {
      echo "Store Page";
   }

   public function edit() {
      echo "Edit Page";
   }

   public function update() {
      echo "Update Page";
   }

   public function destroy() {
      echo "Destroy Page";
   }

}