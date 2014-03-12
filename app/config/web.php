<?php
// web application configuration
return array(
    // theme name
    'theme' => 'yiistrap',
    // path aliases
    'aliases' => array(
        'app' => 'application',
    ),
    // paths to import
    'import' => array(
        'app.helpers.*',
        'app.models.ar.*',
        'app.models.form.*',
        'app.components.*',
    ),
    // application behaviors
    'behaviors' => array(
        'maintain' => array(
            'class' => 'MaintainApplicationBehavior',
            'maintainFile' => dirname(__DIR__) . '/runtime/maintain',
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
            'class' => 'TbApi',
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
            'class'=>'\app\components\WebUser',
            'allowAutoLogin' => true,
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'themeManager' => array(
            'basePath' => realpath(dirname(__DIR__) . '/themes'),
        ),
    ),
);