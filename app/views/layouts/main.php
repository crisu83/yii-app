<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo e($this->pageTitle); ?></title>

	<?php css('css/main.css'); ?>
	<?php css('css/responsive.css'); ?>

	<?php if (YII_DEBUG): ?>
		<?php js('js/main.js'); ?>
	<?php else: ?>
		<?php js('js/main.min.js'); ?>
	<?php endif; ?>
</head>

<body>
	<?php $this->widget('bootstrap.widgets.TbNavbar',array(
		'collapse'=>true,
		'items'=>array(
			array(
				'class'=>'bootstrap.widgets.TbNav',
				'items'=>array(
					array('label'=>'Home','url'=>array('/site/index')),
					array('label'=>'About','url'=>array('/site/page','view'=>'about')),
					array('label'=>'Contact','url'=>array('/site/contact')),
					array('label'=>'Login','url'=>array('/site/login'),'visible'=>user()->isGuest),
					array('label'=>'Logout ('.user()->name.')','url'=>array('/site/logout'),'visible'=>!user()->isGuest)
				),
			),
			// uncomment the following if your application is multilingual
			/*
			array(
				'class'=>'ext.multilingual.widgets.MlLanguageMenu',
				'htmlOptions'=>array('class'=>'pull-right'),
			),
			*/
		),
	)); ?>

	<div class="container" id="page">

		<?php if(!empty($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
			'links'=>$this->breadcrumbs,
		)); ?>
		<?php endif?>

		<?php echo $content; ?>

		<hr />

		<div id="footer">
			Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
			All Rights Reserved.<br/>
			<?php echo Yii::powered(); ?>
		</div>

	</div>
</body>
</html>
