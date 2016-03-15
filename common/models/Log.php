<?php

namespace common\models;

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
class Log extends \yii\db\ActiveRecord
{
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
            [['computer_id', 'type_id', 'mode'], 'integer'],
            [['event_datetime', 'datetime_created', 'datetime_updated'], 'safe'],
            [['description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('log', 'ID'),
            'computer_id' => Yii::t('log', 'Computer ID'),
            'type_id' => Yii::t('log', 'Type ID'),
            'mode' => Yii::t('log', 'Mode'),
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
