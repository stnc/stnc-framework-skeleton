/*
Navicat MySQL Data Transfer

Source Server         : loca
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-03-26 16:55:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dr_cms_posts
-- ----------------------------
DROP TABLE IF EXISTS `dr_cms_posts`;
CREATE TABLE `dr_cms_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  `img` varchar(255) DEFAULT NULL,
  `last_edit_user_id` int(11) DEFAULT NULL,
  `counter` varchar(255) DEFAULT NULL,
  `addate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `editdate` datetime DEFAULT NULL,
  `type` enum('pages','news','products') DEFAULT NULL,
  `status` enum('open','close','delete') DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `cat_id` (`cat_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dr_cms_posts
-- ----------------------------
INSERT INTO `dr_cms_posts` VALUES ('1', '60', 'anasayfa', 'anasayfa', 'anasyfa', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc maximus finibus tempor. Aenean condimentum scelerisque interdum. Phasellus ac tincidunt odio, sit amet finibus augue. Quisque vulputate ut sem sed ultrices. Nam dignissim, dolor eget congue pretium, arcu sapien porttitor dolor, ut pellentesque nibh sem blandit neque. Sed mattis nunc et ligula congue pretium. Pellentesque malesuada metus nisi, lacinia luctus odio rhoncus eget. Donec ullamcorper turpis consectetur nulla gravida facilisis. Fusce sem tortor, gravida non auctor vel, fringilla in libero. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.\r\n\r\nPraesent sit amet porta ligula. Ut consequat velit enim, sit amet fermentum tortor fermentum sed. Vivamus lacinia non eros at sagittis. Nulla pellentesque ante at consectetur dictum. Nunc laoreet diam cursus nibh aliquam lobortis. Praesent sit amet odio nec sem rhoncus interdum quis ut lorem. Integer efficitur sem ligula, quis fermentum turpis ullamcorper et. Proin viverra venenatis pharetra. Morbi vel ex elit. Curabitur finibus magna vel velit tempus, nec molestie sem ultrices. Phasellus in iaculis mauris. Vivamus a hendrerit lectus. Nam auctor, justo id ultrices eleifend, libero enim dapibus turpis, in suscipit leo quam nec nulla. Quisque mattis eu orci vitae bibendum. Nulla suscipit egestas sodales. Ut arcu elit, pulvinar nec neque quis, dignissim vulputate ante.\r\n\r\nVestibulum porta varius metus, ut tristique enim. Etiam mollis auctor placerat. Praesent viverra a magna eu cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec mi mi, tincidunt nec tincidunt sit amet, euismod eget nibh. Duis in maximus mauris, in eleifend libero. Phasellus nisl leo, bibendum a rutrum at, accumsan pellentesque massa. Aliquam quis neque sit amet nisi facilisis finibus a eget quam. Cras eget libero vel orci eleifend tempus. Mauris elit elit, viverra at neque vitae, efficitur rutrum magna. Vivamus quam ipsum, scelerisque vitae est eget, eleifend egestas nisi. Phasellus gravida est in condimentum volutpat. Mauris nibh elit, pellentesque in nisl vel, pretium suscipit ipsum. Curabitur egestas justo a nisi ornare faucibus. Phasellus lobortis auctor eros, posuere euismod enim blandit vitae.\r\n\r\nSed bibendum, turpis eget dapibus maximus, orci elit consectetur sapien, sit amet bibendum nibh odio vitae nunc. Sed ornare vestibulum dolor non sodales. In quis ultrices mi, nec efficitur mauris. Duis scelerisque molestie magna, in condimentum eros. Suspendisse sit amet felis sit amet ante finibus molestie. In faucibus laoreet nisi eu tempus. Aliquam erat volutpat. Nullam condimentum felis et orci laoreet hendrerit. Cras nec lorem felis. Vestibulum fermentum, nisi nec dapibus tincidunt, justo ligula rhoncus dui, ut consequat ligula neque sit amet dolor. Proin quis ultrices dolor. Proin ac lacinia ligula, id tempu', null, null, null, '2015-10-16 12:09:43', null, 'pages', 'open');
INSERT INTO `dr_cms_posts` VALUES ('2', '60', 'Kurumsal', 'kurumsal', '', '	   	   <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tbody><tr>\r\n    <td><p><font size=\"3\" face=\"Arial, Helvetica, sans-serif\"><b><font color=\"#003399\" size=\"2\"><u><a name=\"tarihce\">TARİHÇE</a></u></font></b></font></p>\r\n				<p align=\"justify\">Vestibulum porta varius metus, ut tristique enim. Etiam mollis auctor placerat. Praesent viverra a magna eu cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec mi mi, tincidunt nec tincidunt sit amet, euismod eget nibh. Duis in maximus mauris, in eleifend libero. Phasellus nisl leo, bibendum a rutrum at, accumsan pellentesque massa. Aliquam quis neque sit amet nisi facilisis finibus a eget quam. Cras eget libero vel orci eleifend tempus. Mauris elit elit, viverra at neque vitae, efficitur rutrum magna. Vivamus quam ipsum, scelerisque vitae est eget, eleifend egestas nisi. Phasellus gravida est in condimentum volutpat. Mauris nibh elit, pellentesque in nisl vel, pretium suscipit ipsum. Curabitur egestas justo a nisi ornare faucibus. Phasellus lobortis auctor eros, posuere euismod enim blandit vitae.</p>\r\n				<p align=\"justify\">Vestibulum porta varius metus, ut tristique enim. Etiam mollis auctor placerat. Praesent viverra a magna eu cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec mi mi, tincidunt nec tincidunt sit amet, euismod eget nibh. Duis in maximus mauris, in eleifend libero. Phasellus nisl leo, bibendum a rutrum at, accumsan pellentesque massa. Aliquam quis neque sit amet nisi facilisis finibus a eget quam. Cras eget libero vel orci eleifend tempus. Mauris elit elit, viverra at neque vitae, efficitur rutrum magna. Vivamus quam ipsum, scelerisque vitae est eget, eleifend egestas nisi. Phasellus gravida est in condimentum volutpat. Mauris nibh elit, pellentesque in nisl vel, pretium suscipit ipsum. Curabitur egestas justo a nisi ornare faucibus. Phasellus lobortis auctor eros, posuere euismod enim blandit vitae.</p>\r\n    <hr size=\"1\" noshade=\"\" color=\"#CCCCCC\">    \r\n    <p align=\"justify\"><font size=\"3\" face=\"Arial, Helvetica, sans-serif\"><b><font color=\"#003399\" size=\"2\"><u><a name=\"misyon\">MİSYONUMUZ</a></u></font></b></font></p>\r\n    <p align=\"justify\">Sağdıçlar Balıkçılık olarak tüketicilere, deniz ürünlerini sezonlarının dışında da istedikleri zaman ve en sağlıklı şekilde sunmak temel görevimizdir.</p>\r\n    <hr size=\"1\" noshade=\"\" color=\"#CCCCCC\">\r\n    <p align=\"justify\"><font size=\"3\" face=\"Arial, Helvetica, sans-serif\"><b><font color=\"#003399\" size=\"2\"><u><a name=\"vizyon\">VİZYONUMUZ</a></u></font></b></font></p>\r\n    <p align=\"justify\">Vestibulum porta varius metus, ut tristique enim. Etiam mollis auctor placerat. Praesent viverra a magna eu cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec mi mi, tincidunt nec tincidunt sit amet, euismod eget nibh. Duis in maximus mauris, in eleifend libero. Phasellus nisl leo, bibendum a rutrum at, accumsan pellentesque massa. Aliquam quis neque sit amet nisi facilisis finibus a eget quam. Cras eget libero vel orci eleifend tempus. Mauris elit elit, viverra at neque vitae, efficitur rutrum magna. Vivamus quam ipsum, scelerisque vitae est eget, eleifend egestas nisi. Phasellus gravida est in condimentum volutpat. Mauris nibh elit, pellentesque in nisl vel, pretium suscipit ipsum. Curabitur egestas justo a nisi ornare faucibus. Phasellus lobortis auctor eros, posuere euismod enim blandit vitae.</p>\r\n    <hr size=\"1\" noshade=\"\" color=\"#CCCCCC\">\r\n    <p align=\"justify\"><font size=\"3\" face=\"Arial, Helvetica, sans-serif\"><b><font color=\"#003399\" size=\"2\"><u><a name=\"ilkler\">İLKLERİMİZ ve ÖNCÜLÜKLERİMİZ</a></u></font></b></font></p>\r\n    <p align=\"justify\">Vestibulum porta varius metus, ut tristique enim. Etiam mollis auctor placerat. Praesent viverra a magna eu cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec mi mi, tincidunt nec tincidunt sit amet, euismod eget nibh. Duis in maximus mauris, in eleifend libero. Phasellus nisl leo, bibendum a rutrum at, accumsan pellentesque massa. Aliquam quis neque sit amet nisi facilisis finibus a eget quam. Cras eget libero vel orci eleifend tempus. Mauris elit elit, viverra at neque vitae, efficitur rutrum magna. Vivamus quam ipsum, scelerisque vitae est eget, eleifend egestas nisi. Phasellus gravida est in condimentum volutpat. Mauris nibh elit, pellentesque in nisl vel, pretium suscipit ipsum. Curabitur egestas justo a nisi ornare faucibus. Phasellus lobortis auctor eros, posuere euismod enim blandit vitae.</p>\r\n   </td>\r\n  </tr>\r\n</tbody></table>', null, null, null, '2015-10-16 12:13:49', null, 'pages', 'open');
INSERT INTO `dr_cms_posts` VALUES ('3', '60', 'Hizmetler', 'hizmetler', 'Lorem ipsum dolor sit amet, ei quaeque necessitatibus usu,', '	   	   <div align=\"center\">\r\n  <br>\r\n</div><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tbody><tr>\r\n    <td>\r\n      <p align=\"justify\">Vestibulum porta varius metus, ut tristique enim. Etiam mollis auctor placerat. Praesent viverra a magna eu cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec mi mi, tincidunt nec tincidunt sit amet, euismod eget nibh. Duis in maximus mauris, in eleifend libero. Phasellus nisl leo, bibendum a rutrum at, accumsan pellentesque massa. Aliquam quis neque sit amet nisi facilisis finibus a eget quam. Cras eget libero vel orci eleifend tempus. Mauris elit elit, viverra at neque vitae, efficitur rutrum magna. Vivamus quam ipsum, scelerisque vitae est eget, eleifend egestas nisi. Phasellus gravida est in condimentum volutpat. Mauris nibh elit, pellentesque in nisl vel, pretium suscipit ipsum. Curabitur egestas justo a nisi ornare faucibus. Phasellus lobortis auctor eros, posuere euismod enim blandit vitae. </p></td>\r\n  </tr>\r\n</tbody></table>', null, null, null, '2015-10-16 12:21:56', null, 'pages', 'open');
INSERT INTO `dr_cms_posts` VALUES ('12', '60', 'Ürünler', 'urunler', '', 'Vestibulum porta varius metus, ut tristique enim. Etiam mollis auctor placerat. Praesent viverra a magna eu cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec mi mi, tincidunt nec tincidunt sit amet, euismod eget nibh. Duis in maximus mauris, in eleifend libero. Phasellus nisl leo, bibendum a rutrum at, accumsan pellentesque massa. Aliquam quis neque sit amet nisi facilisis finibus a eget quam. Cras eget libero vel orci eleifend tempus. Mauris elit elit, viverra at neque vitae, efficitur rutrum magna. Vivamus quam ipsum, scelerisque vitae est eget, eleifend egestas nisi. Phasellus gravida est in condimentum volutpat. Mauris nibh elit, pellentesque in nisl vel, pretium suscipit ipsum. Curabitur egestas justo a nisi ornare faucibus. Phasellus lobortis auctor eros, posuere euismod enim blandit vitae.\r\n\r\nVestibulum porta varius metus, ut tristique enim. Etiam mollis auctor placerat. Praesent viverra a magna eu cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec mi mi, tincidunt nec tincidunt sit amet, euismod eget nibh. Duis in maximus mauris, in eleifend libero. Phasellus nisl leo, bibendum a rutrum at, accumsan pellentesque massa. Aliquam quis neque sit amet nisi facilisis finibus a eget quam. Cras eget libero vel orci eleifend tempus. Mauris elit elit, viverra at neque vitae, efficitur rutrum magna. Vivamus quam ipsum, scelerisque vitae est eget, eleifend egestas nisi. Phasellus gravida est in condimentum volutpat. Mauris nibh elit, pellentesque in nisl vel, pretium suscipit ipsum. Curabitur egestas justo a nisi ornare faucibus. Phasellus lobortis auctor eros, posuere euismod enim blandit vitae.\r\n\r\nVestibulum porta varius metus, ut tristique enim. Etiam mollis auctor placerat. Praesent viverra a magna eu cursus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec mi mi, tincidunt nec tincidunt sit amet, euismod eget nibh. Duis in maximus mauris, in eleifend libero. Phasellus nisl leo, bibendum a rutrum at, accumsan pellentesque massa. Aliquam quis neque sit amet nisi facilisis finibus a eget quam. Cras eget libero vel orci eleifend tempus. Mauris elit elit, viverra at neque vitae, efficitur rutrum magna. Vivamus quam ipsum, scelerisque vitae est eget, eleifend egestas nisi. Phasellus gravida est in condimentum volutpat. Mauris nibh elit, pellentesque in nisl vel, pretium suscipit ipsum. Curabitur egestas justo a nisi ornare faucibus. Phasellus lobortis auctor eros, posuere euismod enim blandit vitae.', null, null, null, '2015-10-23 18:03:44', null, 'pages', 'open');
INSERT INTO `dr_cms_posts` VALUES ('13', '60', 'Markalar', 'markalar', null, 'markalar gelecek ', null, null, null, '2015-10-23 18:06:52', null, 'pages', 'open');
INSERT INTO `dr_cms_posts` VALUES ('14', '60', 'SATIŞ NOKTALARI', 'satis', null, 'satış noktaları gelecek ', null, null, null, '2015-10-23 18:10:42', null, 'pages', 'open');

-- ----------------------------
-- Table structure for dr_cms_posts_cats
-- ----------------------------
DROP TABLE IF EXISTS `dr_cms_posts_cats`;
CREATE TABLE `dr_cms_posts_cats` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_post_id` int(11) DEFAULT NULL,
  `cat_title` varchar(200) DEFAULT NULL,
  `cat_slug` varchar(200) DEFAULT NULL,
  `cat_type` enum('pages','news','products') DEFAULT NULL,
  `cat_status` enum('open','close') DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dr_cms_posts_cats
-- ----------------------------
INSERT INTO `dr_cms_posts_cats` VALUES ('60', '1', 'genel', 'sayfa_tr_genel_', 'pages', 'open');

-- ----------------------------
-- Table structure for dr_cms_post_photos
-- ----------------------------
DROP TABLE IF EXISTS `dr_cms_post_photos`;
CREATE TABLE `dr_cms_post_photos` (
  `photo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo_filename` varchar(120) DEFAULT NULL,
  `photo_post_id` bigint(20) unsigned DEFAULT '0',
  `photo_status` enum('open','') DEFAULT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `photo_id` (`photo_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dr_cms_post_photos
-- ----------------------------

-- ----------------------------
-- Table structure for dr_cms_users
-- ----------------------------
DROP TABLE IF EXISTS `dr_cms_users`;
CREATE TABLE `dr_cms_users` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `added_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('user','admin') DEFAULT NULL,
  `token_key` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='members grubu ';

-- ----------------------------
-- Records of dr_cms_users
-- ----------------------------
INSERT INTO `dr_cms_users` VALUES ('1', null, null, 'Demo', '$2y$12$.x4k941dv0bZIf4joNfKxe0.S.HLHA7tEhTS6339eXDz8sSxd6a/a', 'selmantunc@gmail.com', '2014-12-08 20:07:19', 'admin', null);

-- ----------------------------
-- Table structure for dr_gallery_photos
-- ----------------------------
DROP TABLE IF EXISTS `dr_gallery_photos`;
CREATE TABLE `dr_gallery_photos` (
  `photo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo_filename` varchar(25) DEFAULT NULL,
  `photo_caption` text,
  `photo_category_id` bigint(20) unsigned DEFAULT '0',
  `photo_status` enum('') DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `photo_counter` int(11) DEFAULT NULL,
  `photo_content_text` text,
  PRIMARY KEY (`photo_id`),
  KEY `photo_id` (`photo_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dr_gallery_photos
-- ----------------------------
