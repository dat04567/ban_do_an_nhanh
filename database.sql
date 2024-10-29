CREATE DATABASE IF NOT EXISTS bandoanDB;


USE bandoanDB;


-- thông tin món ăn và danh mục
CREATE TABLE CuaHang(
	idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	storeName VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	tongDoanhThu DECIMAL(20, 2) DEFAULT 0,
	loiNhuan DECIMAL(20, 2) DEFAULT 0
);


CREATE TABLE MonAn  (
    idMonAn CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    tenMonAn VARCHAR(100),
   	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    price DECIMAL(10, 2) DEFAULT 0,
    pathImage VARCHAR(255),
    status ENUM('Active', 'Deactive', 'Draf'),
    idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    FOREIGN KEY (idCuaHang) REFERENCES CuaHang(idCuaHang)
);

CREATE TABLE DanhMuc(
	idDanhMuc CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	idMonAn CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	FOREIGN KEY (idMonAn) REFERENCES MonAn(idMonAn)
);


INSERT INTO MonAn (tenMonAn, price, pathImage, status)
VALUES ('Phở Bò', 50000.00, '/images/pho_bo.jpg', 'Active');

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


CREATE TABLE KhachHang (
    idKH CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    tenKH VARCHAR(100),
    diaChi VARCHAR(255),
    email VARCHAR(100),
    password VARCHAR(100),
   	idGioHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
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
	FOREIGN KEY (idHoaDon) REFERENCES HoaDon(idHoaDon), 
);



CREATE TABLE ChiTietHoaDon(
	soLuong INT DEFAULT 1,
	giaBan DECIMAL(20, 2),
	giaVon DECIMAL(20, 2),
	idMonAn CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	PRIMARY KEY (idMonAn, idHoaDon),
	FOREIGN KEY (idHoaDon) REFERENCES HoaDon(idHoaDon),
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

CREATE TABLE NhanVien(
	idNhanVien CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	mucLuong DECIMAL(10, 2) NOT NULL,
	tenNhanVien VARCHAR(255),
    soDienThoai VARCHAR(15),
    diaChi VARCHAR(255),
    pathImage VARCHAR(255),
    roles ENUM('NhanVienKho', 'NhanVien' , 'QuanLyCuaHang',  'QuanLyChuoiCuaHang', 'SuperAdmin'),
    password VARCHAR(255),
    idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
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














