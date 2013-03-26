<?php
// shared application configuration
return array(
	'basePath' => realpath(__DIR__ . '/..'),

	// application name
	'name' => 'Application',

	// application language
	'language' => 'en_gb',

	// path aliases
	'aliases' => array(
		'app' => 'application',
		'vendor' => '../vendor',
	),

	// components to preload
	'preload' => array('log'),

	// paths to import
	'import' => array(
		'application.helpers.*',
		'application.models.ar.*',
		'application.models.form.*',
		'application.components.*',
	),

	// application components
	'components' => array(
		// uncomment the following to enable the email extension
		/*
		'email' => array(
			'class' => 'ext.email.components.Emailer',
			'templates' => array(
			),
		),
		*/
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=yii_app',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application parameters
	'params' => array(
		'adminEmail' => 'webmaster@example.com',
	),
);