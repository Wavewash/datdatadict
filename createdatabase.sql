-- --------------------------------------------------------
-- Host:                         192.168.99.100
-- Server version:               10.1.16-MariaDB-1~jessie - mariadb.org binary distribution
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for slides
-- DROP DATABASE IF EXISTS `datadict`;
CREATE DATABASE IF NOT EXISTS `datadict` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `datadict`;


-- Dumping structure for table slides.slidedata
-- DROP TABLE IF EXISTS `slidedata`;
CREATE TABLE IF NOT EXISTS `dict` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data` longtext NOT NULL,
  `name` varchar(50) NOT NULL,
  `updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
