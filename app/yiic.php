<?php

$yiic = __DIR__ . '/vendor/yiisoft/yii/framework/yiic.php';
$builder = __DIR__ . '/vendor/crisu83/yii-configbuilder/ConfigBuilder.php';

require_once($builder);

$config = ConfigBuilder::build(array(
	__DIR__ . '/config/common.php',
	__DIR__ . '/config/console.php',
	__DIR__ . '/config/local.php',
));

require_once($yiic);