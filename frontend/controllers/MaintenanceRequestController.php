<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 22-03-16
 * Time: 11:04
 */

namespace frontend\controllers;

use frontend\components\web\FrontendController;
use frontend\models\MaintenanceRequestForm;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

class MaintenanceRequestController extends FrontendController
{
    public $defaultAction = 'index';

    public function actionIndex()
    {
        $model = new MaintenanceRequestForm();
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            } else if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('maintenanceRequest', 'Thenks, we send you a mail with your account'));
                //send mail
                Yii::$app->mailer->compose('maintenanceRequest', ['model' => $model])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['adminName']])
                    ->setTo([$model->email => $model->customerName])
                    ->setSubject(Yii::t('maintenanceRequest', 'Your request has revered'))
                    ->send();
                $this->redirect('/site/index');
            }
        }
        return $this->render('requestForm', ['model' => $model]);
    }

}