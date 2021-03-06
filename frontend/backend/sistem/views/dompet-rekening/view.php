<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\sistem\models\DompetRekening */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Dompet Rekenings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dompet-rekening-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
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
            'NAMA_LENGKAP',
            'BANK',
            'NO_REK',
            'ALAMAT:ntext',
            'TLP',
            'STATUS',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
            'DCRP_DETIL:ntext',
            'YEAR_AT',
            'MONTH_AT',
        ],
    ]) ?>

</div>
