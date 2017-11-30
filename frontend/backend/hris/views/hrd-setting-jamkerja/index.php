<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\hris\models\HrdSettingJamkerjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hrd Setting Jamkerjas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-setting-jamkerja-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hrd Setting Jamkerja', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'SHIFT_ID',
            'SHIFT_NM',
            // 'RENTANG_BAWAH',
            // 'RENTANG_ATAS',
            // 'RENTANG_TENGAH',
            // 'SHIFT_IN_BATAS_BAWAH',
            // 'SHIFT_IN_BATAS_SEQ',
            // 'SHIFT_IN_BATAS_ATAS',
            // 'SHIFT_IN',
            // 'SHIFT_OUT',
            // 'SHIFT_SEQ',
            // 'RADIUS_KOORDINAT',
            // 'TOLERANSI_TELAT',
            // 'TOLERANSI_PULANG',
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
