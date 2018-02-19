<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\payment\models\DompetSaldoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dompet Saldos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dompet-saldo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dompet Saldo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ACCESS_GROUP',
            'VA_ID',
            'SALDO_DOMPET',
            'SALDO_MENEGNDAP',
            'SALDO_JUALAN',
            //'CURRENT_TGL',
            //'TGL',
            //'WAKTU',
            //'CREATE_BY',
            //'CREATE_AT',
            //'UPDATE_BY',
            //'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
