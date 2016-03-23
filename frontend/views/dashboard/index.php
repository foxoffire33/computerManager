<?php
use yii\bootstrap\Html;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\widgets\DetailView;

?>
<div class="row">
    <div class="col-sm-8">
        <h3><?= Yii::t('dashboard', 'My invoices') ?></h3>
        <p>
            <?= GridView::widget([
                'dataProvider' => new ArrayDataProvider(['allModels' => $customer->invoices]),
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'reference',
                    'invoice_number',
                    'payed:boolean',
                    'exBtw:currency',
                    'inBtw:currency',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{download}{mail}{print}',
                        'contentOptions' => ['width' => 70],
                        'buttons' => [
                            'download' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-download"></i> ', ['download-pdf', 'id' => $model->id]);
                            },
                            'mail' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-envelope"></i> ', ['mail', 'id' => $model->id]);
                            },
                            'print' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-print"></i> ', ['print', 'id' => $model->id]);
                            },
                        ]
                    ],
                ],
            ]); ?>
        </p>
    </div>
    <div class="col-sm-4">
        <h3><?= Yii::t('dashboard', 'My information') ?></h3>
        <p>
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
        </p>
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
                                <i class="icon-ok"></i><?= \Yii::t('maintenance', 'Maintenance requests ({count})', ['count' => count($computer->maintenanceRequests)]) ?>
                            </li>
                            <li>
                                <i class="icon-ok"></i><?= \Yii::t('log', 'Logs ({count})', ['count' => count($computer->logs)]) ?>
                            </li>
                        </ul>
                    </div>
                    <div class="pricing-action">
                        <?= Html::a(Yii::t('common', 'view'), ['dashboard/computer', 'id' => $computer->id], ['class' => 'btn btn-medium btn-theme']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>