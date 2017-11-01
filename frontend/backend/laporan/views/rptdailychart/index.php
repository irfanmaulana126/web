<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\RptDailyChartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rpt Daily Charts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rpt-daily-chart-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rpt Daily Chart', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'Val_Nm',
            'Val_Cnt',
            'Val_Json:ntext',
            'ACCESS_GROUP',
            // 'UPDT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
