DROP TABLE IF EXISTS `atest_data`;
CREATE TABLE `atest_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `discount` int(11), 
  `discount_code` varchar(255) NOT NULL,
  `create_date` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;