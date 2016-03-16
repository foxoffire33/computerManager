<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ComputerSummary */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('computerSummary', 'Computer Summaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computer-summary-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('computerSummary', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('computerSummary', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('computerSummary', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'customer_id',
            'type',
            'serial_number',
            'datetime_created:datetime',
            'datetime_updated:datetime',
        ],
    ]) ?>

</div>
