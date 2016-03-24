<?php

use common\models\Log;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Log */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('log', 'Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('log', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('log', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('log', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'computer_id' => [
                'attribute' => 'computer_id',
                'value' => $model->computer->name
            ],
            'type' => [
                'attribute' => 'type_id',
                'value' => ($model->type == Log::TYPE_INFORMATION ? Yii::t('log', 'Information') : ($model->type == Log::TYPE_WARNING ? Yii::t('log', 'Warning') : Yii::t('log', 'Error')))
            ],
            'event_datetime:datetime',
            'datetime_created:datetime',
            'datetime_updated:datetime',
        ],
    ]) ?>

    <div class="text-info">
        <?= nl2br($model->description); ?>
    </div>

</div>
