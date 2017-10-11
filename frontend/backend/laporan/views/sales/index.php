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

$this->registerCss("
		#book-openclose .kv-grid-table :link {
			color: #fdfdfd;
		}
		#import-absen-log .kv-grid-table :link {
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
		
		// * @property string $PPN
 // * @property string $
 // * @property string $MERCHANT_ID
 // * @property string $TYPE_PAY_ID
 // * @property string $TYPE_PAY_NM
 // * @property string $BANK_ID
 // * @property string $BANK_NM
 // * @property string $MERCHANT_NM
 // * @property string $MERCHANT_NO
 // * @property string $CONSUMER_ID
 // * @property string $CONSUMER_NM
 // * @property string $CONSUMER_EMAIL
 // * @property string $CONSUMER_PHONE
	$aryFieldDTrans= [		  
		['ID' =>0, 'ATTR' =>['FIELD'=>'storeNm','SIZE' => '150px','label'=>'Toko','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>true]],		  
		['ID' =>1, 'ATTR' =>['FIELD'=>'tgl','SIZE' => '6px','label'=>'TRANS DATE','align'=>'center','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>2,'pageSummary'=>false,'group'=>false]],
		['ID' =>2, 'ATTR' =>['FIELD'=>'waktu','SIZE' => '6px','label'=>'WAKTU','align'=>'center','vAlign'=>'top','mergeHeader'=>true,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		['ID' =>3, 'ATTR' =>['FIELD'=>'username','SIZE' => '6px','label'=>'USER','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		['ID' =>4, 'ATTR' =>['FIELD'=>'TOTAL_PRODUCT','SIZE' => '6px','label'=>'QTY','align'=>'right','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>['decimal', 2],'filterColspn'=>0,'pageSummary'=>true,'group'=>false]],	
		['ID' =>5, 'ATTR' =>['FIELD'=>'PPN','SIZE' => '6px','label'=>'PPN','align'=>'right','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>['decimal', 2],'filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		['ID' =>6, 'ATTR' =>['FIELD'=>'SUB_TOTAL_HARGA','SIZE' => '6px','label'=>'SUB TOTAL HARGA','align'=>'right','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>['decimal', 2],'filterColspn'=>0,'pageSummary'=>true,'group'=>false]],	
		['ID' =>7, 'ATTR' =>['FIELD'=>'TOTAL_HARGA','SIZE' => '6px','label'=>'TOTAL HARGA','align'=>'right','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>['decimal', 2],'filterColspn'=>0,'pageSummary'=>true,'group'=>false]],	
		['ID' =>8, 'ATTR' =>['FIELD'=>'TYPE_PAY_NM','SIZE' => '6px','label'=>'TIPE BAYAR','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		['ID' =>9, 'ATTR' =>['FIELD'=>'BANK_NM','SIZE' => '6px','label'=>'NAMA BANK','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		['ID' =>10, 'ATTR' =>['FIELD'=>'CONSUMER_NM','SIZE' => '6px','label'=>'CONSUMER','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		//['ID' =>11, 'ATTR' =>['FIELD'=>'OPENCLOSE_ID','SIZE' => '6px','label'=>'BOOK.ID','align'=>'left','vAlign'=>'middle','mergeHeader'=>false,'FILTER'=>true,'format'=>'raw','filterColspn'=>0,'pageSummary'=>false,'group'=>false]],	
		
	];	
	$valFieldsDTrans = ArrayHelper::map($aryFieldDTrans, 'ID', 'ATTR'); 
	$bColor='rgba(87,114,111, 1)';
	$attTransDetail[] =[			
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
	/*OTHER ATTRIBUTE*/
	foreach($valFieldsDTrans as $key =>$value[]){	
		//==== CUSTIMUZE ====
		if ($value[$key]['FIELD']=='storeNm' OR $value[$key]['FIELD']=='TYPE_PAY_NM'){				
			$gvfilterType=GridView::FILTER_SELECT2;
			$filterWidgetOpt=[				
				'pluginOptions'=>['allowClear'=>true],		
			]; 
			if($value[$key]['FIELD']=='HARI'){
				$filterInputOpt=['placeholder'=>'-Pilih-'];
			}else{
				$filterInputOpt=['placeholder'=>'-- Pilih --'];
			};			
			$filterOptions=[				
				'style'=>'background-color:rgba(255, 255, 255, 1); align:center',
				'colspan'=>$value[$key]['filterColspn']
			];
		}elseif($value[$key]['FIELD']=='tgl'){
			//DATE FORMAT FILTER
			$gvfilterType=GridView::FILTER_DATE;
			$filterWidgetOpt=[	
				'pluginOptions' => [				
						'format' => 'yyyy-mm-dd',					 
						'autoclose' => true,
						'todayHighlight' => true,
						//'format' => 'dd-mm-yyyy hh:mm',
						'autoWidget' => false,
						//'todayBtn' => true,
				]
			];
			$filterOptions=[				
				'style'=>'background-color:rgba(255, 255, 255, 1); align:center',
				'colspan'=>$value[$key]['filterColspn']
			];			
		}elseif($value[$key]['FIELD']=='storeNm'){
			$groupFooter="function($model, $key, $index, $widget){ 
				return [
					'mergeColumns'=>[[1,11]], 
					'content'=>[             // content to show in each summary cell
						1=>'Group ' . $model->storeNm,
						//6=>'100',
						// 5=>GridView::F_SUM,
						// 6=>GridView::F_SUM,
					],
					'contentOptions'=>[      // content html attributes for each summary cell
						1>['style'=>'font-variant:small-caps'],
						1=>['style'=>'text-align:left'],
						//5=>['style'=>'text-align:right'],
						//6=>['style'=>'text-align:right'],
					],
					'options'=>['class'=>'info','style'=>'font-weight:bold;']
				];
			}"; 
		}else{
			$gvfilterType=false;
			//$gvfilter=true;
			$filterWidgetOpt=[];		
			$filterInputOpt=['class'=>"form-control"];	
			$filterOptions=[				
				'style'=>'background-color:rgba(255, 255, 255, 1); align:center',
				'colspan'=>$value[$key]['filterColspn']
			];
			$groupFooter='false';			
		}; 
		
		$attTransDetail[]=[		
			'attribute'=>$value[$key]['FIELD'],
			'label'=>$value[$key]['label'],
			'group'=>$value[$key]['group'],
			'filter'=>$value[$key]['FILTER'],
			'filterType'=>$gvfilterType,
			'filterWidgetOptions'=>$filterWidgetOpt,	
			'filterInputOptions'=>$filterInputOpt,	
			'filterOptions'=>$filterOptions,			
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
					'mergeColumns'=>[[1,2]], 
					'content'=>[             // content to show in each summary cell
						1=>'Group ' . $model->storeNm,
						5=>GridView::F_SUM,
						7=>GridView::F_SUM,
						8=>GridView::F_SUM,
					],
					'contentFormats'=>[      // content html attributes for each summary cell
						5=>['format'=>'number', 'decimals'=>2],
						7=>['format'=>'number', 'decimals'=>2],
						8=>['format'=>'number', 'decimals'=>2],
					],
					'contentOptions'=>[      // content html attributes for each summary cell
						1=>['style'=>'text-align:right;color:#243852'],
						5=>['style'=>'font-variant:small-caps;text-align:right;color:white'],
						7=>['style'=>'font-variant:small-caps;text-align:right;color:white'],
						8=>['style'=>'font-variant:small-caps;text-align:right;color:white'],
					],
					'options'=>['class'=>'danger','style'=>'font-weight:bold;']
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
				]
			],  
			'contentOptions'=>[
				'style'=>[
					'text-align'=>$value[$key]['align'],
					//'width'=>'12px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'8pt',
					//'background-color'=>'rgba(13, 127, 3, 0.1)',
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
 $gvTransDetail= GridView::widget([
	'id'=>'detail-sales-trans',
	'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	'filterRowOptions'=>['style'=>'background-color:'.$bColor.'; align:center'],
	'columns' =>$attTransDetail,	
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
			'id'=>'detail-sales-trans',
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
	'floatHeader'=>true,
	'showPageSummary' => true,
]);	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row" style="font-family: tahoma ;font-size: 8pt;">		
			<?=$gvTransDetail?>
		</div>
	</div>
</div>