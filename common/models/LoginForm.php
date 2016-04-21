<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Login form
 */
class LoginForm extends Model
{
    const RBAC_BACKEND_ROLE = 'admin';
    const RBAC_FRONTEND_ROLE = 'customer';
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function scenarios()
    {
        return ArrayHelper::merge([
            self::RBAC_BACKEND_ROLE => ['username', 'password', 'rememberMe'],
            self::RBAC_FRONTEND_ROLE => ['username', 'password', 'rememberMe'],
        ], parent::scenarios());
    }

    public function beforeValidate()
    {
        if (!empty($this->username)) {
            if (!empty(($user = User::findOne(['email' => $this->username])))) {
                $hasNoError = false;
                if ($this->scenario == self::RBAC_BACKEND_ROLE) {
                    $hasNoError = Yii::$app->authManager->checkAccess($user->id, 'admin');
                } elseif ($this->scenario == self::RBAC_FRONTEND_ROLE) {
                    $hasNoError = !Yii::$app->authManager->checkAccess($user->id, 'admin') &&
                        Yii::$app->authManager->checkAccess($user->id, 'customer');
                }
                if (!$hasNoError) {
                    $this->addError('password', Yii::t('user', 'Incorrect username or password.'));
                }
            }
        }
        return parent::beforeValidate();
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('user', 'Username'),
            'password' => Yii::t('user', 'Password'),
            'rememberMe' => Yii::t('user', 'Remember Me'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }
}
