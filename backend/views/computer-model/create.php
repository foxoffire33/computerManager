<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ComputerModel */

$this->title = Yii::t('common', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('computerModel', 'Computer Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computer-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
