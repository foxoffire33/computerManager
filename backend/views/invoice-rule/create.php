<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\InvoiceRule */

$this->title = Yii::t('invoiceRule', 'Create Invoice Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('invoiceRule', 'Invoice Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-rule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
