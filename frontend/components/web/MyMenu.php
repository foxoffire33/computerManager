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
            case 'Customer':
                return array_merge(self::getBeginDefaultItems(), [
                    ['label' => '' . Yii::t('nav', 'Computer'), 'url' => ['/computer'], 'itemOptions' => ['class' => 'dropdown-toggle'],
                        'linkOptions' => [
                            'data-hover' => 'dropdown',
                            'data-delay' => '0',
                            'data-close-others' => 'false',
                            'data-toggle' => 'dropdown',
                            'aria-expanded' => 'true',
                        ],
                        'items' => []],
//                    ['label' => 'Software', 'url' => ['/computer/software'], 'items' => [
//                            ['label' => 'information', 'url' => ['/computer/software']],
//                            ['label' => 'license', 'url' => ['/computer/software/license']],
//                            ['label' => 'Log', 'url' => ['/computer/log']],
//                        ]],
//                    ['label' => 'Hardware', 'url' => ['/computer/hardware'], 'items' => [
//                            ['label' => 'information', 'url' => ['/computer/hardware']],
//                            ['label' => 'Model', 'url' => ['/computer/hardware/model']],
//                            ['label' => 'type', 'url' => ['/computer/hardware/type']],
//                            ['label' => 'Connet method', 'url' => ['/computer/hardware/connet-methode']],
//                            ['label' => 'Log', 'url' => ['/computer/log']],
//                        ]],
                ]);
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
            ['label' => 'Maintenance request','url' => '/maintenance-request'],
            ['label' => 'Informatie', [], 'items' => [
                ['label' => 'Hoe werken wij', 'url' => ['/hoe-werken-wij']],
                ['label' => 'Traage computer?', 'url' => ['/waarom-wordt-mijn-computer-traag']]
            ]],
            ['label' => 'Contact', 'url' => ['/site/contact']]
        ];
    }

    /*private static function userComputers()
    {
        $findUserComputers = \common\modules\computer\models\ComputerInformation::find()->asArray()->all();
        $returnArray = [['label' => 'Overzicht', 'url' => ['/computer/information']]];
        if ($findUserComputers != null) {
            foreach ($findUserComputers as $computer) {
                $returnArray[] = ['label' => $computer['name'], 'url' => ['/computer/information/view', 'id' => $computer['id']]];
            }
        }
        return $returnArray;
    }*/

    private static function getEndDefaultItems()
    {
        $items = [
            ['label' => Yii::t('nav', 'Contact'), 'url' => ['/site/contact']],
        ];
        if (!Yii::$app->user->isGuest) {
            $items [] = ['label' => \Yii::$app->user->identity->email . '', 'items' => [
                ['label' => 'Overzicht', 'url' => ['/user/user/view']],
                ['label' => 'Update', 'url' => ['/user/user/update']],
                //['label' => '<i class="fa fa-key"></i> Update password', 'url' => ['/user/user/updatePassword', 'id' => \Yii::$app->user->id]],
                [
                    'label' => 'Logout (' . \Yii::$app->user->identity->email . ')',
                    'url' => ['/user/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ]
            ]];
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