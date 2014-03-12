<?php
// development environment configuration
return array(
	'components' => array(
		'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=yii_app',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
			'enableProfiling' => true,
			'enableParamLogging' => true,
		),
	),
);
