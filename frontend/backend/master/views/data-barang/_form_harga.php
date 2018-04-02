<?php

use yii\helpers\Html;
use kartik\grid\GridView;
// use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
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
$this->registerJs("

$(document).ready(function() {
	$('#hitung').change(function(){
    var hpp=parseInt($('#productharga-hpp').val());
    var ppn=parseInt($('#productharga-ppn').val());
    var margin=parseInt($('#margin').val());
    var hppbersih=hpp+margin;
    if (!isNaN(hppbersih)) {
        $('#productharga-harga_jual-disp').val(hppbersih);
        $('#productharga-harga_jual').val(hppbersih);
     }
	
	});
});
");
$this->registerCss("   
.product-discount-form #gv-all-data-prodak-harga-item .kv-grid-container{
		height:200px;
    }
.product-discount-form	#gv-all-data-prodak-harga-item .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, rgba(21, 175, 213, 0.14) 100%);
		color: #000;
	}
.product-discount-form #gv-all-data-prodak-harga-item .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, rgba(21, 175, 213, 0.14) 100%);
	}
");
$bColor='rgb(76, 131, 255)';
$pageNm='<span class="fa-stack fa-xs text-right">				  
				  <i class="fa fa-share fa-1x"></i>
				</b></span><b>HISTORI HARGA PRODUCT </b>
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
        'label'=>'PRODUK',
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
        'label'=>'TGL AWAL',
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
        'label'=>'TGL AKHIR',
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
    [
        'attribute'=>'HPP',
        'label'=>'HPP',
        'filterType'=>false,
        'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
        'hAlign'=>'right',
        'vAlign'=>'middle',
        'mergeHeader'=>false,
        'noWrap'=>false,
        //gvContainHeader($align,$width,$bColor)
        'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
        'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
        
    ],
];
?>

<div class="product-discount-form" id="hitung">
<div class="row">
<div class="col-md-6">
<?= GridView::widget([
		'id'=>'gv-all-data-prodak-harga-item',
		'dataProvider' => $dataProviderHarga,
		// 'filterModel' => $searchModelHarga,
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
        'summary'=>false
		// 'floatOverflowContainer'=>true,
		// 'floatHeader'=>true,
	]); 
    ?>
</div>
<div class="col-md-6">
<?php $form = ActiveForm::begin(); ?>
<?=$form->field($model,'storeNm',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span><b>Toko</b></span>',
						'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 105px;']
					]
				]
				])->textInput([
					'value'=>$productdetail->STORE_NM,
                    'readOnly'=>true,
                    'style'=>';width: 315px;border-radius: 0px 5px 5px 0px;'
				])->label(false);	
		?>
        <?=$form->field($model,'produkNm',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Produk</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 105px;']
						]
					]
				])->textInput([
					'value'=>$productdetail->PRODUCT_NM,
					'readOnly'=>true,
                    'style'=>'width: 315px;border-radius: 0px 5px 5px 0px;'
				])->label(false);	
		?> 

        <?php
         if (empty($product->PERIODE_TGL2)) {
            $date = date('Y-m-d');
        } else {
            if ($product->PERIODE_TGL2 < date('Y-m-d')) {
                $date = date('Y-m-d');
            } else {
                $date = date('Y-m-d', strtotime('+1 days', strtotime($product->PERIODE_TGL2)));
            }
            
        }
        $date1=date('Y-m-d');
        $date2=date('Y-m-d', strtotime('+21 days', strtotime($date1)));
        echo $form->field($model,'PERIODE_TGL1',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Tanggal</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 105px;']
						]
					]
				])->widget(DatePicker::classname(), [
                    
                    'attribute2' => 'PERIODE_TGL2',
                        
                        'options' => ['placeholder' => 'Tanggal Awal','value'=>$date],
                        'options2' => ['placeholder' => 'Tanggal Akhir'],
                        'type' => DatePicker::TYPE_RANGE,
                        'form' => $form,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            "startDate" => $date,
                            'style'=>'border-radius: 0px 5px 5px 0px;'
                            
                        ]
                    ])->label(false);	
		?>     
     <?= $form->field($model, 'HPP',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>HPP</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 105px;']
						]
					]
				])->widget(MaskMoney::classname(), [
                            'options' => ['placeholder' => 'HPP ...','style'=>';width: 315px;border-radius: 0px 5px 5px 0px;','onkeyup'=>'sum();'],
                            'pluginOptions'=>[
                                'prefix'=>'Rp ',
                                'precision' => 0
                            ],
                        ])->label(false) ?>
     <?= $form->field($model, 'margin',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Margin Laba</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 105px;']
						]
					]
				])->widget(MaskMoney::classname(), [
		'options' => [
					'placeholder' => 'Margin Harga ...','style'=>';width: 315px;border-radius: 0px 5px 5px 0px;','onkeyup'=>'sum();',
					'class' => 'form-control',
					'id'=>'margin',
				],'pluginOptions' => [
					'prefix' => 'Rp ',
					'precision' => 0
				 ]
				])->label(false); ?>
    <?= $form->field($model, 'HARGA_JUAL',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span><b>Harga Jual</b></span>',
							'options'=>['style' =>'border-radius: 5px 0px 0px 5px;background-color: rgba(21, 175, 213, 0.14);text-align:right;width: 105px;']
						]
					]
				])->widget(MaskMoney::classname(), [
                'options' => ['placeholder' => 'Harga Barang ...','style'=>';width: 315px;border-radius: 0px 5px 5px 0px;','readonly'=>TRUE],
                // 'disabled' => true,
                'pluginOptions'=>[
                    'prefix'=>'Rp ',
                    'precision' => 0
                ],
            ])->label(false) ?>
    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>
</div>
</div>