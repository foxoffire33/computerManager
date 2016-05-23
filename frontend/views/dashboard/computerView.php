<?php
use common\models\Log;
use common\models\MaintenanceRequest;
use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\ComputerSummary;

$this->params['breadcrumbs'][] = ['label' => Yii::t('dashboard', 'Dashboard'), 'url' => ['/dashboard']];
$this->params['breadcrumbs'][] = Yii::t('dashboard', 'View computer');
$this->params['breadcrumbs'][] = $model->name;

?>
<div class="pull-right row">
    <?= Html::a(Yii::t('maintenaceRequest', 'Maintenance Requests'), ['maintenance-request/existing-computer', 'id' => $model->id], ['class' => 'btn btn-medium btn-warning']) ?>
</div>
<div class="row">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'type' => [
                'attribute' => 'type',
                'value' => ($model->type == ComputerSummary::TYPE_LAPTOP ? Yii::t('computerSummary', 'Laptop') : ($model->type == ComputerSummary::TYPE_DESKTOP ? Yii::t('computerSummary', 'Desktop') : Yii::t('computerSummary', 'Tablet')))
            ],
            'serial_number',
            [
                'label' => Yii::t('maintenaceRequest', 'Maintenance Requests'),
                'value' => count($model->maintenanceRequests)
            ],
            [
                'label' => Yii::t('log', 'Logs'),
                'value' => count($model->logs)
            ],
        ],
    ]) ?>
</div>
<div class="col-sm-6">
    <h3><?= Yii::t('log', 'Logs') ?></h3>
    <?php if (!empty($model->logs)) {
        $logItems = [];
        foreach ($model->logs as $log) {
            $logItem = [
                'label' => Yii::$app->formatter->asDatetime($log->event_datetime),
                'content' => nl2br($log->description),
                'options' => ['class' => ($log->type == Log::TYPE_INFORMATION ? 'panel-success' : ($log->type == Log::TYPE_WARNING ? 'panel-warning' : 'panel-danger'))]
            ];
            $logItems[] = $logItem;
        }
    } ?>
    <?php if (!empty($logItems)): ?>
        <?= Collapse::widget(['items' => $logItems]); ?>
    <?php else: ?>
        <div class="alert alert-danger">
            <?= Yii::t('dashboard', 'No Logs found') ?>
        </div>
    <?php endif; ?>
</div>
<div class="col-sm-6">
    <h3><?= Yii::t('maintenaceRequest', 'Maintenance Requests') ?></h3>
    <?php if (!empty($model->maintenanceRequests)) {
        $logItems = [];
        foreach ($model->maintenanceRequests as $maintenanceRequest) {
            $logItem = [
                'label' => Yii::$app->formatter->asDate($maintenanceRequest->datetime_created),
                'content' => $maintenanceRequest->description,
                'content' => DetailView::widget([
                    'model' => $maintenanceRequest,
                    'attributes' => [
                        'status' => [
                            'attribute' => 'status',
                            'value' => ($maintenanceRequest->status == MaintenanceRequest::STATUS_REQUEST ? Yii::t('maintenaceRequest', 'Request') :
                                ($maintenanceRequest->status == MaintenanceRequest::STATUS_PROCESS ? Yii::t('maintenaceRequest', 'Process')
                                    : Yii::t('maintenaceRequest', 'Done'))),
                        ],
                        'date_done:datetime',
                        'date_apointment:datetime',
                        'datetime_created:datetime',
                        'datetime_updated:datetime',
                        'description',
                    ],
                ]),
                'options' => ['class' => ($maintenanceRequest->status == MaintenanceRequest::STATUS_REQUEST ? 'panel-danger' : ($maintenanceRequest->status == MaintenanceRequest::STATUS_PROCESS ? 'panel-warning' : 'panel-success'))]
            ];
            $logItems[] = $logItem;
        }
    } ?>
    <?php if (!empty($logItems)): ?>
        <?= Collapse::widget(['items' => $logItems]); ?>
    <?php else: ?>

        <div class="alert alert-danger">
            <?= Yii::t('dashboard', 'No Maintenance requests found') ?>
        </div>
    <?php endif; ?>
</div>
