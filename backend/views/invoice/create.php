<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Invoice */

$this->title = Yii::t('invoice', 'Create Invoice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('invoice', 'Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'invoiceRules' => $invoiceRules]) ?>

</div>
