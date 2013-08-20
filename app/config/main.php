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
        'vendor.crisu83.yiistrap.helpers.TbHtml',
        'vendor.nordsoftware.yii-emailer.models.*',
    ),
    // application components
    'components' => array(
        // uncomment the following to enable the email extension
        /*
        'emailer' => array(
            'class' => 'vendor.nordsoftware.yii-emailer.components.Emailer',
            'defaultLayout' => 'application.views.layouts.email',
            'data' => array(
                'h1Style' => 'font-size: 38.5px; line-height: 40px; margin: 0 0 10px; font-weight: bold; text-rendering: optimizelegibility;',
                'linkStyle' => 'color: #0088CC; text-decoration: none',
            ),
            'templates' => array(
            ),
        ),
        */
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'format' => array(
            'class' => 'vendor.crisu83.yii-formatter.components.Formatter',
            'formatters' => array(),
        ),
        // uncomment the following to enable the imagemanager extension
        /*
        'imageManager' => array(
            'class' => 'vendor.crisu83.yii-imagemanager.components.ImageManager',
            'presets' => array(
            ),
        ),
        */
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