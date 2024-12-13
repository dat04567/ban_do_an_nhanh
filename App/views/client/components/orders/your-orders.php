<div class="col-lg-9 col-md-8 col-12">
   <div class="py-6 p-md-6 p-lg-10">
      <!-- heading -->
      <h2 class="mb-6">Đơn Hàng Của Bạn</h2>

      <div class="table-responsive-xxl border-0">
         <!-- Table -->
         <table class="table mb-0 text-nowrap table-centered">
            <!-- Table Head -->
            <thead class="bg-light">
               <tr>
                  <th>&nbsp;</th>
                  <th>Sản Phẩm</th>
                  <th>Mã Đơn Hàng</th>
                  <th>Ngày Đặt</th>
                  <th>Số Lượng</th>
                  <th>Trạng Thái</th>
                  <th>Tổng Tiền</th>

                  <th></th>
               </tr>
            </thead>
            <tbody>
               <!-- Table body -->

               <?php if (isset($orders) && count($orders) > 0) : ?>
                  <?php foreach ($orders as $order) : ?>
                     <tr>
                        <td class="align-middle border-top-0 w-0">
                           <a href="#"><img src="<?= $order['hinhAnh'][0] ?>" alt="<?= $order['sanPham']; ?>" class="icon-shape icon-xl" /></a>
                        </td>
                        <td class="align-middle border-top-0">
                           <a href="#" class="fw-semibold text-inherit">
                              <h6 class="mb-0"><?= $order['sanPham']; ?></h6>
                           </a>
                           <!-- If there's product size or details -->
                           <span><small class="text-muted"><?= $order['productSize'] ?? ''; ?></small></span>
                        </td>
                        <td class="align-middle border-top-0 text-ellipsis">
                           <a href="#" class="text-inherit "><?= $order['maDonHang']; ?></a>
                        </td>
                        <td class="align-middle border-top-0"><?= date('d \T\h\á\n\g m, Y', strtotime($order['ngayDat'])); ?></td>
                        <td class="align-middle border-top-0"><?= $order['soLuong']; ?></td>
                        <td class="align-middle border-top-0">
                           <?php
                           switch ($order['trangThai']) {
                              case 'Pending':
                                 $badgeClass = 'bg-warning';
                                 break;
                              case 'Completed':
                                 $badgeClass = 'bg-success';
                                 break;
                              default:
                                 $badgeClass = 'bg-danger';
                                 break;
                           }
                           ?>
                           <span class="badge <?= $badgeClass; ?>"><?= $order['trangThai']; ?></span>
                        </td>
                        <td class="align-middle border-top-0"><?= number_format($order['tongTien'], 0, ',', '.') . ' đ'; ?></td>
                        <td class="text-muted align-middle border-top-0">
                           <a href="#" class="text-inherit" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="feather-icon icon-eye"></i></a>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               <?php else : ?>
                  <tr>
                     <td colspan="8" class="text-center">Không có đơn hàng nào</td>
                  </tr>
               <?php endif; ?>
            
            </tbody>
         </table>
      </div>
   </div>
</div>