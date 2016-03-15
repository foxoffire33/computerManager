<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ComputerModel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('computerModel', 'Computer Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computer-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('computerModel', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('computerModel', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('computerModel', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'brand_id',
            'name',
            'datetime_created',
            'datetime_updated',
        ],
    ]) ?>

</div>
