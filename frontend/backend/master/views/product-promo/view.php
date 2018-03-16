<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductPromo */

?>
<div class="product-promo-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'STORE_NM',
             'label'=>'STORE'  ],
            ['attribute'=>'PRODUCT_NM',
             'label'=>'PRODUCT'  ],
            ['attribute'=>'PERIODE_TGL1',
             'label'=>'TGL AWAL'  ],
            ['attribute'=>'PERIODE_TGL2',
             'label'=>'TGL AKHIR'  ],
            ['attribute'=>'START_TIME',
             'label'=>'WAKTU'  ],
            ['attribute'=>'PROMO',
             'label'=>'PROMO','valueColOptions'=>['style'=>'width:30%'] ],
        ],
        'panel'=>[
			'type'=>DetailView::TYPE_PRIMARY,
		],
		'mode'=>DetailView::MODE_VIEW,
		'buttons1'=>'',
		'buttons2'=>'{view}{save}',
    ]) ?>

</div>
