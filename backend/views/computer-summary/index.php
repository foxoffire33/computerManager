<?php

use common\models\ComputerSummary;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ComputerSummarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('computerSummary', 'Computer Summaries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computer-summary-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('computerSummary', 'Create Computer Summary'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'customer_id' => [
                'attribute' => 'customer_id',
                'value' => function ($data) {
                    return $data->customer->name;
                }
            ],
            'type' => [
                'filter' => [
                    ComputerSummary::TYPE_DESKTOP => Yii::t('computerSummary', 'Desktop'),
                    ComputerSummary::TYPE_LAPTOP => Yii::t('computerSummary', 'Laptop')
                ],
                'attribute' => 'type',
                'value' => function ($data) {
                    return ($data->type ? Yii::t('computerSummary', 'Laptop') : Yii::t('computerSummary', 'Desktop'));
                }
            ],
            'model_id' => [
                'attribute' => 'model_id',
                'value' => function ($data) {
                    return $data->model->brand->name . ', ' . $data->model->id;
                }
            ],
            'serial_number',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
