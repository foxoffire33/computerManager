<?php

use yii\grid\GridView;
use yii\helpers\Html;
use common\models\Vat;
use common\models\InvoiceRuleType;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\InvoiceRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('invoiceRule', 'Invoice Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-rule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'invoice_id' => [
                'attribute' => 'invoice_id',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data->invoice->invoice_number, ['/invoice/view', 'id' => $data->invoice_id]);
                }
            ],
            'type_id' => [
                'filter' => ArrayHelper::map(InvoiceRuleType::find()->asArray()->all(), 'id', 'name'),
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return $data->type->name;
                }
            ],
            'vat_id' => [
                'filter' => ArrayHelper::map(Vat::find()->asArray()->all(), 'id', 'name'),
                'attribute' => 'vat_id',
                'value' => function ($data) {
                    return $data->vat->name;
                }
            ],
            'quantity',
            'price:currency',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
