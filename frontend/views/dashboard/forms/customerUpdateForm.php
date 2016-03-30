<?php
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => Yii::t('dashboard', 'Dashboard'), 'url' => ['/dashboard']];
$this->params['breadcrumbs'][] = Yii::t('dashboard', 'Update information');
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name')->textInput(); ?>
<?= $form->field($model, 'zipcode')->textInput(); ?>
<?= $form->field($model, 'adres')->textInput(); ?>
<?= $form->field($model, 'city')->textInput(); ?>
<?= $form->field($model, 'email')->textInput(); ?>
<?= $form->field($model, 'phone')->textInput(); ?>
<?= $form->field($model, 'iban')->textInput(); ?>
<div class="row">
    <?= Html::submitButton(Yii::t('common', 'Update'), ['class' => 'btn btn-lg btn-theme col-sm-10']) ?>
    <?= Html::a(Yii::t('common', 'Back'), Yii::$app->request->referrer, ['class' => 'btn btn-lg col-sm-2 btn-danger']) ?>
</div>
<?php ActiveForm::end(); ?>
