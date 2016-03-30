<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ComputerModel */

$this->title = Yii::t('common', 'Update: {name}', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('computerModel', 'Computer Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('computerModel', 'Update');
?>
<div class="computer-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
