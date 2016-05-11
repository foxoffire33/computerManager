<?php
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

?>
<div class="row">
    <div style="width: 34%;float: right">
                <?= yii\helpers\Html::img('/images/logo.png', ['alt' => 'logo']); ?>
    </div>
</div>
<div class="row">
    <div style="width: 65%;float: left">
        <address>
            <?= $model->customer->name ?><br>
            <?= $model->customer->adres ?><br>
            <?= $model->customer->zipcode ?> <?= $model->customer->city ?>
        </address>
    </div>
</div>
<div class="row">
    <p>
            <?= GridView::widget([
                'summary' => false,
                'dataProvider' => new ArrayDataProvider(['allModels' => $model->invoiceRules]),
                'columns' => [
                    [
                        'attribute' => 'name',
                        'contentOptions' => ['width' => 400],
                    ],
                    'price:currency',
                    [
                        'attribute' => 'quantity',
                        'contentOptions' => ['width' => 70],
                    ],
                    'subtotaal:currency',
                ],
            ]) ?>
        </p>
</div>
<div class="row">
    <div class="col-xs-offset-9 col-xs-3">
        <div class="row">
            <?= Yii::t('dashboard', '<strong>Totaal:</strong> {total}', ['total' => Yii::$app->formatter->asCurrency($model->inBtw)]) ?>
            </div>
    </div>
</div>
<div style=" position: absolute;bottom: 20px; right: 15px; z-index:-1;text-align: right">
    <p style="padding-bottom: 10px;">
        <strong>Contact</strong><br/>
        info@computeronderhouden.nl<br/>
        050 - 301 59 65<br>
    </p>
    <p style="padding-bottom: 10px;">
        <strong>Postadres</strong><br/>
        Zeewinde 3-11A<br/>
        9738 AM Groningen<br>
    </p>
    <p style="padding-bottom: 10px;">
        <strong>
            <small>www.computeronderhouden.nl</small>
        </strong>
    </p>
</div>