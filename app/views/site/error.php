<?php
/* @var $this SiteController */
/* @var $error array */
/* @var $code integer */

$this->pageTitle=app()->name.' - Error';
?>
<div class="site-error">
	<h1>Error <?php echo $code; ?></h1>
	<p><?php echo e($message); ?></p>
</div>