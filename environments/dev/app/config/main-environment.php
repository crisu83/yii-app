<?php
// development environment configuration
return array(
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'yii',
			'ipFilters' => array('10.0.2.*'),
		),
	),
	'components' => array(
		'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=yii_app',
            'username' => 'root',
            'password' => 'vagrant',
            'charset' => 'utf8',
			'enableProfiling' => true,
			'enableParamLogging' => true,
		),
	),
);
