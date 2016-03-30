<?php

use common\models\Brand;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\ComputerModel */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="computer-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'virtualBrandName')->widget(Select2::classname(), ['pluginOptions' => ['data' => ArrayHelper::getColumn(Brand::find()->all(), 'name')]]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
