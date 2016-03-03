<?php
namespace frontend\models;

use common\models\Sailor;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $repeat_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //altijd vereist
            [['email', 'password','repeat_password'], 'required'],
            //check email
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('signup', 'This email address has already been taken.')],
            //check passwrd
            ['password', 'string', 'min' => 6],
            //check repeat password
            ['repeat_password', 'string', 'min' => 6],
            //matching passwords
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'operator' => '===', 'message' => Yii::t('signup', 'Passwords don\'t match.')],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                $auth = Yii::$app->authManager;
                //save role
                $authorRole = $auth->getRole('user');
                $auth->assign($authorRole, $user->id);
                //return user information for login
                return $user;
            }
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('signup', 'Email'),
            'password' => Yii::t('signup', 'Password'),
            'repeat_password' => Yii::t('signup', 'Repeat Password'),
        ];
    }
}