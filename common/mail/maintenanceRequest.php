Beste <?= $model->customerName; ?>, u aanvraag wordt verwerkt, Wij nemen binnen twee werkdagen contact met u op.
<br/>
U kunt inloggen met de volgende gegevens.<br/>
<ul>
    <li><?= Yii::t('maintenaceRequest', 'Username: {username}', ['username' => $model->email]) ?></li>
    <li><?= Yii::t('maintenaceRequest', 'Password: {password}', ['password' => $model->userPassword]) ?></li>
</ul>