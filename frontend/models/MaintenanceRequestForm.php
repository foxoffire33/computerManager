<?php

namespace frontend\models;

use common\models\ComputerSummary;
use common\models\Customer;
use common\models\MaintenanceRequest;
use common\models\User;
use frontend\components\api\PostcodeApi;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class MaintenanceRequestForm extends Model
{
    //customer model
    public $email;
    public $firstName;
    public $lastName;
    public $zipcode;
    public $houseNumber;
    public $phone;
    //MaintenanceRequest model
    public $description;

    public $address;
    //private vars for customer model
    public $city;
    public $customerName;
    //user password
    public $userPassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['firstName', 'lastName', 'email', 'zipcode', 'houseNumber', 'phone', 'description'], 'required'],
            [['houseNumber'], 'integer'],
            ['zipcode', 'match', 'pattern' => '/^[0-9]{4}[A-Z]{2}/'],
            [['phone'], 'string', 'max' => 10],
            // email has to be a valid email address
            ['email', 'email'],
            [['firstName', 'lastName'], 'string', 'length' => [2, 128]],
            [['email', 'phone'], 'unique', 'targetClass' => 'common\models\Customer'],
            [['email'], 'unique', 'targetClass' => 'common\models\User'],
            //custom validatetor postcode Api
            [['zipcode', 'houseNumber'], 'checkAddressValidatetor']
        ];
    }

    public function beforeValidate()
    {
        $this->customerName = trim("{$this->firstName} {$this->lastName}");
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('customer', 'Email'),
            'firstName' => Yii::t('maintenaceRequest', 'First name'),
            'lastName' => Yii::t('maintenaceRequest', 'Lastname'),
            'zipcode' => Yii::t('maintenaceRequest', 'Zipcode'),
            'houseNumber' => Yii::t('maintenaceRequest', 'House number'),
            'phone' => Yii::t('maintenaceRequest', 'Phone'),
            'description' => Yii::t('maintenaceRequest', 'Description'),
            'address' => Yii::t('maintenaceRequest', 'Address'),
            'city' => Yii::t('maintenaceRequest', 'City'),
        ];
    }

    public function checkAddressValidatetor()
    {
        $postcodeApi = new PostcodeApi($this->zipcode, $this->houseNumber);
        if (($postcodeApiData = $postcodeApi->return) !== false) {
            $this->address = "{$postcodeApiData['street']} {$this->houseNumber}";
            $this->city = $postcodeApiData['municipality'];
        } else {
            $this->addError('zipcode', Yii::t('maintenanceRequest', 'Not found'));
        }
    }
}
