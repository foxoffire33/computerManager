<?php

use common\models\Customer;
use common\models\Invoice;
use common\models\InvoiceRuleType;
use common\models\Vat;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;


$nextIndex = count($invoiceRules);

$invoiceRuleTypes = ArrayHelper::map(InvoiceRuleType::find()->all(), 'id', 'name');
$vatOptions = ArrayHelper::map(Vat::find()->all(), 'id', 'name');
$this->registerJs('
	var nextIndex = ' . $nextIndex . ';
	var invoiceRuleTypes =' . JSON::encode($invoiceRuleTypes) . ';
	var vatOptions =' . JSON::encode($vatOptions) . ';

	$(\'#add-invoice-line\').click(addLine);
	$(\'.remove-invoice-line\').click(removeLine);

	function addLine()
	{
		$newRow = $(\'<tr/>\');

		$(\'<td/>\').append(formGroup(\'name\', textInput(\'name\'))).appendTo($newRow);
		$(\'<td/>\').append(formGroup(\'quantity\', textInput(\'quantity\'))).appendTo($newRow);
		$(\'<td/>\').append(formGroup(\'price\', textInput(\'price\'))).appendTo($newRow);
		$(\'<td/>\').append(formGroup(\'type_id\', selectInput(\'type_id\',$(invoiceRuleTypes)))).appendTo($newRow);
		$(\'<td/>\').append(formGroup(\'vat_id\', selectInput(\'vat_id\',$(vatOptions)))).appendTo($newRow);
		$(\'<td/>\').append(hiddenInput(\'id\')).append(deleteIcon()).appendTo($newRow);

		$(\'#invoice-lines tbody\').append($newRow);

		++nextIndex;
	}

	function removeLine()
	{
		$(this).closest(\'tr\').remove();
		return false;
	}

	function textInput(attribute)
	{
		return $(\'<input/>\', {
			id: \'InvoiceRule\' + nextIndex + \'-\' + attribute.toLowerCase(),
			class: \'form-control\',
			type: \'text\',
			name: \'InvoiceRule[\' + nextIndex + \'][\' + attribute + \']\'
		});
	}

	function selectInput(attribute, options)
	{
		$select =  $(\'<select/>\', {
			id: \'InvoiceRule\' + nextIndex + \'-\' + attribute.toLowerCase(),
			class: \'form-control\',
			name: \'InvoiceRule[\' + nextIndex + \'][\' + attribute + \']\'
		});

		$(options).each(function(key,option) {
		    var key = Object.keys(option)[0];
            var value = this[key];
			$select.append($(\'<option/>\', {
				text: value,
				value: key
			}));
		});

		return $select;
	}

	function formGroup(attribute, input)
	{
		return $(\'<div/>\', {
			class: \'form-group field-InvoiceRule\' + nextIndex + \'-\' + attribute.toLowerCase() + \' required\'
		}).append(input);
	}

	function hiddenInput(attribute)
	{
		return $(\'<input/>\', {
			id: \'InvoiceRule\' + nextIndex + \'-\' + attribute.toLowerCase(),
			type: \'hidden\',
			name: \'InvoiceRule[\' + nextIndex + \'][\' + attribute + \']\'
		});
	}

	function deleteIcon()
	{
		return $(\'<a/>\', {
			class: \'remove-invoice-line\',
			href: \'#\'
		}).append($(\'<span/>\', {
			class: \'glyphicon glyphicon-trash\'
		})).click(removeLine);
	}');

?>

<div class="invoice-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>

    <?= $form->field($model, 'customerNameVirtual')->widget(Select2::classname(), ['pluginOptions' => ['data' => ArrayHelper::getColumn(Customer::find()->all(), 'name')]]); ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoice_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invoice_date')->widget(DatePicker::classname(), ['pluginOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]); ?>

    <?= $form->field($model, 'payed')->dropDownList([Invoice::PAYED_NO => Yii::t('common', 'No'), Invoice::PAYED_YES => Yii::t('common', 'Yes')]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="row">
        <h2><?= Yii::t('invoiceRule', 'Invoice Rules') ?></h2>

        <table class="table table-bordered table-striped" id="invoice-lines">
            <thead>
            <tr>
                <th><?= Yii::t('invoiceRule', 'Name') ?></th>
                <th><?= Yii::t('invoiceRule', 'Quantity') ?></th>
                <th><?= Yii::t('invoiceRule', 'Price') ?></th>
                <th><?= Yii::t('invoiceRule', 'Type') ?></th>
                <th><?= Yii::t('invoiceRule', 'Vat ID') ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php $index = 0 ?>
            <?php if (!empty($invoiceRules)): ?>
                <?php foreach ($invoiceRules as $lineModel): ?>
                    <tr>
                        <td><?= $form->field($lineModel, 'name')->textInput(['name' => "InvoiceRule[$index][name]"])->label(false) ?></td>
                        <td><?= $form->field($lineModel, 'quantity')->textInput(['name' => "InvoiceRule[$index][quantity]"])->label(false) ?></td>
                        <td><?= $form->field($lineModel, 'price')->textInput(['name' => "InvoiceRule[$index][price]"])->label(false) ?></td>
                        <td><?= $form->field($lineModel, 'type_id')->dropDownList($invoiceRuleTypes, ['name' => "InvoiceRule[$index][type_id]", 'prompt' => Yii::t('common', 'Select')])->label(false) ?></td>
                        <td><?= $form->field($lineModel, 'vat_id')->dropDownList($vatOptions, ['name' => "InvoiceRule[$index][vat_id]", 'prompt' => Yii::t('common', 'Select')])->label(false) ?></td>
                        <td><?= $form->field($lineModel, 'id')->hiddenInput(['name' => "InvoiceRule[$index][id]"])->label(false) ?>
                            <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', ['class' => 'remove-invoice-line']) ?></td>
                    </tr>
                    <?php ++$index ?>
                <?php endforeach ?>
            <?php endif; ?>
            </tbody>
        </table>

        <div class="form-group">
            <?= Html::a(Yii::t('invoice', 'Add invoice line'), null, ['class' => 'btn btn-success', 'id' => 'add-invoice-line']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
