<?php
use frontend\themes\moderna\AssetsBundel\ModernaAsset;
use yii\bootstrap\BootstrapAsset;

BootstrapAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
<?php $this->endPage() ?>
