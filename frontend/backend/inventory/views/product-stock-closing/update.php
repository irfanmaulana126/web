<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\inventory\models\ProductStockClosing */

$this->title = 'Update Product Stock Closing: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Product Stock Closings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UNIX_BULAN_ID, 'url' => ['view', 'UNIX_BULAN_ID' => $model->UNIX_BULAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-stock-closing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
