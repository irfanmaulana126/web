<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTambahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jurnal Tambahans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-tambahan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jurnal Tambahan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'JURNAL_ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'TRANS_DATE',
            'STT_PAY',
            //'STT_PAY_NM',
            //'AKUN_CODE',
            //'AKUN_NM',
            //'KTG_CODE',
            //'KTG_NM',
            //'JUMLAH_TOTAL',
            //'JUMLAH_PEMBAGIAN',
            //'FREKUENSI',
            //'FREKUENSI_NM',
            //'RANGE_TGL1',
            //'RANGE_TGL2',
            //'CREATE_AT',
            //'UPDATE_AT',
            //'MONTH_AT',
            //'YEAR_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
