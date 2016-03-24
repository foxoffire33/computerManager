<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['action' => ['/maintenance-request/existing-computer', 'id' => $model->computer_id]]); ?>
<?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>
<div class="row">
    <?= Html::submitButton(Yii::t('dashboard', 'Request'),['class' => 'btn btn-lg btn-theme col-sm-10']) ?>
    <?= Html::a(Yii::t('dashboard', 'Back'),Yii::$app->request->referrer,['class' => 'btn btn-lg col-sm-2 btn-danger']) ?>
</div>
<?php ActiveForm::end(); ?>