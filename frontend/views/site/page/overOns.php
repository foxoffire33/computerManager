<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Informatie'];
$this->params['breadcrumbs'][] = ['label' => 'Over ons'];
?>
<div class="row">
    <div class="col-sm-9">
        <h2>Wat is het idee achter computeronderhouden.nl</h2>
        <p>Wij willen het menssen zo simpel mogelijk maken om hun computer te laten repareren.<br/>
            U kunt als u nog geen klant bent via ons <?= Html::a('reparatie formulier', ['maintenance-request']) ?> een
            reparatie aanvragen.
            Als u al wel klant bent, kunt u inloggen en onderhouden voor een computer aanvragen.
            De standaard bij computeronderhouden.nl is dat wij de computer bij u thuis komen op halen of afleveren.
            U hoeft zelf helemaal niets te doen.
        </p>
        <h2>Klanten login</h2>
        <p>Als u een reparatie aanvraag voor de eerste keer. Dan krijgt u per mail een gebruikersnaam en
            wachtwoord op gestuurd.<br/>
            Hier mee kunt u inloggen en alles zien wat wij met uw computer/tablet gedaan hebben.
            Ook kunt u hier uw klant gegevens bijwerken en facturen downloaden
        </p>
    </div>
    <div class="col-sm-3">
        <div class="col-sm-8 col-sm-12 text-center">
            <img class="img-circle img-responsive img-center" src="http://placehold.it/200x200" alt="">
            <h3>Reinier<br/>
                <small>De la parra</small>
            </h3>
            <p>Goedendag, ik doe alle onderhoud en reparaties voor computeronderhouden.nl. Ook ga ik bij klanten thuis langs.</p>
        </div>
    </div>
</div>
<div class="row">
    <h2>hoe werkt het</h2>
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
        <p>Er wordt een afspaak gemaakt voor het ophalen of bregen.</p>
    </div>
    <div class="col-sm-2">
        <h4>Onderzoek</h4>
        <p>Wij onderzoeken het probleem en nemen contact op met de klant. Voor dat we de reparatie uitvoeren.</p>
    </div>
    <div class="col-sm-2">
        <h4>Reparatie</h4>
        <p>Wij repareren alles wat wij met de klant is besproken hebben.</p>
    </div>
    <div class="col-sm-2">
        <h4>aflevering</h4>
        <p>Er wordt een afspraak gemaakt voor brengen of ophalen.</p>
    </div>
</div>