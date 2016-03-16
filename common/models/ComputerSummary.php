<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;
use yii\db\Expression;


/**
 * This is the model class for table "computer_summary".
 *
 * @property integer $id
 * @property string $name
 * @property integer $customer_id
 * @property integer $type
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
class ComputerSummary extends ActiveRecord
{

    const TYPE_DESKTOP = 0;
    const TYPE_LAPTOP = 1;

    public $modelNameVirtual;
    public $customerNameVirtual;

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
            [['name', 'modelNameVirtual', 'customerNameVirtual', 'serial_number', 'type'], 'required'],
            [['serial_number'], 'unique'],
            [['customer_id', 'type', 'model_id'], 'integer'],
            [['datetime_created', 'datetime_updated'], 'safe'],
            [['name', 'serial_number'], 'string', 'max' => 128],
            ['type', 'in', 'range' => [self::TYPE_DESKTOP, self::TYPE_LAPTOP]],
            [['customerNameVirtual'], 'exist', 'targetClass' => 'common\models\Customer', 'targetAttribute' => 'name'],
            [['modelNameVirtual'], 'checkIfComputerModelExist'],
        ];
    }

    public function checkIfComputerModelExist()
    {
        $model = ComputerModel::find()
            ->select(['computer_model.id', new Expression('CONCAT(lower(brand.name),\', \',lower(computer_model.name)) as name')])
            ->joinWith('brand')
            ->having('name = :name', ['name' => strtolower($this->modelNameVirtual)])
            ->one();
        if (!empty($model)) {
            $this->model_id = $model->id;
        } else {
            $this->addError('modelNameVirtual', Yii::t('computerSummary', 'Model name in correct'));
        }
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
            'id' => Yii::t('computerSummary', 'ID'),
            'name' => Yii::t('computerSummary', 'Name'),
            'customer_id' => Yii::t('computerSummary', 'Customer ID'),
            'type' => Yii::t('computerSummary', 'Type'),
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
