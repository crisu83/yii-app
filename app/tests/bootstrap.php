<?php

$config = __DIR__ . '/../config/test.php';

require(__DIR__ . '/../../vendor/yiisoft/yii/framework/yiit.php');
require(__DIR__ . '/WebTestCase.php');

Yii::createWebApplication($config);
