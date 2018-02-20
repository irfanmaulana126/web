<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetTransaksi */

$this->title = $model->TRANS_ID;
$this->params['breadcrumbs'][] = ['label' => 'Dompet Transaksis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dompet-transaksi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->TRANS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->TRANS_ID], [
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
            'TRANS_ID',
            'STORE_ID',
            'ACCESS_GROUP',
            'VA_ID',
            'TRANSCODE',
            'TRANSCODE_NM',
            'TRANS_TYPE',
            'TRANS_TYPE_NM',
            'JUMLAH',
            'CURRENT_TGL',
            'TGL',
            'WAKTU',
            'REF_NUMBER',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
        ],
    ]) ?>

</div>
