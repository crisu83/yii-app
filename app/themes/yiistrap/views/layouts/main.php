<?php
/**
 * @var $content string
 */
?>
<!DOCTYPE html>
<html lang="en">
<?php $this->renderPartial('app.themes.yiistrap.views.layouts._head'); ?>
<body class="layout-main">
<?php $this->widget(
    '\TbNavbar',
    array(
        'collapse' => true,
        'items' => array(
            array(
                'class' => '\TbNav',
                'items' => array(
                    array('label' => 'Home', 'url' => array('/site/index')),
                    array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                    array('label' => 'Contact', 'url' => array('/site/contact')),
                    array('label' => 'Login', 'url' => array('/site/login'), 'visible' => user()->isGuest),
                    array(
                        'label' => 'Logout (' . user()->name . ')',
                        'url' => array('/site/logout'),
                        'visible' => !user()->isGuest
                    )
                ),
            ),
        ),
    )
); ?>

<div class="container" id="page">

    <?php if (!empty($this->breadcrumbs)): ?>
        <?php $this->widget(
            '\TbBreadcrumb',
            array(
                'links' => $this->breadcrumbs,
            )
        ); ?>
    <?php endif ?>

    <?php echo $content; ?>

    <hr/>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
        All Rights Reserved.<br/>
        <?php echo Yii::powered(); ?>
    </div>

</div>
</body>
</html>
