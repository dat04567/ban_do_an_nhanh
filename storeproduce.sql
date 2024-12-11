
INSERT INTO CuaHang (idCuaHang, storeName, email, isDeleted, deletedAt, tongDoanhThu, loiNhuan) 
VALUES
(UUID(), 'Gà Rán KFC Express', 'kfcexpress@example.com', false, NULL, 450000000.00, 135000000.00),
(UUID(), 'Burger House', 'burgerhouse@example.com', false, NULL, 380000000.00, 114000000.00),
(UUID(), 'Pizza Express 24h', 'pizza24h@example.com', false, NULL, 420000000.00, 126000000.00),
(UUID(), 'Cơm Gà Taiwan', 'comgataiwan@example.com', false, NULL, 280000000.00, 84000000.00),
(UUID(), 'Mì Cay Seoul', 'micayseoul@example.com', false, NULL, 350000000.00, 105000000.00),
(UUID(), 'Sushi Express', 'sushiexpress@example.com', true, '2024-02-20 14:30:00', 180000000.00, 54000000.00),
(UUID(), 'Bánh Mì Thịt Nướng 24/7', 'banhmi247@example.com', false, NULL, 220000000.00, 66000000.00),
(UUID(), 'Hot Dog & Chips', 'hotdogchips@example.com', false, NULL, 195000000.00, 58500000.00),
(UUID(), 'Cơm Văn Phòng Express', 'comvanphong@example.com', false, NULL, 320000000.00, 96000000.00),
(UUID(), 'Đồ Ăn Đêm 247', 'doandem247@example.com', false, NULL, 280000000.00, 84000000.00);


-- triggers 

DELIMITER //

-- Trigger khi INSERT dữ liệu mới
CREATE TRIGGER before_insert_kho
BEFORE INSERT ON KhoNguyenLieu
FOR EACH ROW
BEGIN
    SET NEW.trangThai = CASE
        WHEN NEW.soLuongTonKho = 0 THEN 'Hết hàng'
        WHEN NEW.soLuongTonKho <= 10 THEN 'Sắp hết hàng'
        ELSE 'Còn hàng'
    END;
END//

-- Trigger khi UPDATE dữ liệu
CREATE TRIGGER before_update_kho
BEFORE UPDATE ON KhoNguyenLieu
FOR EACH ROW
BEGIN
    SET NEW.trangThai = CASE
        WHEN NEW.soLuongTonKho = 0 THEN 'Hết hàng'
        WHEN NEW.soLuongTonKho <= 10 THEN 'Sắp hết hàng'
        ELSE 'Còn hàng'
    END;
END//

DELIMITER 



-- store produce
DELIMITER //

CREATE PROCEDURE ThemNguyenLieu(
    IN p_tenNguyenLieu VARCHAR(100),
    IN p_donVi VARCHAR(100),
    IN p_giaNguyenLieu DECIMAL(20, 2)
)
BEGIN
    DECLARE v_idNguyenLieu CHAR(36);
    DECLARE done INT DEFAULT FALSE;
    DECLARE v_idCuaHang CHAR(36);
    DECLARE cur_cuahang CURSOR FOR 
        SELECT idCuaHang 
        FROM CuaHang 
        WHERE isDeleted = FALSE;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    
    -- Kiểm tra tên nguyên liệu đã tồn tại chưa
    IF EXISTS (SELECT 1 FROM NguyenLieu WHERE tenNguyenLieu = p_tenNguyenLieu AND isDeleted = FALSE) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tên nguyên liệu đã tồn tại';
    END IF;

    START TRANSACTION;
    
    -- Tạo UUID mới cho nguyên liệu
    SET v_idNguyenLieu = UUID();
    
    -- Thêm vào bảng NguyenLieu
    INSERT INTO NguyenLieu (
        idNguyenLieu,
        tenNguyenLieu,
        donVi,
        giaNguyenLieu,
        isDeleted
    ) VALUES (
        v_idNguyenLieu,
        p_tenNguyenLieu,
        p_donVi,
        p_giaNguyenLieu,
        FALSE
    );
    
    -- Thêm vào KhoNguyenLieu cho tất cả các cửa hàng
    OPEN cur_cuahang;
    
    read_loop: LOOP
        FETCH cur_cuahang INTO v_idCuaHang;
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        INSERT INTO KhoNguyenLieu (
            idNguyenLieu,
            idCuaHang,
            soLuongTonKho
        ) VALUES (
            v_idNguyenLieu,
            v_idCuaHang,
            0
        );
    END LOOP;
    
    CLOSE cur_cuahang;
    
    COMMIT;
    
    
	SELECT 'Thêm nguyên liệu thành công' as message;
    
END //

DELIMITER 






DELIMITER //

