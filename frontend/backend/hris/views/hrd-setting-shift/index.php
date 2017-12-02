<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\hris\models\HrdSettingShiftSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hrd Setting Shifts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-setting-shift-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hrd Setting Shift', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'SHIFT_ID',
            'SHIFT_NM',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            // 'UPDATE_AT',
            // 'STATUS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
