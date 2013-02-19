<?php

$yii = __DIR__ . '/../app/vendor/yiisoft/yii/framework/yii.php';
$globals = __DIR__ . '/../app/globals.php';
$config = __DIR__ . '/../app/config/main.php';

require_once($yii);
require_once($globals);
Yii::createWebApplication($config)->run();
