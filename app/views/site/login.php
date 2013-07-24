<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form TbActiveForm */

$this->pageTitle = app()->name . ' - Login';
?>
<div class="site-login">

    <h1><?php echo app()->name; ?></h1>

    <div class="login-form">

        <?php $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            array(
                'id' => 'login-form',
            )
        ); ?>

        <fieldset>
            <?php echo $form->textFieldControlGroup(
                $model,
                'username',
                array('block' => true, 'label' => false, 'placeholder' => 'Username')
            ); ?>
            <?php echo $form->passwordFieldControlGroup(
                $model,
                'password',
                array('block' => true, 'label' => false, 'placeholder' => 'Password')
            ); ?>
        </fieldset>

        <?php echo TbHtml::submitButton(
            'Login',
            array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'size' => TbHtml::BUTTON_SIZE_LARGE, 'block' => true)
        ); ?>

        <?php $this->endWidget(); ?>

    </div>
</div>