<?php
// development environment configuration
return array(
    'components' => array(
        'log' => array(
            'routes' => array(
                array(
                    'class' => 'vendor.malyshev.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('*'),
                ),
            ),
        ),
    ),
);