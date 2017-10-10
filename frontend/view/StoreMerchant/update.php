<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\StoreMerchant */

$this->title = 'Update Store Merchant: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Store Merchants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-merchant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
