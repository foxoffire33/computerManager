<?php
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = Yii::t('maintenaceRequest', 'Maintenance Request');
?>
<div class="container">
    <h1><?= Yii::t('maintenaceRequest', 'Maintenance Request'); ?></h1>
    <p>
        Via het formulier hieronder kunt u snel en makkelijk een reparatie aanvragen.
        Wij nemen dan zo snel mogelijk contact met u op om een afspraak te maken. Vervolgens
        overleggen we of de computer door ons wordt opgehaald of een reparatie op mogelijk is.
    </p>

    <p>Als uw computer klaar is sluiten wij alles weer bij u thuis aan.
        Vraag via onderstaand formulier uw onderhoud aan of neem contact met ons op via het .
    </p>
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'validateOnSubmit' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
    ]); ?>
    <div class="form-group">
        <div class="col-sm-6">
                <?= $form->field($model, 'firstName')->textInput() ?>
            </div>
        <div class="col-sm-6">
                <?= $form->field($model, 'lastName')->textInput() ?>
            </div>
    </div>
    <div class="form-group">
        <div class="col-sm-6">
                <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
            </div>
        <div class="col-sm-6">
                <?= $form->field($model, 'phone')->textInput(['type' => 'tel']) ?>
            </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <?= $form->field($model, 'address')->textInput() ?>                
            </div>
        <div class="col-sm-4">
                <?= $form->field($model, 'zipcode')->textInput(['keyup' => 'alert($(this).val())']) ?>
            </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
             <?= $form->field($model, 'city')->textInput() ?>
        </div
    </div>
    <div class="form-group">
        <div class=" col-sm-12">
            <?= $form->field($model, 'description')->textArea(['rows' => 6]); ?>
        </div>
    </div>
    <div class="row">
            <?= Html::submitButton(Yii::t('maintenaceRequest', 'Send maintenance request'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJs('$(\'#maintenancerequestform-zipcode\').keyup(function(e){$(this).val($(this).val().toUpperCase());})'); ?>
