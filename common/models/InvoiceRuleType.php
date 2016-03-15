<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoice_rule_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $datetime_created
 * @property string $datetime_updated
 *
 * @property InvoiceRule[] $invoiceRules
 */
class InvoiceRuleType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_rule_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'name' => Yii::t('customer', 'Name'),
            'datetime_created' => Yii::t('customer', 'Datetime Created'),
            'datetime_updated' => Yii::t('customer', 'Datetime Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceRules()
    {
        return $this->hasMany(InvoiceRule::className(), ['type_id' => 'id']);
    }
}
