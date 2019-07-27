-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2019 at 08:18 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addSales` (IN `sales` DOUBLE, IN `admin` INT)  NO SQL
BEGIN

DECLARE adminid INT(11) DEFAULT 0;
DECLARE tsales  DOUBLE DEFAULT 0.0;
DECLARE cdate  VARCHAR(50);

SET adminid = admin;
SET tsales = sales;
SET cdate = "";


SELECT CURDATE() INTO cdate;
INSERT INTO sales(TotalSales, dateAndtime, admin) VALUES ( tsales, cdate, adminid);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addToOrderKart` (IN `nid` INT)  NO SQL
BEGIN
DECLARE pID INT(11) DEFAULT 0;
DECLARE pPrice  DOUBLE DEFAULT 0.0;
DECLARE pPrice2  DOUBLE DEFAULT 0.0;
DECLARE qt  INT(11) DEFAULT 0;
DECLARE qt2  INT(11) DEFAULT 0;
DECLARE countProduct  INT(11) DEFAULT 0;

SET pID = nid;
SET pPrice = 0.0;
SET pPrice2 = 0.0;
SET qt = 1;
SET qt2 = 0;
SET countProduct = 0;

SELECT price INTO pPrice FROM product WHERE id = pID;
SELECT COUNT(*) INTO countProduct FROM orderkart WHERE id = pID;
SELECT quantity INTO qt2 FROM orderkart WHERE id = pID;
SET qt2 = qt2 + qt;
SET pPrice2 = pPrice * qt2;

IF (countProduct = 0) THEN
INSERT INTO orderkart(id, quantity, total) VALUES( pID, qt, pPRice);
elseif (countProduct > 0) then
UPDATE orderkart SET quantity = qt2, total = pPRice2 WHERE id = pID;
end if;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addToOrderKart2` (IN `nid` INT)  NO SQL
BEGIN
DECLARE pID INT(11) DEFAULT 0;
DECLARE pPrice  DOUBLE DEFAULT 0.0;
DECLARE pPrice2  DOUBLE DEFAULT 0.0;
DECLARE qt  INT(11) DEFAULT 0;
DECLARE qt2  INT(11) DEFAULT 0;
DECLARE countProduct  INT(11) DEFAULT 0;

SET pID = nid;
SET pPrice = 0.0;
SET pPrice2 = 0.0;
SET qt = 1;
SET qt2 = 0;
SET countProduct = 0;

SELECT price INTO pPrice FROM product WHERE id = pID;
SELECT COUNT(*) INTO countProduct FROM orderkart WHERE id = pID;
SELECT quantity INTO qt2 FROM orderkart WHERE id = pID;
SET qt2 = qt2 + qt;
SET pPrice2 = pPrice * qt2;

IF (countProduct = 0) THEN
INSERT INTO orderkart(id, quantity, total) VALUES( pID, qt, pPRice);
elseif (countProduct > 0) then
UPDATE orderkart SET quantity = qt2, total = pPRice2 WHERE id = pID;
end if;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addtoProductSold` ()  NO SQL
BEGIN

    DECLARE sID  INT(11) DEFAULT 0;
    DECLARE countProducts  INT(11) DEFAULT 0;
    DECLARE i  INT;
DECLARE pID INT(11) DEFAULT 0;
DECLARE qt INT(11) DEFAULT 0;
DECLARE totals DOUBLE DEFAULT 0.0;
DECLARE j int DEFAULT 0;

    SET sID = 0;
    SET i = 0;
	SET j = 0;
    SET countProducts = 0;
SET pID = 0;
SET qt = 0;
SET totals = 0;

    SELECT COUNT(*) INTO countProducts FROM orderkart;
    SELECT id INTO sID FROM sales ORDER BY id DESC LIMIT 1;

WHILE i < CountProducts DO

SELECT oid INTO j FROM orderkart ORDER BY oid LIMIT i,1;

SELECT id INTO pID FROM orderkart WHERE oid = j;
SELECT quantity INTO qt FROM orderkart WHERE oid = j;
SELECT total INTO totals FROM orderkart WHERE oid = j; 
INSERT INTO product_sold(product, sales_number, quantity, total) VALUES(pID, sID, qt, totals);

