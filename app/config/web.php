<?php
// web application configuration
return array(
    // path aliases
    'aliases' => array(
        'bootstrap' => 'vendor.crisu83.yiistrap',
    ),
    // application behaviors
    'behaviors' => array(
        // uncomment this if your application is multilingual
        /*
        'multilingual' => array(
            'class' => 'vendor.crisu83.yii-multilingual.behaviors.MlApplicationBehavior',
            'languages' => array( // enabled languages (locale => language)
                'en' => 'English',
            ),
        ),
        */
        'maintain' => array(
            'class' => 'vendor.crisu83.yii-consoletools.behaviors.MaintainApplicationBehavior',
            'maintainFile' => __DIR__ . '/../runtime/maintain',
        ),
    ),
    // controllers mappings
    'controllerMap' => array(
        // uncomment the following if you enable the emailer component
        //'email' => array('class' => 'vendor.nordsoftware.yii-emailer.controllers.EmailController'),
        // uncomment the following if you enable the imagemanager extension
        'image' => array('class' => 'vendor.crisu83.yii-imagemanager.controllers.ImageController'),
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
        'livereload' => array(
            'class' => 'vendor.crisu83.yii-livereload.components.LiveReload',
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
            // uncomment the following if you application is multilingual
            //'class' => 'vendor.crisu83.yii-multilingual.components.MlUrlManager','
            // uncomment the following if you have enabled Apache's Rewrite module.
            /*
            'urlFormat' => 'path',
            'showScriptName' => false,
            */
            'rules' => array(
                // language rules, uncomment the following if your application is multilingual
                //'<lang:([a-z]{2}(?:_[a-z]{2})?)>/<route:[\w\/]+>'=>'<route>',
                // seo rules
                '<controller:\w+>/<name>-<id:\d+>.html' => '<controller>/view',
                // default rules
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
