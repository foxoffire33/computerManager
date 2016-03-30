<?php

use common\models\MaintenanceRequest;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MaintenanceRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('maintenaceRequest', 'Maintenance Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-request-index">

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
            'status' => [
                'filter' => [
                    MaintenanceRequest::STATUS_REQUEST => Yii::t('maintenaceRequest', 'Request'),
                    MaintenanceRequest::STATUS_PROCESS => Yii::t('maintenaceRequest', 'Process'),
                    MaintenanceRequest::STATUS_DONE => Yii::t('maintenaceRequest', 'Done'),
                ],
                'attribute' => 'status',
                'value' => function ($data) {
                    return ($data->status == MaintenanceRequest::STATUS_REQUEST ? Yii::t('maintenaceRequest', 'Request') :
                        ($data->status == MaintenanceRequest::STATUS_PROCESS ? Yii::t('maintenaceRequest', 'Process')
                            : Yii::t('maintenaceRequest', 'Done')));
                }
            ],
            'description:ntext',
            'date_done:datetime',
            'date_apointment:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
