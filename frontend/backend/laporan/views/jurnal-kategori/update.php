<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalKategori */

$this->title = 'Update Jurnal Kategori: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->KTG_CODE, 'url' => ['view', 'id' => $model->KTG_CODE]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurnal-kategori-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
