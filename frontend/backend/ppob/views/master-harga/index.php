<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\ppob\models\PpobMasterHargaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ppob Master Hargas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppob-master-harga-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ppob Master Harga', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'DETAIL_ID',
            'KODE',
            'KETERANGAN',
            'NOMINAL',
            // 'HARGA1',
            // 'HARGA2',
            // 'HARGA3',
            // 'STATUS',
            // 'DCRIP:ntext',
            // 'CREATE_BY',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
