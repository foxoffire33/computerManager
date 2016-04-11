<?php

use common\widgets\Alert;
use frontend\components\web\BreadcrumsSeo;
use frontend\components\web\MyMenu;
use frontend\themes\moderna\AssetsBundel\ModernaAsset;
use yii\helpers\Html;

//

/* @var $this \yii\web\View */
/* @var $content string */
$bundel = ModernaAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="description" content="Houd uw computer snel en werkbaar via ComputerOnderhouden.nl">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(Yii::$app->params['applicationName']) ?></title>
        <style type="text/css">
            .flexslider .slides > li {
                display: none;
                -webkit-backface-visibility: hidden;
            }
        </style>
        <?php $this->head() ?>
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body>
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-1727337-66', 'auto');
        ga('send', 'pageview');

    </script>
    <?php $this->beginBody() ?>
    <section id="wrapper">
        <!-- start header -->
        <header>
            <div class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/" style="padding-bottom: 15px"><span>Computer</span><br/>onderhouden.nl</a>
                    </div>
                    <div class="navbar-collapse collapse ">
                        <?= MyMenu::MyMenu(['options' => ['class' => 'nav navbar-nav']]); ?>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <?= Alert::widget() ?>
            </div>
        </section>
        <?php if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index'): ?>
            <?= $this->render(Yii::$app->view->theme->getPath('/layouts/index'), ['bundel' => $bundel]); ?>
        <?php else: ?>
            <section id="inner-headline">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <?=
                            BreadcrumsSeo::widget([
                                'homeLink' => ['label' => '', 'url' => ['/'], 'class' => 'fa fa-home'],
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ])
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <section id="content">
                <div class="container">
                    <div class="row">
                        <?= $content; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <footer>
            <?= $this->render(Yii::$app->view->theme->getPath('layouts/footer')); ?>
        </footer>
    </section>
    <a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
    <script type="application/ld+json">
            { "@context" : "http://schema.org",
            "@type" : "Organization",
            "name" : "ComputerOnderhouden",
            "url" : "http://www.computeronderhouden.nl",
            "sameAs" : [ "https://www.facebook.com/pages/ComputerOnderhoudennl/442709885907316"]
            }
    </script>
    <?php if (isset($this->params['breadcrumbs'])): ?>
        <script type='application/ld+json'>
    <?= BreadcrumsSeo::makeBreadcrums($this->params['breadcrumbs']) ?>
        </script>
    <?php endif; ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>