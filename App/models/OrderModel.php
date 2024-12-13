<?php


namespace App\Models;

use App\Models\BaseModel;
use Exception;
use Framework\Database;

class OrderModel extends BaseModel
{


   protected $idNguoiDung;

   protected $addressId;

   protected $paymentMethod;


   protected $rules = [
      'addressId' => [
         'required',
         'UUID'
      ],
      'paymentMethod' => [
         'required',
         'UUID'
      ]
   ];




   public function validateUUID($attribute, $value): bool
   {
      return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $value);
   }





   public function setIdNguoiDung($idNguoiDung)
   {
      $this->idNguoiDung = $idNguoiDung;
   }

   public function generateUUID()
   {
      return sprintf(
         '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff),
         mt_rand(0, 0x0fff) | 0x4000,
         mt_rand(0, 0x3fff) | 0x8000,
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff),
         mt_rand(0, 0xffff)
      );
   }


   public function save()
   {
      try {
         $db = Database::getInstance();
         $db->beginTransaction();

         // 1. Get cart items with a single optimized query
         $cartItems = $db->select(
            "SELECT 
               cgh.idSanPham,
               cgh.soLuong,
               cgh.idCuaHang,
               sp.price,
               (cgh.soLuong * sp.price) as lineTotal
            FROM GioHang gh 
            INNER JOIN ChiTietGioHang cgh ON gh.idGioHang = cgh.idGioHang 
            INNER JOIN SanPham sp ON sp.idSanPham = cgh.idSanPham 
            WHERE gh.idNguoiDung = ? AND sp.isDeleted = false
            FOR UPDATE", // Lock rows to prevent concurrent modifications
            [$this->idNguoiDung]
         );



         // // 2. Calculate total using SQL SUM for better performance
         $totalAmount = array_sum(array_column($cartItems, 'lineTotal'));



         $orderId = $this->generateUUID();
         // // 3. Create order with minimal fields
         $db->insert('HoaDon', [
            'idHoaDon' => $orderId,
            'tongTien' => $totalAmount,
            'trangThaiHoaDon' => 'Pending',
            'idNguoidung' => $this->idNguoiDung
         ]);



         // // 4. Prepare batch inserts for better performance
         $uniqueStores = [];
         $storeOrderValues = [];

         $cartItems = array_map(function ($item) use ($orderId) {
            return [
               'soLuong' => $item['soLuong'],
               'giaVon' => $item['price'],
               'idSanPham' => $item['idSanPham'],
               'idHoaDon' => $orderId,
               'idCuaHang' => $item['idCuaHang']
            ];
         }, $cartItems);



         // // 5. Batch insert order details
         foreach ($cartItems as $item) {
            $db->insert('ChiTietHoaDon', [
               'soLuong' => $item['soLuong'],
               'giaVon' => $item['giaVon'],
               'idSanPham' => $item['idSanPham'],
               'idHoaDon' => $item['idHoaDon']
            ]);
         }


         // // 6.  insert store orders
         foreach ($cartItems as $item) {
            $storeId = $item['idCuaHang'];
            if (!isset($uniqueStores[$storeId])) {
               $uniqueStores[$storeId] = [
                  'idHoaDon' => $orderId,
                  'idCuaHang' => $storeId,
               ];
            }
         }
         // Convert to values array for insertion
         $storeOrderValues = array_values($uniqueStores);

         // Insert store orders
         foreach ($storeOrderValues as $storeOrder) {
            $db->insert('HoaDonCuaHang', [
               'idHoaDon' => $storeOrder['idHoaDon'],
               'idCuaHang' => $storeOrder['idCuaHang']
            ]);
         }



         // // 7. Add payment method
         $db->insert('PhuongThucHoaDon', [
            'idPhuongThuc' => $this->paymentMethod,
            'idHoaDon' => $orderId
         ]);

         // // 8. insert shipping address 
         $db->insert('DiaChiHoaDon', [
            'idHoaDon' => $orderId,
            'idDiaChi' => $this->addressId,
         ]);


         // After creating the order, create the payment record
         $db->insert('Payment', [
            'idHoaDon' => $orderId,
            'tongTienThanhToan' => $totalAmount,
            'trangThai' => 'Pending',
            'idPhuongThuc' => $this->paymentMethod,
            'notes' => 'Tạo thanh toán khi đặt hàng'
         ]);

         // If payment method is COD, mark payment as completed
         if ($this->getPaymentMethodName($this->paymentMethod) === 'COD') {
            $db->update('Payment', [
               'trangThai' => 'Completed'
            ], 'idHoaDon = ?',  [$orderId]);
         }


         // Update product inventory
         foreach ($cartItems as $item) {
            // Get current stock
            $currentStock = $db->select(
               "SELECT soLuongTonKho FROM KhoSanPham 
                WHERE idSanPham = ? AND idCuaHang = ? 
                FOR UPDATE",
               [$item['idSanPham'], $item['idCuaHang']]
            )[0]['soLuongTonKho'] ?? 0;

            // Calculate new stock
            $newStock = $currentStock - $item['soLuong'];

            // Update stock
            $db->update(
               'KhoSanPham',
               ['soLuongTonKho' => $newStock],
               'idSanPham = ? AND idCuaHang = ?',
               [$item['idSanPham'], $item['idCuaHang']]
            );
         }


         // // 9. Delete cart items
         $cartId = $db->select(
            "SELECT idGioHang FROM GioHang WHERE idNguoiDung = ?",
            [$this->idNguoiDung]
         )[0]['idGioHang'] ?? null;

         // Delete cart items first
         $db->query('DELETE FROM ChiTietGioHang WHERE idGioHang = ?', [$cartId]);
         // Then delete the cart
         $db->query('DELETE FROM GioHang WHERE idGioHang = ?', [$cartId]);

         $db->commit();
         return $orderId;
      } catch (Exception $th) {
         $db->rollBack();
         throw $th;
      }
   }

   private function getPaymentMethodName($paymentMethodId)
   {
      $db = Database::getInstance();
      $method = $db->select(
         "SELECT tenPhuongThuc FROM PhuongThucThanhToan WHERE idPhuongThuc = ?",
         [$paymentMethodId]
      );
      return $method[0]['tenPhuongThuc'] ?? null;
   }

   public function getErrorMessages(): array
   {
      return [
         'addressId.required' => 'Vui lòng chọn địa chỉ giao hàng',
         'addressId.UUID' => 'Địa chỉ giao hàng không hợp lệ',
         'paymentMethod.required' => 'Vui lòng chọn phương thức thanh toán',
         'paymentMethod.UUID' => 'Phương thức thanh toán không hợp lệ'
      ];
   }
}
