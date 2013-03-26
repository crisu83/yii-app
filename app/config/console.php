<?php
// console application configuration
return array(
	'commandMap' => array(
		'debug' => array(
			'class' => 'vendor.crisu83.yii-debug.commands.DebugCommand',
		),
		'env' => array(
			'class' => 'vendor.crisu83.yii-configbuilder.commands.EnvCommand',
		),
		'migrate' => array(
			'class' => 'system.cli.commands.MigrateCommand',
			'migrationTable' => 'migration',
		),
	)
);