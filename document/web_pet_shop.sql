-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2025 at 07:36 AM
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
-- Database: `web_pet_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `address_line` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `address_line`, `city`, `state`, `country`, `postal_code`) VALUES
(1, 2, 'Trịnh Văn Bô', 'Hà Nội', 'Từ Liêm', 'Việt Nam', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Chuột Hamster', NULL),
(2, 'Chó cảnh', NULL),
(3, 'Mèo cảnh', NULL),
(4, 'Vẹt cảnh', NULL),
(5, 'Thỏ cảnh', NULL),
(6, 'Bò sát cảnh', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `address_id` int DEFAULT NULL,
  `status` enum('Chưa xử lý','Đang xử lý','Đang vận chuyển','Đã giao','Đã hủy') COLLATE utf8mb4_general_ci DEFAULT 'Chưa xử lý',
  `total` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address_id`, `status`, `total`, `created_at`) VALUES
(6, 2, 1, 'Chưa xử lý', '630000.00', '2025-08-09 11:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(3, 6, 13, 20, '20000.00'),
(4, 6, 11, 10, '20000.00');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `method` enum('COD','Thanh toán bằng thẻ','QRCODE') COLLATE utf8mb4_general_ci DEFAULT 'COD',
  `status` enum('Đã thanh toán','Chưa thanh toán') COLLATE utf8mb4_general_ci DEFAULT 'Chưa thanh toán',
  `paid_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` double(10,0) NOT NULL DEFAULT '0',
  `category_id` int DEFAULT NULL,
  `main_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `main_image`, `created_at`) VALUES
(1, 'Chuột Hamster bear màu đẹp', 'HAMSTER BEAR MÀU TAM THỂ, ĐEN KHOANG TRẮNG, NÂU KHOANG TRẮNG, XÁM.. : 160K\r\nCHUỘT HAMSTER BEAR LÀ LOẠI HAMSTER CÓ KÍCH THƯỚC LỚN NHẤT, TÍNH CÁCH HIỀN LÀNH, THÂN THIỆN, CÓ THỂ BẾ CHƠI RẤT PHÙ HỢP VỚI MỌI LỨA TUỔI, NHỮNG NGƯỜI MỚI NUÔI.\r\n\r\n– Hamster bear có tên nước ngoài là hamster syrian – Có thể nói đây là loại hamster phổ biến nhất trên thế giới – Lựa chọn hàng đầu cho người lần đầu mua chuột hamster .\r\n\r\n– Chuột hamster bear là loại lớn nhất trưởng thành đạt 150g – 200g , nhưng tính cách lại đặc biệt hiền lành thân thiện nên phù hợp với bất kỳ ai kể cả trẻ em . Với thân hình lớn , Chuột hamster bear cũng có sức khỏe rất tốt , chăm sóc rất dễ dàng.\r\n\r\n– Hamster bear rất gần gũi với mọi người, điều này thể hiện ở chỗ nó có thể làm quen gần như ngay lập tức với những người lạ mà không tỏ ra bối rối hay sợ hãi.\r\n\r\n–  Khác với các loài chuột hamster khác, bear không thích các đồ ăn có đạm như sâu khô, chúng thường thích các loại cookie, hay các hạt ngũ cốc hơn.\r\n\r\n– Hamster bear là thiên tài trong việc chạy trốn, bạn nên đảm bảo rằng lồng của mình đủ chắc chắn không có khe hở quá to để bear không thể chui lọt hay gặm nhấm chỗ đó để trốn thoát. Do kích thước cơ thể lớn hơn các loại hamster khác nên răng khi phát triển cũng nhanh hơn các loại khác, bạn nên chuẩn bị một vài đồ nhai dành cho chúng nhé.\r\n\r\nBạn có thể tham khảo thêm thông tin cũng như cách chăm sóc trong mục Hướng dẫn nuôi chuột hamster, Lolipet đã tổng hợp thành các bài viết cho các bạn tham khảo rồi nhé. Hoặc bạn có thể liên hệ hay đến cửa hàng để được giải đáp.', 10000, 1, 'z4857310072695_728959d9bec5acddc5a04e389c77c113.jpg', '2025-08-02 10:00:50'),
(2, 'CHUỘT HAMSTER SOCOLA – CAMPELL (CẮN)', 'HAMSTER SOCOLA THUỘC DÒNG CAMPELL VÌ VẬY CHÚNG HƠI KHÓ LÀM QUEN 1 CHÚT , VÌ VẬY NHỮNG BẠN MỚI CHƠI CẦN CÓ SỰ CÂN NHẮC TRƯỚC KHI NUÔI DÒNG HAMSTER NÀY\r\n\r\nNguồn gốc :\r\n\r\n– Chuột hamster socola thuộc dòng campell. Chúng được đặt tên bởi Oldfield Thomas, người đã tìm thấy những con hamster campell đầu tiên ở Mông Cổ vào ngày 01 Tháng Bảy, 1902.\r\n\r\nĐặc điểm và tính cách :\r\n\r\n– Hamster socola có màu nâu sữa toàn thân, kích thước nhỏ, rất nhanh nhẹn nên chúng không cần không gian lớn để nuôi\r\n\r\n-Chuột hamster Socola thuộc dòng hamster campell nên khá dữ , Người nuôi cần có sự kiên nhẫn làm quen thời gian dài và kể cả nuôi lâu rồi vẫn có thể bị cắn khá đau đấy nhé.\r\n\r\nSinh sản :\r\n\r\n– Trong tự nhiên, mùa sinh sản cho chuột hamster socola thay đổi theo vị trí. Ví dụ, mùa sinh sản bắt đầu từ giữa tháng Tư tại Tuva và đến cuối tháng Tư ở Mông Cổ. Tuy nhiên, trong điều kiện nuôi trong gia đình, chúng không có mùa sinh sản cố định và có thể sinh thường xuyên trong suốt cả năm. Con cái thường thành thục khi hai tháng tuổi và giai đoạn thai kỳ thường là 20 ngày.\r\n\r\nTổng kết :\r\n\r\n– Hamster Socola  phù hợp với người nuôi lâu năm , thích sưu tập đầy đủ, có thời gian dành ra để làm quen, chơi với chúng. Hamster socola không phù hợp với những người nuôi là trẻ nhỏ vì đôi lúc chúng khá dữ tợn hay cắn người nếu không quen. Những người mới chơi hay có ý định mua chuột hamster socola cần cân nhắc điều này trước khi có ý định đón một bé về nhà.\r\n\r\nNếu bạn có những điều chưa hiểu, đừng ngại hãy liên hệ với Lolipet để nhận được những giải đáp về chuột hamster nhé !', 20000, 1, 'chuột-hamster-socola-21-600x450.jpg', '2025-08-02 10:00:50'),
(3, 'Vẹt Yến Phụng (Budgie)', 'Giới Thiệu Về Vẹt Yến Phụng (Budgie)\r\nThông Tin Chung\r\nVẹt Yến Phụng, hay còn được biết đến với tên tiếng Anh là Budgie còn ở có tên khác ở Việt Nam là Vẹt Hồng Kông , là một trong những loài chim cảnh phổ biến nhất trên thế giới. Với ngoại hình nhỏ nhắn, màu sắc sặc sỡ và tính cách dễ gần, Yến Phụng là sự lựa chọn tuyệt vời cho cả người mới bắt đầu và những người đã có kinh nghiệm nuôi chim cảnh. Loài vẹt này có nguồn gốc từ các vùng sa mạc ở Úc, nơi chúng sống theo bầy đàn và phát triển những kỹ năng sống đặc biệt để thích nghi với khí hậu khắc nghiệt.\r\n\r\nĐặc Điểm Hình Dáng\r\nVẹt Yến Phụng có kích thước nhỏ, chỉ từ 15-18 cm và nặng khoảng 30-40 gram. Chúng có đôi cánh mạnh mẽ, chiếc mỏ cong nhọn giúp dễ dàng mổ thức ăn. Màu sắc của Yến Phụng rất đa dạng, từ xanh lá, vàng, xanh dương, đến màu trắng và xám. Đặc biệt, trên đầu và cánh của chúng thường có các đường vằn đen giúp tạo nên vẻ ngoài rực rỡ và nổi bật. Đôi mắt đen tròn và chiếc mỏ cong đặc trưng giúp Yến Phụng trông dễ thương và thân thiện.\r\n\r\nTính Cách và Hành Vi\r\nVẹt Yến Phụng là loài chim thông minh, vui vẻ và rất dễ gần. Chúng thích giao tiếp và có thể bắt chước âm thanh, thậm chí học nói một số từ đơn giản nếu được luyện tập từ nhỏ. Yến Phụng thường rất thân thiện với con người và các loài chim khác, dễ dàng hòa nhập trong môi trường mới. Chúng yêu thích được chơi đùa và tương tác, đặc biệt là với những đồ chơi có màu sắc sặc sỡ và xích đu trong lồng. Với bản tính hoạt bát, Yến Phụng có thể mang đến nhiều niềm vui và tiếng cười cho chủ nhân.', 200000, 4, 'vet1.jpg', '2025-08-02 10:37:20'),
(4, 'Vẹt Cockatiel Lutino', 'Giới Thiệu về Vẹt Cockatiel Lutino tại LOLIPET\r\nThông Tin Chung\r\nVẹt Cockatiel Lutino là một trong những giống vẹt phổ biến và được yêu thích nhất, nổi bật với bộ lông màu vàng rực rỡ và tính cách thân thiện. Chúng có nguồn gốc từ Úc, nơi mà vẹt Cockatiel thường sinh sống trong các bầy đàn lớn. Với vẻ đẹp cuốn hút và sự hoạt bát, vẹt Cockatiel Lutino đã trở thành lựa chọn hàng đầu cho những người yêu thích chim cảnh.\r\n\r\nĐặc Điểm Hình Dáng\r\nVẹt Cockatiel Lutino có kích thước trung bình, khoảng 30 cm chiều dài và nặng từ 80-120 gram. Bộ lông của chúng chủ yếu có màu vàng rực rỡ, với các điểm nhấn màu cam trên má và những chiếc lông cánh có màu xám nhạt. Đặc biệt, phần mào của chúng có thể dựng đứng, tạo nên vẻ ngoài nổi bật và đáng yêu. Hình dáng thanh thoát và tinh tế của chúng khiến chúng trở thành một loài chim rất hấp dẫn.\r\n\r\nTính Cách và Hành Vi\r\nVẹt Cockatiel Lutino nổi tiếng với tính cách hiền hòa và thân thiện. Chúng rất xã hội và thích giao tiếp với con người cũng như với các loài chim khác. Khả năng bắt chước âm thanh và giọng nói khiến chúng trở thành những người bạn đồng hành thú vị. Tuy nhiên, vẹt Cockatiel cũng cần được xã hội hóa và tương tác thường xuyên để phát triển tính cách vui vẻ và không trở nên nhút nhát.\r\n\r\nChế Độ Dinh Dưỡng\r\nĐể đảm bảo sức khỏe cho Vẹt Cockatiel Lutino, chế độ dinh dưỡng cân bằng là rất quan trọng. Chúng cần một chế độ ăn đa dạng bao gồm:\r\n\r\nHạt giống chuyên dụng cho Cockatiel\r\nTrái cây tươi như táo, chuối và dâu tây\r\nRau xanh như cải xoăn, bông cải xanh và cà rốt\r\nCác loại thức ăn bổ sung để cung cấp vitamin và khoáng chất cần thiết\r\nĐảm bảo rằng chúng luôn có nước sạch để uống và thực phẩm tươi mới để duy trì sức khỏe tốt nhất.', 300000, 4, 'lutino-cockatiel.jpg', '2025-08-02 10:38:47'),
(5, 'THỎ MINILOP ĐỐM', 'THỎ MINILOP ĐỐM', 900000, 5, 'tho1.jpeg', '2025-08-02 10:47:17'),
(7, 'THỎ MINILOP ĐỐM', 'THỎ MINILOP ĐỐM', 900000, 5, 'img-5830-jpg.webp', '2025-08-02 10:47:17'),
(8, 'THỎ MINILOP ĐỐM', 'THỎ MINILOP ĐỐM', 900000, 5, 'image28-1660878449-306-width2048height1357.jpg', '2025-08-02 10:47:17'),
(9, 'Vẹt Cockatiel Lutino', 'Giới Thiệu về Vẹt Cockatiel Lutino tại LOLIPET\r\nThông Tin Chung\r\nVẹt Cockatiel Lutino là một trong những giống vẹt phổ biến và được yêu thích nhất, nổi bật với bộ lông màu vàng rực rỡ và tính cách thân thiện. Chúng có nguồn gốc từ Úc, nơi mà vẹt Cockatiel thường sinh sống trong các bầy đàn lớn. Với vẻ đẹp cuốn hút và sự hoạt bát, vẹt Cockatiel Lutino đã trở thành lựa chọn hàng đầu cho những người yêu thích chim cảnh.\r\n\r\nĐặc Điểm Hình Dáng\r\nVẹt Cockatiel Lutino có kích thước trung bình, khoảng 30 cm chiều dài và nặng từ 80-120 gram. Bộ lông của chúng chủ yếu có màu vàng rực rỡ, với các điểm nhấn màu cam trên má và những chiếc lông cánh có màu xám nhạt. Đặc biệt, phần mào của chúng có thể dựng đứng, tạo nên vẻ ngoài nổi bật và đáng yêu. Hình dáng thanh thoát và tinh tế của chúng khiến chúng trở thành một loài chim rất hấp dẫn.\r\n\r\nTính Cách và Hành Vi\r\nVẹt Cockatiel Lutino nổi tiếng với tính cách hiền hòa và thân thiện. Chúng rất xã hội và thích giao tiếp với con người cũng như với các loài chim khác. Khả năng bắt chước âm thanh và giọng nói khiến chúng trở thành những người bạn đồng hành thú vị. Tuy nhiên, vẹt Cockatiel cũng cần được xã hội hóa và tương tác thường xuyên để phát triển tính cách vui vẻ và không trở nên nhút nhát.\r\n\r\nChế Độ Dinh Dưỡng\r\nĐể đảm bảo sức khỏe cho Vẹt Cockatiel Lutino, chế độ dinh dưỡng cân bằng là rất quan trọng. Chúng cần một chế độ ăn đa dạng bao gồm:\r\n\r\nHạt giống chuyên dụng cho Cockatiel\r\nTrái cây tươi như táo, chuối và dâu tây\r\nRau xanh như cải xoăn, bông cải xanh và cà rốt\r\nCác loại thức ăn bổ sung để cung cấp vitamin và khoáng chất cần thiết\r\nĐảm bảo rằng chúng luôn có nước sạch để uống và thực phẩm tươi mới để duy trì sức khỏe tốt nhất.', 300000, 4, 'lutino-cockatiel.jpg', '2025-08-02 10:38:47'),
(10, 'Vẹt Yến Phụng (Budgie)', 'Giới Thiệu Về Vẹt Yến Phụng (Budgie)\r\nThông Tin Chung\r\nVẹt Yến Phụng, hay còn được biết đến với tên tiếng Anh là Budgie còn ở có tên khác ở Việt Nam là Vẹt Hồng Kông , là một trong những loài chim cảnh phổ biến nhất trên thế giới. Với ngoại hình nhỏ nhắn, màu sắc sặc sỡ và tính cách dễ gần, Yến Phụng là sự lựa chọn tuyệt vời cho cả người mới bắt đầu và những người đã có kinh nghiệm nuôi chim cảnh. Loài vẹt này có nguồn gốc từ các vùng sa mạc ở Úc, nơi chúng sống theo bầy đàn và phát triển những kỹ năng sống đặc biệt để thích nghi với khí hậu khắc nghiệt.\r\n\r\nĐặc Điểm Hình Dáng\r\nVẹt Yến Phụng có kích thước nhỏ, chỉ từ 15-18 cm và nặng khoảng 30-40 gram. Chúng có đôi cánh mạnh mẽ, chiếc mỏ cong nhọn giúp dễ dàng mổ thức ăn. Màu sắc của Yến Phụng rất đa dạng, từ xanh lá, vàng, xanh dương, đến màu trắng và xám. Đặc biệt, trên đầu và cánh của chúng thường có các đường vằn đen giúp tạo nên vẻ ngoài rực rỡ và nổi bật. Đôi mắt đen tròn và chiếc mỏ cong đặc trưng giúp Yến Phụng trông dễ thương và thân thiện.\r\n\r\nTính Cách và Hành Vi\r\nVẹt Yến Phụng là loài chim thông minh, vui vẻ và rất dễ gần. Chúng thích giao tiếp và có thể bắt chước âm thanh, thậm chí học nói một số từ đơn giản nếu được luyện tập từ nhỏ. Yến Phụng thường rất thân thiện với con người và các loài chim khác, dễ dàng hòa nhập trong môi trường mới. Chúng yêu thích được chơi đùa và tương tác, đặc biệt là với những đồ chơi có màu sắc sặc sỡ và xích đu trong lồng. Với bản tính hoạt bát, Yến Phụng có thể mang đến nhiều niềm vui và tiếng cười cho chủ nhân.', 200000, 4, 'vet1.jpg', '2025-08-02 10:37:20'),
(11, 'CHUỘT HAMSTER SOCOLA – CAMPELL (CẮN)', 'HAMSTER SOCOLA THUỘC DÒNG CAMPELL VÌ VẬY CHÚNG HƠI KHÓ LÀM QUEN 1 CHÚT , VÌ VẬY NHỮNG BẠN MỚI CHƠI CẦN CÓ SỰ CÂN NHẮC TRƯỚC KHI NUÔI DÒNG HAMSTER NÀY\r\n\r\nNguồn gốc :\r\n\r\n– Chuột hamster socola thuộc dòng campell. Chúng được đặt tên bởi Oldfield Thomas, người đã tìm thấy những con hamster campell đầu tiên ở Mông Cổ vào ngày 01 Tháng Bảy, 1902.\r\n\r\nĐặc điểm và tính cách :\r\n\r\n– Hamster socola có màu nâu sữa toàn thân, kích thước nhỏ, rất nhanh nhẹn nên chúng không cần không gian lớn để nuôi\r\n\r\n-Chuột hamster Socola thuộc dòng hamster campell nên khá dữ , Người nuôi cần có sự kiên nhẫn làm quen thời gian dài và kể cả nuôi lâu rồi vẫn có thể bị cắn khá đau đấy nhé.\r\n\r\nSinh sản :\r\n\r\n– Trong tự nhiên, mùa sinh sản cho chuột hamster socola thay đổi theo vị trí. Ví dụ, mùa sinh sản bắt đầu từ giữa tháng Tư tại Tuva và đến cuối tháng Tư ở Mông Cổ. Tuy nhiên, trong điều kiện nuôi trong gia đình, chúng không có mùa sinh sản cố định và có thể sinh thường xuyên trong suốt cả năm. Con cái thường thành thục khi hai tháng tuổi và giai đoạn thai kỳ thường là 20 ngày.\r\n\r\nTổng kết :\r\n\r\n– Hamster Socola  phù hợp với người nuôi lâu năm , thích sưu tập đầy đủ, có thời gian dành ra để làm quen, chơi với chúng. Hamster socola không phù hợp với những người nuôi là trẻ nhỏ vì đôi lúc chúng khá dữ tợn hay cắn người nếu không quen. Những người mới chơi hay có ý định mua chuột hamster socola cần cân nhắc điều này trước khi có ý định đón một bé về nhà.\r\n\r\nNếu bạn có những điều chưa hiểu, đừng ngại hãy liên hệ với Lolipet để nhận được những giải đáp về chuột hamster nhé !', 20000, 1, 'chuột-hamster-socola-21-600x450.jpg', '2025-08-02 10:00:50'),
(12, 'CHUỘT HAMSTER SOCOLA – CAMPELL (CẮN)', 'HAMSTER SOCOLA THUỘC DÒNG CAMPELL VÌ VẬY CHÚNG HƠI KHÓ LÀM QUEN 1 CHÚT , VÌ VẬY NHỮNG BẠN MỚI CHƠI CẦN CÓ SỰ CÂN NHẮC TRƯỚC KHI NUÔI DÒNG HAMSTER NÀY\r\n\r\nNguồn gốc :\r\n\r\n– Chuột hamster socola thuộc dòng campell. Chúng được đặt tên bởi Oldfield Thomas, người đã tìm thấy những con hamster campell đầu tiên ở Mông Cổ vào ngày 01 Tháng Bảy, 1902.\r\n\r\nĐặc điểm và tính cách :\r\n\r\n– Hamster socola có màu nâu sữa toàn thân, kích thước nhỏ, rất nhanh nhẹn nên chúng không cần không gian lớn để nuôi\r\n\r\n-Chuột hamster Socola thuộc dòng hamster campell nên khá dữ , Người nuôi cần có sự kiên nhẫn làm quen thời gian dài và kể cả nuôi lâu rồi vẫn có thể bị cắn khá đau đấy nhé.\r\n\r\nSinh sản :\r\n\r\n– Trong tự nhiên, mùa sinh sản cho chuột hamster socola thay đổi theo vị trí. Ví dụ, mùa sinh sản bắt đầu từ giữa tháng Tư tại Tuva và đến cuối tháng Tư ở Mông Cổ. Tuy nhiên, trong điều kiện nuôi trong gia đình, chúng không có mùa sinh sản cố định và có thể sinh thường xuyên trong suốt cả năm. Con cái thường thành thục khi hai tháng tuổi và giai đoạn thai kỳ thường là 20 ngày.\r\n\r\nTổng kết :\r\n\r\n– Hamster Socola  phù hợp với người nuôi lâu năm , thích sưu tập đầy đủ, có thời gian dành ra để làm quen, chơi với chúng. Hamster socola không phù hợp với những người nuôi là trẻ nhỏ vì đôi lúc chúng khá dữ tợn hay cắn người nếu không quen. Những người mới chơi hay có ý định mua chuột hamster socola cần cân nhắc điều này trước khi có ý định đón một bé về nhà.\r\n\r\nNếu bạn có những điều chưa hiểu, đừng ngại hãy liên hệ với Lolipet để nhận được những giải đáp về chuột hamster nhé !', 20000, 1, 'b1fd38bf-1159-4e03-a6d8-aec173213c28.jpg', '2025-08-02 10:00:50'),
(13, 'CHUỘT HAMSTER SOCOLA – CAMPELL (CẮN)', 'HAMSTER SOCOLA THUỘC DÒNG CAMPELL VÌ VẬY CHÚNG HƠI KHÓ LÀM QUEN 1 CHÚT , VÌ VẬY NHỮNG BẠN MỚI CHƠI CẦN CÓ SỰ CÂN NHẮC TRƯỚC KHI NUÔI DÒNG HAMSTER NÀY\r\n\r\nNguồn gốc :\r\n\r\n– Chuột hamster socola thuộc dòng campell. Chúng được đặt tên bởi Oldfield Thomas, người đã tìm thấy những con hamster campell đầu tiên ở Mông Cổ vào ngày 01 Tháng Bảy, 1902.\r\n\r\nĐặc điểm và tính cách :\r\n\r\n– Hamster socola có màu nâu sữa toàn thân, kích thước nhỏ, rất nhanh nhẹn nên chúng không cần không gian lớn để nuôi\r\n\r\n-Chuột hamster Socola thuộc dòng hamster campell nên khá dữ , Người nuôi cần có sự kiên nhẫn làm quen thời gian dài và kể cả nuôi lâu rồi vẫn có thể bị cắn khá đau đấy nhé.\r\n\r\nSinh sản :\r\n\r\n– Trong tự nhiên, mùa sinh sản cho chuột hamster socola thay đổi theo vị trí. Ví dụ, mùa sinh sản bắt đầu từ giữa tháng Tư tại Tuva và đến cuối tháng Tư ở Mông Cổ. Tuy nhiên, trong điều kiện nuôi trong gia đình, chúng không có mùa sinh sản cố định và có thể sinh thường xuyên trong suốt cả năm. Con cái thường thành thục khi hai tháng tuổi và giai đoạn thai kỳ thường là 20 ngày.\r\n\r\nTổng kết :\r\n\r\n– Hamster Socola  phù hợp với người nuôi lâu năm , thích sưu tập đầy đủ, có thời gian dành ra để làm quen, chơi với chúng. Hamster socola không phù hợp với những người nuôi là trẻ nhỏ vì đôi lúc chúng khá dữ tợn hay cắn người nếu không quen. Những người mới chơi hay có ý định mua chuột hamster socola cần cân nhắc điều này trước khi có ý định đón một bé về nhà.\r\n\r\nNếu bạn có những điều chưa hiểu, đừng ngại hãy liên hệ với Lolipet để nhận được những giải đáp về chuột hamster nhé !', 20000, 1, '1_8Js7cOCxnJIGT8Nfrk288g_NBAH.jpg', '2025-08-02 10:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('customer','admin') COLLATE utf8mb4_general_ci DEFAULT 'customer',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$zA40KufIDXWkvoG/0/u.W.MuQ7U/evv2odFbTySyRqkRI99k6KSoC', '0123456789', 'admin', '2025-08-01 15:56:23'),
(2, 'Nguyễn Đức Trung', 'TrungND87@fpt.edu.vn', '$2y$10$PR6ZJTpTI2Dt1lj/RVBWkeqRin5MrUUlZIbjuTKH3XKiTi/DuAjsS', '09123123123', 'customer', '2025-08-01 15:57:34'),
(4, 'test1', 'test1@gmail.com', '$2y$10$p8E4R6H1MiUX8eepKnqezOM2rBXLvfZJp.k9qmnrQAOi9eHB3397K', '0145682222', 'customer', '2025-08-01 15:59:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
