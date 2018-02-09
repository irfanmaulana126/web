<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductStock */

?>
<div class="product-stock-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
