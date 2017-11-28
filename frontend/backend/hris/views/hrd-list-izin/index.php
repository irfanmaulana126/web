<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\hris\models\HrdListIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hrd List Izins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-list-izin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hrd List Izin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'IZIN_ID',
            'IZIN_NM',
            'IZIN_KET:ntext',
            'CREATE_BY',
            'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',
            // 'STATUS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
