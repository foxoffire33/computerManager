<?php
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;

$this->params['breadcrumbs'][] = Yii::t('maintenaceRequest', 'Maintenance Request');
?>
    <div class="container">
        <p>
            Via het formulier hier onder kunt u snel en makkelijk een reparaie aanvragen.<br/>
            Wij nemen dan zo snel mogelijk contact met u op om de computer bij u thuis op te halen.
            <br/> Of bij u thuis klaar te maken <?= Html::a('mogelijkheden', ['/page/mogelijkheden-thuis']); ?><br/>
            En als uw computer klaar is sluiten wij alles weer bij u thuis aan.
            Nog vragen? neem dan contact met ons op via het <?= Html::a('contact formulier', ['/site/contact']) ?> of
            bel

        </p>
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false,
            'enableAjaxValidation' => true,
            'validateOnSubmit' => true,
            'validateOnChange' => false,
            'validateOnBlur' => false,
        ]); ?>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'firstName')->textInput() ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'lastName')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'phone')->textInput(['type' => 'tel']) ?>
            </div>
        </div>
        <div class="row col-sm-12">
            <?= $form->field($model, 'address')->textInput() ?>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'city')->textInput() ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'zipcode')->textInput(['keyup' => 'alert($(this).val())']) ?>
            </div>
        </div>
        <div class="row col-sm-12">
            <?= $form->field($model, 'description')->textArea(['rows' => 6]); ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('maintenaceRequest', 'Requesting'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php $this->registerJs('$(\'#maintenancerequestform-zipcode\').keyup(function(e){$(this).val($(this).val().toUpperCase());})'); ?>