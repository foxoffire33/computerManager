<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "log".
 *
 * @property integer $id
 * @property integer $computer_id
 * @property integer $type_id
 * @property integer $mode
 * @property string $event_datetime
 * @property string $description
 * @property string $datetime_created
 * @property string $datetime_updated
 *
 * @property ComputerSummary $computer
 */
class Log extends ActiveRecord
{

    const TYPE_INFORMATION = 0;
    const TYPE_WARNING = 1;
    const TYPE_ERROR = 2;

    public $computerNameVirtual;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['computerNameVirtual', 'event_datetime', 'type', 'description'], 'required'],
            [['type'], 'integer'],
            [['event_datetime', 'datetime_created', 'datetime_updated'], 'safe'],
            [['computerNameVirtual'], 'exist', 'targetClass' => 'common\models\ComputerSummary', 'targetAttribute' => 'name'],
            [['description'], 'string'],
            ['type', 'in', 'range' => [self::TYPE_INFORMATION, self::TYPE_WARNING, self::TYPE_ERROR]]
        ];
    }

    public function beforeSave($insert)
    {
        $this->computer_id = ComputerSummary::find()->where(['name' => $this->computerNameVirtual])->one()->id;
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('log', 'ID'),
            'computer_id' => Yii::t('log', 'Computer ID'),
            'type' => Yii::t('log', 'Type ID'),
            'event_datetime' => Yii::t('log', 'Event Datetime'),
            'description' => Yii::t('log', 'Description'),
            'datetime_created' => Yii::t('log', 'Datetime Created'),
            'datetime_updated' => Yii::t('log', 'Datetime Updated'),
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
