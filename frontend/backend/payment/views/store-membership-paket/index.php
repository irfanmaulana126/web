<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\payment\models\StoreMembershipPaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Membership Pakets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-membership-paket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Store Membership Paket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PAKET_ID',
            'PAKET_GROUP',
            'PAKET_NM',
            'PAKET_DURATION',
            'PAKET_DURATION_BONUS',
            //'HARGA_BULAN',
            //'HARGA_HARI',
            //'HARGA_PAKET',
            //'HARGA_PAKET_HARI',
            //'PAKET_STT',
            //'PAKET_STT_NM',
            //'CREATE_BY',
            //'UPDATE_BY',
            //'CREATE_AT',
            //'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
