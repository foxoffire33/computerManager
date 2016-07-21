<?php
namespace frontend\controllers;

use frontend\components\web\FrontendController;
use frontend\models\ContactForm;
use Yii;
use yii\helpers\Inflector;
use yii\web\NotFoundHttpException;

class SiteController extends FrontendController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['static'],
                'lastModified' => function ($action, $params) {
                    $filePath = Yii::getAlias('@frontend') . '/views/site/page/' . Inflector::variablize(Yii::$app->request->get('page')) . '.php';
                    return filemtime($filePath);
                },
                'sessionCacheLimiter' => 'public',
            ],
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['index', 'contact'],
                'lastModified' => function ($action, $params) {
                    $filePath = Yii::getAlias('@frontend') . '/views/site/' . strtolower($action->id) . '.php';
                    return filemtime($filePath);
                },
                'sessionCacheLimiter' => 'public',
            ],
        ];
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', Yii::t('contact', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('contact', 'There was an error sending email.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionStatic($page = 'index')
    {
        $filePath = Yii::getAlias('@frontend') . '/views/site/page/' . Inflector::variablize($page) . '.php';
        if (is_file($filePath)) {
            return $this->render('page/' . Inflector::variablize($page));
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
