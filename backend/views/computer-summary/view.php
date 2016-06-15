<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ComputerSummary;

/* @var $this yii\web\View */
/* @var $model common\models\ComputerSummary */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('computerSummary', 'Computer Summaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
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
            'name',
            'customer_id' => [
                'attribute' => 'customer_id',
                'value' => $model->customer->name
            ],
            'type' => [
                'attribute' => 'type',
                'value' => ($model->type == ComputerSummary::TYPE_LAPTOP ? Yii::t('computerSummary', 'Laptop') : ($model->type == ComputerSummary::TYPE_DESKTOP ? Yii::t('computerSummary', 'Desktop') : Yii::t('computerSummary', 'Tablet')))
            ],
            'serial_number',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
</div>

