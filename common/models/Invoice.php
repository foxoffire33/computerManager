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
 * @property string $created_at
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
            [['customerNameVirtual', 'payed', 'invoice_number', 'invoice_date'], 'required'],
            [['customer_id', 'payed'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
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
            'id' => Yii::t('invoice', 'ID'),
            'customer_id' => Yii::t('invoice', 'Customer ID'),
            'reference' => Yii::t('invoice', 'Reference'),
            'invoice_number' => Yii::t('invoice', 'Invoice Number'),
            'invoice_date' => Yii::t('invoice', 'Invoice Date'),
            'payed' => Yii::t('invoice', 'Payed'),
            'description' => Yii::t('invoice', 'Description'),
            'created_at' => Yii::t('common', 'Datetime Created'),
            'updated_at' => Yii::t('common', 'Datetime Updated'),
            'inBtw' => Yii::t('invoice', 'Incl Btw'),
            'exBtw' => Yii::t('invoice', 'Excl Btw'),
            //form labels
            'customerNameVirtual' => Yii::t('customer', 'Customer')
        ];
    }

    public function checkInvoiceNumber()
    {
        if (empty($this->invoice_number)) {
            $query = self::find()->select('max(invoice_number) as invoice_number')
                ->where(['year(invoice_date)' => $this->invoice_date])
                ->asArray()
                ->one();
            if (intval($query['invoice_number']) == 0) {
                $this->invoice_number = date('Y') . '00001';
            } else {
                $this->invoice_number = intval($query['invoice_number']) + 1;
            }
        }
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
