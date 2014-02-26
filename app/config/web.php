<?php
// web application configuration
return array(
    // path aliases
    'aliases' => array(
        'bootstrap' => 'vendor.crisu83.yiistrap',
    ),
    // application behaviors
    'behaviors' => array(
        'maintain' => array(
            'class' => 'vendor.crisu83.yii-consoletools.behaviors.MaintainApplicationBehavior',
            'maintainFile' => __DIR__ . '/../runtime/maintain',
        ),
    ),
    // controllers mappings
    'controllerMap' => array(
    ),
    // application modules
    'modules' => array(
    ),
    // application components
    'components' => array(
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        'log' => array(
            'routes' => array(
                array(
                    'class' => 'vendor.malyshev.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1', '10.0.2.2'/* Vagrant */, '::1'/* WAMP */),
                ),
            ),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'user' => array(
            'class'=>'app.components.WebUser',
            'allowAutoLogin' => true,
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
    ),
);