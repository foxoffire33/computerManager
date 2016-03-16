<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $country
 * @property string $address
 * @property string $zipcode
 * @property string $city
 * @property string $email
 * @property string $phone
 * @property string $webpage
 * @property string $datetime_created
 * @property string $datetime_updated
 *
 * @property ComputerModel[] $computerModels
 */
class Brand extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'webpage'], 'unique'],
            ['email', 'email'],
            ['webpage', 'url'],
            [['datetime_created', 'datetime_updated'], 'safe'],
            [['name', 'country', 'address', 'zipcode', 'city', 'email', 'phone', 'webpage'], 'string', 'max' => 128],
            ['name', 'match', 'not' => true, 'pattern' => '/,/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('brand', 'ID'),
            'name' => Yii::t('brand', 'Name'),
            'country' => Yii::t('brand', 'Country'),
            'address' => Yii::t('brand', 'Address'),
            'zipcode' => Yii::t('brand', 'Zipcode'),
            'city' => Yii::t('brand', 'City'),
            'email' => Yii::t('brand', 'Email'),
            'phone' => Yii::t('brand', 'Phone'),
            'webpage' => Yii::t('brand', 'Webpage'),
            'datetime_created' => Yii::t('brand', 'Datetime Created'),
            'datetime_updated' => Yii::t('brand', 'Datetime Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComputerModels()
    {
        return $this->hasMany(ComputerModel::className(), ['brand_id' => 'id']);
    }
}
