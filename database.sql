CREATE DATABASE IF NOT EXISTS bandoanDB;


USE bandoanDB;


-- thông tin món ăn và danh mục
CREATE TABLE CuaHang(
	idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	storeName VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
	tongDoanhThu DECIMAL(20, 2) DEFAULT 0,
	loiNhuan DECIMAL(20, 2) DEFAULT 0
);

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




CREATE TABLE SanPham  (
    idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    tenSanPham VARCHAR(100),
   	createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    price DECIMAL(10, 2) DEFAULT 0,
    pathImage VARCHAR(255),
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    status ENUM('Active', 'Deactive', 'Draf'),
    idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    FOREIGN KEY (idCuaHang) REFERENCES CuaHang(idCuaHang)
);

-- Mối quan hệ giữa sản phẩm và cửa hàng 
CREATE TABLE KhoSanPham(
	idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	soLuongTonKho INT,
    PRIMARY KEY (idCuaHang, idSanPham),
    FOREIGN KEY (idCuaHang) REFERENCES CuaHang(idCuaHang),
	FOREIGN KEY (idSanPham) REFERENCES SanPham(idSanPham)
);

-- Danh mục

CREATE TABLE DanhMuc(
	idDanhMuc CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	tenDanhMuc VARCHAR(50) NOT NULL,
    isActive BOOLEAN DEFAULT true,
    isDeleted BOOLEAN DEFAULT false,
	idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	FOREIGN KEY (idSanPham) REFERENCES SanPham(idSanPham),
	deletedAt TIMESTAMP NULL,
	createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE DanhMucCon (
    idDanhMucCon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()),
    idDanhMuc CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    tenDanhMucCon VARCHAR(100) NOT NULL,
    isActive BOOLEAN DEFAULT true,
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (idDanhMucCon),
    FOREIGN KEY (idDanhMuc) REFERENCES DanhMuc(idDanhMuc)
);



CREATE TABLE SanPhamDanhMuc(
	idDanhMucCon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	PRIMARY KEY (idSanPham, idDanhMucCon),
	FOREIGN KEY (idSanPham) REFERENCES SanPham(idSanPham),
    FOREIGN KEY (idDanhMucCon) REFERENCES DanhMucCon(idDanhMucCon)
);


CREATE TABLE NguyenLieu(
	idNguyenLieu CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    tenNguyenLieu VARCHAR(100) NOT NULL,
    donVi VARCHAR(100) NOT NULL,
    giaNguyenLieu DECIMAL(20, 2) 
);



-- Các thành phần để tạo ra một sản phẩm

CREATE TABLE SanPhamNguyenLieu(
	idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idNguyenLieu CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    soLuong INT,
    PRIMARY KEY(idSanPham, idNguyenLieu),
    FOREIGN KEY (idSanPham) REFERENCES SanPham(idSanPham),
    FOREIGN KEY (idNguyenLieu) REFERENCES NguyenLieu(idNguyenLieu)
);

-- Kho lưu trữ nguyên liệu 1 cửa hàng có nhiều 
CREATE TABLE KhoNguyenLieu(
	idKho CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	idNguyenLieu CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    soLuong INT DEFAULT 0,
	idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    FOREIGN KEY (idCuaHang) REFERENCES CuaHang(idCuaHang),
    FOREIGN KEY (idNguyenLieu) REFERENCES NguyenLieu(idNguyenLieu)
)



-- INSERT INTO MonAn (tenMonAn, price, pathImage, status)
-- VALUES ('Phở Bò', 50000.00, '/images/pho_bo.jpg', 'Active');

-- giỏ hàng và khách hàng

CREATE TABLE GioHang (
	idGioHang CHAR(36)  CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	trangThaiGH VARCHAR(50)
);

CREATE TABLE ChiTietGioHang (
	soLuong INT,
	idMonAn CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	idGioHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	PRIMARY KEY (idGioHang, idMonAn),
   	FOREIGN KEY (idGioHang) REFERENCES GioHang(idGioHang),
   	FOREIGN KEY (idMonAn) REFERENCES MonAn(idMonAn)
);

