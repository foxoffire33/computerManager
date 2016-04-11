<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "maintenance_request".
 *
 * @property integer $id
 * @property integer $computer_id
 * @property integer $status
 * @property string $description
 * @property string $date_done
 * @property string $date_apointment
 * @property string $datetime_created
 * @property string $datetime_updated
 *
 * @property ComputerSummary $computer
 */
class MaintenanceRequest extends ActiveRecord
{

    const STATUS_REQUEST = 0;
    const STATUS_PROCESS = 1;
    const STATUS_DONE = 2;
    //scenarios
    const SCENARIO_FRONTEND = 'frontend';

    public $computerNameVirtual;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maintenance_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['computerNameVirtual', 'description'], 'required'],
            ['status', 'required', 'on' => self::SCENARIO_DEFAULT],
            [['status'], 'default', 'value' => self::STATUS_REQUEST],
            [['computer_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['date_apointment', 'date_done'], 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],
            [['date_done', 'date_apointment', 'datetime_created', 'datetime_updated', 'computerNameVirtual'], 'safe'],
            [['computerNameVirtual'], 'exist', 'targetClass' => 'common\models\ComputerSummary', 'targetAttribute' => 'name'],
            ['status', 'in', 'range' => [self::STATUS_REQUEST, self::STATUS_PROCESS, self::STATUS_DONE]],
            [['computerNameVirtual', 'computer_id'], 'hasComputerAlReadyAMaintenenceRequestValidatetor']
        ];
    }


    /**
     * check is the computer has an maintenance request
     */
    public function hasComputerAlReadyAMaintenenceRequestValidatetor()
    {
        if ($this->isAttributeChanged('computer_id') || $this->isAttributeChanged('computerNameVirtual')) {
            //backend
            if (isset($this->computerNameVirtual) && ($computer = ComputerSummary::find()->where(['name' => $this->computerNameVirtual])->one())) {
                if (!empty(self::find()->where('computer_id = :computerID and status != :status', ['computerID' => $computer->id, 'status' => self::STATUS_DONE])->one())) {
                    $this->addError('computerNameVirtual', Yii::t('error', 'Computer has already an maintenance request.'));
                }
            } elseif (isset($this->computer_id)) {//frontend
                if (!empty(self::find()->where('computer_id = :computerID and status != :status', ['computerID' => $this->computer_id, 'status' => self::STATUS_DONE])->one())) {
                    $this->addError('description', Yii::t('error', 'Computer has already an maintenance request.'));
                }
            }
        }
    }

    public function beforeSave($insert)
    {
        if ($this->scenario == self::SCENARIO_DEFAULT) {
            $this->computer_id = ComputerSummary::find()->where(['name' => $this->computerNameVirtual])->one()->id;
        }
        return parent::beforeSave($insert);
    }

    public function scenarios()
    {
        return array_merge([
            self::SCENARIO_FRONTEND => ['computer_id', 'description', 'status']
        ], parent::scenarios());
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('maintenaceRequest', 'ID'),
            'computer_id' => Yii::t('maintenaceRequest', 'Computer ID'),
            'status' => Yii::t('maintenaceRequest', 'Status'),
            'description' => Yii::t('maintenaceRequest', 'Description'),
            'date_done' => Yii::t('maintenaceRequest', 'Date Done'),
            'date_apointment' => Yii::t('maintenaceRequest', 'Date Apointment'),
            'datetime_created' => Yii::t('common', 'Datetime Created'),
            'datetime_updated' => Yii::t('common', 'Datetime Updated'),
            //form labels
            'computerNameVirtual' => Yii::t('computerSummary', 'Computer')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComputer()
    {
        return $this->hasOne(ComputerSummary::className(), ['id' => 'computer_id']);
    }
}
