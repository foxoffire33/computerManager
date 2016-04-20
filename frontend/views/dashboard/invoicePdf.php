<?php
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

?>
<div class="row">
    <div style="width: 65%;float: left">
        <?= yii\helpers\Html::img('/images/logo.png', ['alt' => 'logo']); ?>
        </div>
    <div style="width: 34%;float: right">
        <address>
            <strong>Computeronderhouden.nl</strong><br>
            Zeewinde 3-11A, 9738 AM<br>
            Groningen
        </address>
    </div>
</div>
<div class="row">
    <p>
            <?= GridView::widget([
                'summary' => false,
                'dataProvider' => new ArrayDataProvider(['allModels' => $model->invoiceRules]),
                'columns' => [
                    'name',
                    'price:currency',
                    'quantity',
                    'subtotal:currency',
                ],
            ]) ?>
        </p>
</div>
<div class="row">
    <div class="col-xs-offset-9 col-xs-3">
        <?php if (!empty($model->allBtwPercanges)): ?>
            <?php foreach ($model->allBtwPercanges as $btw): ?>
                <div class="row">
                    <strong><?= $btw['name'] ?> </strong><?= Yii::$app->formatter->asCurrency($btw['total']) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <br/>
        <div class="row">
            <?= Yii::t('dashboard', '<strong>Totaal:</strong> {total}', ['total' => Yii::$app->formatter->asCurrency($model->inBtw)]) ?>
            </div>
    </div>
</div>
</div>