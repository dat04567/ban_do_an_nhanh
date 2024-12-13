CREATE DATABASE IF NOT EXISTS bandoanDB;


USE bandoanDB;


-- thông tin món ăn và danh mục

CREATE TABLE CuaHang(
	idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	storeName VARCHAR(100) NOT NULL,
	email VARCHAR(100) NULL,
    pathImage VARCHAR(100) NULL,
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
	tongDoanhThu DECIMAL(20, 2) DEFAULT 0,
	loiNhuan DECIMAL(20, 2) DEFAULT 0
);





CREATE TABLE SanPham  (
    idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    tenSanPham VARCHAR(100),
   	createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    price DECIMAL(10, 2) DEFAULT 0,
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    status ENUM('Active', 'Deactive', 'Draf')
);

CREATE TABLE HinhAnh (
    idHinhAnh CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    duongDan VARCHAR(255) NOT NULL,
    thuTu INT DEFAULT 0, -- Ordering of images
    laHinhChinh BOOLEAN DEFAULT FALSE, -- Is main product image
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    isDeleted BOOLEAN DEFAULT FALSE,
    deletedAt TIMESTAMP NULL,
    FOREIGN KEY (idSanPham) REFERENCES SanPham(idSanPham)
);


-- Mối quan hệ giữa sản phẩm và cửa hàng 
CREATE TABLE KhoSanPham(
	idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	soLuongTonKho INT,
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    PRIMARY KEY (idCuaHang, idSanPham),
    FOREIGN KEY (idCuaHang) REFERENCES CuaHang(idCuaHang),
	FOREIGN KEY (idSanPham) REFERENCES SanPham(idSanPham)
);

-- Danh mục

CREATE TABLE DanhMuc(
	idDanhMuc CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	tenDanhMuc VARCHAR(50) NOT NULL,
	hinhAnh  VARCHAR(100) NOT NULL,
    isActive BOOLEAN DEFAULT true,
    isDeleted BOOLEAN DEFAULT false,	
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
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
	PRIMARY KEY (idSanPham, idDanhMucCon),
	FOREIGN KEY (idSanPham) REFERENCES SanPham(idSanPham),
    FOREIGN KEY (idDanhMucCon) REFERENCES DanhMucCon(idDanhMucCon)
);


CREATE TABLE NguyenLieu(
	idNguyenLieu CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    tenNguyenLieu VARCHAR(100) NOT NULL,
    donVi VARCHAR(100) NOT NULL,
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    giaNguyenLieu DECIMAL(20, 2) 
);



-- Các thành phần để tạo ra một sản phẩm

CREATE TABLE SanPhamNguyenLieu(
	idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idNguyenLieu CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    soLuong INT,
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    PRIMARY KEY(idSanPham, idNguyenLieu),
    FOREIGN KEY (idSanPham) REFERENCES SanPham(idSanPham),
    FOREIGN KEY (idNguyenLieu) REFERENCES NguyenLieu(idNguyenLieu)
);





-- Kho lưu trữ nguyên liệu 1 cửa hàng có nhiều 
CREATE TABLE KhoNguyenLieu(
	idNguyenLieu CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    soLuongTonKho INT DEFAULT 0,
	isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    trangThai ENUM ('Còn hàng', 'Sắp hết hàng', 'Hết hàng'),
	idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    PRIMARY KEY(idNguyenLieu, idCuaHang),
    FOREIGN KEY (idCuaHang) REFERENCES CuaHang(idCuaHang),
    FOREIGN KEY (idNguyenLieu) REFERENCES NguyenLieu(idNguyenLieu)
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
    hinhAnh VARCHAR(255),
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    role ENUM('NhanVienKho', 'NhanVien', 'QuanLyCuaHang', 'QuanLyChuoiCuaHang', 'SuperAdmin', 'KhachHang' )  DEFAULT 'KhachHang' ,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- giỏ hàng và khách hàng
CREATE TABLE GioHang (
	idGioHang CHAR(36)  CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	trangThaiGH VARCHAR(50),
    idNguoiDung CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	UNIQUE(idNguoiDung), 
    FOREIGN KEY (idNguoiDung) REFERENCES NguoiDung(id)
);



CREATE TABLE ChiTietGioHang (
    soLuong INT,
    idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idGioHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    PRIMARY KEY (idGioHang, idSanPham, idCuaHang),
    FOREIGN KEY (idGioHang) REFERENCES GioHang(idGioHang),
    FOREIGN KEY (idSanPham) REFERENCES SanPham(idSanPham),
    FOREIGN KEY (idCuaHang) REFERENCES CuaHang(idCuaHang)
);






-- Bảng KhachHang kế thừa từ NguoiDung


CREATE TABLE KhachHang (
    idKH CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()),
    PRIMARY KEY (idKH),
	idNguoiDung CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
	UNIQUE(idNguoiDung), 
    FOREIGN KEY (idNguoiDung) REFERENCES NguoiDung(id)
);



