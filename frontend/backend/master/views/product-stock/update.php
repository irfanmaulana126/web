<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductStock */

$this->title = 'Update Product Stock: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Product Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID, 'PRODUCT_ID' => $model->PRODUCT_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-stock-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
