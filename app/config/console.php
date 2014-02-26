<?php
// console application configuration
return array(
    'commandMap' => array(
        'dump' => array(
            'class' => 'vendor.crisu83.yii-consoletools.commands.MysqldumpCommand',
            'basePath' => __DIR__ . '/../../',
            'dumpPath' => 'app/tests/_data',
        ),
        'environment' => array(
            'class' => 'vendor.crisu83.yii-consoletools.commands.EnvironmentCommand',
            'basePath' => __DIR__ . '/../../',
            'flushPaths' => array(
                'web/assets',
                'web/css',
                'web/js',
            ),
        ),
        'maintain' => array(
            'class' => 'vendor.crisu83.yii-consoletools.commands.MaintainCommand',
            'basePath' => __DIR__ . '/../../',
            'flushPaths' => array(),
        ),
        // uncomment the following if you enable the imagemanager extension.
        /*
        'image' => array(
            'class' => 'vendor.crisu83.yii-imagemanager.commands.ImageCommand',
        ),
        */
        'migrate' => array(
            'class' => 'system.cli.commands.MigrateCommand',
            'migrationTable' => 'migration',
        ),
    )
);
