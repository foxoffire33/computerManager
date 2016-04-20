<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 22-03-16
 * Time: 11:04
 */

namespace frontend\controllers;

use common\models\ComputerSummary;
use common\models\Customer;
use common\models\MaintenanceRequest;
use common\models\User;
use frontend\components\web\FrontendController;
use frontend\models\MaintenanceRequestForm;
use Yii;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;
use yii\widgets\ActiveForm;

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
                } else if ($model->validate()) {
                    //create models
                    $user = new User();
                    $customer = new Customer();
                    $computerSummary = new ComputerSummary(['scenario' => ComputerSummary::SCENARIO_FRONTEND]);
                    $maintenanceRequest = new MaintenanceRequest(['scenario' => MaintenanceRequest::SCENARIO_FRONTEND]);
                    //set userPassword
                    $model->userPassword = Yii::$app->security->generateRandomString(8);
                    //set user attributes
                    $user->setAttributes(['username' => $model->email, 'email' => $model->email, 'password' => $user->setPassword($model->userPassword), 'status' => User::STATUS_ACTIVE], false);
                    //set customer attributes
                    $customer->setAttributes(['name' => $model->customerName, 'email' => $model->email, 'zipcode' => $model->zipcode, 'adres' => $model->address, 'city' => $model->city, 'phone' => $model->phone], false);
                    //set computer attributes
                    $computerSummary->setAttribute('name', "{$model->customerName}s, computer");
                    //set maintenance request attributes
                    $maintenanceRequest->setAttribute('description', $model->description);
                    //save kopel en save
                    if ($user->save()) {
                        $customer->user_id = $user->id;
                        //rbac
                        $auth = Yii::$app->authManager;
                        $customerRule = $auth->getRole('customer');
                        $auth->assign($customerRule, $user->id);
                        if ($customer->save()) {
                            $computerSummary->customer_id = $customer->id;
                            if ($computerSummary->save()) {
                                $maintenanceRequest->computer_id = $computerSummary->id;
                                if ($maintenanceRequest->save()) {
                                    //set status message
                                    Yii::$app->session->setFlash('success', Yii::t('maintenaceRequest', 'Thenks, we send you a mail with your account'));
                                    //send mail
                                    Yii::$app->mailer->compose('maintenanceRequest', ['model' => $model])
                                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['adminName']])
                                        ->setTo([$model->email => $model->customerName])
                                        ->setSubject(Yii::t('maintenaceRequest', 'Your request has revered'))
                                        ->send();
                                    return $this->redirect('/maintenance-request');
                                }
                            }
                        }
                    }
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