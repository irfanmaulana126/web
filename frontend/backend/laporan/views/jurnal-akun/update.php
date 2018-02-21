<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalAkun */

$this->title = 'Update Jurnal Akun: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Akuns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AKUN_CODE, 'url' => ['view', 'id' => $model->AKUN_CODE]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurnal-akun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
