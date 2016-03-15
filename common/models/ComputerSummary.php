<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "computer_summary".
 *
 * @property integer $id
 * @property string $name
 * @property integer $customer_id
 * @property integer $type_id
 * @property integer $model_id
 * @property string $serial_number
 * @property string $datetime_created
 * @property string $datetime_updated
 *
 * @property ComputerModel $model
 * @property Customer $customer
 * @property Log[] $logs
 * @property MaintenanceRequest[] $maintenanceRequests
 */
class ComputerSummary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'computer_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'type_id', 'model_id'], 'integer'],
            [['datetime_created', 'datetime_updated'], 'safe'],
            [['name', 'serial_number'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('computerSummary', 'ID'),
            'name' => Yii::t('computerSummary', 'Name'),
            'customer_id' => Yii::t('computerSummary', 'Customer ID'),
            'type_id' => Yii::t('computerSummary', 'Type ID'),
            'model_id' => Yii::t('computerSummary', 'Model ID'),
            'serial_number' => Yii::t('computerSummary', 'Serial Number'),
            'datetime_created' => Yii::t('computerSummary', 'Datetime Created'),
            'datetime_updated' => Yii::t('computerSummary', 'Datetime Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(ComputerModel::className(), ['id' => 'model_id']);
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
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['computer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::className(), ['computer_id' => 'id']);
    }
}
