set names utf8;
create database found;
use found;

DROP TABLE IF EXISTS `info`;
CREATE TABLE `info`(
	`info_id` tinyint(4) NOT NULL,
	`title` VARCHAR(30) NOT NULL DEFAULT '',
	`content` text NOT NULL DEFAULT '',
	PRIMARY KEY(`info_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `donor`;
CREATE TABLE `donor`(
	`donor_id` int(11) NOT NULL AUTO_INCREMENT,
	`money` int(11) NOT NULL DEFAULT '0',
	`project_id` int(11) NOT NULL DEFAULT '0',
	`name` VARCHAR(70) NOT NULL DEFAULT '',
	`email` VARCHAR(50) NOT NULL DEFAULT '',
	`phone` VARCHAR(30) NOT NULL DEFAULT '',
	`address` VARCHAR(255) NOT NULL DEFAULT '',
	`postcode` VARCHAR(20) NOT NULL DEFAULT '',
	`ourschool` tinyint(1) NOT NULL DEFAULT '1',
	`isdonation` tinyint(1) NOT NULL DEFAULT '0',
	`isvisble` CHAR(1) NOT NULL DEFAULT '0',
	`schoolname` VARCHAR(100) NOT NULL DEFAULT '',
	`addtime` datetime DEFAULT NULL,
	`message` text,
	PRIMARY KEY(`donor_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `News_type`;

CREATE TABLE `News_type`(
	`type_id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(30) NOT NULL DEFAULT '',
	PRIMARY KEY(`type_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `News_main`;

CREATE TABLE `News_main`(
	`type_id` SMALLINT(6) NOT NULL,
	`news_id` int(11) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL DEFAULT '',
	`content` mediumtext,
	`addtime` datetime DEFAULT NULL,
	`seecount` int(11) NOT NULL DEFAULT '0',
	PRIMARY KEY(`type_id`,`news_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` char(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL,
  PRIMARY KEY(`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `picshow`;
CREATE TABLE `picshow`(
	`pic_id` int(11) NOT NULL AUTO_INCREMENT,
	`isshow` tinyint(1) NOT NULL DEFAULT '1',
	`urllink` VARCHAR(255) NOT NULL DEFAULT '',
	PRIMARY KEY(`pic_id`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;