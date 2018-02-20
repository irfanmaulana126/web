<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetTransaksi */

$this->title = 'Create Dompet Transaksi';
$this->params['breadcrumbs'][] = ['label' => 'Dompet Transaksis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dompet-transaksi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
