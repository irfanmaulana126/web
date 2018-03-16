
<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductDiscount */

?>
<div class="product-discount-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'GROUP_NM',
            'label'=>'NAMA','valueColOptions'=>['style'=>'width:30%'] ],
            'NOTE:ntext',
        ],
        'panel'=>[
			'type'=>DetailView::TYPE_PRIMARY,
		],
		'mode'=>DetailView::MODE_VIEW,
		'buttons1'=>'',
		'buttons2'=>'{view}{save}',
    ]) ?>

</div>
