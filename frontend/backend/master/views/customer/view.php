<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\Customer */

?>
<div class="customer-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'NAME',
            'label'=>'NAMA'  ],
           ['attribute'=>'EMAIL',
            'label'=>'EMAIL'  ],
           ['attribute'=>'PHONE',
            'label'=>'PHONE'  ],
           ['attribute'=>'DCRP_DETIL',
            'label'=>'DCRP_DETIL' ,'valueColOptions'=>['style'=>'width:30%'] ],
        ],
        'panel'=>[
			'type'=>DetailView::TYPE_PRIMARY,
		],
		'mode'=>DetailView::MODE_VIEW,
		'buttons1'=>'',
		'buttons2'=>'{view}{save}',
    ]) ?>

</div>
