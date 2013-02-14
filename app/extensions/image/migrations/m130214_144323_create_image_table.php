<?php

class m130214_144323_create_image_table extends CDbMigration
{
	public function up()
	{
		$this->execute("CREATE TABLE `image` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
			`name` VARCHAR(255) NOT NULL,
			`path` VARCHAR(255) NULL DEFAULT NULL,
			`extension` VARCHAR(255) NOT NULL,
			`filename` VARCHAR(255) NOT NULL,
			`mimeType` VARCHAR(255) NOT NULL,
			`byteSize` INT UNSIGNED NOT NULL,
			`createTime` DATETIME NOT NULL,
			PRIMARY KEY (`id`)
		) COLLATE='utf8_general_ci' ENGINE=InnoDB;");
	}

	public function down()
	{
		$this->dropTable('image');
	}
}