<p>Beste <?= str_replace(',','',$model->customerName) ?>, </p>
<p>Bedankt voor uw onderhoudsaanvraag. Wij nemen binnen twee werkdagen contact met u op voor het maken van een afspraak.</p>
<p>Op onze website kunt u straks de afspraak en gegevens over het onderhoud van uw computer inzien.<br />
U kunt inloggen met de onderstaande gegevens:</p>
<p>
    <ul>
        <li><?= Yii::t('maintenaceRequest', 'Username: {username}', ['username' => $model->email]) ?></li>
        <li><?= Yii::t('maintenaceRequest', 'Password: {password}', ['password' => $model->userPassword]) ?></li>
    </ul>
</p>