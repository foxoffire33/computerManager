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
 * @property string $datetime_created
 * @property string $datetime_updated
 *
 * @property Vat $vat
 * @property Invoice $invoice
 * @property InvoiceRuleType $type
 */
class InvoiceRule extends ActiveRecord
{
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
            [['invoice_id', 'type_id', 'vat_id'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['datetime_created', 'datetime_updated'], 'safe'],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('customer', 'ID'),
            'invoice_id' => Yii::t('customer', 'Invoice ID'),
            'type_id' => Yii::t('customer', 'Type ID'),
            'vat_id' => Yii::t('customer', 'Vat ID'),
            'name' => Yii::t('customer', 'Name'),
            'price' => Yii::t('customer', 'Price'),
            'quantity' => Yii::t('customer', 'Quantity'),
            'datetime_created' => Yii::t('customer', 'Datetime Created'),
            'datetime_updated' => Yii::t('customer', 'Datetime Updated'),
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
}
