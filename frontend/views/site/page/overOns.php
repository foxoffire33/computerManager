<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Informatie'];
$this->params['breadcrumbs'][] = ['label' => 'Over ons'];
?>
<div class="row">
	<h1>Over ons</h1>
</div>
<div class="row">
    <div class="col-sm-12">
        <h2>Wat is het idee achter computeronderhouden.nl</h2>
        <p>Wij willen het mensen zo simpel mogelijk maken om hun computer te laten repareren.<br/>
            U kunt als u nog geen klant bent via ons <?= Html::a('reparatieformulier', ['/maintenance-request']) ?> een
            reparatie aanvragen.
            Als u al wel klant bent, kunt u inloggen en onderhoud voor een computer aanvragen.
            De standaard bij computeronderhouden.nl is dat wij de computer bij u thuis komen op halen of afleveren.
            U hoeft zelf helemaal niets te doen.
        </p>
        <h2>Klanten login</h2>
        <p>Als u een reparatie aanvraag voor de eerste keer. Dan krijgt u per mail een gebruikersnaam en
            wachtwoord op gestuurd.
            Hier mee kunt u inloggen en alles zien wat wij met uw computer/tablet gedaan hebben.
            Ook kunt u hier uw klant gegevens bijwerken en facturen downloaden
        </p>
    </div>
    <!--<div class="col-sm-3">
		<div class="col-sm-8 col-sm-12 text-center">
			<?php // Html::img('/images/foto_reinier.jpeg',['class' => 'img-circle img-responsive img-center']); ?>
            <h3>Reinier<br/>
                <small>De la parra</small>
            </h3>
            <p>Goedendag, ik doe alle onderhoud en reparaties voor computeronderhouden.nl. Ook ga ik bij klanten thuis langs.</p>
        </div>
    </div>-->
</div>
<div class="row">
    <h2>Hoe werkt het</h2>
    <div class="col-sm-2">
        <h4>Aanmelden</h4>
        <p>Reparatie wordt aangemeld via de website.</p>
    </div>
    <div class="col-sm-2">
        <h4>Bevestiging</h4>
        <p>Er wordt een mail gestuurd naar de klant.</p>
    </div>
    <div class="col-sm-2">
        <h4>Ophalen</h4>
        <p>Er wordt een afspraak gemaakt voor het ophalen of bregen.</p>
    </div>
    <div class="col-sm-2">
        <h4>Onderzoek</h4>
        <p>Wij onderzoeken het probleem en nemen contact op. Voor dat we de reparatie uitvoeren.</p>
    </div>
    <div class="col-sm-2">
        <h4>Reparatie</h4>
        <p>Wij repareren alles wat is besproken.</p>
    </div>
    <div class="col-sm-2">
        <h4>Aflevering</h4>
        <p>Er wordt een afspraak gemaakt voor het brengen of ophalen.</p>
    </div>
</div>
