<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 22-03-16
 * Time: 11:04
 */

namespace frontend\controllers;

use common\models\MaintenanceRequest;
use frontend\components\web\FrontendController;
use frontend\models\MaintenanceRequestForm;
use Yii;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;
use yii\widgets\ActiveForm;
use common\models\ComputerSummary;

class MaintenanceRequestController extends FrontendController
{
    public $defaultAction = 'index';

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
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
        throw new UnauthorizedHttpException(Yii::t('maintenanceRequest', 'This page is only available voor guests'));
    }

    public function actionExistingComputer($id)
    {
        if (!empty(($computer = ComputerSummary::findOne($id))) && Yii::$app->user->can('viewOwnComputer', ['id' => $id])) {
            $model = new MaintenanceRequest(['scenario' => MaintenanceRequest::SCENARIO_FRONTEND]);
            $model->setAttribute('computer_id', $computer->id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                //send mail
                Yii::$app->mailer->compose('maintenanceRequestExisting', ['model' => $model])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['adminName']])
                    ->setTo([$computer->customer->email => $computer->customer->name])
                    ->setSubject(Yii::t('maintenanceRequest', 'Your request has revered'))
                    ->send();
                return $this->redirect(['/dashboard/view-computer', 'id' => $computer->id]);
            }
            return $this->render('existingComputerForm', [
                'computer' => $computer,
                'model' => $model,
            ]);
        }
    }

}