--  người dùng


CREATE TABLE NguoiDung (
    id CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
	soDienThoai VARCHAR(15),  
    diaChi VARCHAR(255),      
    role ENUM('NhanVienKho', 'NhanVien', 'QuanLyCuaHang', 'QuanLyChuoiCuaHang', 'SuperAdmin', 'KhachHang' )  DEFAULT 'KhachHang' ,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Bảng KhachHang kế thừa từ NguoiDung
CREATE TABLE KhachHang (
    idKH CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()),
    idNguoiDung CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idGioHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    PRIMARY KEY (idKH),
	UNIQUE(idNguoiDung), 
    FOREIGN KEY (idNguoiDung) REFERENCES NguoiDung(id),
    FOREIGN KEY (idGioHang) REFERENCES GioHang(idGioHang)
);



-- thông tin về hoá đơn

CREATE TABLE HoaDon (
	idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    ngayTaoHoaDon DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    tongTien DECIMAL(20, 2),
    trangThaiHoaDon ENUM('Pending', 'Processing', 'Completed', 'Cancelled') DEFAULT 'Pending',
    idKH CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idPhuongThuc  CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    FOREIGN KEY (idKH) REFERENCES KhachHang(idKH)
);

CREATE TABLE DiaChiGiaoHang(
	idDiaChi CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	hoTen VARCHAR(50),
	diaChi1 VARCHAR(50),
	diaChi2 VARCHAR(50),
	thanhPho VARCHAR(50),
	zipCode VARCHAR(50),
	idKH CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	FOREIGN KEY (idHoaDon) REFERENCES HoaDon(idHoaDon),
	FOREIGN KEY (idKH) REFERENCES KhachHang(idKH)
);


CREATE TABLE PhuongThucThanhToan(
	idPhuongThuc CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
 	tenPhuongThuc VARCHAR(100) NOT NULL,
 	idHoaDon  CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()),
	FOREIGN KEY (idHoaDon) REFERENCES HoaDon(idHoaDon)
);



CREATE TABLE ChiTietHoaDon(
	soLuong INT DEFAULT 1,
	giaBan DECIMAL(20, 2),
	giaVon DECIMAL(20, 2),
	idMonAn CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
	idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	PRIMARY KEY (idMonAn, idHoaDon),
	FOREIGN KEY (idHoaDon) REFERENCES HoaDon(idHoaDon) ,
	FOREIGN KEY (idMonAn) REFERENCES MonAn(idMonAn)
);


CREATE TABLE HoaDonCuaHang (
    idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    PRIMARY KEY (idHoaDon, idCuaHang),
    FOREIGN KEY (idHoaDon) REFERENCES HoaDon(idHoaDon),
    FOREIGN KEY (idCuaHang) REFERENCES CuaHang(idCuaHang)
);


-- nhân viên và lịch làm việc 


-- Bảng NhanVien kế thừa từ NguoiDung
CREATE TABLE NhanVien (
    idNhanVien CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()),
    idNguoiDung CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    mucLuong DECIMAL(10, 2) NOT NULL,
    pathImage VARCHAR(255),
    idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    PRIMARY KEY (idNhanVien),
    UNIQUE(idNguoiDung),
    FOREIGN KEY (idNguoiDung) REFERENCES NguoiDung(id),
    FOREIGN KEY (idCuaHang) REFERENCES CuaHang(idCuaHang)
);



CREATE TABLE CaLamViec(
	idCaLamViec CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    thoiGianBatDau TIME NOT NULL,
    thoiGianKetThuc TIME NOT NULL,
    notes VARCHAR(255),
    gioGiaiLao TIME,
    viTri VARCHAR(100)
);


CREATE TABLE LichLamViec(
	idLichLamViec CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	ngayLamViec DATE NOT NULL, 
    idNhanVien CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idCaLamViec CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    FOREIGN KEY (idNhanVien) REFERENCES NhanVien(idNhanVien),
    FOREIGN KEY (idCaLamViec) REFERENCES CaLamViec(idCaLamViec)
);














