-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2024 at 01:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasirtokobangunan`
--



-- --------------------------------------------------------

--
-- Table structure for table `data_barang_masuk`
--

CREATE TABLE `data_barang_masuk` (
  `id_barang_masuk` int NOT NULL,
  `id_produk` int NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah_masuk` int NOT NULL,
  `penerima` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_barang_masuk`
--

INSERT INTO `data_barang_masuk` (`id_barang_masuk`, `id_produk`, `tanggal_masuk`, `jumlah_masuk`, `penerima`) VALUES
(1, 2, '2024-06-13 01:16:07', 101, 'gaha'),
(4, 17, '2024-06-14 05:59:06', 15, 'ali');

-- --------------------------------------------------------

--
-- Table structure for table `data_produk`
--

CREATE TABLE `data_produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `supplier` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stock` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `gambar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_produk`
--

INSERT INTO `data_produk` (`id_produk`, `nama_produk`, `supplier`, `stock`, `harga`, `gambar`) VALUES
(17, 'cat tembok b1', 'PT Atma Jaya', 136, '1200000.00', '83ff3a0035045b566f284daaba992ebc.png'),
(18, 'asbes', 'PT Atma Jaya', 122, '110000.00', '7d7b39ed8b5a1d513c2811e65d629057.png'),
(19, 'cat tembok dulux', 'PT Atma Jaya', 123, '130000.00', 'c8fa19f90bcc76f9ea92dedb02c183bf.png'),
(20, 'cat', 'PT. Atma Jaya', 4, '45000.00', '6d707f2a66e335c8754b8cddf6791a96.png'),
(21, 'cat', 'PT. Atma Jaya', 12, '120000.00', '46694d6a58b81c543a87a49013905513.png');

-- --------------------------------------------------------

--
-- Table structure for table `data_supplier`
--

CREATE TABLE `data_supplier` (
  `id_supplier` int NOT NULL,
  `nama_supplier` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `produk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_supplier`
--

INSERT INTO `data_supplier` (`id_supplier`, `nama_supplier`, `contact`, `alamat`, `produk`) VALUES
(2, 'PT. Atma Jaya', '098766544', 'cirebon', 'pasir, batu, genteng');

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailtransaksi`
-- (See below for the actual view)
--
CREATE TABLE `detailtransaksi` (
`harga_barang` decimal(10,2)
,`jumlah` int
,`jumlah_beli` int
,`kd_barang` varchar(11)
,`kd_pretransaksi` varchar(7)
,`kd_transaksi` varchar(7)
,`nama_barang` varchar(100)
,`sub_total` int
,`tanggal_beli` timestamp
,`total_harga` int
);

-- --------------------------------------------------------

--
-- Table structure for table `table_pretransaksi`
--

