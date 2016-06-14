<?php

namespace console\controllers;

set_time_limit(0);

use common\models\MaintenanceRequest;
use yii;
use yii\console\Controller;

class MailController extends Controller
{

    const EXIT_CODE_SEND_MAIL_ERROR = 2;
    private $exitcode = self::EXIT_CODE_NORMAL;


    private $dateTimeToDay;

    public function init()
    {
        parent::init();
        $this->dateTimeToDay = new \DateTime('NOW');
    }

    /**
     * deze functie checkt of er mail moet worden verstuurd en zo ja naar wie.
     */
    public function actionIndex()
    {
        $this->actionDefault(); //standaard mails
        return $this->exitcode;
    }

    private function actionDefault()
    {

        //check and send mails
        if (!is_null(($models = $this->getMaintenanceRequestByDateTime($this->modifyDatetime('-1 month'))))) {
            $this->sendMail('maintenanceRequests/oneMonth', $models); //1 maand na reparatie
        }
        if (!is_null(($models = $this->getMaintenanceRequestByDateTime($this->modifyDatetime('-5 month'))))) {
            $this->sendMail('maintenanceRequests/sixMonths', $models); //6 maanden na reparatie
        }
    }

    private function getMaintenanceRequestByDateTime($datetime)
    {
        return MaintenanceRequest::find()->where('date(date_done) <= :ready_date and mail_sended IS NULL', [':ready_date' => $datetime])->all();
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
                $model->scenario = MaintenanceRequest::SCENARIO_MAIL;
                if (isset($model->computer->customer->name) && isset($model->computer->customer->email)) {

                    $mailSetup = Yii::$app->mailer->compose($layout, ['model' => $model])
                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['adminName']])
                        ->setSubject('Onderhoud computer');


                    $mailSetup->setTo([$model->computer->customer->email => $model->computer->customer->name]);
                    if (!$mailSetup->send()) {
                        $this->errorCode = self::EXIT_CODE_SEND_MAIL_ERROR;
                    }
                    $mailSetup->setTo([Yii::$app->params['adminEmail'] => Yii::$app->params['adminName']]);
                    if (!$mailSetup->send()) {
                        $this->errorCode = self::EXIT_CODE_SEND_MAIL_ERROR;
                    }

                    if($this->exitcode == self::EXIT_CODE_NORMAL){
                        $model->mail_sended = time();
                        $model->save();
                    }

                }
            }
        }
    }

}