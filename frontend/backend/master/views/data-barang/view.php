<?php
use yii\helpers\Html;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $model app\backend\master\models\ItemFdiscount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-fdiscount-form">
    <?= DetailView::widget([
        'id'=>'dv-data-barang-view',
        'model' => $model,
        'attributes' => [
            'STORE_ID',
            'PRODUCT_QR',
            'PRODUCT_NM',
            'PRODUCT_SIZE',
            'PRODUCT_SIZE_UNIT',
            'PRODUCT_HEADLINE',
            'CURRENT_STOCK',
            'CURRENT_PRICE'
        ],
        'hover'=>true,
        'panel'=>[
			'heading'=>'<span class="fa fa-user"><span><b>Detail Prodak</b>',
			'type'=>DetailView::TYPE_INFO,
		],
        'mode'=>DetailView::MODE_VIEW,
        'buttons1'=>'',
		'buttons2'=>'{view}{save}',		
    ]) ?>
</div>