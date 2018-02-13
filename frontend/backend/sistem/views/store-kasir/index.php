<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\sistem\models\StoreKasirSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Kasirs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-kasir-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Store Kasir', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'KASIR_ID',
            'KASIR_NM',
            'ACCESS_GROUP',
            'STORE_ID',
            'PERANGKAT_UUID',
            //'KASIR_STT',
            //'KASIR_STT_NM',
            //'DOMPET_AUTODEBET',
            //'DOMPET_AUTODEBET_NM',
            //'PAYMENT_METHODE',
            //'PAYMENT_METHODE_NM',
            //'PAKET_ID',
            //'DATE_START',
            //'DATE_END',
            //'KONTRAK_DURASI',
            //'KONTRAK_DATE',
            //'STATUS',
            //'CREATE_BY',
            //'UPDATE_BY',
            //'CREATE_AT',
            //'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
