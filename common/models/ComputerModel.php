<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "computer_model".
 *
 * @property integer $id
 * @property integer $brand_id
 * @property string $name
 * @property string $datetime_created
 * @property string $datetime_updated
 *
 * @property Brand $brand
 * @property ComputerSummary[] $computerSummaries
 */
class ComputerModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'computer_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id'], 'integer'],
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
            'id' => Yii::t('brand', 'ID'),
            'brand_id' => Yii::t('brand', 'Brand ID'),
            'name' => Yii::t('brand', 'Name'),
            'datetime_created' => Yii::t('brand', 'Datetime Created'),
            'datetime_updated' => Yii::t('brand', 'Datetime Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComputerSummaries()
    {
        return $this->hasMany(ComputerSummary::className(), ['model_id' => 'id']);
    }
}
