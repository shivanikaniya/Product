CREATE TABLE `Prtab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `price` int(11) NOT NULL,
  `image`LONGBLOB NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;
CREATE TABLE  `Catab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `Prtab` (`id`, `name`,  `price`, `category_id`, `created`, `modified`) VALUES
(1, 'LG P880 4X HD',  336, 3, '2014-06-01 01:12:26', '2014-05-31 17:12:26'),
(2, 'Google Nexus 4',  299, 2, '2014-06-01 01:12:26', '2014-05-31 17:12:26'),
(3, 'Samsung Galaxy S4', 600, 3, '2014-06-01 01:12:26', '2014-05-31 17:12:26'),
(6, 'Bench Shirt',  29, 1, '2014-06-01 01:12:26', '2014-05-31 02:12:21'),
(7, 'Lenovo Laptop',  399, 2, '2014-06-01 01:13:45', '2014-05-31 02:13:39'),
(8, 'Samsung Galaxy Tab 10.1',  259, 2, '2014-06-01 01:14:13', '2014-05-31 02:14:08'),
(9, 'Spalding Watch',  199, 1, '2014-06-01 01:18:36', '2014-05-31 02:18:31'),
(10, 'Sony Smart Watch', 300, 2, '2014-06-06 17:10:01', '2014-06-05 18:09:51'),
(11, 'Huawei Y300', 100, 2, '2014-06-06 17:11:04', '2014-06-05 18:10:54'),
(12, 'Abercrombie Lake Arnold Shirt', 60, 1, '2014-06-06 17:12:21', '2014-06-05 18:12:11'),
(13, 'Abercrombie Allen Brook Shirt',  70, 1, '2014-06-06 17:12:59', '2014-06-05 18:12:49'),
(25, 'Abercrombie Allen Anew Shirt',  999, 1, '2014-11-22 18:42:13', '2014-11-21 19:42:13'),
(26, 'Another product',555, 2, '2014-11-22 19:07:34', '2014-11-21 20:07:34'),
(27, 'Bag',  999, 1, '2014-12-04 21:11:36', '2014-12-03 22:11:36'),
(28, 'Wallet',  799, 1, '2014-12-04 21:12:03', '2014-12-03 22:12:03'),
(30, 'Wal-mart Shirt',  555, 2, '2014-12-13 00:52:29', '2014-12-12 01:52:29'),
(31, 'Amanda Waller Shirt',  333, 1, '2014-12-13 00:52:54', '2014-12-12 01:52:54'),
(32, 'Washing Machine Model PTRR',  999, 1, '2015-01-08 22:44:15', '2015-01-07 23:44:15');

INSERT INTO `Catab` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Fashion', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(2, 'Electronics', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(4, 'Pillow', '2014-06-01 00:35:07', '2014-05-30 17:34:33'),
(3, 'Motors', '2014-06-01 00:35:07', '2014-05-30 17:34:54');

ALTER TABLE `prtab` ADD `image` LONGBLOB on update CURRENT_TIMESTAMP NOT NULL DEFAULT 'NOT NULL' AFTER `modified`;
