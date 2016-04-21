<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hallo,<?= str_replace(',','',$user->customer->name) ?>,met de volgende link kunt u uw wachtwoord resseten</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
