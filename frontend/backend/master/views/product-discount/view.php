<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductDiscount */

?>
<div class="product-discount-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'store.STORE_NM',
            'PRODUCT_NM',
            'PERIODE_TGL1',
            'PERIODE_TGL2',
            'START_TIME',
            'DISCOUNT',
        ],
    ]) ?>

</div>
