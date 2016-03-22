<?php

use common\models\Invoice;
use common\models\InvoiceRuleType;
use common\models\Vat;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\InvoiceRule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-rule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invoiceNameVirtual')->widget(Select2::classname(), ['pluginOptions' => ['data' => ArrayHelper::getColumn(Invoice::find()->all(), 'invoice_number'),]]); ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(InvoiceRuleType::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'vat_id')->dropDownList(ArrayHelper::map(Vat::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('invoiceRule', 'Create') : Yii::t('invoiceRule', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
