<p>Beste <?= str_replace(',','',$model->customerName) ?>, uw aanvraag wordt verwerkt. Wij nemen binnen twee werkdagen contact met u op.</p>
<p>U kunt inloggen met de volgende gegevens.</p>
<p>
    <ul>
        <li><?= Yii::t('maintenaceRequest', 'Username: {username}', ['username' => $model->email]) ?></li>
        <li><?= Yii::t('maintenaceRequest', 'Password: {password}', ['password' => $model->userPassword]) ?></li>
    </ul>
</p>
