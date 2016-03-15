<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\InvoiceRuleTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('invoiceRuleType', 'Invoice Rule Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-rule-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('invoiceRuleType', 'Create Invoice Rule Type'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'datetime_created',
            'datetime_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
