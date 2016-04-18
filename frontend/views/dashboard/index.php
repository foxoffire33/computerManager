<?php
use yii\bootstrap\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\widgets\DetailView;

$this->params['breadcrumbs'][] = Yii::t('dashboard', 'Dashboard');
?>
<div class="row">
    <div class="col-sm-8">
        <h3><?= Yii::t('dashboard', 'My invoices') ?></h3>
        <p>
            <?= GridView::widget([
                'dataProvider' => new ArrayDataProvider(['allModels' => $customer->invoices,
                    'pagination' => [
                        'pageSize' => 10,
                    ]]),
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'reference' => [
                        'attribute' => 'reference',
                        'header' => Yii::t('invoice', 'Reference'),
                    ],
                    'invoice_number' => [
                        'attribute' => 'invoice_number',
                        'header' => Yii::t('invoice', 'Invoice Number')
                    ],
                    'payed:boolean' => [
                        'attribute' => 'payed',
                        'header' => Yii::t('invoice', 'Payed')
                    ],
                    'exBtw:currency' => [
                        'attribute' => 'exBtw',
                        'header' => Yii::t('invoice', 'Excl btw'),
                    ],
                    'inBtw:currency' => [
                        'attribute' => 'inBtw',
                        'header' => Yii::t('invoice', 'Incl btw'),
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{download}',
                        'contentOptions' => ['width' => 15],
                        'buttons' => [
                            'download' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-download"></i> ', ['download-invoice', 'id' => $model->id]);
                            },
                        ]
                    ],
                ],
            ]); ?>
        </p>
    </div>
    <div class="col-sm-4">
        <h3><?= Yii::t('dashboard', 'My information') ?></h3>
        <div class="row">
            <?= DetailView::widget([
                'model' => $customer,
                'attributes' => [
                    'name',
                    'adres',
                    'zipcode',
                    'city',
                    'email:email',
                    'phone',
                    'iban',
                ],
            ]) ?>
            <?= Html::a(Yii::t('common', 'Update'), ['update-information'], ['class' => 'btn btn-lg btn-theme col-sm-12']) ?>
        </div>
    </div>
</div>
<div class="row">
    <h3><?= Yii::t('dashboard', 'Computers') ?></h3>
    <?php if (!empty($customer->computerSummaries)): ?>
        <?php foreach ($customer->computerSummaries as $computer): ?>
            <div class="col-sm-4">
                <div class="pricing-box-alt">
                    <div class="pricing-heading">
                        <h3><strong><?= $computer->name ?></strong></h3>
                    </div>
                    <div class="pricing-terms">
                        <h6><?= "{$computer->model->brand->name}, {$computer->model->name}" ?></h6>
                    </div>
                    <div class="pricing-content">
                        <ul>
                            <li>
                                <i class="icon-ok"></i><?= \Yii::t('maintenaceRequest', 'Maintenance requests ({count})', ['count' => count($computer->maintenanceRequests)]) ?>
                            </li>
                            <li>
                                <i class="icon-ok"></i><?= \Yii::t('log', 'Logs ({count})', ['count' => count($computer->logs)]) ?>
                            </li>
                        </ul>
                    </div>
                    <div class="pricing-action">
                        <?= Html::a(Yii::t('common', 'view'), ['dashboard/view-computer', 'id' => $computer->id], ['class' => 'btn btn-medium btn-theme']) ?>
                        <?= Html::a(Yii::t('maintenaceRequest', 'Maintenance Requests'), ['maintenance-request/existing-computer', 'id' => $computer->id], ['class' => 'btn btn-medium btn-warning']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>