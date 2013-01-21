-- Table schema for `user` table
CREATE TABLE `user` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`salt` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`passwordStrategy` VARCHAR(255) NOT NULL,
	`requiresNewPassword` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`creatorId` INT(10) UNSIGNED NOT NULL,
	`createTime` DATETIME NOT NULL,
	`updaterId` INT(10) UNSIGNED NOT NULL,
	`updateTime` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;
