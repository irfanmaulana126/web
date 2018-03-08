<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use kartik\widgets\Spinner;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use yii\web\View;
use frontend\backend\master\models\Product;

$this->registerCss("
	:link {
		color: #fdfdfd;
	}
	/* mouse over link */
	a:hover {
		color: #5a96e7;
	}
	/* selected link */
	a:active {
		color: blue;
	}
	#gv-all-data-prodak-item .kv-grid-container{
		height:400px
	}
	#gv-all-data-prodak-item .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #000;
	}
	#gv-all-data-prodak-item .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");	

	$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
    $bColor='rgb(76, 131, 255)';
	$pageNm='<b>PRODUCT</b>
	';
	$attDinamikListKaryawan[] =[			
		'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),					
];
	$aryField= [
		['ID' =>0, 'ATTR' =>[
			'attribute'=>'STORE_ID',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
		]],
		['ID' =>1, 'ATTR' =>		
        [
            'attribute'=>'PRODUCT_NM',
            //'label'=>'Cutomer',
            'filterType'=>true,
            'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
            'hAlign'=>'right',
            'vAlign'=>'middle',
            'mergeHeader'=>false,
            'noWrap'=>false,
            'format'=>'raw',
            'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
            'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
            
        ]],		
		['ID' =>2, 'ATTR' =>[
			'attribute'=>'TAHUN',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		]],		
		['ID' =>3, 'ATTR' =>[
			'attribute'=>'BULAN',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
        ]],			
		['ID' =>4, 'ATTR' =>[
			'attribute'=>'TGL',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
        ]],					
	];
	 
	$valFields = ArrayHelper::map($aryField, 'ID', 'ATTR');	
	foreach($valFields as $key =>$value[]){	
		$gvAttProdakItem[]=[		
			'attribute'=>$value[$key]['attribute'],
			'filterType'=>$value[$key]['filterType'],
			'filterOptions'=>$value[$key]['filterOptions'],
			'hAlign'=>$value[$key]['hAlign'],
			'vAlign'=>$value[$key]['vAlign'],
			'mergeHeader'=>$value[$key]['mergeHeader'],
			'noWrap'=>$value[$key]['noWrap'],
			'format'=>$value[$key]['format'],
			'headerOptions'=>$value[$key]['headerOptions'],
			'contentOptions'=>$value[$key]['contentOptions'],			
		];	
	};
	switch ($akunkode) {
		case '1-1001':
			# code...
			break;
		case '1-1002':
			# code...
			break;
		case '1-1003':
			# code...
			break;
		case '2-1001':
			# code...
			break;
		case '3-1001':
		$gvAttProdakItem[]=
			[
				'attribute'=>'PRODUK_SUBTTL_QTY',
				//'label'=>'Cutomer',
				'filterType'=>true,
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'mergeHeader'=>false,
				'noWrap'=>false,
				'format'=>'raw',
				'value'=>function($model)use($store,$tanggal,$akun){
					$icon=Html::a($model->PRODUK_SUBTTL_QTY,'/laporan/arus-uang/detail-produk?akunkode='.$akun->AKUN_CODE.'&tgl='.$model->TGL.'&store='.$store->STORE_ID.'&produk='.$model->PRODUCT_ID,['id'=>'store-button-export-excel','data-pjax' => true,'class'=>"btn btn-primary btn-xs" ]);
					return $icon;
				},
				'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
				'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
				
			];			
			
		$gvAttProdakItem[]=[
				'attribute'=>'PRODUK_SUBTTL_HARGAJUAL',
				//'label'=>'Cutomer',
				'filterType'=>true,
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'mergeHeader'=>false,
				'noWrap'=>false,
				'format'=>'raw',
				'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
				'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
		];
			break;
		
		case '3-1002':
			$gvAttProdakItem[]=
			[
				'attribute'=>'PRODUK_SUBTTL_QTY',
				//'label'=>'Cutomer',
				'filterType'=>true,
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'mergeHeader'=>false,
				'noWrap'=>false,
				'format'=>'raw',
				'value'=>function($model)use($store,$tanggal,$akun){					
					$icon=Html::a($model->PRODUK_SUBTTL_QTY,'/laporan/arus-uang/detail-produk?akunkode='.$akun->AKUN_CODE.'&tgl='.$model->TGL.'&store='.$store->STORE_ID.'&produk='.$model->PRODUCT_ID,['id'=>'store-button-export-excel','data-pjax' => true,'class'=>"btn btn-primary btn-xs" ]);
					return $icon;
				},
				'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
				'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
				
			];		
		
		$gvAttProdakItem[]=[
				'attribute'=>'PRODUK_JUALPPNDISCOUNT',
				//'label'=>'Cutomer',
				'filterType'=>true,
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'mergeHeader'=>false,
				'noWrap'=>false,
				'format'=>'raw',
				'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
				'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
		];
			break;	
		case '3-1003':
			$gvAttProdakItem[]=
			[
				'attribute'=>'PRODUK_SUBTTL_QTY',
				//'label'=>'Cutomer',
				'filterType'=>true,
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'mergeHeader'=>false,
				'noWrap'=>false,
				'format'=>'raw',
				'value'=>function($model)use($store,$tanggal,$akun){					
					$icon=Html::a($model->PRODUK_SUBTTL_QTY,'/laporan/arus-uang/detail-produk?akunkode='.$akun->AKUN_CODE.'&tgl='.$model->TGL.'&store='.$store->STORE_ID.'&produk='.$model->PRODUCT_ID,['id'=>'store-button-export-excel','data-pjax' => true,'class'=>"btn btn-primary btn-xs" ]);
					return $icon;
				},
				'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
				'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
				
			];		
		
		$gvAttProdakItem[]=[
				'attribute'=>'PRODUK_SUBTTL_PPN',
				//'label'=>'Cutomer',
				'filterType'=>true,
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'mergeHeader'=>false,
				'noWrap'=>false,
				'format'=>'raw',
				'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
				'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
		];
			break;
		case '3-2001':
			# code...
			break;
		case '4-1001':
			$gvAttProdakItem[]=
			[
				'attribute'=>'REFUND_SUBTTL_QTY',
				//'label'=>'Cutomer',
				'filterType'=>true,
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'mergeHeader'=>false,
				'noWrap'=>false,
				'format'=>'raw',
				'value'=>function($model)use($store,$tanggal,$akun){
					$icon=Html::a($model->PRODUK_SUBTTL_QTY,'/laporan/arus-uang/detail-produk?akunkode='.$akun->AKUN_CODE.'&tgl='.$model->TGL.'&store='.$store->STORE_ID.'&produk='.$model->PRODUCT_ID,['id'=>'store-button-export-excel','data-pjax' => true,'class'=>"btn btn-primary btn-xs" ]);
					return $icon;
				},
				'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
				'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
				
			];		
		
		$gvAttProdakItem[]=[
				'attribute'=>'REFUND_SUBTTL_HARGAJUAL',
				//'label'=>'Cutomer',
				'filterType'=>true,
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'mergeHeader'=>false,
				'noWrap'=>false,
				'format'=>'raw',
				'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
				'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
		];
			break;
		case '5-1001':
			# code...
			break;
		case '5-1002':
			# code...
			break;
		case '5-1003':
			# code...
			break;
		case '5-1004':
			# code...
			break;
		case '5-1005':
			# code...
			break;
		case '5-1006':
			# code...
			break;
		
		default:
			# code...
			break;
	}	
	$gvAllStoreItem=GridView::widget([
		'id'=>'gv-all-data-prodak-item',
		'dataProvider' => $dataProvider,
		'columns'=>$gvAttProdakItem,				
		'pjax'=>0,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-all-data-prodak-item',
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
			'heading'=>'<div class="pull-right"></div>'.$pageNm,
			'type'=>'default',
			'before'=>false,
			'showFooter'=>false,
			'after'=>false,
			// 'before'=> tombolReqStore(),
		],
		// 'floatOverflowContainer'=>true,
		// 'floatHeader'=>true,
	]); 	
?>
<div class="jurnal-template-title-index">
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row">	
			<div style="height:20px;text-align:center;font-family: tahoma ;font-size: 10pt;;padding-top:10px">	
                    <?php		                    		
						echo '<b>RINGKASAN DETAIL '.strtoupper($akun->AKUN_NM).'<br>PRODUK '.strtoupper($store->STORE_NM).'<br>'.date("F Y",strtotime($tanggal)).'</b>';				
					?>		
			</div>
			<br>
			<br>
			<br>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;padding-top:10px">
		<div class="row">	
			<?=$gvAllStoreItem?>
		</div>
	</div>
</div>


