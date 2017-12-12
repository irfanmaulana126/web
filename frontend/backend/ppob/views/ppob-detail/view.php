<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\ppob\models\PpobDetail */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Ppob Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppob-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID' => $model->ID, 'DETAIL_ID' => $model->DETAIL_ID, 'HEADER_ID' => $model->HEADER_ID, 'PROVIDER_ID' => $model->PROVIDER_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID' => $model->ID, 'DETAIL_ID' => $model->DETAIL_ID, 'HEADER_ID' => $model->HEADER_ID, 'PROVIDER_ID' => $model->PROVIDER_ID], [
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
            'DETAIL_ID',
            'HEADER_ID',
            'PROVIDER_ID',
            'DETAIL_NM',
            'PROVIDER_NM',
            'DETAIL_DCRP:ntext',
            'STATUS',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
        ],
    ]) ?>

</div>