SET i = i + 1;
END WHILE;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateToOrderKart` (IN `nid` INT, IN `nqt` INT)  NO SQL
BEGIN

DECLARE pID INT(11) DEFAULT 0;
DECLARE pPrice  DOUBLE DEFAULT 0.0;
DECLARE ntotal  DOUBLE DEFAULT 0.0;
DECLARE qt  INT(11) DEFAULT 0;

SET pID = nid;
SET pPrice = 0.0;
SET ntotal = 0.0;
SET qt = nqt;


SELECT price INTO pPrice FROM product WHERE id = pID;
SET ntotal = qt * pPRice;

IF (pID > 0) THEN
UPDATE orderkart SET quantity = qt, total = ntotal WHERE id = pID;
end if;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `UserName` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Name`, `UserName`, `Password`) VALUES
(1, 'John Carlo', 'JohnCarlo', 'john'),
(2, 'Abing Leopold', 'abing', 'abing');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Men Shoes'),
(2, 'Women Shoes'),
(3, 'Kiddie Boys'),
(4, 'Kiddie Girls');

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailsview`
-- (See below for the actual view)
--
CREATE TABLE `detailsview` (
`Sales_Number` int(11)
,`Product_ID` int(11)
,`Name` varchar(15)
,`Quantity` int(11)
,`total` double
);

-- --------------------------------------------------------

--
-- Table structure for table `orderkart`
--

CREATE TABLE `orderkart` (
  `oid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `orderkartview`
-- (See below for the actual view)
--
CREATE TABLE `orderkartview` (
`id` int(11)
,`name` varchar(15)
,`price` double
,`quantity` int(11)
,`total` double
);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(15) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `supplier` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category`, `supplier`, `price`, `img_name`) VALUES
(1, 'Marikina Black ', 1, 6, 1299, 'download.jpg'),
(2, 'nike cp3', 1, 1, 2389, 'nike m4.jpg'),
(3, 'Nike Jona', 2, 1, 1234, 'nike_w3.jpg'),
(4, 'adidas pink 1', 2, 2, 1000, 'adidas w.jpg'),
(5, 'Marikina Coco', 1, 2, 600, 'images (1).jpg'),
(6, 'mrkn women 1', 2, 6, 399, 'download (1).jpg'),
(7, 'converse minion', 3, 8, 750, 'HTB1dpyXLFXXXXXGXpXXq6xXFXXXG.jpg'),
(8, 'China Pink', 4, 8, 300, 'chind_g1.jpg'),
(9, 'Converse', 2, 2, 2600, 'converse1.jpg'),
(10, 'Sponge BOB ', 3, 8, 300, 'images.jpg'),
(11, 'adidas pnk grl', 4, 2, 600, '2a24e498267cb32d7b050935b3a1e261--toddler-girl-shoes-kid-shoes.jpg'),
(12, 'nike men 1', 1, 1, 2499, 'nike m1.jpg'),
(13, 'Converse Eyes', 1, 9, 2199, '50ef8b36ffad6abc72cbd7af9c608987--galaxy-converse-boys-converse.jpg'),
(14, 'Converse CT', 1, 9, 3999, 'converseformen1.jpg'),
(15, 'Nike Pink W1', 2, 1, 2888, 'nike_w.jpg'),
(16, 'Adidas M3', 1, 2, 2499, 'adidas m3.jpg'),
(17, 'fila a1', 1, 12, 2999, 'converse m 123.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `productsoldview`
-- (See below for the actual view)
--
CREATE TABLE `productsoldview` (
`Date` date
,`product_id` int(11)
,`name` varchar(15)
,`category` varchar(45)
,`supplier` varchar(45)
,`sales_number` int(11)
,`price` double
,`quantity` int(11)
,`total` double
);

-- --------------------------------------------------------

--
-- Table structure for table `product_sold`
--

CREATE TABLE `product_sold` (
  `id` int(11) NOT NULL,
  `product` int(11) DEFAULT NULL,
  `sales_number` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_sold`
--

