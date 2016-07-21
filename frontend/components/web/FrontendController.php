<?php

/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 01/03/16
 * Time: 16:26
 */
namespace frontend\components\web;

use yii\web\Controller;

class FrontendController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


}