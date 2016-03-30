<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\InvoiceRule */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('invoiceRule', 'Invoice Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-rule-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'invoice_id' => [
                'attribute' => 'invoice_id',
                'format' => 'html',
                'value' => Html::a($model->invoice->invoice_number, ['/invoice/view', 'id' => $model->invoice_id]),
            ],
            'type_id' => [
                'attribute' => 'type_id',
                'value' => $model->type->name
            ],
            'vat_id' => [
                'attribute' => 'vat_id',
                'value' => $model->vat->name
            ],
            'name',
            'price:currency',
            'quantity',
            'datetime_created:datetime',
            'datetime_updated:datetime',
        ],
    ]) ?>

</div>
