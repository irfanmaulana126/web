<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTransaksiBulan */

$this->title = 'Create Jurnal Transaksi Bulan';
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Transaksi Bulans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-transaksi-bulan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
