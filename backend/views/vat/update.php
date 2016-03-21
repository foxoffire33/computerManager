<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vat */

$this->title = Yii::t('vat', 'Update {modelClass}: ', [
    'modelClass' => 'Vat',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('vat', 'Vats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('vat', 'Update');
?>
<div class="vat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
