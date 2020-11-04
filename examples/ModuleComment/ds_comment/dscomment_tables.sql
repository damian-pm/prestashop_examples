CREATE TABLE IF NOT EXISTS `PREFIX_dscomment` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NULL,
  `description` text NOT NULL,
  `customer` int(10) unsigned NOT NULL,
  `product` int(10) unsigned NOT NULL,
  `date_add` datetime NOT NULL,
  `count_like` int(10) unsigned NULL,
  `count_dislike` int(10) unsigned NULL,
  `rating` int(10) unsigned NULL,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`),
  KEY `product` (`product`)
) ENGINE=ENGINE_TYPE  DEFAULT CHARSET=utf8;