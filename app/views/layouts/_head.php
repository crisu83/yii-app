<?php
/* @var Controller $this */
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <link rel="icon" href="<?php echo baseUrl('/favicon.ico'); ?>" type="image/x-icon"/>
    <title><?php echo e($this->pageTitle); ?></title>
    <?php css('css/main.css'); ?>
    <?php css('css/responsive.css'); ?>
    <?php js('js/main.js'); ?>
    <?php app()->bootstrap->registerAllScripts(); ?>
    <?php app()->bootstrap->registerYiistrapCss(); ?>
</head>