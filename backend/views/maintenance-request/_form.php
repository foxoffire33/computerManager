<?php

use common\models\ComputerSummary;
use common\models\MaintenanceRequest;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MaintenanceRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maintenance-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'computerNameVirtual')->widget(Select2::classname(), ['pluginOptions' => ['data' => ArrayHelper::getColumn(ComputerSummary::find()->all(), 'name'),]]); ?>

    <?= $form->field($model, 'status')->dropDownList([
        MaintenanceRequest::STATUS_REQUEST => Yii::t('maintenaceRequest', 'Request'),
        MaintenanceRequest::STATUS_PROCESS => Yii::t('maintenaceRequest', 'Process'),
        MaintenanceRequest::STATUS_DONE => Yii::t('maintenaceRequest', 'Done'),
    ]) ?>

    <div class="form-group">
        <div class="col-sm-6">
            <?= $form->field($model, 'date_apointment')->widget(DateTimePicker::classname(), ['pluginOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd HH:ii:ss']]); ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'date_done')->widget(DateTimePicker::classname(), ['pluginOptions' => ['autoclose' => true,'format' => 'yyyy-mm-dd HH:ii:ss']]); ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
