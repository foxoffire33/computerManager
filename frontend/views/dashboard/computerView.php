<?php
use common\models\Log;
use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="pull-right row">
    <?= Html::a(Yii::t('common', 'Maintenance request'), ['maintenance-request/existing-computer', 'id' => $model->id], ['class' => 'btn btn-medium btn-warning']) ?>
</div>
<div class="row">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'type' => [
                'attribute' => 'type',
                'value' => ($model->type ? Yii::t('computerSummary', 'Laptop') : Yii::t('computerSummary', 'Desktop'))
            ],
            'serial_number',
            [
                'label' => Yii::t('maintenanceRequest', 'MaintenanceRequests'),
                'value' => count($model->maintenanceRequests)
            ],
        ],
    ]) ?>
    <h3><?= Yii::t('dashboard', 'Logs') ?></h3>
</div>
<?php if (!empty($model->logs)) {
    $logItems = [];
    foreach ($model->logs as $log) {
        $logItem = [
            'label' => $log->event_datetime,
            'content' => $log->description,
            'options' => ['class' => ($log->type == Log::TYPE_INFORMATION ? 'panel-success' : ($log->type == Log::TYPE_WARNING ? 'panel-warning' : 'panel-danger'))]
        ];
        $logItems[] = $logItem;
    }
} ?>
<?php if (!empty($logItems)): ?>
    <?= Collapse::widget(['items' => $logItems]); ?>
<?php else: ?>
    <div class="alert alert-info">
        <?= Yii::t('dashboard','No Logs found') ?>
    </div>
<?php endif; ?>
