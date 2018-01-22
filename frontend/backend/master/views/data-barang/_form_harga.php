<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Store;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\field\FieldRange;
/* @var $this yii\web\View */
/* @var $model app\backend\master\models\ItemFdiscount */
/* @var $form yii\widgets\ActiveForm */
$this->registerCss("   
.product-discount-form #gv-all-data-prodak-harga-item .kv-grid-container{
		height:100px
	}
");
$bColor='rgb(76, 131, 255)';
$pageNm='<span class="fa-stack fa-xs text-right">				  
				  <i class="fa fa-share fa-1x"></i>
				</span><b>HISTORI HARGA PRODUCT </b>
	';
$gvAttProdakHargaItem=[
    [
        'class'=>'kartik\grid\SerialColumn',
        'contentOptions'=>['class'=>'kartik-sheet-style'],
        'width'=>'10px',
        'header'=>'No.',
        'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColor,'#ffffff'),
        'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
    ],		
    //ITEM NAME
    [
        'attribute'=>'PRODUCT_NM',
        //'label'=>'Cutomer',
        'filterType'=>false,
        'filter'=>false,
        'hAlign'=>'right',
        'vAlign'=>'middle',
        'mergeHeader'=>true,
        'group'=>true,
        'groupedRow'=>true,
        'noWrap'=>false,        
        'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
        'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
        
    ],		
    //DEFAULT_STOCK
    [
        'attribute'=>'PERIODE_TGL1',
        //'label'=>'Cutomer',
        'filterType'=>false,
        'filter'=>false,
        'hAlign'=>'right',
        'vAlign'=>'middle',
        'mergeHeader'=>true,
        'noWrap'=>false,        
        'group'=>false,
        'groupedRow'=>false,
        //gvContainHeader($align,$width,$bColor)
        'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
        'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
        
    ],
    //DEFAULT_HARGA
    [
        'attribute'=>'PERIODE_TGL2',
        //'label'=>'Cutomer',
        'filterType'=>false,
        'filter'=>false,
        'hAlign'=>'right',
        'vAlign'=>'middle',
        'mergeHeader'=>true,
        'noWrap'=>false,
        'group'=>false,
        'groupedRow'=>false,
        //gvContainHeader($align,$width,$bColor)
        'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
        'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
        
    ],		
    //SATUAN
    [
        'attribute'=>'HARGA_JUAL',
        //'label'=>'Cutomer',
        'filterType'=>false,
        'filter'=>false,
        'hAlign'=>'right',
        'vAlign'=>'middle',
        'mergeHeader'=>true,
        'noWrap'=>false,
        'group'=>false,
        'groupedRow'=>false,
        //gvContainHeader($align,$width,$bColor)
        'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
        'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
        
    ],
];
?>

<div class="product-discount-form">
<?= GridView::widget([
		'id'=>'gv-all-data-prodak-harga-item',
		'dataProvider' => $dataProviderHarga,
		'filterModel' => $searchModelHarga,
		'columns'=>$gvAttProdakHargaItem,				
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-all-data-prodak-harga-item',
		    ],						  
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>true,
		'bordered'=>true,
		'striped'=>true,
		'autoXlFormat'=>true,
		'export' => false,
		'panel'=>[''],
		'toolbar' => false,
		'panel' => [
			// 'heading'=>false,
			'heading'=>'<div style="float:right"></div>'.$pageNm,
			'type'=>'success',
            'before'=>false,
            'footer'=>false,
			'showFooter'=>false,
		],
		// 'floatOverflowContainer'=>true,
		// 'floatHeader'=>true,
	]); 
    ?>
<?php $form = ActiveForm::begin(); ?>
   
    <?php
        echo '<label class="control-label">Periode Tanggal</label>';
       echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'PERIODE_TGL1',
            'attribute2' => 'PERIODE_TGL2',
            'options' => ['placeholder' => 'Start date'],
            'options2' => ['placeholder' => 'End date'],
            'type' => DatePicker::TYPE_RANGE,
            'form' => $form,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]);
    ?>
     <?= $form->field($model, 'HARGA_JUAL')->widget(MaskMoney::classname(), [
                            'options' => ['placeholder' => 'Harga Barang ...'],
                            'pluginOptions'=>[
                                'prefix'=>'Rp',
                            ],
                        ]) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>


</div>

