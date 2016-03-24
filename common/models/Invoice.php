<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $reference
 * @property string $invoice_number
 * @property integer $payed
 * @property string $description
 * @property string $datetime_created
 * @property string $datetime_updated
 *
 * @property Customer $customer
 * @property InvoiceRule[] $invoiceRules
 */
class Invoice extends ActiveRecord
{

    const PAYED_NO = 0;
    const PAYED_YES = 1;

    public $customerNameVirtual;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerNameVirtual', 'payed', 'invoice_number'], 'required'],
            [['customer_id', 'payed'], 'integer'],
            [['description'], 'string'],
            [['datetime_created', 'datetime_updated'], 'safe'],
            [['reference', 'invoice_number'], 'string', 'max' => 128],
            [['customerNameVirtual'], 'exist', 'targetClass' => 'common\models\Customer', 'targetAttribute' => 'name'],
            [['payed'], 'in', 'range' => [self::PAYED_NO, self::PAYED_YES]]

        ];
    }

    public function beforeSave($insert)
    {
        $customer = Customer::find()->where(['lower(name)' => strtolower($this->customerNameVirtual)])->one();
        $this->customer_id = $customer->id;
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('customer', 'ID'),
            'customer_id' => Yii::t('customer', 'Customer ID'),
            'reference' => Yii::t('customer', 'Reference'),
            'invoice_number' => Yii::t('customer', 'Invoice Number'),
            'payed' => Yii::t('customer', 'Payed'),
            'description' => Yii::t('customer', 'Description'),
            'datetime_created' => Yii::t('customer', 'Datetime Created'),
            'datetime_updated' => Yii::t('customer', 'Datetime Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceRules()
    {
        return $this->hasMany(InvoiceRule::className(), ['invoice_id' => 'id']);
    }

    //this rrelation count total exBtw
    public function getExBtw()
    {
        return $this->hasMany(InvoiceRule::className(), ['invoice_id' => 'id'])
            ->select('sum(invoice_rule.quantity*invoice_rule.price) as inBtw')
            ->one()
            ->inBtw;
    }

    public function getInBtw()
    {
        return $this->hasMany(InvoiceRule::className(), ['invoice_id' => 'id'])
            ->select('sum(invoice_rule.quantity*invoice_rule.price/100*vat.procentage+(invoice_rule.quantity*invoice_rule.price)) as exBtw')
            ->joinWith('vat')
            ->one()
            ->exBtw;
    }

    public function getAllBtwPercanges()
    {
        $query = InvoiceRule::find()
            ->select('vat.*,invoice_rule.vat_id,sum(invoice_rule.price*invoice_rule.quantity/100*vat.procentage) as total')
            ->joinWith('vat')
            ->where(['invoice_rule.invoice_id' => $this->id])
            ->groupBy('vat.id')
            ->asArray()
            ->all();
        return $query;
    }

}
