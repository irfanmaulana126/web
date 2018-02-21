<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalAkunSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jurnal Akuns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-akun-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jurnal Akun', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AKUN_CODE',
            'AKUN_NM',
            'KTG_CODE',
            'KTG_NM',
            'STATUS',
            //'KETERANGAN:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
