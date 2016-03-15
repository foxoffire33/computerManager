<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('brand', 'Brands');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('brand', 'Create Brand'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'country',
            'address',
            'zipcode',
             'city',
             'email:email',
             'phone',
             'webpage',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
