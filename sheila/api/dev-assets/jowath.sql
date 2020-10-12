-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 10, 2020 at 10:38 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jowath`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(10) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_name` (`client_name`),
  UNIQUE KEY `phone_number` (`phone_number`),
  UNIQUE KEY `email_address` (`email_address`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `phone_number`, `email_address`, `password`) VALUES
(4, 'Herbert Amukhuma', '711466164', 'herbertamukhuma6@gmail.com', 'U2FsdGVkX1/aXfxjNwlL269WtGrhk6QfyOFIghsBBG/KeMzyPkA+G0vpHT2oHs1y');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(10) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) NOT NULL,
  `item_type` enum('tent','chair','table','stemware_barware','cutlery','cups','plates','mobile_toilet') NOT NULL,
  `item_price` float NOT NULL,
  `item_description` varchar(500) NOT NULL,
  `amount_in_stock` int(10) NOT NULL,
  `image_filename` varchar(100) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `image_filename` (`image_filename`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_type`, `item_price`, `item_description`, `amount_in_stock`, `image_filename`) VALUES
(1, 'Dome Tents', 'tent', 35000, 'This kind of tents are designed from high quality and durable fabrics and metal materials,with careful consideration on local weather conditions.they are best for weddings,churches and party events. It is a 100-seater tent', 2, 'tents1.jpeg'),
(2, 'Hexagon tents', 'tent', 35000, 'Hexagon tents provide good views of the entire venue, complete shelter from the sun while allowing the cool breeze of the wind to waft through. They can be arranged side by side or in a semi-circular manner to provide maximum capacity according to your setup requirements', 40, 'hexagontents.jpg'),
(3, 'Armless plastic chairs', 'chair', 20, 'Confortable plastic chairs suitable for wedding and party events. They can be dressed with linen to enhance elegance.', 30, 'newchair.jpg'),
(4, 'Chiavari chairs', 'chair', 50, 'Its simplicity and lightness are sure to impress no matter what the occasion , so, make it memorable.', 30, 'newchairchiavari.jpg'),
(5, 'Conference chairs', 'chair', 60, 'Comfortable armless chairs designed for corporate events They come in red and blue colors.', 30, 'red chairs.jpg'),
(6, 'Cocktail tables', 'table', 200, 'Wooden round small tables specifically designed for serving or placing drinks. They can be dressed with linen of your choice, Suitable for parties.', 40, 'cocktailtable.jpg'),
(7, 'Rounded table', 'table', 300, 'A round dining table is well-suited for gathering friends and loved ones for a meal, as its smooth shape lends a sense of communal warmth.They can be dressed with linen of your choice. Can accomodate 4-6 seats', 20, 'tables.jpg'),
(8, 'Rectangular table', 'table', 300, 'This is a wooden table that is suited for all occassions. it is stable and easy to set up. Can be dressed with linen of your choice. Can accomodate 6-8 seats.', 6, 'tables2.jpg'),
(9, 'Rounded glass', 'stemware_barware', 100, 'Suitable for soft drinks,cocktails and drinking water. Its thick base ensures its steadiness and elegance. A set contains six glasses.', 30, 'rounded class.jpg'),
(10, 'Long tumbler glass', 'stemware_barware', 80, 'Suitable for soft drinks,cocktails and drinking water. A set is made up of six glasses', 50, 'waterglass.jpg'),
(11, 'Wine glass', 'stemware_barware', 300, 'Bordeaux glass. Characterized with rounder and broader bowl. Suitable for wines especially red wine. Six glasses per set.', 69, 'wine glasses.jpg'),
(12, 'Four-set cutlery', 'cutlery', 30, 'It consists of forks, knives,spoons and teaspoons. A set contains twelve items, three of each kind.', 56, 'cutlery.PNG'),
(13, 'Five-set cutlery', 'cutlery', 25, 'It consists of forks,small forks, knives,spoons and teaspoons. A set contains ten items, two of each kind', 30, 'cutlery5piece.jpg'),
(14, 'Round plate', 'plates', 50, 'A melamine plate. This unique material is lighter and durable many eateries turn to melamine to avoid constantly replacing broken dinnerware', 56, 'white classic china.jpg'),
(15, 'Flowered plate', 'plates', 60, 'None', 67, 'floweredplate.jpg'),
(16, 'Ceramic cups', 'cups', 70, 'This kind of tents are designed from high quality and durable fabrics and metal materials,with careful consideration on local weather conditions.they are best for weddings,churches and party events. It is a 50-seater tent.', 87, 'coffeemugs.jpg'),
(17, 'Clear glass mugs', 'cups', 20, 'This kind of tents are designed from high quality and durable fabrics and metal materials,with careful consideration on local weather conditions.they are best for weddings,churches and party events. It is a 50-seater tent.', 45, 'Clear glass mug.jpg'),
(18, 'White glass opal mugs', 'cups', 50, 'This kind of tents are designed from high quality and durable fabrics and metal materials,with careful consideration on local weather conditions.they are best for weddings,churches and party events. It is a 50-seater tent.', 89, 'coffeecups.jpg'),
(19, 'Mobile toilets', 'mobile_toilet', 5000, 'We rent out clean with reduced odours, spacious, well ventilated portable toilets for an excellent user experience.', 60, 'mobiletoilet.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
