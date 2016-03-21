<?php

use common\models\Invoice;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('invoice', 'Invoices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('invoice', 'Create Invoice'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'customer_id' => [
                'attribute' => 'customer_id',
                'value' => function ($data) {
                    return $data->customer->name;
                }
            ],
            'reference',
            'invoice_number',
            'payed' => [
                'filter' => [
                    Invoice::PAYED_NO => Yii::t('invoice', 'No'),
                    Invoice::PAYED_YES => Yii::t('invoice', 'Yes')
                ],
                'attribute' => 'payed',
                'value' => function ($data) {
                    return ($data->payed ? Yii::t('invoice', 'Yes') : Yii::t('nvoice', 'No'));
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
