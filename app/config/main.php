<?php
// shared application configuration
return array(
    'basePath' => realpath(__DIR__ . '/..'),
    // application name
    'name' => 'Application',
    // path aliases
    'aliases' => array(
        'app' => 'application',
        'vendor' => realpath(__DIR__ . '/../../vendor'),
    ),
    // components to preload
    'preload' => array('log'),
    // paths to import
    'import' => array(
        'application.helpers.*',
        'application.models.ar.*',
        'application.models.form.*',
        'application.components.*',
        'vendor.crisu83.yiistrap.helpers.TbHtml'
    ),
    // application components
    'components' => array(
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