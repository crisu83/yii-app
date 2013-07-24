<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle = app()->name . ' - Contact';
$this->breadcrumbs = array(
    'Contact',
);
?>

    <h1>Contact</h1>

    <?php if (user()->hasFlash('contact')): ?>
        <?php $this->widget('bootstrap.widgets.TbAlert', array('alerts' => array('contact' => array()))); ?>
    <?php else: ?>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="form">

        <?php $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            array(
                'id' => 'contact-form',
                'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            )
        ); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldControlGroup($model, 'name'); ?>

        <?php echo $form->textFieldControlGroup($model, 'email'); ?>

        <?php echo $form->textFieldControlGroup($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>

        <?php echo $form->textAreaControlGroup($model, 'body', array('rows' => 6, 'class' => 'span8')); ?>

        <div class="form-actions">
            <?php echo TbHtml::submitButton('Submit', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>

<?php endif; ?>