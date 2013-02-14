<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
?>
<div class="site-error">
	<h1>Error <?php echo $code; ?></h1>
	<p><?php echo CHtml::encode($message); ?></p>
</div>