<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\InvoiceRuleType */

$this->title = Yii::t('common', 'Update: {name}', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('invoiceRuleType', 'Invoice Rule Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('invoiceRuleType', 'Update');
?>
<div class="invoice-rule-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
