<?php

return CMap::mergeArray(
	require(__DIR__ . '/common.php'),
	array(
		// path aliases
		'aliases' => array(
			'bootstrap' => 'vendor.yii-twbs.yiistrap',
		),

		// application behaviors
		'behaviors' => array(
			// uncomment this if your application is multilingual
			/*
			'multilingual' => array(
				'class' => 'vendor.crisu83.yii-multilingual.components.MlApplicationBehavior',
				'languages' => array( // enabled languages (locale => language)
					'en' => 'English',
				),
			),
			*/
		),

		// controllers mappings
		'controllerMap' => array(
			// uncomment the following if you enable the image component
			//'image' => array('class' => 'vendor.crisu83.yii-image.controllers.ImageController'),
		),

		// application modules
		'modules' => array(
			// uncomment the following to enable the auth module
			/*
			'auth' => array(
				'class' => 'vendor.crisu83.yii-auth.AuthModule',
			),
			*/
		),

		// application components
		'components' => array(
			// uncomment the following if you enable the auth module
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
				'class' => 'bootstrap.components.TbApi',
			),
			// uncomment the following to enable the image extension
			/*
			'image' => array(
				'class' => 'vendor.crisu83.yii-image.components.ImageManager',
				'versions' => array(
				),
			),
			*/
			'less' => array(
				'class' => 'vendor.crisu83.yii-less.components.Less',
				'mode' => 'client',
				'options' => array(
					'env' => 'development',
				),
				'files' => array(
					'less/main.less' => 'css/main.css',
					'less/responsive.less' => 'css/responsive.css', // should be compiled separately
				),
			),
			'urlManager' => array(
				// uncomment the following if you application is multilingual
				//'class' => 'vendor.crisu83.yii-multilingual.components.MlUrlManager','
				// uncomment the following if you have enabled Apache's Rewrite module.
				/*
				'urlFormat' => 'path',
				'showScriptName' => false,
				*/
				'rules' => array(
					// language rules
					'<lang:([a-z]{2}(?:_[a-z]{2})?)>/<route:[\w\/]+>'=>'<route>',
					// seo rules
					'<controller:\w+>/<name>-<id:\d+>.html'=>'<controller>/view',
					// default rules
					'<controller:\w+>/<id:\d+>' => '<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
					'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				),
			),
			'user' => array(
				// uncomment the following if you enable the Auth module
				//'class'=>'auth.components.AuthWebUser',
				'allowAutoLogin' => true,
			),
			'errorHandler' => array(
				'errorAction' => 'site/error',
			),
			'log' => array(
				'class' => 'CLogRouter',
				'routes' => array(
					array(
						'class' => 'ext.debugtoolbar.YiiDebugToolbarRoute',
						'ipFilters' => array('127.0.0.1', '::1'),
					),
				),
			),
		),
	)
);