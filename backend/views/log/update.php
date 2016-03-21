<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Log */

$this->title = Yii::t('log', 'Update {modelClass}: ', [
    'modelClass' => 'Log',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('log', 'Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('log', 'Update');
?>
<div class="log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
