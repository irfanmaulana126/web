<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdListIzin */

$this->title = $model->IZIN_ID;
$this->params['breadcrumbs'][] = ['label' => 'Hrd List Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-list-izin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->IZIN_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->IZIN_ID], [
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
            'IZIN_ID',
            'IZIN_NM',
            'IZIN_KET:ntext',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
            'STATUS',
        ],
    ]) ?>

</div>
