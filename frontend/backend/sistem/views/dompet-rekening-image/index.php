<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\sistem\models\DompetRekeningImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dompet Rekening Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dompet-rekening-image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dompet Rekening Image', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ACCESS_GROUP',
            'IMAGE',
            'CREATE_BY',
            'CREATE_AT',
            //'UPDATE_BY',
            //'UPDATE_AT',
            //'STATUS',
            //'DCRP_DETIL:ntext',
            //'YEAR_AT',
            //'MONTH_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
