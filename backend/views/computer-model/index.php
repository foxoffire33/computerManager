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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('computerModel', 'Create Computer Model'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'brand_id',
            'name',
            'datetime_created',
            'datetime_updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
