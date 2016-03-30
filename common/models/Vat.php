<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "vat".
 *
 * @property integer $id
 * @property string $name
 * @property integer $procentage
 * @property string $datetime_created
 * @property string $datetime_updated
 *
 * @property InvoiceRule[] $invoiceRules
 */
class Vat extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'procentage'], 'integer'],
            [['datetime_created', 'datetime_updated'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('vat', 'ID'),
            'name' => Yii::t('vat', 'Name'),
            'procentage' => Yii::t('vat', 'Procentage'),
            'datetime_created' => Yii::t('common', 'Datetime Created'),
            'datetime_updated' => Yii::t('common', 'Datetime Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceRules()
    {
        return $this->hasMany(InvoiceRule::className(), ['vat_id' => 'id']);
    }
}
