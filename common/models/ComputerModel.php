<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "computer_model".
 *
 * @property integer $id
 * @property integer $brand_id
 * @property string $name
 * @property string $created_at
 * @property string $datetime_updated
 *
 * @property Brand $brand
 * @property ComputerSummary[] $computerSummaries
 */
class ComputerModel extends ActiveRecord
{
    public $virtualBrandName;

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
            [['virtualBrandName', 'name'], 'required'],
            [['brand_id'], 'integer'],
            [['name', 'virtualBrandName'], 'unique', 'targetAttribute' => 'name'],
            //deze validatetor voert een query uit op het brand model en kijkt of name bestaat
            [['virtualBrandName'], 'exist', 'targetClass' => 'common\models\Brand', 'targetAttribute' => 'name'],
            //safe
            [['created_at', 'updated_at', 'virtualBrandName'], 'safe'],
            //char limits
            [['name'], 'string', 'max' => 128],
            //
            ['name', 'match', 'not' => true, 'pattern' => '/,/'],
        ];
    }

    public function beforeSave($insert)
    {
        //set brand_id
        $brand = Brand::find()->where(['lower(name)' => strtolower($this->virtualBrandName)])->one();
        $this->brand_id = $brand->id;
        //return parent
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand_id' => Yii::t('brand', 'Brand'),
            'name' => Yii::t('computerModel', 'Name'),
            'virtualBrandName' => Yii::t('brand', 'Brand'),
            'created_at' => Yii::t('common', 'Datetime Created'),
            'updated_at' => Yii::t('common', 'Datetime Updated'),
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

    public function beforeDelete()
    {
        return $this->name !== 'Onbekend';
    }
}
