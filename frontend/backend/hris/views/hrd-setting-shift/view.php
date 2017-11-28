<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdSettingShift */

$this->title = $model->SHIFT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Hrd Setting Shifts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-setting-shift-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->SHIFT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->SHIFT_ID], [
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
            'SHIFT_ID',
            'SHIFT_NM',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
            'STATUS',
        ],
    ]) ?>

</div>
