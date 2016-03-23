<?php
namespace frontend\controllers;

use frontend\components\web\FrontendController;

class DashboardController extends FrontendController
{

    public function actionIndex()
    {
        $customer = \Yii::$app->user->identity->customer;
        return $this->render('index', [
            'customer' => $customer,
        ]);
    }

}