<?php

use common\models\ComputerSummary;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Log;

/* @var $this yii\web\View */
/* @var $model common\models\Log */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'computerNameVirtual')->widget(Select2::classname(), ['pluginOptions' => ['data' => ArrayHelper::getColumn(ComputerSummary::find()->all(), 'name'),]]); ?>

    <?= $form->field($model, 'type')->dropDownList([
        Log::TYPE_INFORMATION => Yii::t('log', 'Information'),
        Log::TYPE_WARNING => Yii::t('log', 'Warning'),
        Log::TYPE_ERROR => Yii::t('log', 'Error')
    ]) ?>

    <?= $form->field($model, 'event_at')->widget(DateTimePicker::classname(), ['pluginOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd HH:ii:ss']]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
