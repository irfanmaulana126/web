<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $model app\backend\master\models\ItemFdiscount */
/* @var $form yii\widgets\ActiveForm */
$attributes = [
    [
        'attribute'=>'PRODUCT_NM',
        'valueColOptions'=>['style'=>'width:40%'],
    ],
    [
        'attribute'=>'PRODUCT_QR',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->PRODUCT_QR,
    ],
    [
        'attribute'=>'PRODUCT_SIZE_UNIT',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->PRODUCT_SIZE_UNIT,
    ],
    [
        'attribute'=>'INDUSTRY_GRP_NM',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->INDUSTRY_GRP_NM,
    ],
    [
        'attribute'=>'INDUSTRY_NM',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->INDUSTRY_NM,
    ],
    [
        'attribute'=>'PRODUCT_HEADLINE',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->PRODUCT_HEADLINE,
    ],
    [
        'attribute'=>'PRODUCT_SIZE',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->PRODUCT_SIZE,
    ],
    [
        'attribute'=>'CURRENT_STOCK',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=>$model->CURRENT_STOCK,
    ],
    [
        'attribute'=>'CURRENT_PRICE',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=> $model->CURRENT_PRICE,
    ],
    [
        'attribute'=>'gambar',
        'valueColOptions'=>['style'=>'width:40%'],
        'value'=> $model->gambar,
        'format' => ['image',['width'=>'100','height'=>'100']],
    ],
];
?>
<div class="item-fdiscount-form">
    <?= DetailView::widget([
        'id'=>'dv-data-barang-view',
        'model' => $model,
        'attributes' =>$attributes,
        'hover'=>true,
        'panel'=>[
			'heading'=>'<span class="fa fa-share"><span><b> Detail Prodak</b>',
			'type'=>DetailView::TYPE_INFO,
		],
        'mode'=>DetailView::MODE_VIEW,
        'buttons1'=>'',
		'buttons2'=>'{view}{save}',		
    ]) ?>
</div>
