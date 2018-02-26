<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTemplateDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jurnal Template Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-template-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jurnal Template Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'RPT_DETAIL_ID',
            'RPT_SORTING',
            'ACCESS_GROUP',
            'AKUN_CODE',
            'KTG_CODE',
            //'AKUN_NM',
            //'KTG_NM',
            //'RPT_TITLE_ID',
            //'RPT_TITLE_NM',
            //'RPT_GROUP_ID',
            //'RPT_GROUP_NM',
            //'CAL_FORMULA',
            //'CAL_FORMULA_NM',
            //'STATUS',
            //'STATUS_NM',
            //'KETERANGAN:ntext',
            //'CREATE_BY',
            //'UPDATE_BY',
            //'CREATE_AT',
            //'UPDATE_AT',
            //'MONTH_AT',
            //'YEAR_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
