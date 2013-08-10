<?php

class m130427_102520_create_image_table extends CDbMigration
{
    public function up()
    {
        $this->execute(
            "CREATE TABLE `image` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `fileId` INT NOT NULL,
                `width` INT NOT NULL,
                `height` INT NOT NULL,
                PRIMARY KEY (`id`)
            ) COLLATE='utf8_general_ci' ENGINE=InnoDB"
        );
    }

    public function down()
    {
        $this->dropTable('image');
    }
}