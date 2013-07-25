<?php
// console application configuration
return array(
    'commandMap' => array(
        'dump' => array(
            'class' => 'vendor.crisu83.yii-deploymenttools.commands.MysqldumpCommand',
            'basePath' => __DIR__ . '/../../',
            'binPath' => 'C:\"Program Files"\wamp\bin\mysql\mysql5.5.24\bin\mysqldump',
            'dumpPath' => 'app/tests/_data',
        ),
        'environment' => array(
            'class' => 'vendor.crisu83.yii-deploymenttools.commands.EnvironmentCommand',
            'basePath' => __DIR__ . '/../../',
            'flushPaths' => array(
                'app/runtime',
                'web/assets',
                'web/css',
                'web/js',
            ),
        ),
        'migrate' => array(
            'class' => 'system.cli.commands.MigrateCommand',
            'migrationTable' => 'migration',
        ),
    )
);