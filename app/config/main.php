<?php

// require application params
$params = require(__DIR__ . '/params.php');

// application configuration
return array(
	'basePath' => __DIR__ . '/..',

	// application name
	'name' => $params['app.name'],

	// application language
	'language' => 'en',

	// path aliases
	'aliases' => array(
		'bootstrap' => 'ext.bootstrap',
	),

	// components to preload
	'preload' => array('log'),

	// paths to import
	'import' => array(
		'application.models.*',
		'application.components.*',
	),

	'behaviors' => array(
		// uncomment this if your application is multilingual
		/*
		'multilingual' => array(
			'class' => 'ext.multilingual.components.MlApplicationBehavior',
			'languages' => array( // enabled languages (locale => language)
				'en' => 'English',
			),
		),
		*/
	),

	// external controllers
	'controllerMap' => array(
		// uncomment the following if you enable the image component
		//'image' => array('class' => 'ext.image.controllers.ImageController'),
	),

	// application modules
	'modules' => array(
		// uncomment the following to enable the Auth module
		/*
		'auth',
		*/
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components' => array(
		// uncomment the following if you enable the Auth module
		/*
		'authManager'=>array(
			'class'=>'auth.components.CachedDbAuthManager',
			'itemTable'=>'authitem',
			'itemChildTable'=>'authitemchild',
			'assignmentTable'=>'authassignment',
			'behaviors'=>array(
				'auth'=>array(
					'class'=>'auth.components.AuthBehavior',
					'admins'=>array('admin'),
				),
			),
		),
		*/
		'bootstrap' => array(
			'class' => 'bootstrap.components.Bootstrap',
		),
		'db' => array(
			'connectionString' => $params['db.connectionString'],
			'username' => $params['db.username'],
			'password' => $params['db.password'],
			'enableParamLogging' => YII_DEBUG,
			'charset' => 'utf8',
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		// uncomment the following to enable image versioning
		/*
		'image' => array(
			'class' => 'ext.image.components.ImageManager',
			'versions' => $params['image.versions'],
		),
		*/
		'less' => array(
			'class' => 'ext.less.components.Less',
			'mode' => $params['less.mode'],
			'options' => $params['less.options'],
			'files' => $params['less.files'],
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
		'urlManager' => array(
			// uncomment the following if you application is multilingual
			//'class' => 'ext.multilingual.components.MlUrlManager',
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => $params['urlManager.rules'],
		),
		'user' => array(
			// uncomment the following if you enable the Auth module
			//'class'=>'auth.components.AuthWebUser',
			'allowAutoLogin' => true,
		),
	),

	// application parameters
	'params' => $params,
);