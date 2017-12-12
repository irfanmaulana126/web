<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\ppob\models\PpobListNominalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ppob List Nominals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppob-list-nominal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ppob List Nominal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'DETAIL_ID',
            'KODE',
            // 'KETERANGAN',
            // 'NOMINAL',
            // 'HARGA_KG',
            // 'HARGA_JUAL',
            // 'STATUS',
            // 'CREATE_BY',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
