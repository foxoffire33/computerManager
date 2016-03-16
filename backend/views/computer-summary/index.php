<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            'customer_id',
            'type',
            'model_id',
             'serial_number',
            // 'datetime_created',
            // 'datetime_updated',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
