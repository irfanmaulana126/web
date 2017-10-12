<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use kartik\builder\Form;
use yii\helpers\Url;
use yii\web\View;

use common\models\Store;
use frontend\backend\laporan\models\MerchantType;
use frontend\backend\laporan\models\TransPenjualanDetail;
use frontend\backend\laporan\models\TransPenjualanDetailSearch;

$this->registerCss("
		#header-sales-trans .kv-grid-table :link {
			color: #fdfdfd;
		}
		#header-sales-trans .kv-grid-table :link {
			color: #fdfdfd;
		}
		
		#import-absen-log .kv-grid-table .actual-delete :link {
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
		.modal-content { 
			border-radius: 50;
		}
		.kv-panel {
			//min-height: 340px;
			height: 300px;
		}
		.kv-grid-container{
			height:550px
		}
		.tmp-button-delete a:hover {
			color:red;
		}
	");
// $this->title = 'Trans Opencloses';
// $this->params['breadcrumbs'][] = $this->title;
	
	$aryStore=ArrayHelper::map(Store::find()->all(), 'STORE_ID','STORE_NM');
	$aryTypeTrans=ArrayHelper::map(MerchantType::find()->all(), 'TYPE_PAY_ID','TYPE_PAY_NM');
	
	$aryFieldDTransHeader= [		  
		['ID' =>0, 'ATTR' =>['FIELD'=>'storeNm','SIZE' => '150px','label'=>'Toko','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>$aryStore,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>true]],		  
		['ID' =>1, 'ATTR' =>['FIELD'=>'tgl','SIZE' => '6px','label'=>'TRANS DATE','align'=>'center','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>2,'pageSummary'=>false,'group'=>false]],
		['ID' =>2, 'ATTR' =>['FIELD'=>'waktu','SIZE' => '6px','label'=>'WAKTU','align'=>'center','vAlign'=>'top','mergeHeader'=>true,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		['ID' =>3, 'ATTR' =>['FIELD'=>'username','SIZE' => '6px','label'=>'USER','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		['ID' =>4, 'ATTR' =>['FIELD'=>'TOTAL_PRODUCT','SIZE' => '6px','label'=>'QTY','align'=>'right','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>['decimal', 2],'filterColspn'=>0,'pageSummary'=>true,'group'=>false]],	
		['ID' =>5, 'ATTR' =>['FIELD'=>'PPN','SIZE' => '6px','label'=>'PPN','align'=>'right','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>['decimal', 2],'filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		['ID' =>6, 'ATTR' =>['FIELD'=>'SUB_TOTAL_HARGA','SIZE' => '6px','label'=>'SUB TOTAL HARGA','align'=>'right','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>['decimal', 2],'filterColspn'=>0,'pageSummary'=>true,'group'=>false]],	
		['ID' =>7, 'ATTR' =>['FIELD'=>'TOTAL_HARGA','SIZE' => '6px','label'=>'TOTAL HARGA','align'=>'right','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>['decimal', 2],'filterColspn'=>0,'pageSummary'=>true,'group'=>false]],	
		['ID' =>8, 'ATTR' =>['FIELD'=>'TYPE_PAY_NM','SIZE' => '6px','label'=>'TIPE BAYAR','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>$aryTypeTrans,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		['ID' =>9, 'ATTR' =>['FIELD'=>'BANK_NM','SIZE' => '6px','label'=>'NAMA BANK','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		['ID' =>10, 'ATTR' =>['FIELD'=>'CONSUMER_NM','SIZE' => '6px','label'=>'CONSUMER','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		//['ID' =>11, 'ATTR' =>['FIELD'=>'OPENCLOSE_ID','SIZE' => '6px','label'=>'BOOK.ID','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		
	];	
	$valFieldsDTransHeader = ArrayHelper::map($aryFieldDTransHeader, 'ID', 'ATTR'); 
	$bColor='rgba(87,114,111, 1)';
	$attTransHeader[] =[			
		'class'=>'kartik\grid\SerialColumn',
		'contentOptions'=>['class'=>'kartik-sheet-style'],
		'width'=>'10px',
		'header'=>'No.',
		'headerOptions'=>[
			'style'=>[
				'text-align'=>'center',
				'width'=>'10px',
				'font-family'=>'verdana, arial, sans-serif',
				'font-size'=>'9pt',
				'background-color'=>$bColor,
				'color'=>'white',
			]
		],
		'contentOptions'=>[
			'style'=>[
				'text-align'=>'center',
				'width'=>'10px',
				'font-family'=>'tahoma, arial, sans-serif',
				'font-size'=>'9pt',
			]
		],					
	];
	
	
	
	/*DINAMIK  ATTRIBUTE*/
	foreach($valFieldsDTransHeader as $key =>$value[]){	
		//==== CUSTIMUZE ====
		if ($value[$key]['FIELD']=='storeNm' OR $value[$key]['FIELD']=='TYPE_PAY_NM'){				
			$gvHdfilterType=GridView::FILTER_SELECT2;
			$gvHdfilterWidgetOpt=[				
				'pluginOptions'=>['allowClear'=>true],		
			]; 
			if($value[$key]['FIELD']=='HARI'){
				$gvHdfilterInputOpt=['placeholder'=>'-Pilih-'];
			}else{
				$gvHdfilterInputOpt=['placeholder'=>'-- Pilih --'];
			};			
			$gvHdfilterOptions=[				
				'style'=>'background-color:rgba(255, 255, 255, 1); align:center',
				'colspan'=>$value[$key]['filterColspn']
			];
		}elseif($value[$key]['FIELD']=='tgl'){
			//DATE FORMAT FILTER
			$gvHdfilterType=GridView::FILTER_DATE;
			$gvHdfilterWidgetOpt=[	
				'pluginOptions' => [				
						//'format' => 'yyyy-mm-dd',					 
						'autoclose' => true,
						'todayHighlight' => true,
						'format' => 'yyyy-mm-dd',
						'autoWidget' => false,
						'todayBtn' => true,
				]
			];
			$gvHdfilterOptions=[				
				'style'=>'background-color:rgba(255, 255, 255, 1); align:center',
				'colspan'=>$value[$key]['filterColspn']
			];			
		}else{
			$gvHdfilterType=false;
			//$gvfilter=true;
			$gvHdfilterWidgetOpt=[];		
			$gvHdfilterInputOpt=['class'=>"form-control"];	
			$gvHdfilterOptions=[				
				'style'=>'background-color:rgba(255, 255, 255, 1); align:center',
				'colspan'=>$value[$key]['filterColspn']
			];
			$gvHdgroupFooter=false;			
		}; 
		
		$attTransHeader[]=[		
			'attribute'=>$value[$key]['FIELD'],
			'label'=>$value[$key]['label'],
			'group'=>$value[$key]['group'],
			'filter'=>$value[$key]['FILTER'],
			'filterType'=>$gvHdfilterType,
			'filterWidgetOptions'=>$gvHdfilterWidgetOpt,	
			'filterInputOptions'=>$gvHdfilterInputOpt,	
			'filterOptions'=>$gvHdfilterOptions,			
			'hAlign'=>'right',
			'vAlign'=>$value[$key]['vAlign'],
			//'mergeHeader'=>true,
			'noWrap'=>true,	
			'value'=>function($data)use($key,$value){
				$x=$value[$key]['FIELD'];
				return $data->$x;
			},			
			'groupFooter'=>function($model, $key, $index, $widget){ 
				return [
					'mergeColumns'=>[[1,5]], 
					'content'=>[             // content to show in each summary cell
						1=>'SUB TOTAL TOKO "' . $model->storeNm .'"',
						6=>GridView::F_SUM,
						8=>GridView::F_SUM,
						9=>GridView::F_SUM,
					],
					'contentFormats'=>[      // content html attributes for each summary cell
						6=>['format'=>'number', 'decimals'=>2],
						8=>['format'=>'number', 'decimals'=>2],
						9=>['format'=>'number', 'decimals'=>2],
					],
					'contentOptions'=>[      // content html attributes for each summary cell
						1=>['style'=>'text-align:right;color:#243852'],
						6=>['style'=>'font-variant:small-caps;text-align:right;color:white'],
						8=>['style'=>'font-variant:small-caps;text-align:right;color:white'],
						9=>['style'=>'font-variant:small-caps;text-align:right;color:white'],
					],
					'options'=>['class'=>'danger','style'=>'id:header-sales-trans-x1,font-weight:bold;']
				];
			},
			'noWrap'=>false,	
			'mergeHeader'=>$value[$key]['mergeHeader'],
			'headerOptions'=>[		
					'style'=>[									
					'text-align'=>'center',
					'width'=>$value[$key]['SIZE'],
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'8pt',
					'background-color'=>$bColor,
					'color'=>'white',
				]
			],  
			'contentOptions'=>[
				'style'=>[
					'text-align'=>$value[$key]['align'],
					//'width'=>'12px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'8pt',
					//'background-color'=>'rgba(13, 127, 3, 0.1)',
					'color'=>'#191127',
				]
			],
			'format'=>$value[$key]['format'],
			'pageSummaryFunc'=>GridView::F_SUM,
			'pageSummary'=>$value[$key]['pageSummary'],
			'pageSummaryOptions' => [
				'style'=>[
					'text-align'=>'right',		
					//'width'=>'12px',
					'font-family'=>'tahoma',
					'font-size'=>'8pt',	
					'text-decoration'=>'underline',
					'font-weight'=>'bold',
					'border-left-color'=>'transparant',		
					'border-left'=>'0px',
					'background-color'=>'rgba(76, 22, 11, 0.36)',
					'color'=>'white',
				]
			],	
		];	
	};
	
/* ==================================
 * GridViews Body
 *
 * ===================================
 */			
 $gvTransHeader= GridView::widget([
	'id'=>'header-sales-trans',
	'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	'filterRowOptions'=>['style'=>'background-color:'.$bColor.'; align:center'],
	'columns' =>$attTransHeader,	
	'toolbar' => [
		'{export}',
	],	
	'panel'=>[
		//'heading'=>$pageNm.'  '.tombolCreate().' '.tombolExportFormat($paramUrl).' '.tombolUpload().' '.tombolSync(),					
		//'heading'=>tombolRefresh().' '.tombolClear().' '.tombolCreateTmp().' '.tombolCreatePeriode().' '.tombolExportFormat($paramUrl).' -> '.tombolUpload().' -> '.tombolSync().' '.$perode,					
		'type'=>'info',
		'after'=>false,
		'before'=>false,
		'footer'=>false,
	],
	'pjax'=>true,
	'pjaxSettings'=>[
		'options'=>[
			'enablePushState'=>true,
			'id'=>'header-sales-trans',
		],
	],
	'hover'=>true, //cursor select
	'responsive'=>true,
	'responsiveWrap'=>true,
	'bordered'=>true,
	'striped'=>'4px',
	'autoXlFormat'=>true,
	'export' => false,
	'export'=>[//export like view grid --ptr.nov-
	'fontAwesome'=>true,
	'showConfirmAlert'=>false,
	'target'=>GridView::TARGET_BLANK
	],
	//'floatHeader'=>false,
	// 'floatHeaderOptions'=>['scrollingTop'=>'200'] 
	// 'floatOverflowContainer'=>true,
	//'floatHeader'=>true,
	'showPageSummary' => true,
]);	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row" style="font-family: tahoma ;font-size: 8pt;">		
			<?=$gvTransHeader?>
		</div>
	</div>
</div>