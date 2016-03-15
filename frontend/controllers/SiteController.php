<?php
namespace frontend\controllers;

use Yii;
use frontend\models\ContactForm;
use frontend\components\web\FrontendController;
use yii\helpers\Inflector;
use yii\web\NotFoundHttpException;

class SiteController extends FrontendController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionStatic($page = 'index') {
        $filePath = Yii::getAlias('@frontend').'/views/site/page/' . Inflector::variablize($page) . '.php';
        if (is_file($filePath)) {
            return $this->render('page/' . Inflector::variablize($page));
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
