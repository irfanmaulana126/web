<?php

use yii\helpers\Html;
use kartik\grid\GridView;
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

$this->registerCss("   
.product-discount-form #gv-all-data-prodak-harga-item .kv-grid-container{
		height:200px;
    }
.product-discount-form	#gv-all-data-prodak-harga-item .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #000;
	}
.product-discount-form #gv-all-data-prodak-harga-item .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");
$bColor='rgb(76, 131, 255)';
$pageNm='<span class="fa-stack fa-xs text-right">				  
				  <i class="fa fa-share fa-1x"></i>
				</span><b>HISTORI PROMO PRODUCT </b>
	';
$gvAttProdakPromoItem=[
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
        'label'=>'NAMA PRODUK',
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
        'attribute'=>'PROMO',
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
<div class="row">
<div class="col-md-6">
<?= GridView::widget([
		'id'=>'gv-all-data-prodak-harga-item',
		'dataProvider' => $dataProvider,
		// 'filterModel' => $searchModel,
		'columns'=>$gvAttProdakPromoItem,				
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
        'summary'=>false,
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
</div>

<div class="col-md-6">
<?php $form = ActiveForm::begin(); ?>
<?=$form->field($model,'storeNm',[					
				'addon' => [
					'prepend' => [
						'content'=>'<span >Toko </span>',
						'options'=>['style' =>' background-color: lightblue;text-align:right;width: 78px;']
					]
				]
				])->textInput([
					'value'=>$productdetail->STORE_NM,
					'readOnly'=>true,
                    'style'=>'width: 342px;'
				])->label(false);	
		?>
        <?=$form->field($model,'produkNm',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >Produk</span>',
							'options'=>['style' =>' background-color: lightblue;text-align:right;width: 78px;']
						]
					]
				])->textInput([
					'value'=>$productdetail->PRODUCT_NM,
                    'readOnly'=>true,
                    'style'=>'width: 342px;'
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
							'content'=>'<span >Tanggal</span>',
							'options'=>['style' =>' background-color: lightblue;text-align:right']
						]
					]
				])->widget(DatePicker::classname(), [
                    'value'=>$date1,
                    'attribute2' => 'PERIODE_TGL2',
                        'value2'=>$date2,
                        'options' => ['placeholder' => 'Tanggal Awal'],
                        'options2' => ['placeholder' => 'Tanggal Akhir'],
                        'type' => DatePicker::TYPE_RANGE,
                        'form' => $form,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            "startDate" => $date,
                        ]
                    ])->label(false);	
		?>  
    <?= $form->field($model,'PROMO',[					
					'addon' => [
						'prepend' => [
							'content'=>'<span >PROMO</span>',
							'options'=>['style' =>' background-color: lightblue;text-align:right;']
						]
					]
				])->textInput()->label(false); ?>
            
    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>
    </div>
</div>


</div>

