<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Informatie'];
$this->params['breadcrumbs'][] = ['label' => 'Over ons'];
?>
<div class="row">
	<h1>Over ons</h1>
</div>
<div class="row">
    <div class="col-sm-9">
        <h2>Wat is het idee achter computeronderhouden.nl</h2>
        <p>Wij willen het mensen zo simpel mogelijk maken om hun computer te laten repareren.<br/>
            U kunt als u nog geen klant bent via ons <?= Html::a('reparatieformulier', ['/maintenance-request']) ?> een
            reparatie aanvragen.
            Als u al klant bent, kunt u inloggen en onderhoud voor een computer aanvragen.
            Wij komen de computer bij u thuis ophalen en weer afleveren.           
        </p>
        <h2>Klanten login</h2>
        <p>Als u een reparatie aanvraag voor de eerste keer krijgt u per mail een gebruikersnaam en
            wachtwoord opgestuurd.
            Hiermee kunt u inloggen en alles zien wat wij met uw computer/tablet gedaan hebben.
            Ook kunt u hier uw klant gegevens bijwerken en facturen downloaden.
        </p>
    </div>
    <div class="col-sm-3">
		<div class="col-sm-8 col-sm-12 text-center">
			<?= Html::img('/images/foto_reinier.jpeg',['class' => 'img-circle img-responsive img-center']); ?>
            <h3>Reinier<br/>
                <small>De la Parra</small>
            </h3>
            <p>Hoi! Ik doe alle onderhoud en reparaties van Computeronderhouden.nl. Vragen? Neem vrijblijvend contact op.</p>
        </div>
    </div>
</div>
<div class="row">
    <h2>Hoe werkt het</h2>
    <div class="col-sm-2">
        <h4>Aanmelden</h4>
        <p>Reparatie wordt aangemeld via de website.</p>
    </div>
    <div class="col-sm-2">
        <h4>Bevestiging</h4>
        <p>Er wordt een e-mail gestuurd naar de klant.</p>
    </div>
    <div class="col-sm-2">
        <h4>Ophalen</h4>
        <p>Er wordt een afspaak gemaakt voor het ophalen of brengen.</p>
    </div>
    <div class="col-sm-2">
        <h4>Onderzoek</h4>
        <p>Wij onderzoeken het probleem en nemen contact op, voordat we de reparatie uitvoeren.</p>
    </div>
    <div class="col-sm-2">
        <h4>Reparatie</h4>
        <p>Wij repareren alles wat met de klant is besproken.</p>
    </div>
    <div class="col-sm-2">
        <h4>Aflevering</h4>
        <p>Er wordt een afspraak gemaakt voor het terugbrengen of ophalen van de computer/tablet.</p>
    </div>
</div>
