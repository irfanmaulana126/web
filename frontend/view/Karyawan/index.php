<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Karyawans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="karyawan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Karyawan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'KARYAWAN_ID',
            'NAMA_DPN',
            // 'NAMA_TGH',
            // 'NAMA_BLK',
            // 'KTP',
            // 'TMP_LAHIR',
            // 'TGL_LAHIR',
            // 'GENDER',
            // 'ALAMAT:ntext',
            // 'STS_NIKAH',
            // 'TLP',
            // 'HP',
            // 'EMAIL:email',
            // 'CREATE_BY',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',
            // 'STATUS',
            // 'DCRP_DETIL:ntext',
            // 'YEAR_AT',
            // 'MONTH_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
