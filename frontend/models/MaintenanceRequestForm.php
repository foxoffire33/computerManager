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
    //private
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
            [['firstName', 'lastName'], 'unique', 'targetClass' => 'common\models\Customer', 'targetAttribute' => ['customerName' => 'name']],
            [['email', 'phone'], 'unique', 'targetClass' => 'common\models\Customer'],
            [['email'], 'unique', 'targetClass' => 'common\models\User'],
            //custom validatetor postcode Api
            [['zipcode', 'houseNumber'], 'checkAddressValidatetor']
        ];
    }

    public function save()
    {
        //create models
        $user = new User();
        $customer = new Customer();
        $computerSummary = new ComputerSummary(['scenario' => ComputerSummary::SCENARIO_FRONTEND]);
        $maintenanceRequest = new MaintenanceRequest(['scenario' => MaintenanceRequest::SCENARIO_FRONTEND]);
        //set userPassword
        $this->userPassword = Yii::$app->security->generateRandomString(8);
        //set user attributes
        $user->setAttributes([
            'username' => $this->email,
            'email' => $this->email,
            'password' => $user->setPassword($this->userPassword),
            'status' => User::STATUS_ACTIVE,
        ], false);
        //set customer attributes
        $customer->setAttributes([
            'name' => $this->customerName,
            'email' => $this->email,
            'zipcode' => $this->zipcode,
            'adres' => $this->address,
            'city' => $this->city,
            'phone' => $this->phone
        ], false);
        //set computer attributes
        $computerSummary->setAttributes([
            'name' => "{$this->customerName}s, computer",
        ], false);
        //set maintenance request attributes
        $maintenanceRequest->setAttributes([
            'description' => $this->description
        ], false);
        //save kopel en save
        if ($user->save()) {
            $customer->user_id = $user->id;
            if ($customer->save()) {
                $computerSummary->customer_id = $customer->id;
                if ($computerSummary->save()) {
                    $maintenanceRequest->computer_id = $computerSummary->id;
                    return $maintenanceRequest->save();
                }
            }
        }
        return false;
    }

    public function beforeValidate()
    {
        $this->customerName = trim("{$this->firstName}, {$this->lastName}");
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('customer', 'Email'),
            'firstName' => Yii::t('maintenanceRequest', 'First name'),
            'lastname' => Yii::t('maintenanceRequest', 'Last name'),
            'zipcode' => Yii::t('maintenanceRequest', 'Zipcode'),
            'houseNumber' => Yii::t('maintenanceRequest', 'House number'),
            'phone' => Yii::t('maintenanceRequest', 'Phone'),
            'description' => Yii::t('maintenanceRequest', 'Description'),
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