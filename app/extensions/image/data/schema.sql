/*
	Image database schematic.
	Author Christoffer Niska <ChristofferNiska@gmail.com>
	Copyright (c) 2012, Christoffer Niska
 */

CREATE TABLE `image` (
	`id` BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`path` VARCHAR(255) NULL DEFAULT NULL,
	`extension` VARCHAR(4) NOT NULL,
	`filename` VARCHAR(255) NOT NULL,
	`mimeType` VARCHAR(255) NOT NULL,
	`byteSize` INT(10) UNSIGNED NOT NULL,
	`createTime` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;;