-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 03:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thucphamchucnang`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `id` int(9) NOT NULL,
  `madh` int(9) NOT NULL,
  `masp` varchar(20) NOT NULL,
  `soluong` int(9) NOT NULL,
  `thanhtien` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`id`, `madh`, `masp`, `soluong`, `thanhtien`) VALUES
(7, 7, 'LD1', 1, 560000),
(8, 8, 'GC1', 1, 200000),
(12, 12, 'LD1', 2, 1120000),
(13, 13, 'TH3', 1, 480000),
(14, 14, 'TH3', 1, 480000);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `madh` int(11) NOT NULL,
  `tendathang` varchar(50) NOT NULL,
  `tendn` varchar(50) NOT NULL,
  `sdt` varchar(10) NOT NULL,
  `diachi` varchar(200) NOT NULL,
  `tongtien` int(9) NOT NULL,
  `ngaydat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`madh`, `tendathang`, `tendn`, `sdt`, `diachi`, `tongtien`, `ngaydat`) VALUES
(7, 'Văn Thịnh', 'thinhbeo', '0987456323', 'Phú Mỹ, Đình Tổ, Thuận Thành, Bắc Ninh', 560000, '2024-11-04 10:51:08'),
(8, 'Văn Thịnh', 'thinhbeo', '0987456323', 'Phú Mỹ, Đình Tổ, Thuận Thành, Bắc Ninh', 200000, '2024-11-05 15:41:32'),
(12, 'Ngọc Ánh', 'ngocanh7699', '0874569321', 'Phú Mỹ, Đình Tổ, Thuận Thành, Bắc Ninh', 1120000, '2024-11-10 02:39:03'),
(13, 'Vanh', 'vananhbeo', '0967493585', 'Phú Mỹ, Đình Tổ, Thuận Thành, Bắc Ninh', 480000, '2024-11-10 04:04:51'),
(14, 'Văn Thịnh', 'thinhbeo', '0987456323', 'Phú Mỹ, Đình Tổ, Thuận Thành, Bắc Ninh', 480000, '2024-11-10 15:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `id` int(9) NOT NULL,
  `tendn` varchar(50) NOT NULL,
  `masp` varchar(20) NOT NULL,
  `soluong` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(9) NOT NULL,
  `tendn` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gopy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lienhe`
--

INSERT INTO `lienhe` (`id`, `tendn`, `email`, `gopy`) VALUES
(4, 'vananhbeo', 'vuvananh2323@gmail.com', 'nmb nh'),
(5, 'vananhbeo', 'vuvananh2323@gmail.com', 'HELLO');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `masp` varchar(20) NOT NULL,
  `tensp` varchar(255) NOT NULL,
  `anh` varchar(100) NOT NULL,
  `gia` int(9) NOT NULL,
  `giagiam` int(9) NOT NULL,
  `luotban` int(9) NOT NULL,
  `mota` text NOT NULL,
  `chitiet` text NOT NULL,
  `thanhphan` text NOT NULL,
  `cachdung` text NOT NULL,
  `doituong` text NOT NULL,
  `ngayban` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`masp`, `tensp`, `anh`, `gia`, `giagiam`, `luotban`, `mota`, `chitiet`, `thanhphan`, `cachdung`, `doituong`, `ngayban`) VALUES
('GAN1', 'Viên uống bổ gan Shijimi Orihiro 70 viên', 'GAN1.png', 530000, 450000, 210, 'Bảo vệ tế bào gan trước tác hại của rượu bia, chất độc, thực phẩm bẩn.\r\nTăng cường chức năng giải độc của gan\r\nHỗ trợ điều trị gan nhiễm mỡ, viêm gan, xơ gan\r\nThanh lọc cơ thể, giúp mát gan, giảm nóng trong', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên, 70 viên/lọ\r\nTrọng lượng: 570mg x 70 viên', 'Bột chiết xuất nghêu Shijimi - 100 mg\r\nChất phân hủy men gan - 200 mg\r\nBột chiết xuất cô đặc thịt hàu - 20 mg\r\nBột chiết xuất nghệ mùa thu - 20 mg\r\nCurcumin - 30 mg\r\nOrnitine - 50 mg\r\nInositol - 5 mg\r\nVitamin B1 - 5 mg\r\nVitamin B2 - 2 mg\r\nVitamin B6 - 3 mg\r\nVitamin B12 - 2 μg\r\nAcid Folic - 200 μg\r\nKẽm - 1 mg\r\n', 'Mỗi ngày uống 2 viên.\r\nNên uống trước bữa ăn 30 phút.', 'Người thường xuyên sử dụng rượu bia\r\nNgười bị viêm gan\r\nNgười xơ gan\r\nBệnh nhân gan nhiễm mỡ\r\nNgười chức năng gan kém\r\nNgười bị nóng trong người, mẩn ngứa, dị ứng\r\nLưu ý: Không sử dụng viên uống bổ gan Shijimi cho các đối tượng sau: Phụ nữ đang mang thai và cho con bú, Người dưới 18 tuổi, Người dị ứng với hải sản ', '2024-04-16'),
('GAN2', 'Viên uống tinh bột nghệ mùa thu Orihiro 520 viên', 'GAN2.png', 428000, 0, 260, 'Bảo vệ gan, tăng cường chức năng gan\r\nChống viêm giảm đau dạ dày\r\nGiảm mỡ máu, kiểm soát đường huyết\r\nGiảm số đo vòng bụng, giảm cảm giác thèm ăn, hỗ trợ giảm cân\r\nGiảm thâm nám, tàn nhang, cải thiện màu da.\r\nTrị sẹo, nhanh lành vết thương\r\nHỗ trợ tiêu hóa', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên nén, 520 viên/ hộp\r\nTrọng lượng: 130g/ hộp, mỗi viên 130mg', 'Tinh chất nghệ mùa thu 120mg (tương đương 1100 mg bột thô)\r\nCurcuminoid 2 mg', 'Uống 8 – 12 viên/ ngày, trước mỗi bữa ăn, ngày chia 2 – 3 lần.\r\nUống cùng với nước ấm hoặc nước lọc', 'Người có chức năng gan kém\r\nBệnh nhân viêm gan, xơ gan, gan nhiễm mỡ\r\nNgười viêm loét dạ dày, hành tá tràng\r\nNgười đang trong quá trình hồi phục sau mổ, sau chấn thương\r\nNgười nóng trong, có các biểu hiện dị ứng, mẩn ngứa\r\nNgười muốn làm đẹp da, bị thâm nám, tàn nhang.\r\nLưu ý: Không sử dụng cho đối tượng dưới 18 tuổi, Bà bầu và người cho con bú không nên sử dụng', '2024-03-18'),
('GAN3', 'Trà nghệ mùa thu Orihiro 48 gói', 'GAN3.jpg', 180000, 0, 220, 'Hỗ trợ giải độc gan, giảm tác hại của rượu bia gây ra cho cơ thể.\r\nTăng cường chức năng gan, hỗ trợ điều trị gan nhiễm mỡ, xơ gan.\r\nHỗ trợ thanh lọc cơ thể, giải nhiệt, giảm nóng trong, hạn chế mụn nhọt\r\nHỗ trợ làm đẹp da, giảm thâm nám, tàn nhang.\r\nHỗ trợ giảm viêm đau dạ dày.\r\nHỗ trợ làm lành vết thương.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: 72g [(1,5g x 16 gói) x 3 túi/túi PE]', '100% tinh bột nghệ mùa thu', 'Cách 1: Thả 1 gói trà vào ấm chứa ít nước nóng, loại bỏ nước hãm đầu, sau đó thêm nước nóng lần 2, đợi trà ngấm và thưởng thức trà nóng.\r\nCách 2: Đun sôi khoảng 500ml nước, thả 1 gói trà nước sôi, đun thêm 3-5 phút trên lửa nhỏ, sau đó để nguội hoặc bảo quản ngăn mát tủ lạnh để thưởng thức.', 'Người bị thương, người mới phẫu thuật cần phục hồi vết thương\r\nNgười có chức năng gan, thận hoạt động kém hiệu quả\r\nBệnh nhân xơ gan, viêm gan, gan nhiễm mỡ\r\nNgười thường xuyên uống rượu bia, sử dụng chất kích thích, hút thuốc lá\r\nBệnh nhân bị viêm loét dạ dày\r\nNgười bị nóng trong, bị mụn nhọt\r\nNgười có nhiều độc tố, cần thanh lọc cơ thể\r\nPhụ nữ nhiều nám, tàn nhang, da xấu kém sắc.\r\nNgười muốn duy trì lối sống lành mạnh, tăng cường sức khỏe', '2024-04-28'),
('GAN4', 'Trà diếp cá thanh nhiệt thải độc Orihiro 60 gói', 'GAN4.jpg', 180000, 0, 310, 'Giúp cơ thể nhuận tràng, giảm triệu chứng táo bón\r\nThanh nhiệt, giải độc, tăng cường hệ miễn dịch\r\nHỗ trợ điều trị bệnh sỏi thận, tiểu đường\r\nHỗ trợ điều trị viêm phế quản, viêm phổi\r\nHỗ trợ làm đẹp da, cải thiện tình trạng da mụn do nóng trong\r\nHỗ trợ giảm các triệu chứng của cảm cúm như sốt, đau đầu.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng túi trà lọc, 60 túi nhỏ/gói\r\nTrọng lượng: 180g [(3g x 20 túi) x 3 túi]', '100% lá diếp cá nguyên chất', 'Pha 1 gói trà với khoảng 250ml nước sôi và chờ khoảng 3 phút để trả ngấm và thưởng thức. Một gói trà có thể pha 3 lần nước, tùy vào khẩu vị của mỗi người.\r\nHoặc bạn có thể nấu một lần để uống cả ngày, đun khoảng 1 lít nước sôi và thả túi trà vào, tiếp tục đun với lửa nhỏ trong khoảng 2 phút. sau đó để nguội hoặc thêm đá thưởng thức.', 'Người bị nóng trong người, thường xuyên nổi mụn nhọt, mề đay.\r\nNgười bị trĩ.\r\nNgười lười ăn rau xanh, thường xuyên bị táo bón.\r\nNgười có chức năng gan kém.\r\nNgười sức khỏe kém, hay ốm vặt.\r\nNgười muốn sở hữu làn da đẹp, không nổi mụn.\r\nNgười bị sỏi thận, tiểu tiện khó khăn,', '2024-03-11'),
('GC1', 'Hồng trà Nam Phi Orihiro 60 gói', 'GC1.jpg', 200000, 0, 411, 'Hồng trà Nam Phi Orihiro giúp chống oxy hóa, bảo vệ sức khỏe tim mạch, ngăn ngừa ung thư, phòng chống các bệnh mãn tính.\r\nGiúp hỗ trợ giảm huyết áp, cải thiện chỉ số đường huyết, hạ mỡ máu.\r\nHỗ trợ giảm viêm, phòng bệnh lý đường hô hấp, giảm phản ứng dị ứng\r\nTăng khả năng tập trung, giúp tỉnh táo, giảm mệt mỏi, cải thiện hiệu suất làm việc.\r\nHỗ trợ làm đẹp da, giảm nếp nhăn, chống lão hóa.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng gói lọc, 60 gói lọc/ túi\r\nTrọng lượng: Mỗi gói lọc 3g (túi 180g)', 'Trong 1 gói trà chứa: Bột hồng trà Nam Phi, trà ô long, trà Hadu Ấn Độ, Trà Pu’er, lúa mạch gạo rang.', 'Cách 1: Pha với ít nước. Đặt 1 túi trà vào ấm và đổ nước sôi. Sau 1 phút hãy bỏ phần nước này đi. Hãm nước thứ 2 và thưởng thức trà.\r\nCách 2: Pha với nhiều nước. Đun sôi khoảng 1 lít nước, cho một túi trà vào và đun trên lửa nhỏ trong khoảng 3 đến 5 phút. Khi bạn ưng ý với màu sắc và mùi hương của trà thì tắt lửa và giữ ấm trong nồi hoặc làm lạnh trong tủ lạnh. Điều chỉnh thời gian đun sôi theo sở thích và màu sắc của trà.', 'Người có sức đề kháng kém, hay ốm vặt, cần bồi bổ sức khỏe.\r\nNgười lớn tuổi có nguy cơ mắc bệnh lý tim mạch, mỡ máu.\r\nNgười đang mất tập trung khi làm việc, người mệt mỏi, không tỉnh táo.\r\nNgười muốn cải thiện vóc dáng, sắc đẹp.', '2024-05-30'),
('GC2', 'Trà cúc vu dâu tằm Salacia hỗ trợ giảm cân Orihiro 20 gói', 'GC2.jpg', 280000, 0, 360, 'Chống béo phì, giảm cân an toàn, hiệu quả\r\nGiảm đường trong máu, tốt cho hệ tim mạch\r\nTăng cường chức năng đường ruột, giảm táo bón\r\nGiảm căng thẳng, chống lão hóa, làm đẹp da', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng túi lọc, 20 túi lọc/ Gói\r\nTrọng lượng: 3g x 20 gói', 'Salacia, lá dâu tằm, cúc vu, diếp cá\r\nHàm lượng dưỡng chất có trong 1 gói lọc: Lượng calo - 11 kcal, Protein - 0.3 g, Lipid - 0 – 0.2 g, Carbohydrate - 2.16 g, Muối tương tương - 0 – 0.02 g', 'Cách 1. Đun sôi với nước: Cho một túi lọc vào 500ml nước sôi và đun ở lửa nhỏ trong khoảng 5 phút. Sau đó tắt bếp và để nguội. Có thể bảo quản ngăn mát tủ lạnh và sử dụng trong vòng 24h.\r\nCách 2. Sử dụng ấm trà: Cho một túi lọc vào ấm trà cùng nước sôi. Hãm trong 3 – 5 phút sau đó có thể thưởng thức.', 'Người có nhu cầu giảm cân, giảm mỡ thừa\r\nNgười muốn giữ dáng, giữ cân hiện tại\r\nNgười thường xuyên ăn nhiều tinh bột, đồ ngọt, có nguy cơ tiểu đường\r\nNgười muốn duy trì lối sống lành mạnh, tăng cường sức khỏe\r\nKhông dùng cho đối tượng dưới 18 tuổi, Phụ nữ đang mang thai.', '2024-05-30'),
('GC3', 'Viên uống giảm cân Night Diet Orihiro hộp 60 gói', 'GC3.png', 778000, 585000, 306, 'Thúc đẩy trao đổi chất, đốt cháy mỡ thừa\r\nHỗ trợ giảm cân hiệu quả nhất tại các vùng bụng, đùi, bắp tay, bắp chân,\r\nBổ sung acid amin, vitamin hạn chế các vấn đề thiếu chất dinh dưỡng khi giảm cân\r\nHỗ trợ làm đẹp da\r\nAn thần, tạo giấc ngủ ngon', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên, 6 viên/ gói, 60 gói/hộp\r\nTrọng lượng: 90g\r\n', 'Hỗn hợp acid amin - 850 mg\r\n(gồm Arginine, Ornithine, Lysine)	\r\nVitamin B1 - 0.5 mg\r\nVitamin B6 - 0.8 mg\r\nAcid pantothenic - 1.7 mg\r\n', 'Mỗi hộp gồm 60 túi, mỗi túi chứa 6 viên. Mỗi ngày dùng 2 túi.\r\nUống kèm với nước lọc hoặc nước ấm.\r\nNên uống trước lúc tập luyện, lúc nghỉ ngơi hoặc trước khi đi ngủ.', 'Người mắc bệnh béo phì, thừa cân.\r\nNgười muốn giữ dáng và kiểm soát cân nặng hiện tại.\r\nNgười cần bổ sung năng lượng, chất dinh dưỡng khi thực hiện ăn kiêng.\r\nNgười muốn sở hữu vóc dáng thon gọn và làn da đẹp.\r\nNgười hay mất ngủ, ngủ không sâu giấc.\r\nKhông sử dụng cho trẻ em, phụ nữ đang mang thai.\r\nPhụ nữ ngừng cho con bú có thể sử dụng để lấy lại vóc dáng và cân nặng sau sinh', '0000-00-00'),
('GC4', 'Viên uống gừng đen Salacia giảm mỡ bụng Orihiro 30 viên', 'GC4.jpg', 382000, 0, 210, 'Giảm cân hiệu quả và an toàn, đạt tỷ lệ BMI tiêu chuẩn\r\nĐiều hòa mức đường huyết sau bữa ăn\r\nTăng cường chức năng đường ruột, giảm táo bón, hỗ trợ điều trị viêm loét dạ dày\r\nChống lão hóa, làm đẹp da', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Viên nang, 30 viên/ Túi', 'Polymethoxyflavone (chiết xuất gừng đen) - 12 mg\r\nSalacinol (chiết xuất cây keo Salacia) - 0,05 mg', 'Mỗi ngày uống 1 viên với nước lọc hoặc nước ấm.\r\nCó thể uống trước hoặc sau bữa ăn 15 – 30 phút.', 'Người muốn giữ dáng, giữ cân hiện tại\r\nNgười có chỉ số BMI (chỉ số khối cơ thể) cao (BMI 24 trở lên và dưới 30)\r\nNgười muốn giảm cân, giảm mỡ (đặc biệt vùng mỡ khó giảm như: mỡ nội tạng, mỡ bụng, mỡ đùi,…)\r\nNgười bị tiểu đường, bị tăng đường huyết sau ăn\r\n', '2024-07-22'),
('GC5', 'Trà giảm cân Night Diet Tea Orihiro 24 gói', 'GC5.png', 210000, 0, 220, 'Hỗ trợ giảm cân, giữ dáng hiệu quả\r\nThúc đẩy quá trình đốt cháy mỡ thừa giảm cân hiệu quả\r\nKiểm soát lượng đường trong máu\r\nThanh nhiệt, thải độc cơ thể\r\nCải thiện chất lượng giấc ngủ\r\nGiúp làm đẹp da, chống lão hóa', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng gói lọc, 24 gói/túi\r\nTrọng lượng: 48g/ túi(2g x 24)', 'Trong 1 túi trà Night Diet Tea chứa: Rooibos (hồng trà Nam Phi), bột hồng trà, bột gừng, hoa cúc, cỏ ngọt, citrulline, ornithine, glycine, arginine, lysine.', 'Pha 1 gói trà vào 200~250ml nước sôi, sau 3 phút có thể uống ngay.\r\n1 ngày uống từ 1 -2 gói.\r\nTránh nơi có ánh nắng mặt trời trực tiếp, nhiệt độ và độ ẩm cao. Sau khi mở túi nên dùng ngay và đóng lại, tránh để hơi ẩm làm giảm chất lượng của trà.', 'Người thừa cân béo phì, muốn thực hiện chế độ giảm cân lành mạnh.\r\nNgười muốn giữ dáng, làm đẹp.\r\nNgười mỡ máu, đường huyết cao.\r\nNgười đi làm bận rộn, không có thời gian luyện tập thể dục thể thao.\r\nNgười thường xuyên ăn nhiều đồ ngọt, đồ chiên rán nhiều dầu mỡ.\r\nKhông sử dụng cho người dưới 18 tuổi, phụ nữ đang mang thai\r\nPhụ nữ ngừng cho con bú có thể sử dụng trà Night Diet 24 gói để hỗ trợ giảm cân, lấy lại vóc dáng sau sinh\r\n', '2024-08-10'),
('GC6', 'Trà giảm mỡ bụng Meta Shot Tea Orihiro 30 gói', 'GC6.png', 310000, 0, 180, 'Trà Meta Shot Tea Orihiro giúp hỗ trợ giảm mỡ bụng, giảm hấp thu đường vào máu, hỗ trợ điều trị đái tháo đường.\r\nGiúp giảm cảm giác thèm ăn, thèm ngọt, từ đó hỗ trợ kiểm soát cân nặng.\r\nHỗ trợ tiêu hóa, tăng cường sức đề kháng.\r\nHỗ trợ giảm mỡ máu, đường huyết, bảo vệ sức khỏe tim mạch.\r\nHỗ trợ tiêu hóa, tăng cường sức đề kháng.\r\nHỗ trợ làm đẹp da, chống lão hóa sớm.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng túi trà lọc, 30 gói/ hộp\r\nTrọng lượng: 5g x 30 gói', 'Lá Tochuu, Rooibos, Dây thìa canh, Diếp cá, Bằng lăng nước, Ổi, Salacia, lá dâu tằm, mướp đắng, chiết xuất bột garcinia. ', 'Uống nóng: Hãm 1 gói trà với một ít nước nóng, sau đó bỏ nước đầu. Thêm lượt nước thứ 2, để trà ngấm và thưởng thức trà nóng..\r\nUống lạnh: Đun sôi 1 lít nước, thả 1 gói trà vào, đun trên bếp với lửa nhỏ thêm 3-5 phút, sau đó để trà nguội hoặc bảo quản trong ngăn mát tủ lạnh để sử dụng.', 'Người có nhu cầu giảm cân.\r\nNgười muốn giữ dáng, giữ cân hiện tại.\r\nNgười thừa cân, béo phì cần giảm cân.\r\nNgười làm việc văn phòng, ngồi nhiều, ít hoạt động gây tích mỡ.\r\nNgười không có thời gian để tập luyện thể thao tăng cường sức khỏe.\r\nKhông sử dụng cho phụ nữ đang mang thai.\r\nPhụ nữ ngừng cho con bú có thể sử dụng Trà Meta Shot để hỗ trợ giảm cân, lấy lại vóc dáng sau sinh\r\nNgười đang điều trị đái tháo đường bằng thuốc tân dược cần tham khảo ý kiến bác sĩ trước khi dùng trà để tránh nguy cơ hạ đường huyết quá mức.', '2024-09-12'),
('LD1', 'Bột Collagen Acid Hyaluronic Orihiro 11000mg 180g', 'LD1.jpg', 615000, 560000, 133, 'Bổ sung hàm lượng Collagen cao lên tới 11000 mg, Collagen dạng peptide có khả năng hấp thu cao, giúp làm đẹp da, căng mịn, mượt mà.\r\nGiúp cấp ẩm cho da, giúp da đàn hồi tốt, căng tràn sức sống\r\nThúc đẩy sự phát triển của tế bào, phục hồi tế bào tổn thương', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng bột\r\nTrọng lượng: 180g/ túi', 'Collagen peptide từ cá - 5500 mg (Tương đương 11000mg Collagen)	\r\nAcid Hyaluronic trọng lượng phân tử thấp - 20 mg\r\nGlucosamin (Chiết xuất từ tôm cua) - 100 mg\r\nCeramide (Chiết xuất từ gạo) - 200 μg\r\n', 'Pha 6 gram bột Collagen với nước ấm hoặc thức uống yêu thích. Uống 1 lần/ngày.\r\nThời điểm tốt nhất nên uống Collagen vào buổi tối trước khi đi ngủ 30 phút. Nếu sử dụng vào thời điểm khác trong ngày thì nên uống xa bữa ăn khoảng 3 tiếng và không ăn thêm ngay sau khi uống.', 'Bất kỳ ai muốn sở hữu một làn da đẹp, căng mịn, tươi trẻ.\r\nPhụ nữ gặp các vấn đề về làn da: da lão hóa, da xỉn màu, da nám, tàn nhang, da khô.\r\nNgười thường xuyên tiếp xúc với ánh sáng xanh của máy tính hoặc làm việc ngoài trời tiếp xúc với các tia bức xạ gây hại da.\r\nPhụ nữ sau tuổi trưởng thành cần bổ sung Collagen.\r\nKhông sử dụng sản phẩm cho người dưới 18 tuổi, phụ nữ có thai và cho con bú dưới 6 tháng.\r\nNgười dị ứng với hải sản (tôm, cua) cần thận trọng khi sử dụng sản phẩm', '2024-10-01'),
('LD2', 'Viên uống nở ngực BBB Orihiro 300 viên', 'LD2.png', 550000, 0, 190, 'Giúp tăng sự phát triển của các mô đệm mỡ quanh ngực, giúp tăng kích thước vòng 1\r\nKích thích dây chằng nâng đỡ ngực phát triển, giúp vòng 1 săn chắc\r\nĐiều hòa nội tiết tố, đẩy lùi các triệu chứng tiền mãn kinh, mãn kinh\r\nGiảm hình thành nếp nhăn nơi khóe miệng, mắt và trán\r\nCung cấp các dưỡng chất làm đẹp da', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên nén, 300 viên/ hộp\r\nTrọng lượng: 75g / 250mg mỗi viên', 'Elastin - 40 mg\r\nMineral water - 300 mg\r\nBột sữa ong chúa - 33 mg\r\nBột chiết xuất Maca (tương đương với 150 mg Maca thô) - 7.5 mg\r\nChiết xuất Isoflavone từ đậu nành - 4 mg\r\nSắt - 6.8 mg\r\nAcid Folic - 100 μg\r\nVitamin D - 2.5 μg\r\n', 'Uống 10 viên/ ngày (sáng 3 viên, trưa 3 viên, tối 3 viên, 1 viên uống ngay trước thời điểm đi ngủ)\r\nNên sử dụng sau ăn khoảng 30 phút\r\nUống với 200ml mỗi lần, lượng nước được bổ sung nhiều hằng ngày sẽ giúp viên uống dễ hấp thu và giúp làn da mịn màng, sáng đẹp hơn, cơ thể được thanh lọc.\r\nMỗi một liệu trình nên sử dụng 2 tháng liên tục, tương ứng với 2 hộp viên uống nở ngực BBB Orihiro.\r\nQuá trình sử dụng viên uống nở ngực BBB Orihiro cần kết hợp với chế độ ăn uống, sinh hoạt, thể dục thể thao hợp lý, đặc biệt là kết hợp mát xa ngực đều đặn hàng ngày, sau 2 tháng bạn sẽ cảm thấy kết quả rõ rệt.', 'Phụ nữ có vòng 1 nhỏ, chảy xệ, kém săn chắc.\r\nPhụ nữ tiền mãn kinh, muốn cải thiện vòng 1 và tăng cường hormon estrogen.\r\nPhụ nữ có da thâm nám, sạm, tàn nhang, nhiều vết nhăn.\r\nPhụ nữ tóc ít, hay gãy rụng', '2024-06-25'),
('LD3', 'Viên nhai Collagen Orihiro Most Chewable 180 viên', 'LD3.png', 365000, 0, 150, 'Duy trì sự đàn hồi của làn da, ngăn hình thành nếp nhăn, giúp da săn chắc.\r\nCải thiện các vấn da bị lão hóa, da khô ráp, kém sắc.\r\nGiúp da tươi trẻ, sáng mịn.\r\nBổ sung vitamin, khoáng chất, acid amin cho cơ thể để cải thiện sức khỏe của làn da.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiroww333\r\nQuy cách đóng gói: Dạng viên, 180 viên/lọ', 'Collagen peptide - 200 mg\r\nL-Arginine - 5 mg\r\nL-Proline - 2.5 mg\r\nL-Cystine - 2.5 mg\r\nVitamin B2 - 0.6 mg\r\nVitamin B6 - 0.8 mg\r\nAcid pantothenic - 2.5 mg', 'Người lớn sử dụng 2 viên/ngày, nhai trực tiếp hoặc uống với nước ấm. Thời điểm tốt nhất nên dùng trước khi đi ngủ 30 phút. Hoặc vào các thời điểm khác trong ngày, nên dùng xa bữa ăn và không ăn ngày sau khi uống.', 'Chị em phụ nữ muốn sở hữu làn da trẻ đẹp.\r\nPhụ nữ sau tuổi trưởng thành bắt đầu xuất hiện các dấu hiệu lão hóa da.\r\nNgười gặp các vấn đề về da như thâm nám, tàn nhang, sẹo do mụn để lại.\r\nPhụ nữ tuổi trung niên có nhiều nếp nhăn, da khô kém sắc.\r\nKhông sử dụng cho trẻ em, phụ nữ đang mang thai và cho con bú', '2024-06-09'),
('LD4', 'Viên uống trắng da Natural White Premium Orihiro 300 viên', 'LD4.png', 530000, 0, 242, 'Giúp da trắng sáng, mịn màng\r\nCải thiện tình trạng nám, tàn nhang, da xỉn màu.\r\nGiúp da đàn hồi, săn chắc, duy trì độ ẩm cho da\r\nTăng cường đề kháng cho làn da, giảm nhanh các tổn thương làn da\r\nCải thiện làn da mụn', 'Xuất xứ : Nhật Bản\r\nNhà sản xuất : Orihiro\r\nQuy cách đóng gói : Dạng viên nén, 300 viên/ hộp\r\nTrọng lượng : 270mg/viên; 81g/hộp', 'Vitamin C - 100mg\r\nL-cystine - 25mg\r\nAxit hyaluronic - 1mg\r\nAcid pantothenate - 1mg\r\nVitamin B1 - 0.15mg\r\nVitamin B6 - 0.25mg\r\nAxit folic - 10-35μg', 'Uống 10 viên/ngày. Sử dụng với nước ấm hoặc nước lọc\r\nCó thể chia 2 lần/ ngày. \r\nNên dùng sau ăn sáng-trưa 30 phút.', 'Người đang gặp các tình trạng về nám da, tàn nhang, xỉn màu, da bị lão hóa\r\nBất kỳ ai muốn sở hữu làn da trắng mịn., đều màu.\r\nPhụ nữ sau tuổi trường thành bắt đầu có các dấu hiệu lão hóa da, xuống sắc.\r\nNgười có làn da đen do ánh nắng hoặc sạm do tiếp xúc nhiều ánh sáng xanh.\r\nKhông sử dụng sản phẩm cho người dưới 18 tuổi, phụ nữ có thai và cho con bú.\r\nNgười bị đau dạ dày nên uống sau ăn no, nếu có các biểu hiện kích ứng thì có thể ngừng sản phẩm và tham khảo thêm ý kiến bác sĩ.', '2024-08-17'),
('LD5', 'Viên uống sữa ong chúa Royal Jelly 3000mg Orihiro 90 viên', 'LD5.png', 500000, 0, 210, 'Bổ sung vitamin, khoáng chất, acid amin giúp bồi bổ sức khỏe, tăng cường hệ miễn dịch.\r\nBổ sung dưỡng chất giúp chống lão hóa da, làm đẹp da, trẻ hóa.\r\nHỗ trợ kháng khuẩn, kháng viêm, làm lành tổn thương, giúp hỗ trợ điều trị mụn da.\r\nPhòng chống các bệnh nhiễm khuẩn, hạn chế mắc bệnh đường hô hấp.\r\nHỗ trợ bảo vệ sức khỏe tim mạch, huyết áp.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên, 90 viên/ hộp', '100% Sữa ong chúa nguyên chất', 'Uống 3 viên /ngày sau bữa ăn\r\nCó thể uống kèm nước ấm hoặc nước lọc.', 'Phụ nữ muốn sở hữu làn da đẹp.\r\nPhụ nữ sau tuổi trưởng thành, bắt đầu xuất hiện các dấu hiệu lão hóa.\r\nNgười cần tăng cường sức đề kháng.\r\nKhông sử dụng cho người dưới 18 tuổi, phụ nữ mang thai và cho con bú.\r\nKhông sử dụng cho người mẫn cảm với bất kỳ thành phần nào trong sản phẩm.', '2024-08-26'),
('LD6', 'Bột Collagen, Proteoglycan, Nhau thai heo 11000mg Orihiro 180g', 'LD6.jpg', 517000, 465000, 372, 'Bổ sung hàm lượng Collagen cao lên tới 11000 mg, Collagen được tổng hợp dưới dạng Peptide giúp tăng khả năng hấp thu.\r\nGiúp da căng mịn, mượt mà, tươi trẻ, tràn đầy sức sống\r\nThúc đẩy sự phát triển của tế bào, phục hồi tế bào tổn thương và tái tạo da\r\nNgăn chặn sự hình thành sắc tố melanin gây nám da\r\nGiảm nếp nhăn, nám, sạm da hiệu quả', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng bột, 180g (30 ngày)', 'Collagen peptide đậm đặc - 5500 mg (Tương đương 11000mg Collagen, nguồn gốc từ heo, bò)	\r\nChiết xuất sụn mũi cá hồi chứa Proteoglycan - 5000 μg\r\nBột chiết xuất nhau thai heo - 30 mg (Tương đương 1500 mg nhau thai)	\r\n', 'Mỗi ngày 1 lần, mỗi lần 6g (tương đương 1 muỗng canh). Có thể sử dụng cùng nước ấm hoặc đồ uống yêu thích.\r\nThời gian sử dụng tốt nhất là buổi tối, trước khi đi ngủ 30 phút. Nếu dùng Collagen vào các thời điểm khác trong ngày thì nên uống cách xa bữa ăn 3 tiếng và không ăn ngay sau khi uống.', 'Người muốn sở hữu làn da căng tràn sức sống, sáng mịn, tươi trẻ.\r\nPhụ nữ gặp các vấn đề về làn da: da lão hóa, da xỉn màu, da nám, tàn nhang, da khô.\r\nNữ giới trên 18 tuổi (đặc biệt là phụ nữ sau tuổi 30 khuyến cáo bổ sung thêm collagen).\r\nNgười làm việc văn phòng tiếp xúc nhiều với ánh sáng xanh hoặc người làm việc dưới tác hại của tia UV.', '2024-09-06'),
('MNT1', 'Viên nhai bổ sung Lutein và Việt quất Orihiro túi 120 viên', 'MNT1.png', 230000, 0, 312, 'Hỗ trợ tăng cường thị lực, giúp mắt sáng khỏe\r\nPhòng ngừa thoái hóa điểm vàng và đục thủy tinh thể\r\nHạn chế khô mỏi mắt.\r\nChống viêm giác mạc, phục hồi thị lực\r\nPhòng ngừa cận thị, viễn thị, loạn thị và giảm tiến triển độ cận\r\nCải thiện nhận thức, khả năng học tập, ghi nhớ\r\nTốt cho tim mạch, não bộ, tiêu hóa.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên, 120 viên\r\nTrọng lượng: 60g (120 viên/500mg)', 'Bột chiết xuất Việt quất: 50 mg\r\nLutein: 30 μg', 'Trẻ em từ 10 tuổi trở lên và người lớn: 4 viên/ ngày, dùng sau ăn, có thể chia thành 2 lần, nhai kỹ trước khi nuốt.\r\nTrẻ em 3 – 10 tuổi: 2 viên/ ngày, dùng sau ăn, có thể chia thành 2 lần, nhai kĩ trước khi nuốt.', 'Trẻ từ 3 tuổi trở lên, có khả năng nhai nuốt tốt và sử dụng dưới sự giám sát của người lớn.\r\nNgười có thị lực kém (người già, người mắc các tật khúc xạ, người bị thoái hóa điểm vàng, đục thủy tinh thể).\r\nNgười mắc bệnh Alzhermer.\r\nNgười lớn tuổi có bệnh lý tim mạch, tiểu đường, huyết áp cao, mắt nhìn kém.\r\nNgười giảm khả năng nhận thức, học tập, ghi nhớ.\r\nTrẻ em đang trong độ tuổi phát triển trí não.\r\nPhụ nữ mang thai và cho con bú bổ sung Lutein để hỗ trợ phát triển hệ thần kinh cho trẻ.', '2024-09-18'),
('MNT2', 'Viên uống bổ mắt Việt quất Orihiro 120 viên', 'MNT2.png', 910000, 750000, 120, 'Giúp mắt sáng khỏe, tăng cường thị lực\r\nHạn chế tác hại của ánh sáng xanh\r\nChống viêm giác mạc, phục hồi thị lực\r\nNgừa cận, viễn, loạn thị, hỗ trợ giảm độ cận\r\nTăng khả năng học tập, nhận thức, ghi nhớ\r\nTốt cho tim mạch, não bộ, tiêu hóa', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên nang, 120 viên/ hộp\r\nTrọng lượng: 480mg mỗi viên / 250mg chất lỏng', '\r\nAnthocyanin chiết xuất từ quả Việt quất: 45 mg\r\nLutein: 10 mg\r\nBeta-caroten: 3000 μg\r\nChiết xuất Euphrasia rostkoviana (Eyebright): 30 mg\r\nChiết xuất Acer Maximowiczianum (chứa Anthocyanin): 15.2 mg\r\nDầu cá tinh luyện chứa:	DHA - 120 mg, Kẽm - 2 mg, Vitamin C - 40 μg, Vitamin B1 - 4 mg, Vitamin B6 - 4 mg, Vitamin B12 - 40 μg, Vitamin E', 'Uống 4 viên mỗi ngày với nước ấm, có thể chia thành 2 lần/ngày.\r\nSử dụng sau bữa ăn 30 phút.', 'Người có thị lực kém (người già, người mắc các tật khúc xạ, người bị thoái hóa điểm vàng, đục thủy tinh thể).\r\nNgười giảm khả năng nhận thức, học tập, ghi nhớ.\r\nNgười mắc bệnh Alzhermer.\r\nNgười lớn tuổi có bệnh lý tim mạch, tiểu đường, huyết áp cao, mắt nhìn kém.\r\nNgười thường xuyên sử dụng máy tính.\r\nPhụ nữ mang thai và cho con bú muốn bổ sung dưỡng chất để phát triển trí não, thị lực cho trẻ ngay trong bụng mẹ.\r\nTrẻ em trên 6 tuổi', '2024-04-23'),
('MNT3', 'Viên uống bổ não DHA EPA Orihiro 180 viên', 'MNT3.png', 593000, 420000, 325, 'Hỗ trợ cải thiện chức năng hệ thần kinh, tăng cường khả năng ghi nhớ và tập trung\r\nGiảm tình trạng sa sút trí tuệ.\r\nBảo vệ và phòng tránh các bệnh về mắt, chống lão hóa mắt và các bệnh khúc xạ\r\nGiảm thiểu nguy cơ xơ vữa động mạch, nhồi máu cơ tim, tăng cường sức khỏe tim mạch.\r\nGiúp kích thích và phát triển hệ thần kinh thai nhi.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên nang, 180 viên/ hộp\r\nTrọng lượng: Mỗi viên 511 mg (hộp 92g)', 'Trong 6 viên uống bổ não DHA EPA Orihiro 180 viên chứa: DHA - 780 mg, EPA - 80 mg, DPA - 18 mg\r\nHàm lượng dưỡng chất có trong 6 viên: Lượng calo - 22.5 kcal, Protein - 0.65g, Lipid - 2.13g, Carbohydrate - 0.2g, Muối tương tương - 0-0.01g', 'Người trên 18 tuổi: uống 6 viên/ ngày với nước ấm, nên uống cùng bữa ăn, có thể chia làm 2 lần/ngày.', 'Người mệt mỏi, căng thẳng do làm việc nhiều.\r\nNgười lớn tuổi suy giảm trí nhớ.\r\nNgười có bệnh về mắt, thị lực kém.\r\nNgười bệnh Alzheimer, sa sút trí tuệ, suy giảm trí nhớ.', '2024-03-30'),
('MNT4', 'Viên uống dầu cá omega-3 hỗ trợ tim mạch Orihiro 180 viên', 'MNT4.png', 420000, 0, 240, 'Giảm thiểu các nguy cơ các bệnh về tim mạch\r\nPhát triển não bộ, tăng cường trí nhớ\r\nHỗ trợ cải thiện các hoạt động của mắt\r\nHỗ trợ hệ thống miễn dịch, thúc đẩy lưu thông máu, tăng cường sức khỏe', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên nang, 180 viên/ hộp\r\nTrọng lượng: 1 viên 455 mg / hàm lượng chất lỏng 300 mg', 'Trong 4 viên dầu cá Omega-3 chứa:\r\nEPA (eicosapentaenoic acid) - 186 mg\r\nDHA (docosahexaenoic acid) - 124 mg\r\nHàm lượng dưỡng chất có trong 4 viên: Lượng calo - 13 kcal, Protein - 0.46g, Lipid - 1.23g, Carbohydrate - 0.1g, Muối tương tương - 0g', 'Đối với người lớn và trẻ em trên 10 tuổi: uống 4 viên/ngày, chia 2 lần, uống cùng với bữa ăn.\r\nĐối với trẻ em từ 6-10 tuổi: uống 2 viên/ngày, chia 2 lần, uống cùng bữa ăn.\r\nHạn chế không dùng điện thoại, máy tính trong phòng tối tắt điện\r\nKhi làm việc với máy tính nên cho mắt nghỉ ngơi sau 20’\r\nHạn chế nhìn trực tiếp vào khu vực có nắng gắt. Nên sử dụng kính râm để tránh tia Uv vào mùa hè.', 'Người có nguy cơ bị mắc các bệnh tim mạch hoặc có tiền sử các bệnh tim mạch\r\nNgười bị tật khúc xạ, thị lực kém, làm việc nhiều với máy tính, điện thoại, ánh sáng xanh.\r\nNgười già giảm trí nhớ, sa sút trí tuệ.\r\nNgười giảm khả năng ghi nhớ, khó tập trung khi học tập và làm việc.\r\nNgười lớn tuổi cần tăng cường sức khỏe tim mạch, não bộ và mắt.\r\nPhụ nữ mang thai và cho con bú cần bổ sung Omega-3 để phát triển trí não thai nhi ngay khi còn trong bụng mẹ\r\n', '2024-05-12'),
('SL1', 'Tỏi không mùi Maca Orihiro 180 viên ', 'SL1.jpg', 172000, 0, 260, 'Tăng cường sinh lực, hỗ trợ sinh lý cho cả nam và nữ.\r\nGiảm cholesterol trong máu, cải thiện tuần hoàn máu, hạ huyết áp, tốt cho hệ tim mạch.\r\nTăng cường sức đề kháng của cơ thể, hồi phục cơ thể suy nhược.\r\nPhòng ngừa và hỗ trợ điều trị cảm cúm thông thường.\r\nTốt cho bệnh già suy giảm trí nhớ, sa sút trí tuệ.\r\nTốt cho người làm việc trong môi trường nhiễm độc kim loại.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên, 180 viên/ hộp', 'Bột chiết xuất tỏi không mùi - 100 mg\r\nBột Maca thô - 70 mg\r\nVitamin A - 100 μg\r\nVitamin D - 0.8 μg\r\nVitamin B1 - 0.5 mg\r\nVitamin B2 - 0.5 mg\r\nVitamin B6 - 0.7 mg\r\nVitamin B12 - 0.7 μg\r\nNiacin - 5 mg\r\nAcid folic - 70 μg\r\nAcid pantothenic - 1.7 mg\r\nVitamin C - 1.2 mg\r\nVitamin E - 1.7 mg\r\n', 'Uống 3 viên mỗi ngày với nước ấm. Nên uống sau ăn để tăng khả năng hấp thu.\r\nKhi mới sử dụng có thể uống từ liều thấp 1 viên/ngày, sau đó tăng dần như liều quy định.', 'Người bình thường muốn tăng cường sức khỏe.\r\nNgười mắc bệnh lý mãn tính tim mạch, mỡ màu.\r\nNam giới muốn cải thiện sức khỏe sinh lý.\r\nNgười suy nhược cơ thể, làm việc môi trường nặng nhọc, thường xuyên tiếp xúc với các chất độc kim loại.\r\nNgười già bị suy giảm trí nhớ, sa sút trí tuệ.\r\nNgười mới ốm dậy, sức đề kháng kém.', '2024-07-04'),
('SL2', 'Viên uống tăng cường sinh lực chiết xuất ba ba Orihiro 120 viên', 'SL2.jpg', 397000, 0, 150, 'Tăng cường sinh lý nam\r\nTăng khả năng ham muốn, kèo dài thời gian quan hệ\r\nCải thiện tình trạng xuất tinh sớm, di tinh, mộng tinh\r\nBổ thận, tráng dương\r\nTăng cường sức đề kháng, nâng cao miễn dịch.\r\nBồi bổ sức khỏe, tăng cường sinh lực cho cơ thể.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên, 120 viên/ hộp', 'Bột Mai ba ba - 40 mg\r\nBột Rắn Mamushi đỏ (Gloydius blomhoffii) - 20 mg\r\nNgoài ra, trong viên uống còn chứa bột trứng ba ba, bột sữa ong chúa.\r\nHàm lượng dưỡng chất có trong 1 viên uống:\r\nCalo - 3 kcal, Protein - 0.15 g, Lipid - 0.20 g, Carbohydrate - 0.05 g, Muối tương đương - 0-0.01 g', 'Uống 3 – 6 viên mỗi ngày với nước hoặc nước ấm.\r\nKhi mới sử dụng nên uống từ 1 viên/ngày, sau đó tăng dần liều như khuyến cáo của nhà sản xuất.', 'Người bình thường muốn tăng cường sức khỏe\r\nNam giới muốn cải thiện sức khỏe sinh lý\r\nNgười suy nhược cơ thể, sức khỏe sa sút\r\nNam giới hiếm muộn\r\nNam giới giảm ham muốn\r\nNam giới xuất tinh sớm, di tinh, mộng tinh', '2024-06-12'),
('SL3', 'Viên uống chiết xuất cây cọ lùn hỗ trợ tuyến tiền liệt Orihiro 60 viên Date 9/2024', 'SL3.png', 320000, 0, 240, 'Bảo vệ tuyến tiền liệt ở nam giới\r\nHỗ trợ điều trị bệnh phì đại tuyến tiền liệt\r\nHỗ trợ cải thiện chất lượng và số lượng tinh trùng\r\nTăng cường Testosterone, cải thiện chức năng sinh lý\r\nNgăn ngừa rụng tóc do giảm nội tiết tố nam\r\nTăng cường sinh lực, bồi bổ sức khỏe', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên nang, 60 viên/ hộp\r\nTrọng lượng: 1 viên 525mg / hàm lượng chất lỏng 340mg', 'Bột chiết xuất cây cọ lùn - 160 mg\r\nBột chiết xuất hạt bí ngô - 50 mg\r\nBột chiết xuất gừng đen - 5 mg\r\nBột chiết xuất nhân sâm	- 5 mg\r\nVitamin E - 1.8 mg\r\nKẽm - 1.5 mg\r\nSelen - 1.5 μg\r\n', 'Mỗi ngày uống 2 viên cùng với nước ấm.\r\nSử dụng trong 3 tháng liên tiếp để đạt hiệu quả cao.', 'Nam giới bị phì đại tuyến tiền liệt.\r\nNam giới bị suy giảm chức năng sinh lý.\r\nNam giới bị hạn chế trong chuyện chăn gối.\r\nNam giới tuổi trung niên rụng tóc nhiều.\r\nNam giới muốn bồi bổ sức khỏe.\r\nLưu ý: Không sử dụng sản phẩm cho các đối tượng: người dưới 18 tuổi, phụ nữ có thai cho con bú và người dị ứng với bất kỳ thành phần nào trong sản phẩm.', '2024-05-22'),
('SL4', 'Viên uống tinh chất hàu tỏi nghệ Orihiro 180 viên', 'SL4.png', 532000, 475000, 222, 'Bổ sung tinh chất hàu, tỏi, nghệ giúp hỗ trợ sức khỏe sinh lý nam giới.\r\nBổ sung kẽm, vitamin và khoáng chất giúp bồi bổ sức khỏe\r\nTăng cường chức năng gan, ngăn ngừa sự phá hủy gan do bia rượu gây ra.\r\nTăng cường miễn dịch và sinh lực cho cơ thể\r\n', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên nén, 180 viên/ hộp', 'Bột chiết xuất cô đặc thịt hàu - 33 mg\r\nBột chiết xuẩt cô đặc kẽm - 33 mg\r\nBột chiết xuất cô đặc nghệ mùa thu - 10 mg\r\nBột chiết xuất cô đặc tỏi - 13 mg\r\nVitamin A - 175 μg\r\nVitamin D - 0.8 μg\r\nVitamin B1 - 0.5 mg\r\nVitamin B2 - 0.5 mg\r\nVitamin B6 - 0.7 mg\r\nVitamin B12 - 0.7 μg\r\nNiacin - 5 mg\r\nAcid folic - 70 μg\r\nAcid pantothenic - 3 mg\r\nVitamin C - 12 mg\r\nVitamin E - 2.4 mg\r\nL-Citruline - 33 mg\r\nL-Methionin - 17 mg\r\nL-Cystine - 17 mg\r\nKẽm - 2 mg\r\nSắt - 1.8 mg\r\n', 'Uống 3 viên/ ngày, chia làm 2 -3 lần\r\nNên uống sau ăn khoảng 30 phút để có hiệu quả tốt nhất\r\nĐể viên tinh chất hàu tỏi nghệ phát huy tối đa tác dụng, nên uống liên tục trong khoảng 3 tháng trở lên', 'Người thường xuyên uống rượu bia, sử dụng chất kích thích, ảnh hưởng đến chức năng gan và sinh lý.\r\nNam giới muốn tăng cường sinh lực, cải thiện chất lượng khi quan hệ tình dục.\r\nNam giới bị rối loạn cương sương, xuất tinh sớm.\r\nNgười bị hiếm muộn, chậm con hoặc người chuẩn bị có con.\r\nNgười thường xuyên mệt mỏi, suy nhược, stress.', '2024-08-11'),
('TH1', 'Men vi sinh hỗ trợ hệ tiêu hóa Orihiro 16 túi', 'TH1.png', 214000, 0, 220, 'Cân bằng hệ vi sinh đường ruột\r\nTăng cường chức năng tiêu hóa\r\nTạo môi trường đường ruột lành mạnh\r\nTăng cường hệ miễn dịch\r\nNgăn ngừa các bệnh lý về tiêu hóa và đại tràng', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng bột, 16 túi nhỏ/gói\r\nTrọng lượng: 16g (1g x 16)', 'Lợi khuẩn axit lactic có trong dạ dày, Vi khuẩn Bifidobacteria, Lactobacillus, lactoferrin, Isomalto-oligosaccharide, Dextrin.\r\nHàm lượng dinh dưỡng có trong 1 túi (1g) mỗi ngày: Lượng calo - 3.5g, Lipid - 0.0g, Proterin - 0.05g, Cacbohydrate - 0.91g, Muối tương đương - 0.01g', 'Trong thời gian bị rối loạn tiêu hóa, ngày uống 1 gói pha với nước ấm (không dùng với nước nóng). \r\nKhi tình trạng rối loạn tiêu hóa đã khỏi duy trì thêm 2-3 ngày.\r\nNếu sử dụng đều đặn để duy trì sức khỏe đường ruột thì nên uống mỗi ngày sau bữa ăn.', 'Trẻ em trên 3 tuổi, người lớn, đặc biệt là người già bị rối loạn tiêu hóa (tiêu chảy, táo bón, chướng bụng đầy hơi, phân sống, nhiễm lỵ amip), trẻ em rối loạn khuẩn ruột do dùng nhiều kháng sinh hoặc do các nguyên nhân khác.\r\nNgười mắc bệnh viêm đại tràng cấp và mãn tính.\r\nTrẻ em biếng ăn, suy dinh dưỡng, hấp thu kém.\r\nNgười lớn sau ốm dậy, ăn uống kém, sức khỏe còn yếu.\r\nNgười có chế độ ăn ít chất xơ, vitamin, ăn uống thất thường, người bị stress, căng thẳng', '2024-08-11'),
('TH2', 'Enzyme thực vật Orihiro 60 viên', 'TH2.png', 380000, 0, 340, 'Hỗ trợ hệ tiêu hóa hiệu quả\r\nTạo môi trường đường ruột lành mạnh \r\nTăng cường sức đề kháng\r\nCải thiện các vấn đề ốm vặt, cơ thể mệt mỏi…\r\nCải thiện các vấn đề chán ăn, không ngon miệng', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên, 60 viên/túi\r\nTrọng lượng: 450mg x 60 viên', 'Bột chiết xuất thực vật lên men, vi khuẩn axit lactic thực vật.\r\nHàm lượng dưỡng chất có trong 1 viên mỗi ngày: Lượng calo - 2.65 kcal, Protein - 0.02g, Lipid - 0.019g, Carbohydrate - 0.24g, Muối tương tương - 0-0.02g', 'Uống 1 viên/ ngày, sau ăn 30 – 60 phút\r\nUống nhiều nước để hấp thu tốt hơn', 'Người biếng ăn hoặc đang cần kích thích cảm giác muốn ăn.\r\nNgười ít ăn rau, hoa quả do đó thiếu hụt vitamin, khoáng chất và chất xơ trong cơ thể.\r\nNgười có vấn đề về hệ tiêu hóa, hay táo bón, ăn không tiêu.\r\nNgười có sức đề kháng kém, hay cảm mạo, ốm vặt…\r\nLưu ý: Không sử dụng cho đối tượng dưới 7 tuổi, Phụ nữ mang thai và cho con bú tham khảo ý kiến bác sĩ trước khi sử dụng', '2024-08-13'),
('TH3', 'Men vi sinh BioAmicus Complete giúp bổ sung lợi khuẩn, tăng đề kháng lọ 10ml', 'TH3.jpg', 480000, 0, 4, 'Cải thiện và phòng ngừa táo bón\r\nKhắc phục tiêu chảy\r\nGiảm thiểu rối loạn tiêu hóa.', 'Thương hiệu: BioAmicus (Canada) \r\nNhà sản xuất: BioAmicus Laboratories Inc. \r\nNơi sản xuất: Canada\r\nDạng bào chế: Dung dịch uống', 'Trong 5 giọt chứa: Lactobacillus Gasseri 100 × 10ˆ6CFU, Lactobacillus Johnsonii 100 × 10ˆ6CFU, Lactobacillus Plantarum 100 × 10ˆ6CFU, Lactobacillus Reuteri 100 × 10ˆ6CFU, Lactobacillus Salivarius 100 × 10ˆ6CFU, Bifidobacterium bifidum 100 × 10ˆ6CFU, Bifidobacterium Breve 100 × 10ˆ6CFU, Bifidobacterium Longum 100 × 10ˆ6CFU, Bifidobacterium Longum subsp. Infantis 100 × 10ˆ6CFU, Bifidobacterium animalis subsp. Lactis 100 × 10ˆ6CFU. \r\nPhụ liệu: dầu hướng dương, chất béo trung tính chuỗi trung bình (medium chain triglyceride oil), Silicon dioxide.', 'Trẻ dưới 1 tuổi sử dụng theo hướng dẫn của bác sĩ (khuyến cáo dùng 5 giọt/lần, ngày dùng 1 lần).\r\nTrẻ em từ 1 - 12 tuổi, thiếu niên và người lớn dùng 5 giọt/lần, ngày dùng 2 lần.\r\nNếu đang dùng kháng sinh, hãy dùng ít nhất 2 - 3 giờ trước hoặc sau khi dùng kháng sinh.\r\nLắc kỹ trước khi sử dụng.\r\nKhông tiếp xúc đầu nhỏ giọt với bất kỳ chất lỏng nào bao gồm cả nước bọt.', 'Trẻ em bị rối loạn tiêu hoá với các triệu chứng như: tiêu chảy, phân sống, đầy bụng khó tiêu, táo bón.\r\nNgười dùng kháng sinh kéo dài gây loạn khuẩn đường một.\r\nNgười có nhu cầu bổ sung lợi khuẩn để hỗ trợ tiêu hoá và nâng cao sức đề kháng cho cơ thể.', '2024-11-02'),
('UT1', 'Nấm thái dương Agaricus Orihiro 432 viên', 'UT1.jpg', 855000, 799000, 216, 'Hỗ trợ điều trị ung thư, chống khối u di căn.\r\nCắt nguồn nuôi dưỡng khối u, thúc đẩy quá trình tự chết của khối u.\r\nKích hoạt hệ thống miễn dịch tiêu diệt mầm bệnh và khối u\r\nTăng sức đề kháng chống vi khuẩn, virus gây bệnh cơ hội\r\nPhòng chống các bệnh mãn tính', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên,432 viên/lọ\r\nTrọng lượng: 108g/ lọ', 'Chiết xuất nấm Agaricus blazei cô đặc 10 lần - 53 mg\r\n(tương đương 530 mg nấm Agaricus blazei), (chứa phức hợp protein polysaccharide 25 mg)	\r\nBột nấm Agaricus blazei - 63 mg\r\nBeta-glucan - 30 mg\r\n', 'Mỗi lần uống 4 viên, ngày 3 lần, trước hoặc sau mỗi bữa ăn.\r\nNên sử dụng sản phẩm trong vòng 3 tháng liên tục để đạt hiệu quả cao nhất.', 'Bệnh nhân đang điều trị ung thư\r\nBệnh nhân sau điều trị hóa xạ trị\r\nNgười có sức khỏe suy giảm.\r\nNgười có hệ miễn dịch kém.\r\nNgười mắc các bệnh lý tim mạch, mỡ máu, đường huyết cao.\r\nLưu ý: Không sử dụng cho phụ nữ đang mang thai và cho con bú, Không sử dụng cho người dưới 18 tuổi, Chống chỉ định với người mẫn cảm với bất kỳ thành phần nào trong sản phẩm.\r\n', '2024-06-27'),
('UT2', 'Tảo Fucoidan Orihiro 90 viên', 'UT2.png', 850000, 799000, 229, 'Hỗ trợ điều trị ung thư bằng cách tăng quá trình tự hủy của các khối u và cắt nguồn nuôi dưỡng khối u.\r\nTăng cường sức đề kháng, củng cố hệ miễn dịch.\r\nBồi bổ, duy trì sức khỏe, giảm mệt mỏi cho bệnh nhân ung thư.\r\nNâng cao chất lượng cuộc sống cho người mắc ung thư', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên, 90 viên\r\nTrọng lượng: 60g (2.0g x 30)', 'Trong 3 viên Tảo Fucoidan Orihiro chứa: Chiết xuất tảo nâu Mekabu 300 mg, trong đó chứa 80% Fucoidan.\r\nNgoài ra, trong 3 viên uống chứa hàm lượng dưỡng chất như sau: Calo - 3 kcal, Protein	 \r\n - 0.3g, Lipid - 0.03 g, Carbohydrate - 0.51 g, Muối - 0.02 g\r\n', 'Mỗi ngày uống 3 viên, có thể uống với nước thường hoặc nước ấm\r\nNên uống sau bữa ăn khoảng 30 phút \r\nKhông uống quá liều lượng mỗi ngày\r\nNên sử dụng sản phẩm liên tục trong vòng 3 tháng để đạt hiệu quả công dụng cao nhất.', 'Người bệnh đang điều trị ung thư.\r\nNgười bị suy giảm miễn dịch.\r\nNgười cần tăng cường sức khỏe của hệ miễn dịch\r\nLưu ý: Không sử dụng viên Tảo Fucoidan Orihiro cho các đối tượng sau: Phụ nữ có thai, người đang cho con bú và trẻ em, Người mẫn cảm với bất kỳ thành phần nào chứa trong sản phẩm\r\n', '2024-05-12'),
('V1', 'Bột rau xanh Aojiru bổ sung chất xơ Orihiro 30 gói', 'V1.jpg', 375000, 0, 243, 'Bổ sung chất xơ, vitamin cần thiết cho cơ thể\r\nThanh lọc, thải độc cơ thể\r\nCải thiện chức năng hệ tiêu hóa hiệu quả\r\nChống lão hóa, làm đẹp da', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng bột, 30 gói\r\nTrọng lượng: 60g (2.0g x 30)', 'Lá lúa mạch hữu cơ, bột matcha hữu cơ, sản phẩm phân hủy tinh bột, bột Moroheiya hữu cơ, bột nước ép xanh hữu cơ (lá dâu tằm hữu cơ, lá lúa mạch hữu cơ, cải xoăn hữu cơ, lá non hữu cơ)', 'Mỗi ngày 1 gói, pha với khoảng 100ml nước nóng\r\nNên khuấy đều và kĩ trước khi sử dụng để thưởng thức trọn vẹn hương vị thơm ngon của sản phẩm.', 'Những người lười ăn rau xanh và hoa quả\r\nNgười nóng bị trong. Người nổi mẩn, kích ứng, da cực kỳ mẫn cảm, …\r\nNhững người gặp vấn đề về tiêu hoá\r\nNgười bình thường cần tăng cường sức khỏe\r\nKhông sử dụng cho trẻ em\r\nPhụ nữ đang mang thai và cho con bú, đối tượng đang điều trị bệnh nên hỏi ý kiến bác sĩ, dược sĩ trước khi sử dụng', '2024-09-17'),
('V2', 'Viên nhai bổ sung Kẽm Orihiro Most Chewable 180 viên', 'V2.png', 277000, 0, 305, 'Tăng cường hệ miễn dịch\r\nCải thiện sức khỏe não bộ\r\nGiúp kích thích ăn và tạo cảm giác ngon miệng.\r\nGiúp xương da tóc móng chắc khỏe\r\nCải thiện các vấn đề về thị lực', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên nén, 180 viên/lọ\r\nTrọng lượng: 180g/ lọ (1g/ viên)', 'Kẽm - 2.0 mg\r\nVitamin B1 - 0.5 mg\r\nVitamin B2 - 0.6 mg\r\nVitamin B6 - 0.8 mg\r\nBiotin - 8 μg', 'Nhai 2 viên/ ngày. Có thể chia làm 1-2 lần.\r\nDùng với nước ấm sau khi ăn sáng và trưa khoảng 30 phút.\r\nKhông dùng chung kẽm với sắt, kháng sinh tetracyclin, penicilamin, chế phẩm chứa phospho.\r\nSử hấp thu của kẽm bị giảm khi dùng chung với các loại thực phẩm: bánh mì, trứng luộc, cà phê, sữa. Do đó, dùng cách xa kẽm với các loại trên.', 'Trẻ em trên 3 tuổi (có khả năng nhai nuốt tốt).\r\nNgười gặp các vấn đề về da, tóc, nội tiết tố\r\nNgười cao tuổi gặp các vấn đề về xương khớp\r\nNgười gặp các vấn đề về trí nhớ, tim mạch, huyết áp\r\nNgười bình thường muốn tăng cường sức khỏe.\r\nPhụ nữ có thai (thường bị nôn) và người cho con bú.\r\nNgười thực hiện chế độ ăn kiêng, nghèo chất dinh dưỡng.', '2024-07-23'),
('V3', 'Viên nhai bổ sung Sắt Acid Folic Orihiro Most Chewable Iron 180 viên', 'V3.png', 277000, 0, 160, 'Bổ sung sắt cho cơ thể, giúp tăng sản xuất hồng cầu, tăng vận chuyển oxy để thực hiện các chức năng sống của cơ thể.\r\nGiảm tình trạng đau đầu, hoa mắt, chóng mặt, thiếu máu lên não.\r\nHỗ trợ điều trị thiếu máu do thiếu sắt.', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên nang, 180 viên/ hộp', 'Sắt - 5 mg\r\nAcid Folic - 100 μg\r\nVitamin B6 - 0.3 mg\r\nVitamin B12 - 0.6 μg\r\nVitamin C - 25 mg', 'Sử dụng 2 viên/ ngày.\r\nNên nhai nát viên sắt trong miệng để cơ thể hấp thu hiệu quả nhất.', 'Phụ nữ mang thai và cho con bú\r\nNgười thiếu máu\r\nTrẻ em trên 3 tuổi (khả năng nhai nuốt tốt)', '2024-08-09'),
('V4', 'Viên nhai bổ sung Vitamin và khoáng chất Orihiro dạng túi 120 viên', 'V4.png', 187000, 0, 250, 'Bổ sung 11 loại vitamin và 6 loại khoáng chất cho cơ thể\r\nGiúp tăng cường sức khỏe toàn diện\r\nCung cấp năng lượng cho cơ thể hoạt động\r\nHỗ trợ bảo vệ tim mạch, phát triển hệ cơ xương', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên, 120 viên/ túi\r\nTrọng lượng: 1500mg x 120 viên ( 60g/ túi)', 'Trong 4 viên nhai bổ sung 6 khoáng chất và 11 vitamin chứa: Canxi - 80 mg, Magie - 40 mg, Sắt - 1.0 mg, Kẽm - 1.2 mg, Đồng - 0.1 mg, Selen - 4.0 μg, Vitamin A - 360 μg, Vitamin D - 2.8 μg, Vitamin B1 - 0.6 mg, Vitamin B2 - 0.42 – 1.0 mg, Vitamin B6 - 0.45 – 1.0 mg, Vitamin B12 - 1.2 μg, Vitamin C - 40 mg, Vitamin E - 4.0 mg, Vitamin B3 - 6.0 mg, Vitamin B5 - 2.8 mg, Acid folic - 120 μg', 'Trẻ em trên 10 tuổi và người lớn: 4 viên/ ngày, hiệu quả nhất dùng sau ăn sáng, nhai trực tiếp.\r\nTrẻ 3 tuổi – 10 tuổi: 2 viên/ngày, dùng sau ăn sáng, nhai trực tiếp, sau đó uống thêm nước để nuốt.\r\nLưu ý: với trẻ nhỏ cần phải có sự giám sát của người lớn khi sử dụng, tránh tình trạng bị hóc viên hoặc dùng quá số lượng.', 'Người cần bổ sung vitamin và khoáng chất cho cơ thể để bồi bổ sức khỏe\r\nNgười mới ốm dậy, sức đề kháng kém\r\nTrẻ trên 3 tuổi, cần bổ sung vitamin để phát triển\r\nNgười ăn kiêng, không cung cấp đủ chất dinh dưỡng\r\nNgười hay bị ốm vặt\r\nTrẻ suy dinh dưỡng, còi cọc, chậm lớn', '2024-08-14'),
('V5', 'Viên uống bổ sung vitamin D axit folic sắt Orihiro 120 viên', 'V5.png', 257000, 0, 220, 'Bổ sung sắt cho bà bầu, giúp tăng cường tạo máu nuôi dưỡng thai nhi\r\nBổ sung acid folic, giúp phát triển ống thần kinh của trẻ trong thai kỳ\r\nBổ sung vitamin D tăng cường hấp thu canxi\r\nBổ sung canxi cho mẹ bầu, phòng loãng xương sau thai kỳ', 'Xuất xứ: Nhật Bản\r\nNhà sản xuất: Orihiro\r\nQuy cách đóng gói: Dạng viên nén, 120 viên/ túi\r\nTrọng lượng: Mỗi viên 300mg (hộp 36g)\r\n', 'Canxi - 25 mg\r\nSắt - 3.4 mg\r\nVitamin C - 25 mg\r\nVitamin D - 18 μg\r\nAcid folic - 100 μg', 'Uống 1-2 viên/ ngày với nước ấm.', 'Sản phẩm phù hợp nhất với phụ nữ mang thai và cho con bú, bởi giai đoạn này họ cần bổ sung nhiều chất dinh dưỡng, đặc biệt là Sắt, Acid folic giúp tái tạo máu nuôi dưỡng thai nhi và phát triển ống thần kinh của trẻ. Ngoài ra, sản phẩm cũng có thể sử dụng cho những người cần bổ sung dưỡng chất. Đối tượng trẻ nhỏ nên dùng các loại chế phẩm bổ sung vitamin dạng viên nhai vị hoa quả sẽ tiện lợi hơn.', '2024-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `tentk` varchar(50) NOT NULL,
  `tendn` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sdt` varchar(10) NOT NULL,
  `diachi` varchar(200) NOT NULL,
  `matkhau` varchar(255) NOT NULL,
  `maxacnhan` int(9) NOT NULL,
  `isadmin` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`tentk`, `tendn`, `email`, `sdt`, `diachi`, `matkhau`, `maxacnhan`, `isadmin`) VALUES
