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
            [['customer_id', 'payed'], 'integer'],
            [['description'], 'string'],
            [['datetime_created', 'datetime_updated'], 'safe'],
            [['reference', 'invoice_number'], 'string', 'max' => 128]
        ];
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
}
