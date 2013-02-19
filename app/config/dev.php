<?php

return CMap::mergeArray(
	require(__DIR__ . '/web.php'),
	array(
		'modules' => array(
			'gii' => array(
				'class' => 'system.gii.GiiModule',
				'password' => 'yii',
				'ipFilters' => array('127.0.0.1','::1'),
			),
		),
	)
);