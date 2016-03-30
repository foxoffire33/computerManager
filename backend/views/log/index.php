<?php

use common\models\Log;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('log', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'computer_id' => [
                'attribute' => 'computer_id',
                'value' => function ($data) {
                    return $data->computer->name;
                }
            ],
            'type' => [
                'filter' => [
                    Log::TYPE_INFORMATION => Yii::t('log', 'Information'),
                    Log::TYPE_WARNING => Yii::t('log', 'Warning'),
                    Log::TYPE_ERROR => Yii::t('log', 'Error')
                ],
                'attribute' => 'type',
                'value' => function ($data) {
                    return ($data->type == Log::TYPE_INFORMATION ? Yii::t('log', 'Information') : ($data->type == Log::TYPE_WARNING ? Yii::t('log', 'Warning') : Yii::t('log', 'Error')));
                }
            ],
            'event_datetime',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
