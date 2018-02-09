<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdSettingJamkerja */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Hrd Setting Jamkerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-setting-jamkerja-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT], [
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
            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'SHIFT_ID',
            'SHIFT_NM',
            'RENTANG_BAWAH',
            'RENTANG_ATAS',
            'RENTANG_TENGAH',
            'SHIFT_IN_BATAS_BAWAH',
            'SHIFT_IN_BATAS_SEQ',
            'SHIFT_IN_BATAS_ATAS',
            'SHIFT_IN',
            'SHIFT_OUT',
            'SHIFT_SEQ',
            'RADIUS_KOORDINAT',
            'TOLERANSI_TELAT',
            'TOLERANSI_PULANG',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
            'STATUS',
            'DCRP_DETIL:ntext',
            'YEAR_AT',
            'MONTH_AT',
        ],
    ]) ?>

</div>
