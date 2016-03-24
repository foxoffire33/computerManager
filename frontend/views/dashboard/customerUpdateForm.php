<?php
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'zipcode'); ?>
<?= $form->field($model, 'adres'); ?>
<?= $form->field($model, 'city'); ?>
<?= $form->field($model, 'email'); ?>
<?= $form->field($model, 'phone'); ?>
<?= $form->field($model, 'iban'); ?>
<div class="row">
    <?= Html::submitButton(Yii::t('dashboard', 'Update'),['class' => 'btn btn-lg btn-theme col-sm-10']) ?>
    <?= Html::a(Yii::t('dashboard', 'Back'),['index'],['class' => 'btn btn-lg col-sm-2 btn-danger']) ?>
</div>
<?php ActiveForm::end(); ?>