-- thông tin về hoá đơn

CREATE TABLE HoaDon (
	idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    ngayTaoHoaDon DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    tongTien DECIMAL(20, 2),
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    trangThaiHoaDon ENUM('Pending', 'Processing', 'Completed', 'Cancelled') DEFAULT 'Pending',
    idNguoidung CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    FOREIGN KEY (idNguoidung) REFERENCES NguoiDung(id)
);

CREATE TABLE PhuongThucThanhToan (
    idPhuongThuc CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    tenPhuongThuc VARCHAR(100) NOT NULL,
	isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL
);

INSERT INTO PhuongThucThanhToan (tenPhuongThuc) VALUES ('COD');
INSERT INTO PhuongThucThanhToan (tenPhuongThuc) VALUES ('MOMO');

CREATE TABLE PhuongThucHoaDon(
    idPhuongThuc CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    PRIMARY KEY (idPhuongThuc, idHoaDon),
    FOREIGN KEY (idPhuongThuc) REFERENCES PhuongThucThanhToan(idPhuongThuc),
    FOREIGN KEY (idHoaDon) REFERENCES HoaDon(idHoaDon)
);

CREATE TABLE DiaChiGiaoHang(
	idDiaChi CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	hoTen VARCHAR(50),
	diaChi1 VARCHAR(50),
	diaChi2 VARCHAR(50),
	thanhPho VARCHAR(50),
	zipCode VARCHAR(50),
	macDinh BOOLEAN DEFAULT false,
    soDienThoai VARCHAR(50),
    congTy VARCHAR(50),
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
	idNguoidung CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
	FOREIGN KEY (idNguoidung) REFERENCES NguoiDung(id)
);

CREATE TABLE DiaChiHoaDon(
    idDiaChi CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    PRIMARY KEY (idDiaChi, idHoaDon),
    FOREIGN KEY (idDiaChi) REFERENCES DiaChiGiaoHang(idDiaChi),
    FOREIGN KEY (idHoaDon) REFERENCES HoaDon(idHoaDon)
);






CREATE TABLE ChiTietHoaDon(
	soLuong INT DEFAULT 1,
	giaVon DECIMAL(20, 2),
	idSanPham CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
	idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
	PRIMARY KEY (idSanPham, idHoaDon),
	FOREIGN KEY (idHoaDon) REFERENCES HoaDon(idHoaDon),
	FOREIGN KEY (idSanPham) REFERENCES SanPham(idSanPham)
);


CREATE TABLE HoaDonCuaHang (
    idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idCuaHang CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
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
    
    trangThai ENUM ('Ngừng làm việc', 'Hoạt động', 'Đã nghỉ việc') DEFAULT 'Hoạt động',
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
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
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    notes VARCHAR(255),
    gioGiaiLao TIME,
    viTri VARCHAR(100)
);


CREATE TABLE LichLamViec(
	idLichLamViec CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
	ngayLamViec DATE NOT NULL, 
    isDeleted BOOLEAN DEFAULT false,
	deletedAt TIMESTAMP NULL,
    idNhanVien CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    idCaLamViec CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    FOREIGN KEY (idNhanVien) REFERENCES NhanVien(idNhanVien),
    FOREIGN KEY (idCaLamViec) REFERENCES CaLamViec(idCaLamViec)
);

CREATE TABLE Payment (
    idPayment CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT (UUID()) PRIMARY KEY,
    idHoaDon CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    tongTienThanhToan DECIMAL(20, 2) NOT NULL,
    trangThai ENUM('Pending', 'Processing', 'Completed', 'Failed', 'Refunded') DEFAULT 'Pending',
    transactionCode VARCHAR(100),
    idPhuongThuc CHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
    ngayThanhToan TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notes TEXT,
    isDeleted BOOLEAN DEFAULT false,
    deletedAt TIMESTAMP NULL,
    FOREIGN KEY (idPhuongThuc) REFERENCES PhuongThucThanhToan(idPhuongThuc),
    FOREIGN KEY (idHoaDon) REFERENCES HoaDon(idHoaDon)
);




