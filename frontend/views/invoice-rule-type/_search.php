<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\InvoiceRuleTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-rule-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'datetime_created') ?>

    <?= $form->field($model, 'datetime_updated') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('invoiceRuleType', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('invoiceRuleType', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
