<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductStock */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Product Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-stock-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID' => $model->ID, 'PRODUCT_ID' => $model->PRODUCT_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID' => $model->ID, 'PRODUCT_ID' => $model->PRODUCT_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'PRODUCT_ID',
            'LAST_STOCK',
            'INPUT_DATE',
            'INPUT_TIME',
            'INPUT_STOCK',
            'CURRENT_DATE',
            'CURRENT_TIME',
            'CURRENT_STOCK',
            'SISA_STOCK',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
            'CREATE_UUID',
            'UPDATE_UUID',
            'STATUS',
            'DCRP_DETIL:ntext',
            'YEAR_AT',
            'MONTH_AT',
        ],
    ]) ?>

</div>