('ADMIN', 'anhtuan1108', 'anhtuan6811@gmail.com', '0812336134', 'Hà Nội', '$2y$10$pm1jeCKSjdRU2HvFOGBpYeNl.iM1wX8OWOUo5tj/GUukS4Vcyxp3C', 0, 1),
('Ngọc Ánh', 'ngocanh7699', 'ngocanh99@gmail.com', '0874569321', 'Bắc Ninh', '$2y$10$cqP71Bp3Og0VfBBB9b8tDeB5uC3zhCuz6FczTrFpV6NU3LyLATf4m', 0, 0),
('Văn Thịnh', 'thinhbeo', 'vuvanthinh@gmail.com', '0987456323', 'Đình Tổ, Thuận Thành, Bắc Ninh', '$2y$10$781r6.TyE9WfBCpcYplVsuGUeuZ/wLAfW2fcm5wt2zVS054UaiNTK', 0, 0),
('Vân Anh', 'vananh1234', 'vtvanh6803@gmail.com', '0968745451', 'Lĩnh Nam, Hoàng Mai', '$2y$10$W0eUSPiRjX97RicHAAo/9eikmtuzUdzcoONK9b.mVa56KX2xjxS62', 0, 0),
('Vanh', 'vananhbeo', 'vuvananh2323@gmail.com', '0967493585', 'Bắc Ninh', '$2y$10$5AyqqnO8Wx2Cw/2sACegJ.BeP329dHei.GNQeRH7dXRyeo6/6zpLa', 0, 0),
('Admin2', 'vanhvanh', 'vanhvanh03@gmail.com', '0362145778', 'Hà Nội', '$2y$10$QB1s5gsHv16E63Bc4Ut4BekDj8LS.muQeZ9QbEbYipRyygSqGPbj.', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `madh` (`madh`),
  ADD KEY `masp` (`masp`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`madh`),
  ADD KEY `tendn` (`tendn`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masp` (`masp`),
  ADD KEY `tendn` (`tendn`);

--
-- Indexes for table `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tendn` (`tendn`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`tendn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `madh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`madh`) REFERENCES `donhang` (`madh`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`tendn`) REFERENCES `users` (`tendn`);

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`),
  ADD CONSTRAINT `giohang_ibfk_3` FOREIGN KEY (`tendn`) REFERENCES `users` (`tendn`);

--
-- Constraints for table `lienhe`
--
ALTER TABLE `lienhe`
  ADD CONSTRAINT `lienhe_ibfk_1` FOREIGN KEY (`tendn`) REFERENCES `users` (`tendn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
