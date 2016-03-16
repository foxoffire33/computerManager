<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ComputerSummary */

$this->title = Yii::t('computerSummary', 'Update {modelClass}: ', [
    'modelClass' => 'Computer Summary',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('computerSummary', 'Computer Summaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('computerSummary', 'Update');
?>
<div class="computer-summary-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
