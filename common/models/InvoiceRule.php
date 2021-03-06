<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "invoice_rule".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $type_id
 * @property integer $vat_id
 * @property string $name
 * @property double $price
 * @property double $quantity
 * @property string $created_at
 * @property string $datetime_updated
 *
 * @property Vat $vat
 * @property Invoice $invoice
 * @property InvoiceRuleType $type
 */
class InvoiceRule extends ActiveRecord
{

    const SCENARIO_INVOICEFORM = 'InvoiceForm';

    public $invoiceNameVirtual;
    public $exBtw;
    public $inBtw;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoiceNameVirtual','name', 'price', 'quantity', 'type_id', 'vat_id'], 'required'],
            [['invoice_id', 'type_id', 'vat_id'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['created_at', 'updated_at','name', 'price', 'quantity', 'type_id', 'vat_id','exBtw','inBtw'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['invoiceNameVirtual'], 'exist', 'targetClass' => 'common\models\Invoice', 'targetAttribute' => 'invoice_number'],
            ['type_id', 'exist', 'targetClass' => 'common\models\InvoiceRuleType', 'targetAttribute' => 'id'],
            ['vat_id', 'exist', 'targetClass' => 'common\models\Vat', 'targetAttribute' => 'id'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INVOICEFORM] = ['name', 'price', 'quantity', 'type_id', 'vat_id'];
        return $scenarios;
    }

    public function beforeSave($insert)
    {
        if (!empty($this->invoiceNameVirtual) && $this->scenario !== 'invoiceForm') {
            $this->invoice_id = Invoice::find()->where(['invoice_number' => $this->invoiceNameVirtual])->one()->id;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('invoiceRule', 'ID'),
            'invoice_id' => Yii::t('invoiceRule', 'Invoice ID'),
            'type_id' => Yii::t('invoiceRule', 'Type ID'),
            'vat_id' => Yii::t('invoiceRule', 'Vat ID'),
            'name' => Yii::t('invoiceRule', 'Name'),
            'price' => Yii::t('invoiceRule', 'Price'),
            'quantity' => Yii::t('invoiceRule', 'Quantity'),
            'created_at' => Yii::t('common', 'Datetime Created'),
            'updated_at' => Yii::t('common', 'Datetime Updated'),
            'invoiceNameVirtual' => Yii::t('invoice', 'Invoice Number')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVat()
    {
        return $this->hasOne(Vat::className(), ['id' => 'vat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(InvoiceRuleType::className(), ['id' => 'type_id']);
    }

    public function getSubtotaal()
    {
        return $this->quantity * $this->price;
    }

    public function getExBtw(){
        return $this->price * $this->quantity;
    }

    public function getInBtw(){
        return $this->exBtw / $this->vat->percentage + $this->exBtw;
    }
}
