<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetSaldo */

$this->title = 'Update Dompet Saldo: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Dompet Saldos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ACCESS_GROUP, 'url' => ['view', 'id' => $model->ACCESS_GROUP]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dompet-saldo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
