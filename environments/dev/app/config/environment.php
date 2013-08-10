<?php
// development environment configuration
return array(
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'yii',
			'ipFilters' => array('127.0.0.1', '10.0.2.2'/* Vagrant */, '::1'/* WAMP */),
		),
	),
	'components' => array(
		'db' => array(
			'enableProfiling' => true,
			'enableParamLogging' => true,
		),
	),
);
