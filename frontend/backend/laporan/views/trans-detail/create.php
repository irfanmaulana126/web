<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanDetail */

$this->title = 'Create Trans Penjualan Detail';
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
