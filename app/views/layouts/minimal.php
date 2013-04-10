<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="icon" href="<?php echo baseUrl('/favicon.ico'); ?>" type="image/x-icon"/>

	<title><?php echo e($this->pageTitle); ?></title>

	<?php app()->bootstrap->registerAllScripts(); ?>

	<?php css('css/main.css'); ?>
	<?php css('css/responsive.css'); ?>
</head>

<body class="layout-minimal">

	<div class="container">
		<?php echo $content; ?>
	</div>

</body>
</html>
