<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTransaksiBulan */

$this->title = $model->JURNAL_BULAN;
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Transaksi Bulans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-transaksi-bulan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->JURNAL_BULAN], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->JURNAL_BULAN], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'JURNAL_BULAN',
            'ACCESS_GROUP',
            'STORE_ID',
            'TRANS_DATE',
            'TAHUN',
            'BULAN',
            'JUMLAH',
            'STT_PAY',
            'STT_NM',
            'AKUN_CODE',
            'AKUN_NM',
            'KTG_CODE',
            'KTG_NM',
            'CREATE_AT',
            'UPDATE_AT',
        ],
    ]) ?>

</div>
