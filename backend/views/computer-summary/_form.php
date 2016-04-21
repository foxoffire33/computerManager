<?php

use common\models\ComputerModel;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ComputerSummary;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $model common\models\ComputerSummary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="computer-summary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'name')->textInput() ?>

    <?= $form->field($model, 'customerNameVirtual')->widget(Select2::classname(), ['pluginOptions' => ['data' => ArrayHelper::getColumn(Customer::find()->all(), 'name')]]); ?>

    <?= $form->field($model, 'type')->dropDownList([
        ComputerSummary::TYPE_DESKTOP => Yii::t('computerSumaary','Desktop'),
        ComputerSummary::TYPE_LAPTOP => Yii::t('computerSumaary', 'Laptop'),
        ComputerSummary::TYPE_TABLET => Yii::t('computerSumaary', 'Tablet')
    ]) ?>

    <?= $form->field($model, 'modelNameVirtual')->widget(Select2::classname(), [
        'pluginOptions' => [
            'data' => ArrayHelper::getColumn(ComputerModel::find()->all(), function ($element) {
                return "{$element->brand->name}, $element->name";
            }),
        ]
    ]); ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
