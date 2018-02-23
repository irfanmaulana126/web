<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTambahan */

$this->title = $model->JURNAL_ID;
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Tambahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-tambahan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'JURNAL_ID' => $model->JURNAL_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'JURNAL_ID' => $model->JURNAL_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT], [
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
            'JURNAL_ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'TRANS_DATE',
            'STT_PAY',
            'STT_PAY_NM',
            'AKUN_CODE',
            'AKUN_NM',
            'KTG_CODE',
            'KTG_NM',
            'JUMLAH_TOTAL',
            'JUMLAH_PEMBAGIAN',
            'FREKUENSI',
            'FREKUENSI_NM',
            'RANGE_TGL1',
            'RANGE_TGL2',
            'CREATE_AT',
            'UPDATE_AT',
            'MONTH_AT',
            'YEAR_AT',
        ],
    ]) ?>

</div>
