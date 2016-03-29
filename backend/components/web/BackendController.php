<?php
namespace backend\components\web;

use Yii;

class BackendController extends \yii\web\Controller
{

    public function beforeAction($action)
    {
        if (!Yii::$app->user->can('admin') && $this->id !== 'user') {
            return $this->redirect(['/user/login']);
        }
        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

}