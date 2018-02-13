<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\sistem\models\StoreKasir */

$this->title = 'Update Store Kasir: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Store Kasirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->KASIR_ID, 'url' => ['view', 'id' => $model->KASIR_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-kasir-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
