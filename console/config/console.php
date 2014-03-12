<?php
// console application configuration
return array(
    // commands
    'commandMap' => array(
        'dump' => array(
            'class' => 'MysqldumpCommand',
            'basePath' => realpath(dirname(__DIR__) . '/../'),
            'dumpPath' => 'app/tests/_data',
        ),
        'environment' => array(
            'class' => 'EnvironmentCommand',
            'basePath' => realpath(dirname(__DIR__) . '/../'),
            'flushPaths' => array(),
        ),
        'maintain' => array(
            'class' => 'MaintainCommand',
            'basePath' => realpath(dirname(__DIR__) . '/../'),
            'flushPaths' => array(),
        ),
        'migrate' => array(
            'class' => 'system.cli.commands.MigrateCommand',
            'migrationTable' => 'migration',
        ),
    )
);
