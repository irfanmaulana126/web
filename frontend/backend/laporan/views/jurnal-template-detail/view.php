<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTemplateDetail */

$this->title = $model->RPT_DETAIL_ID;
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Template Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-template-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'RPT_DETAIL_ID' => $model->RPT_DETAIL_ID, 'AKUN_CODE' => $model->AKUN_CODE, 'RPT_TITLE_ID' => $model->RPT_TITLE_ID, 'RPT_GROUP_ID' => $model->RPT_GROUP_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'RPT_DETAIL_ID' => $model->RPT_DETAIL_ID, 'AKUN_CODE' => $model->AKUN_CODE, 'RPT_TITLE_ID' => $model->RPT_TITLE_ID, 'RPT_GROUP_ID' => $model->RPT_GROUP_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT], [
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
            'RPT_DETAIL_ID',
            'RPT_SORTING',
            'ACCESS_GROUP',
            'AKUN_CODE',
            'KTG_CODE',
            'AKUN_NM',
            'KTG_NM',
            'RPT_TITLE_ID',
            'RPT_TITLE_NM',
            'RPT_GROUP_ID',
            'RPT_GROUP_NM',
            'CAL_FORMULA',
            'CAL_FORMULA_NM',
            'STATUS',
            'STATUS_NM',
            'KETERANGAN:ntext',
            'CREATE_BY',
            'UPDATE_BY',
            'CREATE_AT',
            'UPDATE_AT',
            'MONTH_AT',
            'YEAR_AT',
        ],
    ]) ?>

</div>
