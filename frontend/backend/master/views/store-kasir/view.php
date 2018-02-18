<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\StoreKasir */

$this->title = $model->KASIR_ID;
$this->params['breadcrumbs'][] = ['label' => 'Store Kasirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-kasir-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->KASIR_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->KASIR_ID], [
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
            'KASIR_ID',
            'KASIR_NM',
            'ACCESS_GROUP',
            'STORE_ID',
            'PERANGKAT_UUID',
            'KASIR_STT',
            'KASIR_STT_NM',
            'DOMPET_AUTODEBET',
            'DOMPET_AUTODEBET_NM',
            'PAYMENT_METHODE',
            'PAYMENT_METHODE_NM',
            'PAKET_ID',
            'DATE_START',
            'DATE_END',
            'KONTRAK_DURASI',
            'KONTRAK_DATE',
            'STATUS',
            'CREATE_BY',
            'UPDATE_BY',
            'CREATE_AT',
            'UPDATE_AT',
        ],
    ]) ?>

</div>
