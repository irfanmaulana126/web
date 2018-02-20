<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\inventory\models\ProductStockClosing */

$this->title = 'Create Product Stock Closing';
$this->params['breadcrumbs'][] = ['label' => 'Product Stock Closings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-stock-closing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
