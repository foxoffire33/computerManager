<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\InvoiceRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('invoiceRule', 'Invoice Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-rule-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('invoiceRule', 'Create Invoice Rule'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'invoice_id',
            'type_id',
            'vat_id',
            'name',
            // 'price',
            // 'quantity',
            // 'datetime_created',
            // 'datetime_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
