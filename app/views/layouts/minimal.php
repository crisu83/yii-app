<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo e($this->pageTitle); ?></title>

	<?php css('css/main.css'); ?>
	<?php css('css/responsive.css'); ?>
</head>

<body>

	<div class="container">
		<?php echo $content; ?>
	</div>

</body>
</html>
