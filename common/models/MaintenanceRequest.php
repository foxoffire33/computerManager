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
            [['date_done', 'date_apointment', 'datetime_created', 'datetime_updated'], 'safe'],
            [['computerNameVirtual'], 'exist', 'targetClass' => 'common\models\ComputerSummary', 'targetAttribute' => 'name'],
            ['status', 'in', 'range' => [self::STATUS_REQUEST, self::STATUS_PROCESS, self::STATUS_DONE]]
        ];
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
            'datetime_created' => Yii::t('maintenaceRequest', 'Datetime Created'),
            'datetime_updated' => Yii::t('maintenaceRequest', 'Datetime Updated'),
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
