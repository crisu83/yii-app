<?php
/* @var SiteController $this */
/* @var array $error */
/* @var integer $code */
/* @var string $message */

$this->pageTitle = app()->name . ' - Error';
?>
<div class="site-error">
    <h1>Error <?php echo $code; ?></h1>
    <p><?php echo e($message); ?></p>
</div>