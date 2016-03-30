<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\InvoiceRuleType */

$this->title = Yii::t('common', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('invoiceRuleType', 'Invoice Rule Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-rule-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
