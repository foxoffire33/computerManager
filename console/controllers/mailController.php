<?php

namespace console\controllers;

set_time_limit(0);

use common\models\MaintenanceRequest;
use yii;
use yii\console\Controller;

class MailController extends Controller
{

    private $dateTimeToDay;

    public function init()
    {
        parent::init();
        $this->dateTimeToDay = new \DateTime('NOW');
    }

    public function actionIndex()
    {
        try {
            $this->actionDefault(); //standaard mails
            return 0; //return 0 zo weer de server dat de cronjob klaar is
        } catch (Exception $error) {
            return 1;//retirn 1 er ging iets fout
        }
    }

    public function actionDefault()
    {

        //check and send mails
        if (($models = $this->getMaintenanceRequestByDateTime($this->modifyDatetime('-1 month'))) !== false) {
            $this->sendMail('maintenanceRequests/oneMonth', $models); //1 maand na reparatie
        } else {
            return 1;
        }
        if (($models = $this->getMaintenanceRequestByDateTime($this->modifyDatetime('-6 month'))) !== false) {
            $this->sendMail('maintenanceRequests/sixMonths', $models); //6 maanden na reparatie
        } else {
            return 1;
        }

        if (($models = $this->getMaintenanceRequestByDateTime($this->modifyDatetime('-18 month'))) !== false) {
            $this->sendMail('maintenanceRequests/twoYears', $models); //twee jaar na reparatie
        } else {
            return 1;
        }
        return 0;
    }

    private function getMaintenanceRequestByDateTime($datetime)
    {
        try {
            return MaintenanceRequest::find()->where('date(date_done) =:ready_date', [':ready_date' => $datetime])->all();
        } catch (\Exception $error) {
            return false;
        }
    }

    private function modifyDatetime($datetimeModifyString)
    {
        $tempDate = $this->dateTimeToDay;
        return $tempDate->modify($datetimeModifyString)->format('Y-m-d');
    }

    private function sendMail($layout, $models = null)
    {
        if ($models != null) {
            foreach ($models as $model) {
                if (isset($model->computer->customer->name) && isset($model->computer->customer->email)) {

                    $mailSetup = Yii::$app->mailer->compose($layout, ['model' => $model])
                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['adminName']])
                        ->setSubject('Onderhoud computer');

                    $mailSetup->setTo([$model->computer->customer->email => $model->computer->customer->name])->send();
                    $mailSetup->setTo([Yii::$app->params['adminEmail'] => Yii::$app->params['adminName']])->send();
                }
            }
        }
    }

}