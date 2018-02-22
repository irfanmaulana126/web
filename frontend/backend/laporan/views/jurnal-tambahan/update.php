<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTambahan */

$this->title = 'Update Jurnal Tambahan: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Tambahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->JURNAL_ID, 'url' => ['view', 'JURNAL_ID' => $model->JURNAL_ID, 'MONTH_AT' => $model->MONTH_AT, 'YEAR_AT' => $model->YEAR_AT]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurnal-tambahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
