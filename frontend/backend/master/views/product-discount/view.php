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
            ['attribute'=>'store.STORE_NM',
            'label'=>'STORE'  ],
           ['attribute'=>'PRODUCT_NM',
            'label'=>'PRODUCT'  ],
           ['attribute'=>'PERIODE_TGL1',
            'label'=>'TGL AWAL'  ],
           ['attribute'=>'PERIODE_TGL2',
            'label'=>'TGL AKHIR'  ],
           ['attribute'=>'START_TIME',
            'label'=>'WAKTU'  ],
           ['attribute'=>'DISCOUNT',
            'label'=>'DISCOUNT'  ],
        ],
    ]) ?>

</div>
