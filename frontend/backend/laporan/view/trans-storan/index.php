<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\TransStoranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trans Storans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-storan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trans Storan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'ACCESS_ID',
            'OPENCLOSE_ID',
            // 'TGL_STORAN',
            // 'TOTALCASH',
            // 'NOMINAL_STORAN',
            // 'SISA_STORAN',
            // 'BANK_NM',
            // 'BANK_NO',
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
