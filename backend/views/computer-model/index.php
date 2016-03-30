<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ComputerModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('computerModel', 'Computer Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computer-model-index">

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
            'brand_id' => [
                'attribute' => 'brand_id',
                'value' => function($data){
                    return $data->brand->name;
                }
            ],
            'datetime_created:datetime',
            'datetime_updated:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
