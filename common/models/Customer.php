<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $name
 * @property string $adres
 * @property string $zipcode
 * @property string $city
 * @property string $email
 * @property string $phone
 * @property string $iban
 * @property string $datetime_created
 * @property string $datetime_updated
 *
 * @property ComputerSummary[] $computerSummaries
 * @property Invoice[] $invoices
 * @property User[] $users
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datetime_created', 'datetime_updated'], 'safe'],
            [['name', 'adres', 'zipcode', 'city', 'email', 'iban'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('customer', 'ID'),
            'name' => Yii::t('customer', 'Name'),
            'adres' => Yii::t('customer', 'Adres'),
            'zipcode' => Yii::t('customer', 'Zipcode'),
            'city' => Yii::t('customer', 'City'),
            'email' => Yii::t('customer', 'Email'),
            'phone' => Yii::t('customer', 'Phone'),
            'iban' => Yii::t('customer', 'Iban'),
            'datetime_created' => Yii::t('customer', 'Datetime Created'),
            'datetime_updated' => Yii::t('customer', 'Datetime Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComputerSummaries()
    {
        return $this->hasMany(ComputerSummary::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['customer_id' => 'id']);
    }
}
