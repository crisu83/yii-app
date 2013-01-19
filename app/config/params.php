<?php

// application parameters
return array(
	// this is used in contact page
	'adminEmail' => 'webmaster@example.com',
	// database configurations
	'db.name' => '',
	'db.connectionString' => 'mysql:host=localhost;dbname=yii_app',
	'db.username' => 'root',
	'db.password' => '',
	// url rules
	'url.rules' => array(
		'<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
	),
	// less compiler configurations
	'less.mode' => 'client',
	'less.options' => array(),
	'less.files' => array(
		'less/styles.less' => 'css/styles.css',
	),
);