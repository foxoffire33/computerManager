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
        <?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'customer_id' => [
                'attribute' => 'customer_id',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data->customer->name, ['/customer/view', 'id' => $data->customer_id]);
                }
            ],
            'reference',
            'invoice_number',
            'payed' => [
                'filter' => [
                    Invoice::PAYED_NO => Yii::t('common', 'No'),
                    Invoice::PAYED_YES => Yii::t('common', 'Yes')
                ],
                'attribute' => 'payed',
                'value' => function ($data) {
                    return ($data->payed ? Yii::t('common', 'Yes') : Yii::t('common', 'No'));
                }
            ],
            'exBtw:currency',
            'inBtw:currency',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
