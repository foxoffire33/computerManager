<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCssFile('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->can('admin')) {
    $menuItems = [
        ['label' => Yii::t('customer', 'Customers'), 'url' => ['/customer']],
        ['label' => Yii::t('computerSummary', 'Computer'), 'items' => [
            ['label' => Yii::t('brand', 'Brand'), 'url' => ['/brand']],
            ['label' => Yii::t('computerModel', 'Computer Model'), 'url' => ['/computer-model']],
            ['label' => Yii::t('computerSummary', 'Computer summary'), 'url' => ['/computer-summary']],
            ['label' => Yii::t('maintenaceRequest', 'Maintenance Requests'), 'url' => ['/maintenance-request']],
            ['label' => Yii::t('log', 'Log'), 'url' => ['/log']],
        ]],
        ['label' => Yii::t('invoice', 'Invoice'), 'items' => [
            ['label' => Yii::t('invoice', 'Invoices'), 'url' => ['/invoice']],
            ['label' => Yii::t('invoiceRule', 'Invoice rules'), 'url' => ['/invoice-rule']],
            ['label' => Yii::t('invoiceRuleType', 'Invoice Rule Types'), 'url' => ['/invoice-rule-type']],
            ['label' => Yii::t('vat', 'Vats'), 'url' => ['/vat']]
        ]]
    ];
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/user/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->email . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
