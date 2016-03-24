<?php
namespace frontend\components\db;

use yii\rbac\Rule;
use \common\models\User;
use yii\helpers\ArrayHelper;

/**
 * Checks if authorID matches user passed via params
 */
class IsOwnerRule extends Rule
{
    public $name = 'isOwner';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if (!empty(($userModel = User::findOne($user)))) {
            if ($item->name == 'DownloadOwnInvoice' && in_array($params['id'], ArrayHelper::getColumn($userModel->customer->invoices, 'id'))) {
                return true;
            } elseif ($item->name == 'viewOwnComputer' && in_array($params['id'], ArrayHelper::getColumn($userModel->customer->computerSummaries, 'id'))) {
                return true;
            }
        }

        return false;
    }
}