CREATE PROCEDURE XoaNguyenLieu(IN p_idNguyenLieu CHAR(36))
BEGIN
    -- Kiểm tra nguyên liệu có tồn tại không
    IF NOT EXISTS (SELECT 1 FROM NguyenLieu WHERE idNguyenLieu = p_idNguyenLieu AND isDeleted = FALSE) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Nguyên liệu không tồn tại hoặc đã bị xóa';
    END IF;
    
    -- Kiểm tra nguyên liệu có đang được sử dụng trong sản phẩm đang bán không
    IF EXISTS (
        SELECT 1 
        FROM SanPhamNguyenLieu spnl
        JOIN SanPham sp ON sp.idSanPham = spnl.idSanPham
        JOIN KhoSanPham ksp ON ksp.idSanPham = sp.idSanPham
        WHERE spnl.idNguyenLieu = p_idNguyenLieu
        AND sp.isDeleted = FALSE
        AND sp.status = 'Active'
        AND ksp.isDeleted = FALSE
        AND ksp.soLuongTonKho > 0
    ) THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Không thể xóa nguyên liệu đang được sử dụng trong sản phẩm đang bán';
    END IF;

    -- Kiểm tra còn tồn kho không
    IF EXISTS (
        SELECT 1 
        FROM KhoNguyenLieu 
        WHERE idNguyenLieu = p_idNguyenLieu 
        AND soLuongTonKho > 0
        AND isDeleted = FALSE
    ) THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Không thể xóa nguyên liệu còn tồn kho';
    END IF;

    START TRANSACTION;
    
    -- 1. Soft delete trong bảng NguyenLieu
    UPDATE NguyenLieu
    SET isDeleted = TRUE,
        deletedAt = CURRENT_TIMESTAMP
    WHERE idNguyenLieu = p_idNguyenLieu;
    
    -- 2. Soft delete trong bảng SanPhamNguyenLieu 
    -- (công thức cũ sẽ được lưu lại nhưng đánh dấu là đã xóa)
    UPDATE SanPhamNguyenLieu
    SET isDeleted = TRUE,
        deletedAt = CURRENT_TIMESTAMP
    WHERE idNguyenLieu = p_idNguyenLieu
    AND isDeleted = FALSE;
    
    -- 3. Soft delete trong bảng KhoNguyenLieu
    UPDATE KhoNguyenLieu
    SET isDeleted = TRUE,
        deletedAt = CURRENT_TIMESTAMP,
        trangThai = 'Hết hàng',
        soLuongTonKho = 0
    WHERE idNguyenLieu = p_idNguyenLieu
    AND isDeleted = FALSE;
    
    COMMIT;
    
    SELECT 'Xóa nguyên liệu thành công' as message;
END //

DELIMITER 






-- xoá cửa hàng 

DELIMITER //

CREATE PROCEDURE XoaCuaHang(
    IN p_idCuaHang CHAR(36)
)
BEGIN
    DECLARE v_hoaDonCount INT;
    DECLARE v_nhanVienCount INT;
    DECLARE v_khoSanPhamCount INT;
    DECLARE v_khoNguyenLieuCount INT;
    

    -- Kiểm tra cửa hàng có tồn tại không
    IF NOT EXISTS (SELECT 1 FROM CuaHang WHERE idCuaHang = p_idCuaHang AND isDeleted = FALSE) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cửa hàng không tồn tại hoặc đã bị xóa';
    END IF;

    -- Kiểm tra có hóa đơn đang xử lý không
    SELECT COUNT(*) INTO v_hoaDonCount
    FROM HoaDonCuaHang hdc
    JOIN HoaDon hd ON hdc.idHoaDon = hd.idHoaDon
    WHERE hdc.idCuaHang = p_idCuaHang 
    AND hd.isDeleted = FALSE
    AND (
        hd.trangThaiHoaDon = 'Pending' 
        OR hd.trangThaiHoaDon = 'Processing'
        OR (hd.trangThaiHoaDon = 'Completed' AND hd.ngayTaoHoaDon >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY))
    );

    IF v_hoaDonCount > 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Không thể xóa cửa hàng có hóa đơn đang xử lý hoặc hoàn thành trong 30 ngày gần đây';
    END IF;

    -- Kiểm tra số lượng trong kho
    SELECT COUNT(*) INTO v_khoSanPhamCount
    FROM KhoSanPham
    WHERE idCuaHang = p_idCuaHang 
    AND isDeleted = FALSE 
    AND soLuongTonKho > 0;

    SELECT COUNT(*) INTO v_khoNguyenLieuCount
    FROM KhoNguyenLieu
    WHERE idCuaHang = p_idCuaHang 
    AND isDeleted = FALSE 
    AND soLuongTonKho > 0;

    IF v_khoSanPhamCount > 0 OR v_khoNguyenLieuCount > 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Không thể xóa cửa hàng còn hàng tồn trong kho';
    END IF;

    -- Kiểm tra nhân viên đang làm việc
    SELECT COUNT(*) INTO v_nhanVienCount
    FROM NhanVien
    WHERE idCuaHang = p_idCuaHang 
    AND isDeleted = FALSE 
    AND trangThai = 'Hoạt động';

    IF v_nhanVienCount > 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Vui lòng cập nhật trạng thái của tất cả nhân viên trước khi xóa cửa hàng';
    END IF;

    START TRANSACTION;

    -- 1. Đánh dấu xóa trong KhoSanPham
    UPDATE KhoSanPham 
    SET isDeleted = TRUE,
        deletedAt = CURRENT_TIMESTAMP
    WHERE idCuaHang = p_idCuaHang
    AND isDeleted = FALSE;

    -- 2. Đánh dấu xóa trong KhoNguyenLieu
    UPDATE KhoNguyenLieu
    SET isDeleted = TRUE,
        deletedAt = CURRENT_TIMESTAMP
    WHERE idCuaHang = p_idCuaHang
    AND isDeleted = FALSE;

    -- 3. Cập nhật trạng thái nhân viên
    UPDATE NhanVien
    SET isDeleted = TRUE,
		trangThai = 'Đã nghỉ việc',
		deletedAt = CURRENT_TIMESTAMP
    WHERE idCuaHang = p_idCuaHang;


    -- 4. Đánh dấu xóa trong HoaDonCuaHang
    UPDATE HoaDonCuaHang
    SET isDeleted = TRUE,
        deletedAt = CURRENT_TIMESTAMP
    WHERE idCuaHang = p_idCuaHang
    AND isDeleted = FALSE;

    -- 5. Đánh dấu xóa cửa hàng
    UPDATE CuaHang
    SET isDeleted = TRUE,
        deletedAt = CURRENT_TIMESTAMP
    WHERE idCuaHang = p_idCuaHang;

    COMMIT;
    
    SELECT 'Xóa cửa hàng thành công' as message;