CREATE TABLE `table_pretransaksi` (
  `kd_pretransaksi` varchar(7) NOT NULL,
  `kd_transaksi` varchar(7) NOT NULL,
  `kd_barang` varchar(11) NOT NULL,
  `jumlah` int NOT NULL,
  `sub_total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_pretransaksi`
--

INSERT INTO `table_pretransaksi` (`kd_pretransaksi`, `kd_transaksi`, `kd_barang`, `jumlah`, `sub_total`) VALUES
('AN001', 'TR001', '5', 24, 288),
('AN002', 'TR001', '8', 2, 24),
('AN003', 'TR001', '2', 8, 98765),
('AN004', 'TR002', '2', 2, 24691),
('AN005', 'TR004', '5', 1, 12),
('AN006', 'TR006', '7', 1, 12),
('AN007', 'TR007', '5', 1, 12),
('AN008', 'TR008', '5', 1, 12),
('AN009', 'TR009', '7', 2, 24),
('AN010', 'TR010', '5', 4, 48),
('AN011', 'TR010', '7', 2, 24),
('AN012', 'TR011', '5', 1, 12),
('AN013', 'TR012', '5', 1, 12),
('AN014', 'TR013', '2', 1, 12346),
('AN015', 'TR014', '18', 1, 110000),
('AN016', 'TR015', '17', 1, 1200000),
('AN017', 'TR016', '18', 1, 110000),
('AN018', 'TR017', '19', 1, 130000),
('AN019', 'TR018', '17', 1, 1200000);

--
-- Triggers `table_pretransaksi`
--
DELIMITER $$
CREATE TRIGGER `batal_beli` AFTER DELETE ON `table_pretransaksi` FOR EACH ROW UPDATE data_produk SET
stock = stock + OLD.jumlah
WHERE id_produk = OLD.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `transaksi` AFTER INSERT ON `table_pretransaksi` FOR EACH ROW UPDATE data_produk SET
stock = stock - new.jumlah
WHERE id_produk = new.kd_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_beli` AFTER UPDATE ON `table_pretransaksi` FOR EACH ROW UPDATE data_produk SET
stock = stock + OLD.jumlah - NEW.jumlah
WHERE id_produk = new.kd_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `table_transaksi`
--

CREATE TABLE `table_transaksi` (
  `kd_transaksi` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kd_user` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_beli` int NOT NULL,
  `total_harga` int NOT NULL,
  `tanggal_beli` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_transaksi`
--

INSERT INTO `table_transaksi` (`kd_transaksi`, `kd_user`, `jumlah_beli`, `total_harga`, `tanggal_beli`) VALUES
('TR001', '0', 34, 99077, '2024-06-12 17:00:00'),
('TR002', '0', 0, 24691, '2024-06-12 17:00:00'),
('TR003', '0', 0, 24691, '2024-06-12 17:00:00'),
('TR004', '0', 0, 12, '2024-06-12 17:00:00'),
('TR005', '0', 0, 24691, '2024-06-12 17:00:00'),
('TR006', '0', 0, 12, '2024-06-12 17:00:00'),
('TR007', '', 1, 12, '2024-06-12 17:00:00'),
('TR008', '0', 1, 12, '2024-06-12 17:00:00'),
('TR009', '0', 2, 24, '2024-06-12 17:00:00'),
('TR010', '0', 6, 72, '2024-06-12 17:00:00'),
('TR011', '0', 1, 12, '2024-06-12 17:00:00'),
('TR012', '0', 1, 12, '2024-06-13 23:04:53'),
('TR013', '0', 1, 12346, '2024-06-13 23:06:06'),
('TR014', '0', 1, 110000, '2024-06-14 07:03:56'),
('TR015', '0', 1, 1200000, '2024-06-30 23:48:04'),
('TR016', '0', 1, 110000, '2024-06-30 23:49:24'),
('TR017', '0', 1, 130000, '2024-07-01 00:07:26'),
('TR018', '0', 1, 1200000, '2024-07-01 01:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `level` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `pass`, `level`) VALUES
(2, 'presiden', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 'admin'),
(3, 'presiden', '202cb962ac59075b964b07152d234b70', '123', 'admin'),
(4, 'advancestar@gmail.com', '202cb962ac59075b964b07152d234b70', '123', 'kasir');

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewdatabarangmasuk`
-- (See below for the actual view)
--
CREATE TABLE `viewdatabarangmasuk` (
`gambar` varchar(100)
,`id_barang_masuk` int
,`id_produk` int
,`jumlah_masuk` int
,`nama_produk` varchar(100)
,`penerima` varchar(100)
,`tanggal_masuk` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_data_produk`
-- (See below for the actual view)
--
CREATE TABLE `view_data_produk` (
`gambar` varchar(100)
,`harga` decimal(10,2)
,`id_produk` int
,`nama_produk` varchar(100)
,`stock` int
,`supplier` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_data_supplier`
-- (See below for the actual view)
--
CREATE TABLE `view_data_supplier` (
`alamat` varchar(100)
,`contact` varchar(100)
,`id_supplier` int
,`nama_supplier` varchar(100)
,`produk` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_data_user`
-- (See below for the actual view)
--
CREATE TABLE `view_data_user` (
`id_user` int
,`level` enum('admin','kasir')
,`pass` varchar(100)
,`password` varchar(100)
,`username` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_total_harga`
-- (See below for the actual view)
--
CREATE TABLE `view_total_harga` (
`kd_transaksi` varchar(7)
,`sub_total` decimal(32,0)
,`total_harga` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_transaksi_summary`
-- (See below for the actual view)
--
CREATE TABLE `view_transaksi_summary` (
`jumlah_beli` int
,`kd_transaksi` varchar(7)
,`sub_total` decimal(32,0)
,`tanggal_beli` timestamp
,`total_harga` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_transaksi_summary1`
-- (See below for the actual view)
--
CREATE TABLE `view_transaksi_summary1` (
`jumlah_beli` int
,`kd_transaksi` varchar(7)
,`sub_total` int
,`tanggal_beli` timestamp
,`total_harga` decimal(32,0)
);

-- --------------------------------------------------------
DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteDataBarangMasuk` (IN `p_id_barang_masuk` INT)   BEGIN
    DECLARE v_id_produk INT;
    DECLARE v_jumlah_masuk INT;

    -- Retrieve the id_produk and jumlah_masuk before deletion
    SELECT id_produk, jumlah_masuk INTO v_id_produk, v_jumlah_masuk
    FROM data_barang_masuk
    WHERE id_barang_masuk = p_id_barang_masuk;

    -- Update the stock in data_produk
    UPDATE data_produk
    SET stock = stock - v_jumlah_masuk
    WHERE id_produk = v_id_produk;

    -- Delete the record from data_barang_masuk
    DELETE FROM data_barang_masuk
    WHERE id_barang_masuk = p_id_barang_masuk;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_data_produk` (IN `p_id_produk` INT)   BEGIN
    DELETE FROM data_produk
    WHERE id_produk = p_id_produk;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_data_supplier` (IN `p_id_supplier` INT)   BEGIN
    DELETE FROM data_supplier
    WHERE id_supplier = p_id_supplier;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_data_user` (IN `p_id_user` INT)   BEGIN
    DELETE FROM user
    WHERE id_user = p_id_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPreTransaksiSummary` (IN `kd_transaksi_param` VARCHAR(7))   BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE kd_pretransaksi VARCHAR(7);
    DECLARE kd_transaksi VARCHAR(7);
    DECLARE kd_barang VARCHAR(11);
    DECLARE jumlah INT;
    DECLARE sub_total INT;
    DECLARE total_harga INT DEFAULT 0;

    DECLARE cur CURSOR FOR
        SELECT kd_pretransaksi, kd_transaksi, kd_barang, jumlah, sub_total 
        FROM table_pretransaksi 
        WHERE kd_transaksi = kd_transaksi_param;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO kd_pretransaksi, kd_transaksi, kd_barang, jumlah, sub_total;
        
        IF done THEN
            LEAVE read_loop;
        END IF;

        SET total_harga = total_harga + sub_total;
    END LOOP;

    CLOSE cur;

    SELECT kd_transaksi_param AS kd_transaksi, total_harga;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPreTransaksiSummary1` (IN `kd_transaksi_param` VARCHAR(7), OUT `total_harga_param` INT)   BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE kd_pretransaksi VARCHAR(7);
    DECLARE kd_transaksi VARCHAR(7);
    DECLARE kd_barang VARCHAR(11);
    DECLARE jumlah INT;
    DECLARE sub_total INT;
    DECLARE total_harga INT DEFAULT 0;

    DECLARE cur CURSOR FOR
        SELECT kd_pretransaksi, kd_transaksi, kd_barang, jumlah, sub_total 
        FROM table_pretransaksi 
        WHERE kd_transaksi = kd_transaksi_param;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO kd_pretransaksi, kd_transaksi, kd_barang, jumlah, sub_total;
        
        IF done THEN
            LEAVE read_loop;
        END IF;

        SET total_harga = total_harga + sub_total;
    END LOOP;

    CLOSE cur;

    SET total_harga_param = total_harga;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTransaksiDetail` (IN `kd_transaksi_param` VARCHAR(7))   BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE kd_pretransaksi VARCHAR(7);
    DECLARE kd_barang VARCHAR(11);
    DECLARE jumlah INT;
    DECLARE sub_total INT;
    
    DECLARE cur CURSOR FOR
        SELECT kd_pretransaksi, kd_barang, jumlah, sub_total
        FROM table_pretransaksi
        WHERE kd_transaksi = kd_transaksi_param;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Tampilkan informasi dasar transaksi dari table_transaksi
    SELECT 
        kd_transaksi, 
        kd_user, 
        jumlah_beli, 
        total_harga, 
        tanggal_beli 
    FROM 
        table_transaksi 
    WHERE 
        kd_transaksi = kd_transaksi_param;

    -- Membuka cursor
    OPEN cur;

    -- Loop untuk menampilkan barang yang dibeli dalam transaksi tersebut
    read_loop: LOOP
        FETCH cur INTO kd_pretransaksi, kd_barang, jumlah, sub_total;
        
        IF done THEN
            LEAVE read_loop;
        END IF;

        SELECT 
            kd_pretransaksi AS kd_pretransaksi,
            kd_barang AS kd_barang,
            jumlah AS jumlah,
            sub_total AS sub_total;
    END LOOP;

    -- Menutup cursor
    CLOSE cur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTransaksiDetail1` (IN `kd_transaksi_param` VARCHAR(7))   BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE kd_pretransaksi VARCHAR(7);
    DECLARE kd_barang VARCHAR(11);
    DECLARE jumlah INT;
    DECLARE sub_total INT;

    DECLARE cur CURSOR FOR
        SELECT kd_pretransaksi, kd_barang, jumlah, sub_total
        FROM table_pretransaksi
        WHERE kd_transaksi = kd_transaksi_param COLLATE utf8mb4_general_ci;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Tampilkan informasi dasar transaksi dari table_transaksi
    SELECT 
        kd_transaksi, 
        kd_user, 
        jumlah_beli, 
        total_harga, 
        tanggal_beli 
    FROM 
        table_transaksi 
    WHERE 
        kd_transaksi = kd_transaksi_param COLLATE utf8mb4_general_ci;

    -- Membuka cursor
    OPEN cur;

    -- Loop untuk menampilkan barang yang dibeli dalam transaksi tersebut
    read_loop: LOOP
        FETCH cur INTO kd_pretransaksi, kd_barang, jumlah, sub_total;
        
        IF done THEN
            LEAVE read_loop;
        END IF;

        SELECT 
            kd_pretransaksi AS kd_pretransaksi,
            kd_barang AS kd_barang,
            jumlah AS jumlah,
            sub_total AS sub_total;
    END LOOP;

    -- Menutup cursor
    CLOSE cur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTransaksiDetail2` (IN `kd_transaksi_param` VARCHAR(7))   BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE kd_pretransaksi VARCHAR(7);
    DECLARE kd_barang VARCHAR(11);
    DECLARE jumlah INT;
    DECLARE sub_total INT;

    DECLARE cur CURSOR FOR
        SELECT kd_pretransaksi, kd_barang, jumlah, sub_total
        FROM table_pretransaksi
        WHERE kd_transaksi = kd_transaksi_param COLLATE utf8mb4_general_ci;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Tampilkan informasi dasar transaksi dari table_transaksi
    SELECT 
        t.kd_transaksi, 
        t.kd_user, 
        t.jumlah_beli, 
        t.total_harga, 
        t.tanggal_beli 
    FROM 
        table_transaksi t
    WHERE 
        t.kd_transaksi = kd_transaksi_param COLLATE utf8mb4_general_ci;

    -- Membuka cursor
    OPEN cur;

    -- Loop untuk menampilkan barang yang dibeli dalam transaksi tersebut
    read_loop: LOOP
        FETCH cur INTO kd_pretransaksi, kd_barang, jumlah, sub_total;
        
        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Tampilkan detail barang yang dibeli
        SELECT 
            kd_pretransaksi AS kd_pretransaksi,
            kd_barang AS kd_barang,
            jumlah AS jumlah,
            sub_total AS sub_total;
    END LOOP;

    -- Menutup cursor
    CLOSE cur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTransaksiDetail3` (IN `kd_transaksi_param` VARCHAR(7))   BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE kd_pretransaksi VARCHAR(7);
    DECLARE kd_barang VARCHAR(11);
    DECLARE nama_produk VARCHAR(255);  -- Kolom untuk nama barang
    DECLARE jumlah INT;
    DECLARE sub_total INT;

    -- Cursor untuk mengambil data dari table_pretransaksi
    DECLARE cur CURSOR FOR
        SELECT 
            pt.kd_pretransaksi, 
            pt.kd_barang, 
            b.nama_produk,  -- Mengambil nama_barang dari table_barang
            pt.jumlah, 
            pt.sub_total
        FROM 
            table_pretransaksi pt
        INNER JOIN 
            data_produk b ON pt.kd_barang = b.id_produk
        WHERE 
            pt.kd_transaksi = kd_transaksi_param COLLATE utf8mb4_general_ci;
    
    -- Handler untuk menangani kondisi ketika cursor tidak menemukan data
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Tampilkan informasi dasar transaksi dari table_transaksi
    SELECT 
        t.kd_transaksi, 
        t.kd_user, 
        t.jumlah_beli, 
        t.total_harga, 
        t.tanggal_beli 
    FROM 
        table_transaksi t
    WHERE 
        t.kd_transaksi = kd_transaksi_param COLLATE utf8mb4_general_ci;

    -- Membuka cursor
    OPEN cur;

    -- Loop untuk menampilkan barang yang dibeli dalam transaksi tersebut
    read_loop: LOOP
        FETCH cur INTO kd_pretransaksi, kd_barang, nama_produk, jumlah, sub_total;
        
        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Tampilkan detail barang yang dibeli
        SELECT 
            kd_pretransaksi AS kd_pretransaksi,
            kd_barang AS kd_barang,
            nama_produk AS nama_produk,
            jumlah AS jumlah,
            sub_total AS sub_total;
    END LOOP;

    -- Menutup cursor
    CLOSE cur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTransaksiDetail4` (IN `kd_transaksi_param` VARCHAR(7))   BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE kd_pretransaksi VARCHAR(7);
    DECLARE id_produk INT;
    DECLARE nama_produk VARCHAR(100);
    DECLARE jumlah INT;
    DECLARE sub_total INT;

    -- Cursor untuk mengambil data dari table_pretransaksi
    DECLARE cur CURSOR FOR
        SELECT 
            pt.kd_pretransaksi, 
            dp.id_produk,
            dp.nama_produk,
            pt.jumlah, 
            pt.sub_total
        FROM 
            table_pretransaksi pt
        INNER JOIN 
            data_produk dp ON pt.kd_barang = dp.id_produk
        WHERE 
            pt.kd_transaksi = kd_transaksi_param COLLATE utf8mb4_general_ci;
    
    -- Handler untuk menangani kondisi ketika cursor tidak menemukan data
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Tampilkan informasi dasar transaksi dari table_transaksi
    SELECT 
        t.kd_transaksi, 
        t.kd_user, 
        t.jumlah_beli, 
        t.total_harga, 
        t.tanggal_beli 
    FROM 
        table_transaksi t
    WHERE 
        t.kd_transaksi = kd_transaksi_param COLLATE utf8mb4_general_ci;

    -- Membuka cursor
    OPEN cur;

    -- Loop untuk menampilkan barang yang dibeli dalam transaksi tersebut
    read_loop: LOOP
        FETCH cur INTO kd_pretransaksi, id_produk, nama_produk, jumlah, sub_total;
        
        IF done THEN
            LEAVE read_loop;
        END IF;

        -- Tampilkan detail barang yang dibeli
        SELECT 
            kd_pretransaksi AS kd_pretransaksi,
            id_produk AS id_produk,
            nama_produk AS nama_produk,
            jumlah AS jumlah,
            sub_total AS sub_total;
    END LOOP;

    -- Menutup cursor
    CLOSE cur;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertDataBarangMasuk` (IN `p_id_produk` INT, IN `p_jumlah_masuk` INT, IN `p_penerima` VARCHAR(255))   BEGIN
    -- Insert into data_barang_masuk
    INSERT INTO data_barang_masuk (id_produk, jumlah_masuk, penerima)
    VALUES (p_id_produk, p_jumlah_masuk, p_penerima);

    -- Update stock in data_produk
    UPDATE data_produk
    SET stock = stock + p_jumlah_masuk
    WHERE id_produk = p_id_produk;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUser` (IN `p_username` VARCHAR(50), IN `p_password` VARCHAR(255), IN `p_pass` VARCHAR(255), IN `p_level` ENUM('admin','kasir'))   BEGIN
        -- Insert new user
        INSERT INTO `user` (`username`, `password`, `pass`, `level`)
        VALUES (p_username, p_password, p_pass, p_level);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_produk` (IN `p_nama_produk` VARCHAR(255), IN `p_supplier` VARCHAR(255), IN `p_harga` DECIMAL(10,2), IN `p_gambar` VARCHAR(255))   BEGIN
    INSERT INTO data_produk (nama_produk, supplier, harga, gambar)
    VALUES (p_nama_produk, p_supplier, p_harga, p_gambar);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_produk1` (IN `p_nama_produk` VARCHAR(255), IN `p_supplier` VARCHAR(255), IN `p_stok` INT, IN `p_harga` DECIMAL(10,2), IN `p_gambar` VARCHAR(255))   BEGIN
    INSERT INTO data_produk (nama_produk, supplier, stock, harga, gambar)
    VALUES (p_nama_produk, p_supplier, p_stock, p_harga, p_gambar);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_produk2` (IN `p_nama_produk` VARCHAR(255), IN `p_supplier` VARCHAR(255), IN `p_stok` INT, IN `p_harga` DECIMAL(10,2), IN `p_gambar` VARCHAR(255))   BEGIN
    INSERT INTO data_produk (nama_produk, supplier, stock, harga, gambar)
    VALUES (p_nama_produk, p_supplier, p_stok, p_harga, p_gambar);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_supplier` (IN `p_nama_supplier` VARCHAR(100), IN `p_contact` VARCHAR(100), IN `p_alamat` VARCHAR(100), IN `p_produk` VARCHAR(100))   BEGIN
    INSERT INTO data_supplier (nama_supplier, contact, alamat, produk)
    VALUES (p_nama_supplier, p_contact, p_alamat, p_harga, p_produk);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_data_supplier1` (IN `p_nama_supplier` VARCHAR(100), IN `p_contact` VARCHAR(100), IN `p_alamat` VARCHAR(100), IN `p_produk` VARCHAR(100))   BEGIN
    INSERT INTO data_supplier (nama_supplier, contact, alamat, produk)
    VALUES (p_nama_supplier, p_contact, p_alamat, p_produk);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateDataBarangMasuk` (IN `p_id_barang_masuk` INT, IN `p_jumlah_masuk` INT, IN `p_penerima` VARCHAR(255))   BEGIN
    DECLARE v_id_produk INT;
    DECLARE v_jumlah_masuk_old INT;

    -- Retrieve the id_produk and the current jumlah_masuk before update
    SELECT id_produk, jumlah_masuk INTO v_id_produk, v_jumlah_masuk_old
    FROM data_barang_masuk
    WHERE id_barang_masuk = p_id_barang_masuk;

    -- Update penerima in data_barang_masuk
    UPDATE data_barang_masuk
    SET penerima = p_penerima,
        jumlah_masuk = p_jumlah_masuk
    WHERE id_barang_masuk = p_id_barang_masuk;

    -- Compare and update stock in data_produk
    IF p_jumlah_masuk > v_jumlah_masuk_old THEN
        -- New jumlah_masuk is greater, add the difference to stock
        UPDATE data_produk
        SET stock = stock + (p_jumlah_masuk - v_jumlah_masuk_old)
        WHERE id_produk = v_id_produk;
    ELSE
        -- New jumlah_masuk is less or equal, subtract the difference from stock
        UPDATE data_produk
        SET stock = stock - (v_jumlah_masuk_old - p_jumlah_masuk)
        WHERE id_produk = v_id_produk;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_data_supplier` (IN `p_id_supplier` INT, IN `p_nama_supplier` VARCHAR(100), IN `p_contact` VARCHAR(100), IN `p_alamat` VARCHAR(100), IN `p_produk` VARCHAR(100))   BEGIN
    UPDATE data_supplier
    SET
        nama_supplier = p_nama_supplier,
        contact =p_contact,
        alamat = p_alamat,
        produk = p_produk
    WHERE id_supplier = p_id_supplier;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_data_user` (IN `p_id_user` INT, IN `p_username` VARCHAR(255), IN `p_password` VARCHAR(255), IN `p_pass` VARCHAR(255))   BEGIN
    UPDATE user
    SET
        username = p_username,
        password = p_password,
        pass = p_pass
    WHERE kode_user = p_id_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_data_user1` (IN `p_id_user` INT, IN `p_username` VARCHAR(255), IN `p_password` VARCHAR(255), IN `p_pass` VARCHAR(255))   BEGIN
    UPDATE user
    SET
        username = p_username,
        password = p_password,
        pass = p_pass
    WHERE kode_user = p_id_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_data_user2` (IN `p_id_user` INT, IN `p_username` VARCHAR(255), IN `p_password` VARCHAR(255), IN `p_pass` VARCHAR(255))   BEGIN
    UPDATE user
    SET
        username = p_username,
        password = p_password,
        pass = p_pass
    WHERE id_user = p_id_user;
END$$

DELIMITER ;
--
-- Structure for view `detailtransaksi`
--
DROP TABLE IF EXISTS `detailtransaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailtransaksi`  AS SELECT `tp`.`kd_pretransaksi` AS `kd_pretransaksi`, `tp`.`kd_transaksi` AS `kd_transaksi`, `tp`.`kd_barang` AS `kd_barang`, `tp`.`jumlah` AS `jumlah`, `tp`.`sub_total` AS `sub_total`, `dp`.`nama_produk` AS `nama_barang`, `dp`.`harga` AS `harga_barang`, `tt`.`jumlah_beli` AS `jumlah_beli`, `tt`.`total_harga` AS `total_harga`, `tt`.`tanggal_beli` AS `tanggal_beli` FROM ((`table_pretransaksi` `tp` join `data_produk` `dp` on((`tp`.`kd_barang` = `dp`.`id_produk`))) join `table_transaksi` `tt` on((`tt`.`kd_transaksi` = `tp`.`kd_transaksi`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `viewdatabarangmasuk`
--
DROP TABLE IF EXISTS `viewdatabarangmasuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewdatabarangmasuk`  AS SELECT `dbm`.`id_produk` AS `id_produk`, `dbm`.`id_barang_masuk` AS `id_barang_masuk`, `dp`.`nama_produk` AS `nama_produk`, `dbm`.`jumlah_masuk` AS `jumlah_masuk`, `dbm`.`penerima` AS `penerima`, `dbm`.`tanggal_masuk` AS `tanggal_masuk`, `dp`.`gambar` AS `gambar` FROM (`data_barang_masuk` `dbm` join `data_produk` `dp` on((`dbm`.`id_produk` = `dp`.`id_produk`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_data_produk`
--
DROP TABLE IF EXISTS `view_data_produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_data_produk`  AS SELECT `data_produk`.`id_produk` AS `id_produk`, `data_produk`.`nama_produk` AS `nama_produk`, `data_produk`.`supplier` AS `supplier`, `data_produk`.`harga` AS `harga`, `data_produk`.`stock` AS `stock`, `data_produk`.`gambar` AS `gambar` FROM `data_produk``data_produk`  ;

-- --------------------------------------------------------

--
-- Structure for view `view_data_supplier`
--
DROP TABLE IF EXISTS `view_data_supplier`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_data_supplier`  AS SELECT `data_supplier`.`id_supplier` AS `id_supplier`, `data_supplier`.`nama_supplier` AS `nama_supplier`, `data_supplier`.`contact` AS `contact`, `data_supplier`.`alamat` AS `alamat`, `data_supplier`.`produk` AS `produk` FROM `data_supplier``data_supplier`  ;

-- --------------------------------------------------------

--
-- Structure for view `view_data_user`
--
DROP TABLE IF EXISTS `view_data_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_data_user`  AS SELECT `user`.`id_user` AS `id_user`, `user`.`username` AS `username`, `user`.`password` AS `password`, `user`.`pass` AS `pass`, `user`.`level` AS `level` FROM `user``user`  ;

-- --------------------------------------------------------

--
-- Structure for view `view_total_harga`
--
DROP TABLE IF EXISTS `view_total_harga`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_total_harga`  AS SELECT `table_pretransaksi`.`kd_transaksi` AS `kd_transaksi`, sum(`table_pretransaksi`.`sub_total`) AS `total_harga`, sum(`table_pretransaksi`.`sub_total`) AS `sub_total` FROM `table_pretransaksi` GROUP BY `table_pretransaksi`.`kd_transaksi``kd_transaksi`  ;

-- --------------------------------------------------------

--
-- Structure for view `view_transaksi_summary`
--
DROP TABLE IF EXISTS `view_transaksi_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi_summary`  AS SELECT `t`.`kd_transaksi` AS `kd_transaksi`, `t`.`jumlah_beli` AS `jumlah_beli`, ifnull(`v`.`sub_total`,0) AS `sub_total`, ifnull(`v`.`total_harga`,0) AS `total_harga`, `t`.`tanggal_beli` AS `tanggal_beli` FROM (`table_transaksi` `t` left join `view_total_harga` `v` on((`t`.`kd_transaksi` = `v`.`kd_transaksi`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_transaksi_summary1`
--
DROP TABLE IF EXISTS `view_transaksi_summary1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi_summary1`  AS SELECT `t`.`kd_transaksi` AS `kd_transaksi`, `t`.`jumlah_beli` AS `jumlah_beli`, `p`.`sub_total` AS `sub_total`, ifnull(`v`.`total_harga`,0) AS `total_harga`, `t`.`tanggal_beli` AS `tanggal_beli` FROM ((`table_transaksi` `t` left join `view_total_harga` `v` on((`t`.`kd_transaksi` = `v`.`kd_transaksi`))) left join `table_pretransaksi` `p` on((`t`.`kd_transaksi` = `p`.`kd_transaksi`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indexes for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `data_supplier`
--
ALTER TABLE `data_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  MODIFY `id_barang_masuk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_produk`
--
ALTER TABLE `data_produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `data_supplier`
--
ALTER TABLE `data_supplier`
  MODIFY `id_supplier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
