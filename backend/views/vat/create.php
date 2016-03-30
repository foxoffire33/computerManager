<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Vat */

$this->title = Yii::t('common', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('vat', 'Vats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
