# ************************************************************
# Sequel Pro SQL dump
# Version 4703
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.23)
# Database: horse_racing
# Generation Time: 2019-04-23 15:39:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tbl_horses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_horses`;

CREATE TABLE `tbl_horses` (
  `horse_id` varchar(20) NOT NULL DEFAULT '',
  `strength` double NOT NULL,
  `speed` double NOT NULL,
  `endurance` double NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`horse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table tbl_race_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_race_history`;

CREATE TABLE `tbl_race_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `race_id` varchar(20) NOT NULL DEFAULT '',
  `horse_id` varchar(20) NOT NULL DEFAULT '',
  `horse_pos` int(10) NOT NULL,
  `completion_time` double NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table tbl_race_progress
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_race_progress`;

CREATE TABLE `tbl_race_progress` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `race_id` varchar(20) NOT NULL DEFAULT '',
  `horse_id` varchar(20) NOT NULL DEFAULT '',
  `distance_covered` double NOT NULL DEFAULT '0',
  `time_duration` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table tbl_races
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_races`;

CREATE TABLE `tbl_races` (
  `race_id` varchar(20) NOT NULL DEFAULT '',
  `race_finished` int(2) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`race_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