INSERT INTO `product_sold` (`id`, `product`, `sales_number`, `quantity`, `total`) VALUES
(44, 2, 14, 1, 2389),
(45, 3, 14, 1, 1234),
(46, 3, 15, 1, 1234),
(47, 7, 15, 1, 750),
(48, 11, 15, 1, 600),
(49, 2, 16, 2, 4778),
(50, 12, 16, 1, 2499),
(51, 11, 16, 1, 600),
(52, 14, 16, 3, 11997),
(53, 1, 17, 10, 12990),
(54, 3, 17, 1, 1234),
(55, 2, 18, 1, 2389),
(56, 3, 18, 1, 1234),
(57, 4, 18, 4, 4000),
(58, 1, 19, 1, 1299),
(59, 2, 19, 1, 2389),
(60, 3, 19, 1, 1234),
(61, 4, 19, 1, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `TotalSales` double DEFAULT NULL,
  `dateAndtime` date NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `TotalSales`, `dateAndtime`, `admin`) VALUES
(14, 3623, '2017-08-12', 2),
(15, 2584, '2017-08-12', 1),
(16, 19874, '2017-08-13', 2),
(17, 14224, '2017-08-14', 1),
(18, 7623, '2017-08-30', 2),
(19, 5922, '2019-07-27', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `salesview`
-- (See below for the actual view)
--
CREATE TABLE `salesview` (
`sales_number` int(11)
,`total` double
,`Date` date
,`Cashier` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone`) VALUES
(1, 'Nike PH', '297-70-49'),
(2, 'Adidas PH', '301-11-89'),
(3, 'Accel PH', '0935991234'),
(4, 'Vans PH', '093588125'),
(6, 'Marikina Shoe', '3024512'),
(8, 'China Shoes', '87631113434'),
(9, 'Converse PH', '299123312'),
(10, 'Ukay-ukay', '123123123'),
(12, 'FILA ph', '2978039');

-- --------------------------------------------------------

--
-- Structure for view `detailsview`
--
DROP TABLE IF EXISTS `detailsview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailsview`  AS  (select `product_sold`.`sales_number` AS `Sales_Number`,`product`.`id` AS `Product_ID`,`product`.`name` AS `Name`,`product_sold`.`quantity` AS `Quantity`,`product_sold`.`total` AS `total` from (`product_sold` join `product` on((`product_sold`.`product` = `product`.`id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `orderkartview`
--
DROP TABLE IF EXISTS `orderkartview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orderkartview`  AS  (select `o`.`id` AS `id`,`p`.`name` AS `name`,`p`.`price` AS `price`,`o`.`quantity` AS `quantity`,`o`.`total` AS `total` from (`orderkart` `o` join `product` `p` on((`o`.`id` = `p`.`id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `productsoldview`
--
DROP TABLE IF EXISTS `productsoldview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productsoldview`  AS  select `ss`.`dateAndtime` AS `Date`,`ps`.`product` AS `product_id`,`p`.`name` AS `name`,`c`.`name` AS `category`,`s`.`name` AS `supplier`,`ps`.`sales_number` AS `sales_number`,`p`.`price` AS `price`,`ps`.`quantity` AS `quantity`,`ps`.`total` AS `total` from ((((`product_sold` `ps` join `product` `p` on((`ps`.`product` = `p`.`id`))) join `category` `c` on((`p`.`category` = `c`.`id`))) join `supplier` `s` on((`p`.`supplier` = `s`.`id`))) join `sales` `ss` on((`ps`.`sales_number` = `ss`.`id`))) order by `ps`.`sales_number` ;

-- --------------------------------------------------------

--
-- Structure for view `salesview`
--
DROP TABLE IF EXISTS `salesview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `salesview`  AS  (select `sales`.`id` AS `sales_number`,`sales`.`TotalSales` AS `total`,`sales`.`dateAndtime` AS `Date`,`admin`.`Name` AS `Cashier` from (`sales` join `admin` on((`sales`.`admin` = `admin`.`id`)))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderkart`
--
ALTER TABLE `orderkart`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `supplier` (`supplier`);

--
-- Indexes for table `product_sold`
--
ALTER TABLE `product_sold`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product`),
  ADD KEY `sales_number` (`sales_number`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin` (`admin`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orderkart`
--
ALTER TABLE `orderkart`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `product_sold`
--
ALTER TABLE `product_sold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderkart`
--
ALTER TABLE `orderkart`
  ADD CONSTRAINT `orderkart_ibfk_1` FOREIGN KEY (`id`) REFERENCES `product` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `product_sold`
--
ALTER TABLE `product_sold`
  ADD CONSTRAINT `product_sold_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_sold_ibfk_2` FOREIGN KEY (`sales_number`) REFERENCES `sales` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`admin`) REFERENCES `admin` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
