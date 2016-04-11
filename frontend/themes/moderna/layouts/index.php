<?php use yii\helpers\Html; ?>
<section id="featured">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="main-slider" class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="<?= $bundel->baseUrl ?>/img/slides/4.jpg" alt="silder image one"/>
                            <div class="flex-caption">
                                <h3>Is uw computer langzaam?</h3>
                                <p>Via ComputerOnderhouden.nl kunt u snel en simpel een onderhoudsbeurt aanvragen voor
                                    uw computer</p>
                                <?= Html::a('Reparatie aanvragen', '/maintenance-request', ['class' => 'btn btn-theme']) ?>
                            </div>
                        </li>
                        <li>
                            <img src="<?= $bundel->baseUrl ?>/img/slides/5.jpg" alt="silder image two"/>
                            <div class="flex-caption">
                                <h3>Computer informatie bekijken</h3>
                                <p>Nadat uw computer bij ons is geweest kunt u zien wat er in uw computer zit en welke
                                    programma's er op staan</p>
                                <?= Html::a('Reparatie aanvragen', '/maintenance-request', ['class' => 'btn btn-theme']) ?>
                            </div>
                        </li>
                        <li>
                            <img src="<?= $bundel->baseUrl ?>/img/slides/3.jpg" alt="silder image three"/>
                            <div class="flex-caption">
                                <h3>Reparaties inzien</h3>
                                <p>Uw kunt per computer zien wat de status van de reparatie is en wat wij gedaan
                                    hebben</p>
                                <?= Html::a('Reparatie aanvragen', '/maintenance-request', ['class' => 'btn btn-theme']) ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="callaction">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="big-cta">
                    <div class="cta-text">
                        <h2>Voordelig en effectief computeronderhoud in Groningen</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box">
                            <div class="box-gray aligncenter">
                                <h4>Trage computer?</h4>
                                <div class="icon">
                                    <i class="fa fa-desktop fa-3x"></i>
                                </div>
                                <p>
                                    Een medewerker van Computeronderhouden.nl komt bij u langs, inventariseert uw
                                    computergebruik en maakt direct een schatting van de kosten om uw computer weer snel
                                    te laten werken.
                                    <br/><br/><br/><br/>
                                </p>

                            </div>
                            <div class="box-bottom">
                                <?= Html::a('Reparatie aanvragen', '/computer-onderhoud-of-reparatie-aanvragen') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box">
                            <div class="box-gray aligncenter">
                                <h4>Computer stuk?</h4>
                                <div class="icon">
                                    <i class="fa fa-heartbeat fa-3x"></i>
                                </div>
                                <p>
                                    Als uw computer het niet meer doet komt een medewerker van Computeronderhouden.nl bij u langs om de computer op te halen. Vervolgens wordt de computer gerepareerd en ontvangt u via de e-mail updates over de uitgevoerde werkzaamheden. Als uw computer weer klaar is wordt deze weer bij u thuisgebracht en geinstalleerd.
                                </p>

                            </div>
                            <div class="box-bottom">
                                <?= Html::a('Reparatie aanvragen', '/computer-onderhoud-of-reparatie-aanvragen') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box">
                            <div class="box-gray aligncenter">
                                <h4>Nooit een trage computer?</h4>
                                <div class="icon">
                                    <i class="fa fa-check fa-3x"></i>
                                </div>
                                <p>
                                    Bij Computeronderhouden.nl kunt u een onderhoudsabonnement afsluiten. Zo ontvangt u
                                    periodiek (vaak 1x per half jaar) een e-mail voor het inplannen van een afspraak. Na
                                    het inplannen komt een medewerker van Computeronderhouden.nl bij u langs en voert
                                    het onderhoud bij u uit.
                                    Voorkomen is immers beter dan genezen!
                                </p>

                            </div>
                            <div class="box-bottom">
                                <?= Html::a('Reparatie aanvragen', '/computer-onderhoud-of-reparatie-aanvragen') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- divider -->
        <div class="row">
            <div class="col-lg-12">
                <div class="solidline">
                </div>
            </div>
        </div>
        <!-- end divider -->
    </div>
</section>            