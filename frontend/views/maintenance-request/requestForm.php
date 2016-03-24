<?php
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = Yii::t('maintenanceRequest', 'maintenance request');
?>
<div class="container">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'validateOnSubmit' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
    ]); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model,'firstName')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model,'lastName')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model,'email')->textInput(['type' => 'email']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model,'phone')->textInput(['type' => 'tel']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'zipcode')->textInput(['keyup' => 'alert($(this).val())']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model,'houseNumber')->textInput(['tpye' => 'number']) ?>
        </div>
    </div>
    <div class="row">
        <?= $form->field($model,'description')->textArea(['rows' => 6]); ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('maintenanceRequest','Send request'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJs('$(\'#maintenancerequestform-zipcode\').keyup(function(e){$(this).val($(this).val().toUpperCase());})'); ?>