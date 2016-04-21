<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Invoice */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('invoice', 'Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-view">

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

    <div class="row">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'customer_id' => [
                'attribute' => 'customer_id',
                'value' => $model->customer->name,
            ],
            'reference',
            'invoice_number',
            'payed:boolean',
            'exBtw:currency',
            'inBtw:currency',
            'description:ntext',
            'datetime_created',
            'datetime_updated',
        ],
    ]) ?>
    </div>
    <div class="row">
        <h3><?= Yii::t('invoice', 'Invoice rules') ?></h3>
        <p>
            <?= GridView::widget([
            'dataProvider' => new ArrayDataProvider(['allModels' => $model->invoiceRules]),
            'columns' => [
                'name',
                'price:currency',
                'quantity',
                'subtotaal:currency',
                [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                 'urlCreator' => function ($action, $model, $key, $index) {
                     return Yii::$app->urlManager->createUrl(['/invoice-rule/'.$action,'id' => $model->id]);
                 },
                ],
            ],
        ]) ?>
        </p>
    </div>

</div>
