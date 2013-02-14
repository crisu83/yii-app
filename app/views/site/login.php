<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form TbActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
?>
<div class="site-login">

	<h1><?php echo Yii::app()->name; ?></h1>

	<div class="login-form">

		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm'); ?>

		<fieldset>
			<?php echo $form->textFieldRow($model,'username',array('block'=>true,'label'=>false,'placeholder'=>'Username')); ?>
			<?php echo $form->passwordFieldRow($model,'password',array('block'=>true,'label'=>false,'placeholder'=>'Password')); ?>
		</fieldset>

		<?php echo Html::submitButton('Login',array('style'=>Html::STYLE_PRIMARY,'size'=>Html::SIZE_LARGE,'block'=>true)); ?>

		<?php $this->endWidget(); ?>

	</div>
</div>