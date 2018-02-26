<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTemplateDetail */

$this->title = 'Update Jurnal Template Detail: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Template Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->RPT_DETAIL_ID, 'url' => ['view', 'RPT_DETAIL_ID' => $model->RPT_DETAIL_ID, 'AKUN_CODE' => $model->AKUN_CODE, 'RPT_TITLE_ID' => $model->RPT_TITLE_ID, 'RPT_GROUP_ID' => $model->RPT_GROUP_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurnal-template-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
