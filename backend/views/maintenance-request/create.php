<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MaintenanceRequest */

$this->title = Yii::t('maintenanceRequest', 'Create Maintenance Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('maintenanceRequest', 'Maintenance Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
