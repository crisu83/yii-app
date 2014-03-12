<?php
/* @var SiteController $this */
?>
<div class="site-down">
    <?php $this->widget('\TbHeroUnit', array(
        'heading' => 'Down for maintenance',
        'content' => app()->name . 'is temporarily unavailable due to planned maintenance.',
    )); ?>
</div>