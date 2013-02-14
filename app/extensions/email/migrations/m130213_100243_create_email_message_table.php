<?php

class m130213_100243_create_email_message_table extends CDbMigration {
	public function up() {
		$this->execute("CREATE TABLE `email` (
			`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
			`from` TEXT NOT NULL,
			`to` TEXT NOT NULL,
			`cc` TEXT NULL DEFAULT NULL,
			`bcc` TEXT NULL DEFAULT NULL,
			`subject` VARCHAR(255) NOT NULL,
			`body` TEXT NOT NULL,
			`headers` TEXT NOT NULL,
			`createTime` DATETIME NOT NULL,
			`status` INT NOT NULL DEFAULT '0',
			PRIMARY KEY (`id`)
		) COLLATE='utf8_general_ci' ENGINE=InnoDB;");
	}

	public function down() {
		$this->dropTable('email');
	}
}