<?php
// shared application configuration
return array(
    // paths
    'basePath' => dirname(__DIR__),
    'runtimePath' => realpath(dirname(__DIR__) . '/runtime'),
    // application name
    'name' => 'Application',
    // path aliases
    'aliases' => array(
        'vendor' => realpath(dirname(__DIR__) . '/../vendor'),
    ),
    // components to preload
    'preload' => array('log'),
    // paths to import
    'import' => array(
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