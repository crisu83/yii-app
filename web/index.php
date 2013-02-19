<?php
/**
 * This is the bootstrap file for the production environment.
 */

$yii = __DIR__ . '/../app/vendor/yiisoft/yii/framework/yii.php';
$globals = __DIR__ . '/../app/helpers/globals.php';
$config = __DIR__ . '/../app/config/main.php';

require_once($yii);
require_once($globals);
Yii::createWebApplication($config)->run();
