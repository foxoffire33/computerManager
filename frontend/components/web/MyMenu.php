<?php

namespace frontend\components\web;

use Yii;
use yii\bootstrap\Nav;

class MyMenu
{

    private static $options = ['class' => 'navbar-nav navbar-right'];

    public static function MyMenu()
    {
        $items = array_merge(self::GetItems(\Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id)), self::getEndDefaultItems());
        return self::GetMenu($items);
    }

    private static function GetItems($userRole)
    {
        $userRole = array_keys($userRole);
        switch ((isset($userRole[0]) ? $userRole[0] : null)) {
            case 'customer':
                return self::getBeginDefaultItems();
                break;
            default :
                return array_merge(self::getBeginDefaultItems(), [
                    ['label' => Yii::t('nav', 'Login'), 'url' => ['/user/login']],
                ]);
                break;
        }
    }

    private static function getBeginDefaultItems()
    {
        return [['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Maintenance request', 'url' => '/maintenance-request', 'visible' => Yii::$app->user->isGuest],
            ['label' => Yii::t('nav', 'Tariven'), 'url' => ['/page/computer-onderhoud-en-reparatie-tarieven']],
            ['label' => 'Informatie', [], 'items' => [
                ['label' => 'Hoe werken wij', 'url' => ['/page/onderhoud-waarom']],
                ['label' => 'Traage computer?', 'url' => ['/page/waarom-wordt-mijn-computer-traag']]
            ]],
            ['label' => 'Contact', 'url' => ['/site/contact']]
        ];
    }

    private static function getEndDefaultItems()
    {
        $items = [];
        if (!Yii::$app->user->isGuest) {
            $items [] = ['label' => \Yii::$app->user->identity->email, 'url' => ['/dashboard']];
            $items [] = ['label' => 'Logout',
                'url' => ['/user/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        return $items;
    }

    private static function GetMenu($ttems)
    {
        return Nav::widget([
            'options' => self::$options,
            'encodeLabels' => false,
            'items' => $ttems,
            'options' => ['class' => 'nav navbar-nav']
        ]);
    }

}