END //

DELIMITER 



DELIMITER //

CREATE PROCEDURE XoaNhanVien(
    IN p_idNhanVien CHAR(36)
)
BEGIN
    DECLARE v_idNguoiDung CHAR(36);
    DECLARE v_count INT;
 
    -- Kiểm tra nhân viên tồn tại
	SELECT idNguoiDung INTO v_idNguoiDung
    FROM NhanVien 
    WHERE idNhanVien = p_idNhanVien AND isDeleted = false;

    IF v_idNguoiDung IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Nhân viên không tồn tại hoặc đã bị xóa';
    END IF;

    START TRANSACTION;

    -- 1. Bảng nên soft delete:

    -- Soft delete nhân viên
    UPDATE NhanVien 
    SET isDeleted = true,
        deletedAt = CURRENT_TIMESTAMP,
        trangThai = 'Đã nghỉ việc'
    WHERE idNhanVien = p_idNhanVien;

    -- Soft delete tài khoản người dùng
    UPDATE NguoiDung 
    SET isDeleted = true,
        deletedAt = CURRENT_TIMESTAMP
    WHERE id = v_idNguoiDung;

    -- Soft delete lịch làm việc trong tương lai
    UPDATE LichLamViec
    SET isDeleted = true,
        deletedAt = CURRENT_TIMESTAMP
    WHERE idNhanVien = p_idNhanVien
    AND ngayLamViec > CURRENT_DATE;
    
    COMMIT;
    
    SELECT 'Xóa nhân viên thành công' as message;
END //

DELIMITER ;



DELIMITER //

CREATE PROCEDURE XoaDanhMuc(
    IN p_idDanhMuc CHAR(36)
)
BEGIN
    DECLARE v_category_exists INT;

    -- Kiểm tra danh mục tồn tại và chưa bị xóa
    SELECT COUNT(*) INTO v_category_exists 
    FROM DanhMuc 
    WHERE idDanhMuc = p_idDanhMuc AND isDeleted = FALSE;

    -- Xử lý với các điều kiện kiểm tra
    IF v_category_exists = 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Danh mục không tồn tại hoặc đã bị xóa';
    END IF;

    -- Bắt đầu transaction
    START TRANSACTION;

    -- Xóa mềm danh mục con
    UPDATE DanhMucCon 
    SET 
        isDeleted = TRUE, 
        deletedAt = CURRENT_TIMESTAMP,
        isActive = 0
    WHERE idDanhMuc = p_idDanhMuc;

    -- Xóa mềm mối quan hệ sản phẩm với danh mục con
    UPDATE SanPhamDanhMuc spd
    JOIN DanhMucCon dmc ON spd.idDanhMucCon = dmc.idDanhMucCon
    SET 
        spd.isDeleted = TRUE, 
        spd.deletedAt = CURRENT_TIMESTAMP
    WHERE dmc.idDanhMuc = p_idDanhMuc;

    -- Xóa mềm danh mục chính
    UPDATE DanhMuc 
    SET 
        isDeleted = TRUE, 
        deletedAt = CURRENT_TIMESTAMP,
        isActive = FALSE
    WHERE idDanhMuc = p_idDanhMuc;

    -- Commit transaction
    COMMIT;
    
    SELECT 'Xóa danh mục thành công' as message;
    
END //
DELIMITER ;












