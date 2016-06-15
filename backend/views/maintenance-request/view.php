<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\MaintenanceRequest;

/* @var $this yii\web\View */
/* @var $model common\models\MaintenanceRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('maintenaceRequest', 'Maintenance Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-request-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'computer_id' => [
                'attribute' => 'computer_id',
                'value' => $model->computer->name,
            ],
            'status' => [
                'attribute' => 'status',
                'value' => ($model->status == MaintenanceRequest::STATUS_REQUEST ? Yii::t('maintenaceRequest', 'Request') :
                    ($model->status == MaintenanceRequest::STATUS_PROCESS ? Yii::t('maintenaceRequest', 'Process')
                        : Yii::t('maintenaceRequest', 'Done')))
            ],
            'date_done:datetime',
            'date_apointment:datetime',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <div class="text-info">
        <?= nl2br($model->description); ?>
    </div>

</div>
