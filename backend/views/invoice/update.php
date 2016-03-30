<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Invoice */

$this->title = Yii::t('common', 'Update: {name}', ['name' => $model->invoice_number]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('invoice', 'Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('invoice', 'Update');
?>
<div class="invoice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'invoiceRules' => $invoiceRules]) ?>

</div>
