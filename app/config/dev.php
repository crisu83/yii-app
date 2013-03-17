<?php

// development environment configuration
return array(
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'yii',
			'ipFilters' => array('127.0.0.1','::1'),
		),
	),
	'components' => array(
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
);