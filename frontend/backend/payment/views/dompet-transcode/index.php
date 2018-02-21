<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\payment\models\DompetTranscodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dompet Transcodes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dompet-transcode-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dompet Transcode', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TRANSCODE',
            'TRANS_NM',
            'TRANS_DCRP:ntext',
            'TRANS_TYPE',
            'TRANS_TYPE_NM',
            //'CREATE_BY',
            //'CREATE_AT',
            //'UPDATE_BY',
            //'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
