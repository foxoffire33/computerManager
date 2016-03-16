<?php

use common\models\Brand;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\select2;

/* @var $this yii\web\View */
/* @var $model common\models\ComputerModel */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="computer-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'virtualBrandName')->widget(Select2::classname(), [
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'data' => ArrayHelper::getColumn(Brand::find()->all(), 'name'),
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('computerModel', 'Create') : Yii::t('computerModel', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
