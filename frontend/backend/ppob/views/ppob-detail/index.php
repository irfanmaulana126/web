<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\ppob\models\PpobDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ppob Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppob-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ppob Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'DETAIL_ID',
            'HEADER_ID',
            'PROVIDER_ID',
            'DETAIL_NM',
            // 'PROVIDER_NM',
            // 'DETAIL_DCRP:ntext',
            // 'STATUS',
            // 'CREATE_BY',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
