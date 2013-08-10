<?php

class m130426_200339_create_file_table extends CDbMigration
{
    public function up()
    {
        $this->execute(
            "CREATE TABLE `file` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL,
                `extension` VARCHAR(255) NOT NULL,
                `path` VARCHAR(255) NULL DEFAULT NULL,
                `filename` VARCHAR(255) NOT NULL,
                `mimeType` VARCHAR(255) NOT NULL,
                `byteSize` INT UNSIGNED NOT NULL,
                `createdAt` DATETIME NOT NULL,
                PRIMARY KEY (`id`)
            ) COLLATE='utf8_general_ci' ENGINE=InnoDB"
        );
    }

    public function down()
    {
        $this->dropTable('file');
    }
}