<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\StoreMembershipPaket */

$this->title = $model->PAKET_ID;
$this->params['breadcrumbs'][] = ['label' => 'Store Membership Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-membership-paket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PAKET_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PAKET_ID], [
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
            'PAKET_ID',
            'PAKET_GROUP',
            'PAKET_NM',
            'PAKET_DURATION',
            'PAKET_DURATION_BONUS',
            'HARGA_BULAN',
            'HARGA_HARI',
            'HARGA_PAKET',
            'HARGA_PAKET_HARI',
            'PAKET_STT',
            'PAKET_STT_NM',
            'CREATE_BY',
            'UPDATE_BY',
            'CREATE_AT',
            'UPDATE_AT',
        ],
    ]) ?>

</div>
