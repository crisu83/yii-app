<?php
// console application configuration
return array(
    'commandMap' => array(
        'env' => array(
            'class' => 'ext.yii-deploymenttools.commands.EnvCommand',
            'basePath' => __DIR__ . '/../../',
            'permissions' => array(
                'app/runtime' => array('mode' => 0777),
                'app/yiic' => array('mode' => 0755),
                'web/assets' => array('mode' => 0777),
            ),
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