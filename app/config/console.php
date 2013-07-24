<?php
// console application configuration
return array(
    'commandMap' => array(
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
        'permissions' => array(
            'class' => 'vendor.crisu83.yii-deploymenttools.commands.PermissionsCommand',
            'basePath' => __DIR__ . '/../../',
            'permissions' => array(
                'app/runtime' => array('mode' => 0777),
                'app/tests/_log' => array('mode' => 0777),
                'app/yiic' => array('mode' => 0755),
                'web/assets' => array('mode' => 0777),
            ),
        ),
    )
);