<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ComputerSummary */

$this->title = Yii::t('computerSummary', 'Create Computer Summary');
$this->params['breadcrumbs'][] = ['label' => Yii::t('computerSummary', 'Computer Summaries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computer-summary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
