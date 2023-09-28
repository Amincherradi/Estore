-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 04, 2023 at 02:57 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FName` varchar(255) NOT NULL,
  `LName` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserImg` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `FName`, `LName`, `Username`, `Email`, `Password`, `UserImg`) VALUES
(1, 'Cherradi', 'Amine', 'Admin@amin', 'aminecherradi99@gmail.com', 'admin', 'amine.jpg'),
(3, 'wiam', 'Oudhem', 'admin@wiam', 'oudhemw@gmail.com', 'wiamW@admin', 'wiam.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `Id_category` int(11) NOT NULL AUTO_INCREMENT,
  `Image_category` varchar(255) NOT NULL,
  `Title_category` varchar(255) NOT NULL,
  `Status_category` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Id_category`, `Image_category`, `Title_category`, `Status_category`) VALUES
(1, 'Tops.png', 'Tops', 'Active'),
(2, 'Tshirts.png', 'Tshirts', 'Active'),
(3, 'Jackets.png', 'Jackets', 'Active'),
(4, 'Bottoms.png', 'Bottoms', 'Active'),
(6, 'Accs2.png', 'Accessories', 'Active'),
(7, 'Shoes.png', 'Shoes', 'Active'),
(8, 'alt.jpg', 'Tesy', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `CouponID` int(11) NOT NULL AUTO_INCREMENT,
  `CouponCode` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Discount` int(11) NOT NULL,
  `Status` varchar(250) CHARACTER SET utf8 NOT NULL,
  `DateCreate` date NOT NULL,
  `DateUpdate` date NOT NULL,
  PRIMARY KEY (`CouponID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`CouponID`, `CouponCode`, `Discount`, `Status`, `DateCreate`, `DateUpdate`) VALUES
(1, 'Discount10', 10, 'Active', '2023-06-05', '2023-06-05'),
(2, 'Discount20', 20, 'Active', '2023-06-05', '2023-06-05'),
(3, 'Discount30', 30, 'Inactive', '2023-06-05', '2023-06-05'),
(4, 'Discount40', 40, 'Active', '2023-06-11', '2023-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `FName` varchar(255) NOT NULL,
  `LName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Adress` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `State` varchar(250) DEFAULT NULL,
  `ZipCode` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `CStatus` varchar(255) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `RevID` int(11) DEFAULT NULL,
  `DateCreate` varchar(250) NOT NULL,
  `DateUpdate` varchar(250) NOT NULL,
  PRIMARY KEY (`CustomerID`),
  KEY `fk_customer` (`OrderID`),
  KEY `fk_revcus` (`RevID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `FName`, `LName`, `Email`, `Phone`, `Adress`, `City`, `State`, `ZipCode`, `Password`, `Photo`, `CStatus`, `OrderID`, `RevID`, `DateCreate`, `DateUpdate`) VALUES
(1, 'Amine', 'Cherradi', 'aminecherradi99@gmail.com', '0671750088', '13 appt 14 rue tizi ayach', 'Al Hoceima', NULL, '32000', '2692af267889e28e0c1f464f317ade9d', 'amine.jpg', 'Activated', NULL, NULL, '2023-01-23 02:05:12', '2023-06-09 14:43:10'),
(2, 'Amine', 'Younsi', 'aminecherradi@gmail.com', '0671750088', '13 appt 14', 'Al Hoceima', NULL, '32000', '2692af267889e28e0c1f464f317ade9d', 'Capture.PNG', 'Activated', NULL, NULL, '2023-06-10 22:22:17', '2023-06-10 22:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `InvoiceID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderID` int(11) NOT NULL,
  `StatusInv` varchar(255) NOT NULL,
  `DateCreateInv` date NOT NULL,
  PRIMARY KEY (`InvoiceID`),
  KEY `fk_inv` (`OrderID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`InvoiceID`, `OrderID`, `StatusInv`, `DateCreateInv`) VALUES
(1, 1, 'Paid', '2023-06-10'),
(2, 2, 'Paid', '2023-06-10'),
(3, 3, 'Paid', '2023-06-10'),
(4, 4, 'Paid', '2023-06-10'),
(5, 5, 'Paid', '2023-06-10'),
(6, 6, 'Paid', '2023-06-10'),
(7, 7, 'Paid', '2023-06-10'),
(8, 8, 'Paid', '2023-06-11'),
(9, 9, 'Paid', '2023-06-12'),
(10, 10, 'Paid', '2023-06-12'),
(11, 11, 'Paid', '2023-06-12'),
(12, 12, 'Paid', '2023-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `LogID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `CustomerEmail` varchar(255) NOT NULL,
  `Activity` varchar(255) NOT NULL,
  `DateTime` varchar(255) NOT NULL,
  PRIMARY KEY (`LogID`),
  KEY `fk_logs` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`LogID`, `CustomerID`, `CustomerEmail`, `Activity`, `DateTime`) VALUES
(1, 1, 'aminecherradi99@gmail.com', 'Updated Image', '2023-05-28 19:28:12'),
(2, 1, 'aminecherradi99@gmail.com', 'Add Review on product id =12 Comment : gREAT SCRUF', '2023-02-01 17:34:12'),
(5, 1, 'aminecherradi99@gmail.com', 'Updated Profil Settings', '2023-02-05 00:19:53'),
(6, 1, 'aminecherradi99@gmail.com', 'Add Review on product id =1 Comment : Nice', '2023-06-09 01:50:49'),
(7, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=3TS9FVDUL7 Order Number : 1', '2023-06-09 05:03:16'),
(8, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=N4CLTQ29WA Order Number : 2', '2023-06-09 05:10:39'),
(9, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=U7E10LAD9Y Order Number : 6', '2023-06-09 13:04:01'),
(10, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=FQT70GL1C4 Order Number : 1', '2023-06-09 13:09:25'),
(11, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=52NH6XUG0O Order Number : 2', '2023-06-09 14:04:02'),
(12, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=D37SM02VT5 Order Number : 3', '2023-06-09 14:12:45'),
(13, 1, 'aminecherradi99@gmail.com', 'Password Updated from (ch.20000) to (123456789) ', '2023-06-09 14:31:42'),
(14, 1, 'aminecherradi99@gmail.com', 'Password Updated from (123456789) to (ch.20000) ', '2023-06-09 14:31:55'),
(15, 1, 'aminecherradi99@gmail.com', 'Updated Profil Settings', '2023-06-09 14:33:43'),
(16, 1, 'aminecherradi99@gmail.com', 'Updated Profil Settings', '2023-06-09 14:43:10'),
(17, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=JWZ8E7ULPQ Order Number : 4', '2023-06-09 14:46:25'),
(18, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=QOSKWB2DFV Order Number : 1', '2023-06-10 17:43:01'),
(19, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=FI3XDSH1TK Order Number : 2', '2023-06-10 17:44:20'),
(20, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=ZSIP6RXVM1 Order Number : 3', '2023-06-10 19:22:34'),
(21, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=NS3IPAODCH Order Number : 4', '2023-06-10 19:26:31'),
(22, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=EARN5XM062 Order Number : 5', '2023-06-10 19:45:05'),
(23, 2, 'aminecherradi@gmail.com', 'Updated Image', '2023-06-10 22:23:04'),
(24, 2, 'aminecherradi@gmail.com', 'Updated Profil Settings', '2023-06-10 22:23:55'),
(25, 2, 'aminecherradi@gmail.com', 'Updated Profil Settings', '2023-06-10 22:24:06'),
(26, 2, 'aminecherradi@gmail.com', 'Order Products TransactionID=BYX9UFIDQ7 Order Number : 6', '2023-06-10 22:24:39'),
(27, 2, 'aminecherradi@gmail.com', 'Order Products TransactionID=Z7JSA3L29R Order Number : 7', '2023-06-10 23:01:47'),
(28, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=XR3QKB7WP2 Order Number : 8', '2023-06-11 22:02:38'),
(29, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=1VQS9L6UDP Order Number : 9', '2023-06-12 14:30:22'),
(30, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=SM8W2XO7Q3 Order Number : 10', '2023-06-12 19:05:42'),
(31, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=B25I16Q3A9 Order Number : 11', '2023-06-12 19:26:11'),
(32, 1, 'aminecherradi99@gmail.com', 'Order Products TransactionID=GYJHKS06F7 Order Number : 12', '2023-06-15 00:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `MessageID` int(11) NOT NULL AUTO_INCREMENT,
  `Name_msg` varchar(255) NOT NULL,
  `Email_msg` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL,
  PRIMARY KEY (`MessageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `TransactionID` varchar(255) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `CustomerID` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `TransactionID`, `CustomerID`, `Status`, `OrderDate`) VALUES
(1, 'QOSKWB2DFV', 1, 'Shipped', '2023-06-10 17:43:01'),
(2, 'FI3XDSH1TK', 1, 'Shipped', '2023-06-10 17:44:20'),
(3, 'ZSIP6RXVM1', 1, 'Expired', '2023-06-10 19:22:34'),
(4, 'NS3IPAODCH', 1, 'Pending', '2023-06-10 19:26:31'),
(5, 'EARN5XM062', 1, 'Pending', '2023-06-10 19:45:05'),
(6, 'BYX9UFIDQ7', 2, 'Shipped', '2023-06-10 22:24:39'),
(7, 'Z7JSA3L29R', 2, 'Shipped', '2023-06-10 23:01:47'),
(8, 'XR3QKB7WP2', 1, 'Expired', '2023-06-11 22:02:38'),
(9, '1VQS9L6UDP', 1, 'Shipped', '2023-06-12 14:30:22'),
(10, 'SM8W2XO7Q3', 1, 'Pending', '2023-06-12 19:05:42'),
(11, 'B25I16Q3A9', 1, 'Pending', '2023-06-12 19:26:11'),
(12, 'GYJHKS06F7', 1, 'Pending', '2023-06-15 00:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `ordersummary`
--

DROP TABLE IF EXISTS `ordersummary`;
CREATE TABLE IF NOT EXISTS `ordersummary` (
  `OrderSummaryID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `ProductPrice` double DEFAULT NULL,
  PRIMARY KEY (`OrderSummaryID`),
  KEY `OrderID` (`OrderID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordersummary`
--

INSERT INTO `ordersummary` (`OrderSummaryID`, `OrderID`, `ProductID`, `Quantity`, `ProductPrice`) VALUES
(1, 1, 7, 1, 110),
(2, 1, 8, 1, 400),
(4, 2, 10, 1, 200),
(5, 2, 12, 1, 80),
(6, 2, 13, 1, 150),
(7, 3, 8, 1, 400),
(8, 3, 9, 1, 190),
(10, 4, 5, 1, 80),
(11, 5, 6, 1, 280),
(12, 5, 5, 1, 80),
(13, 5, 7, 1, 110),
(14, 6, 7, 1, 110),
(15, 6, 11, 1, 280),
(17, 7, 7, 1, 110),
(18, 7, 9, 1, 190),
(20, 8, 7, 1, 110),
(21, 8, 1, 1, 150),
(23, 9, 2, 1, 140),
(24, 10, 1, 1, 150),
(25, 10, 13, 1, 150),
(26, 10, 8, 1, 400),
(27, 11, 1, 1, 150),
(28, 11, 7, 1, 110),
(29, 12, 1, 1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `Product_id` int(11) NOT NULL AUTO_INCREMENT,
  `Product_name` varchar(255) NOT NULL,
  `Product_Category` int(11) NOT NULL,
  `Product_Disc` varchar(1000) NOT NULL,
  `Product_Size` varchar(255) NOT NULL,
  `PGender` varchar(250) NOT NULL,
  `Product_Price` double NOT NULL,
  `Stock` int(11) NOT NULL,
  `Product_img1` varchar(255) NOT NULL,
  `Product_img2` varchar(255) NOT NULL,
  `Product_img3` varchar(255) NOT NULL,
  `Product_Status` varchar(255) NOT NULL,
  `DateProdCreation` varchar(255) NOT NULL,
  `Date_Update` varchar(255) NOT NULL,
  PRIMARY KEY (`Product_id`),
  KEY `fk_categ` (`Product_Category`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Product_id`, `Product_name`, `Product_Category`, `Product_Disc`, `Product_Size`, `PGender`, `Product_Price`, `Stock`, `Product_img1`, `Product_img2`, `Product_img3`, `Product_Status`, `DateProdCreation`, `Date_Update`) VALUES
(1, 'DAZY Contrast Piping Drop Shoulder Zipper Drawstring Thermal Hoodie', 1, 'Color:	Grey\r\nStyle:	Casual\r\nPattern Type:	Plain\r\nDetails:	Zipper\r\nType:	Zip Up\r\nNeckline:	Hooded\r\nSleeve Length:	Long Sleeve\r\nSleeve Type:	Drop Shoulder\r\nLength:	Long\r\nFit Type:	Oversized\r\nFabric:	Medium Stretch, Slight Stretch\r\nMaterial:	Fabric\r\nComposition:	70% Polyester, 30% Cotton\r\nCare Instructions:	Machine wash, do not dry clean\r\nLined For Added Warmth:	Yes\r\nSheer:	No', 'L', 'Women', 150, 10, '1658813533dfbcfa5b19d4e8956d76014dc0b10bc0.webp', '1662374221c4a35a63c55ae45426b32e479a5e99f9.webp', '16588135362c4477483e4aa0a56772fe8bbafb7752.webp', 'Active', '2023-01-15 21:21:15', '2023-01-22 14:47:42'),
(2, 'Extended Sizes Men Wave & Chinese Dragon Graphic Shirt Without Tee', 2, 'Color:	Black\r\nStyle:	Street\r\nPattern Type:	Animal, Graphic\r\nType:	Shirt\r\nSleeve Length:	Three Quarter Length Sleeve\r\nSleeve Type:	Drop Shoulder\r\nLength:	Regular\r\nFit Type:	Oversized\r\nFabric:	Non-Stretch\r\nMaterial:	Woven Fabric\r\nComposition:	92% Polyester, 8% Elastane\r\nCare Instructions:	Machine wash or professional dry clean\r\nSheer:	No', 'L', 'Men', 140, 10, '1653273356678ba829bab863a02d16821374f1c248_thumbnail_900x.webp', '1653273358e7b084e368b4cae40b9cb85ef1b5dea7_thumbnail_900x.webp', '16532733608b487d3efd3bfee6aba4834a9246d373_thumbnail_900x.webp', 'Active', '2023-01-16 03:23:42', '2023-01-16 03:23:42'),
(3, 'DAZY Men Flap Detail Jacket', 3, 'Color:	Khaki\r\nStyle:	Casual\r\nPattern Type:	Plain\r\nDetails:	Pocket, Button Front\r\nType:	Other\r\nNeckline:	Collar\r\nSleeve Length:	Long Sleeve\r\nSleeve Type:	Regular Sleeve\r\nLength:	Regular\r\nPlacket:	Single Breasted\r\nFit Type:	Regular Fit\r\nFabric:	Non-Stretch\r\nMaterial:	Denim\r\nComposition:	100% Cotton\r\nCare Instructions:	Machine wash, do not dry clean\r\nSheer:	No', 'L', 'Men', 400, 10, '1672389022e3e29edaf4b1ad82b10fbd184dfc6d47_thumbnail_900x.webp', '16723890108a1b1bc6af534b6f20bd48bfa4d42fbe_thumbnail_900x.webp', '16723890064b567473b6ba96c96b01df8579f07f38_thumbnail_900x.webp', 'Active', '2023-01-16 03:26:02', '2023-01-16 03:26:02'),
(4, 'Men Letter Graphic Straight Leg Jeans', 4, 'Color:	White\r\nPattern Type:	Letter\r\nDetails:	Pocket, Zipper\r\nType:	Straight Leg\r\nClosure Type:	Zipper Fly\r\nWaist Line:	Natural\r\nLength:	Long\r\nFit Type:	Regular Fit\r\nFabric:	Non-Stretch\r\nMaterial:	Denim\r\nComposition:	100% Cotton\r\nCare Instructions:	Machine wash, do not dry clean\r\nBody:	Unlined\r\nSheer:	No', 'L', 'Men', 300, 10, '1672202624973c7196f66b8163fa5588dadf30bc11_thumbnail_900x.webp', '16722026226980c5955435cf181dcd3e9d2d042ab0_thumbnail_900x.webp', '167220263061e8877a2031f30ff0e4074aeaea581e_thumbnail_900x.webp', 'Active', '2023-01-16 04:46:06', '2023-01-16 04:46:06'),
(5, 'Men Square Rimless Fashion Glasses', 6, 'WARNING: Fashion Glasses. Not to be worn outside to protect the eyes against strong sunlight. Not designed or intended for use in play by children\r\nColor:	Navy Blue\r\nShape:	Square\r\nMaterial:	Zinc Alloy', 'None', 'Men', 80, 10, '1654498268f5547d4edc92b75636a51ce2eb3713c2_thumbnail_900x.webp', '16544982662a75a8b68015443c033263f3588118c0_thumbnail_900x.webp', '16544982696aebd13c2da916d12f8bb71eb9f7c796_thumbnail_900x.webp', 'Active', '2023-01-17 01:03:25', '2023-01-17 01:03:25'),
(6, 'Men Letter Patch Decor Lace-up Front Skate Shoes', 7, 'Color:	White\r\nStrap Type:	Lace Up\r\nPattern Type:	Letter\r\nToe:	Round Toe\r\nType:	Skate Shoes\r\nUpper Material:	PU Leather\r\nLining Material:	Mesh\r\nInsole Material:	Mesh\r\nOutsole Material:	EVA', 'None', 'Men', 280, 10, '1666580866b6417815c55d9fde6793ff4228413d59_thumbnail_900x.webp', '16665808733a8406fc8740ef389d558b3f680f3ec3_thumbnail_900x.webp', '16665808748269f798015279f9da660c79983d2b87_thumbnail_900x.webp', 'Active', '2023-01-17 01:06:24', '2023-01-17 01:06:24'),
(7, 'DAZY Butterfly & Slogan Graphic Drop Shoulder Tee', 2, 'Color:	Yellow\r\nStyle:	Casual\r\nPattern Type:	Butterfly, Slogan\r\nNeckline:	Round Neck\r\nSleeve Length:	Short Sleeve\r\nSleeve Type:	Drop Shoulder\r\nLength:	Regular\r\nFit Type:	Regular Fit\r\nFabric:	Slight Stretch\r\nMaterial:	Fabric\r\nComposition:	94% Cotton, 6% Elastane\r\nCare Instructions:	Machine wash or professional dry clean\r\nSheer:	No', 'M', 'Women', 110, 10, '1672968150df900abb0a1cb83aa5b101f0fc90a587.webp', '167296814779cd9b4d33db2dc86a18a8e21065dceb_thumbnail_900x.webp', '16729681607836611a18a012f7c93315385691358a.webp', 'Active', '2023-01-18 11:00:35', '2023-01-18 11:00:35'),
(8, 'DAZY Drop Shoulder Slant Pockets Teddy Jacket', 3, 'Color:	Green\r\nStyle:	Casual\r\nPattern Type:	Plain\r\nType:	Teddy\r\nNeckline:	Collar\r\nDetails:	Pocket, Zipper\r\nSleeve Length:	Long Sleeve\r\nSleeve Type:	Drop Shoulder\r\nLength:	Regular\r\nPlacket:	Zipper\r\nFit Type:	Regular Fit\r\nFabric:	Non-Stretch\r\nMaterial:	Fabric\r\nComposition:	100% Polyester\r\nCare Instructions:	Hand wash or professional dry clean\r\nSheer:	No', 'L', 'Women', 400, 10, '1661410309ea1130bf59fa79f22325c81e6aa327fd_thumbnail_900x.webp', '16614103129ffe413ce265b789879a19a1bc39ea74_thumbnail_900x.webp', '16614103227dea39ca0285d2f4bce3de0627163898_thumbnail_900x.webp', 'Active', '2023-01-18 11:03:09', '2023-01-18 11:03:09'),
(9, 'SHEIN EZwear Flap Pocket Cargo Pants', 4, 'Color:	Apricot\r\nStyle:	Casual\r\nPattern Type:	Plain\r\nType:	Cargo Pants\r\nClosure Type:	Zipper Fly\r\nDetails:	Button, Pocket, Zipper\r\nWaist Line:	Drop Waist\r\nLength:	Long\r\nFit Type:	Regular Fit\r\nFabric:	Slight Stretch\r\nMaterial:	Fabric\r\nComposition:	100% Polyester\r\nCare Instructions:	Hand wash or professional dry clean\r\nBody:	Unlined\r\nSheer:	No', 'L', 'Women', 190, 10, '1670208749da40ae42ba2040878ca6b113f91968c2_thumbnail_900x.webp', '16702087520a06d656b2326af0edea6311c3ca9164_thumbnail_900x.webp', '16702087589ab8cc2077f03530dbc266d2483f1f32_thumbnail_900x.webp', 'Active', '2023-01-18 11:05:21', '2023-01-18 11:05:21'),
(10, 'Colorblock Lace Up Front Skate Shoes', 7, 'Color:	Black\r\nType:	Skate Shoes\r\nStyle:	Sporty\r\nToe:	Round Toe\r\nPattern Type:	Colorblock\r\nStrap Type:	Lace Up\r\nUpper Material:	PU Leather\r\nLining Material:	Fabric', 'None', 'Women', 200, 10, '1630632924bdaa92f21eae230a6e5ad5b4f9685bf9_thumbnail_900x.webp', '16306329226ee38ef2076572f9f231831871a1682e_thumbnail_900x.webp', '16306329264f25ec1eec04f00cb1e27d02bd5c6413_thumbnail_900x.webp', 'Active', '2023-01-18 11:07:12', '2023-01-18 11:07:12'),
(11, 'DAZY Men Solid Drop Shoulder Sweater', 1, 'Color:	Apricot\r\nStyle:	Casual\r\nPattern Type:	Plain\r\nType:	Pullovers\r\nNeckline:	Round Neck\r\nSleeve Length:	Long Sleeve\r\nSleeve Type:	Drop Shoulder\r\nLength:	Regular\r\nFit Type:	Regular Fit\r\nFabric:	High Stretch\r\nMaterial:	Fabric\r\nCare Instructions:	Hand wash or professional dry clean\r\nSheer:	No', 'L', 'Men', 280, 10, '1672713900efe36fa9d011ac15fc8a08e43db304d1_thumbnail_900x.webp', '1672713889e8e687612452b9c45357580a58c911d8.webp', '16727138852a9c5f1e20a03cf16f4837b938b36ec9_thumbnail_900x.webp', 'Active', '2023-01-18 11:11:33', '2023-01-18 11:11:33'),
(12, 'Plaid Pattern Fringe Trim Scarf', 6, 'Color:	Multicolor\r\nMagnetic:	No\r\nStyle:	Casual\r\nPattern Type:	Plaid\r\nType:	Scarf\r\nComposition:	100% Polyester\r\nMaterial:	Fabric', 'S', 'Women', 80, 10, '1667274941d968c241aace28848c93c00ca44535d5.webp', '1667274944e37c9449027da51907a6a9d646ae9b45.webp', '16672749435eb1787de19a625fa8c1ebb9462d958e.webp', 'Active', '2023-01-18 11:14:47', '2023-01-18 11:14:47'),
(13, '1pair Simple Fashion Glasses', 6, 'WARNING: Fashion Glasses. Not to be worn outside to protect the eyes against strong sunlight. Not designed or intended for use in play by children\r\nFrame Color:	Black\r\nLens Color:	Dark Grey\r\nShape:	Square\r\nFrame Material:	Plastic', 'None', 'Women', 150, 10, '16492242564e6fd6b3f8ce5a5f50b3ea17305deb94.webp', '16492242589c2d6474854467b2e34ceabdf4da6402.webp', '1664530055ed0e14493921e787dc678b735451769f.webp', 'Active', '2023-01-18 11:20:51', '2023-01-18 11:20:51'),
(14, 'Men Plaid Pattern Scarf', 6, 'Color:	Multicolor\r\nMagnetic:	No\r\nPattern Type:	All Over Print\r\nComposition:	100% Viscose\r\nMaterial:	Fabric', 'M', 'Men', 80, 10, '1671002025c5e40e098e465aadc29ca7afb18a6641.webp', '16710020356d892b2db5134a2704fbacbccaa39c8e.webp', '1671002028a924ba7d7c975243fbc4aa065b65a7ec.webp', 'Active', '2023-01-18 11:23:43', '2023-01-22 14:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `idRev` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `EmailRev` varchar(255) NOT NULL,
  `Comment` varchar(255) NOT NULL,
  `DateRev` varchar(255) NOT NULL,
  `ProductID` int(11) NOT NULL,
  PRIMARY KEY (`idRev`),
  KEY `fk_revprod` (`ProductID`),
  KEY `fk_revcustomer` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`idRev`, `CustomerID`, `EmailRev`, `Comment`, `DateRev`, `ProductID`) VALUES
(3, 1, 'aminecherradi99@gmail.com', 'Wow! Cool hoodie!', '2023-01-23 22:47:53', 1),
(7, 1, 'aminecherradi99@gmail.com', 'This product is realy good', '2023-01-25 15:27:20', 2),
(16, 1, 'aminecherradi99@gmail.com', 'cool glasses', '2023-05-29 01:17:09', 5),
(17, 1, 'aminecherradi99@gmail.com', 'test', '2023-06-04 15:07:05', 7),
(18, 1, 'aminecherradi99@gmail.com', 'Good Quality', '2023-06-09 01:46:17', 1),
(19, 1, 'aminecherradi99@gmail.com', 'Nice', '2023-06-09 01:50:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `CartID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) DEFAULT NULL,
  `IPCustomer` varchar(255) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `ProductImg` varchar(255) DEFAULT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductPrice` decimal(10,2) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `OrderID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CartID`),
  KEY `CustomerID` (`CustomerID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`CartID`, `CustomerID`, `IPCustomer`, `ProductID`, `ProductImg`, `ProductName`, `ProductPrice`, `Quantity`, `OrderID`) VALUES
(1, NULL, '192.168.100.47', 7, '1672968150df900abb0a1cb83aa5b101f0fc90a587.webp', 'DAZY Butterfly & Slogan Graphic Drop Shoulder Tee', '110.00', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usersip`
--

DROP TABLE IF EXISTS `usersip`;
CREATE TABLE IF NOT EXISTS `usersip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) CHARACTER SET latin1 NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CustomerID` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usersip`
--

INSERT INTO `usersip` (`id`, `ip`, `CustomerID`, `date`) VALUES
(1, '192.168.100.47', 1, '2023-06-09'),
(2, '192.168.100.47', 1, '2023-06-09'),
(3, '192.168.100.47', 1, '2023-06-10'),
(4, '192.168.100.47', 2, '2023-06-10'),
(5, '192.168.100.47', 1, '2023-06-10'),
(6, '192.168.100.47', 2, '2023-06-10'),
(7, '192.168.100.47', 1, '2023-06-11'),
(8, '192.168.100.47', 1, '2023-06-11'),
(9, '192.168.100.47', 1, '2023-06-11'),
(10, '192.168.100.47', 1, '2023-06-12'),
(11, '192.168.100.47', 1, '2023-06-12'),
(12, '192.168.100.47', 1, '2023-06-12'),
(13, '192.168.100.47', 1, '2023-06-12'),
(14, '192.168.100.47', 1, '2023-06-15'),
(15, '192.168.100.47', 1, '2023-06-16'),
(16, '192.168.100.47', 1, '2023-06-25');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`RevID`) REFERENCES `reviews` (`idRev`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_inv` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `ordersummary`
--
ALTER TABLE `ordersummary`
  ADD CONSTRAINT `ordersummary_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `ordersummary_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`Product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Product_Category`) REFERENCES `category` (`Id_category`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`Product_id`);

--
-- Constraints for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`),
  ADD CONSTRAINT `shoppingcart_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`Product_id`);

--
-- Constraints for table `usersip`
--
ALTER TABLE `usersip`
  ADD CONSTRAINT `usersip_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
