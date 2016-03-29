<?php
namespace console\controllers;

use frontend\components\db\IsOwnerRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{

    public function actionInt()
    {
        $auth = Yii::$app->authManager;

        //Guest rule
        $login = $auth->createPermission('login');
        $auth->add($login);

        $passwordReset = $auth->createPermission('passwordReset');
        $auth->add($passwordReset);

        $staticPageView = $auth->createPermission('staticPageView');
        $auth->add($staticPageView);

        $guestRule = $auth->createRole('guest');
        $auth->add($guestRule);

        $auth->addChild($guestRule, $login);
        $auth->addChild($guestRule, $passwordReset);
        $auth->addChild($guestRule, $staticPageView);

        //Customer rule
        // add the rule
        $isOwnerRule = new IsOwnerRule();
        $auth->add($isOwnerRule);

        $downloadOwnInvoice = $auth->createPermission('DownloadOwnInvoice');
        $downloadOwnInvoice->ruleName = $isOwnerRule->name;
        $auth->add($downloadOwnInvoice);

        $viewOwnComputer = $auth->createPermission('viewOwnComputer');
        $viewOwnComputer->ruleName = $isOwnerRule->name;
        $auth->add($viewOwnComputer);

        $customerRule = $auth->createRole('customer');
        $auth->add($customerRule);

        $auth->addChild($customerRule, $downloadOwnInvoice);
        $auth->addChild($customerRule, $viewOwnComputer);

        //admin role
        $adminRule = $auth->createRole('admin');
        $auth->add($adminRule);

        $manageUser = $auth->createPermission('manageUser');
        $auth->add($manageUser);

        $manageCustomer = $auth->createPermission('manageCustomer');
        $auth->add($manageCustomer);

        $manageBrand = $auth->createPermission('manageBrand');
        $auth->add($manageBrand);

        $manageComputerModel = $auth->createPermission('manageComputerModel');
        $auth->add($manageComputerModel);

        $amanageComputerSummary = $auth->createPermission('manageComputerSummary');
        $auth->add($amanageComputerSummary);

        $manageLog = $auth->createPermission('manageLog');
        $auth->add($manageLog);

        $manageInvoice = $auth->createPermission('manageInvoice');
        $auth->add($manageInvoice);

        $manageInvoiceRule = $auth->createPermission('manageInvoiceRule');
        $auth->add($manageInvoiceRule);

        $manageInvoiceRuleType = $auth->createPermission('manageInvoiceRuleType');
        $auth->add($manageInvoiceRuleType);

        $manageVat = $auth->createPermission('manageVat');
        $auth->add($manageVat);


        $auth->addChild($adminRule, $manageUser);
        $auth->addChild($adminRule, $manageCustomer);
        $auth->addChild($adminRule, $manageBrand);
        $auth->addChild($adminRule, $manageComputerModel);
        $auth->addChild($adminRule, $amanageComputerSummary);
        $auth->addChild($adminRule, $manageLog);
        $auth->addChild($adminRule, $manageInvoice);
        $auth->addChild($adminRule, $manageInvoiceRule);
        $auth->addChild($adminRule, $manageInvoiceRuleType);
        $auth->addChild($adminRule, $manageVat);

        //set primission childs
        $auth->addChild($viewOwnComputer, $amanageComputerSummary);
        $auth->addChild($downloadOwnInvoice, $manageInvoice);
        //kokppel rollen
        $auth->addChild($adminRule, $customerRule);
        $auth->addChild($customerRule, $guestRule);

    }

}