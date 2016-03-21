<?php

use common\models\Customer;
use common\models\MaintenanceRequest;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ComputerSummary;

/* @var $this yii\web\View */
/* @var $model common\models\MaintenanceRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maintenance-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'computerNameVirtual')->widget(Select2::classname(), ['pluginOptions' => ['data' => ArrayHelper::getColumn(ComputerSummary::find()->all(), 'name'),]]); ?>

    <?= $form->field($model, 'status')->dropDownList([
        MaintenanceRequest::STATUS_REQUEST => Yii::t('maintenanceRequest', 'Request'),
        MaintenanceRequest::STATUS_PROCESS => Yii::t('maintenanceRequest', 'Process'),
        MaintenanceRequest::STATUS_DONE => Yii::t('maintenanceRequest', 'Done'),
    ]) ?>

    <div class="form-group">
        <div class="col-sm-6">
            <?= $form->field($model, 'date_apointment')->widget(DateTimePicker::classname(), ['pluginOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd']]); ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'date_done')->widget(DateTimePicker::classname(), ['pluginOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd']]); ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('maintenanceRequest', 'Create') : Yii::t('maintenanceRequest', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
