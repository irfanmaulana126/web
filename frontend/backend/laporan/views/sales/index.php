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
			height:600px
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
		['ID' =>0, 'ATTR' =>['FIELD'=>'storeNm','SIZE' => '180px','label'=>'Toko','align'=>'left','mergeHeader'=>false,'FILTER'=>true]],		  
		['ID' =>1, 'ATTR' =>['FIELD'=>'tgl','SIZE' => '6px','label'=>'TRANS DATE','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],
		['ID' =>2, 'ATTR' =>['FIELD'=>'waktu','SIZE' => '6px','label'=>'WAKTU','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		['ID' =>3, 'ATTR' =>['FIELD'=>'username','SIZE' => '6px','label'=>'USER','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		['ID' =>4, 'ATTR' =>['FIELD'=>'TOTAL_PRODUCT','SIZE' => '6px','label'=>'QTY','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		['ID' =>5, 'ATTR' =>['FIELD'=>'PPN','SIZE' => '6px','label'=>'PPN','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		['ID' =>6, 'ATTR' =>['FIELD'=>'SUB_TOTAL_HARGA','SIZE' => '6px','label'=>'SUB TOTAL.HARGA','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		['ID' =>7, 'ATTR' =>['FIELD'=>'TOTAL_HARGA','SIZE' => '6px','label'=>'TOTAL HARGA','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		['ID' =>8, 'ATTR' =>['FIELD'=>'TYPE_PAY_NM','SIZE' => '6px','label'=>'TIPE BAYAR','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		['ID' =>9, 'ATTR' =>['FIELD'=>'BANK_NM','SIZE' => '6px','label'=>'NAMA BANK','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		['ID' =>10, 'ATTR' =>['FIELD'=>'CONSUMER_NM','SIZE' => '6px','label'=>'CONSUMER','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		//['ID' =>11, 'ATTR' =>['FIELD'=>'OPENCLOSE_ID','SIZE' => '6px','label'=>'BOOK.ID','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		
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
		if ($value[$key]['FIELD']=='DEP_NM' OR $value[$key]['FIELD']=='HARI'){				
			$gvfilterType=GridView::FILTER_SELECT2;
			//$gvfilterType=false;
			//$gvfilter =$aryDeptId;
			$filterWidgetOpt=[				
				'pluginOptions'=>['allowClear'=>true],		
			]; 
			if($value[$key]['FIELD']=='HARI'){
				$filterInputOpt=['placeholder'=>'-Pilih-'];
			}else{
				$filterInputOpt=['placeholder'=>'-- Pilih --'];
			}			
		}else{
			$gvfilterType=false;
			//$gvfilter=true;
			$filterWidgetOpt=[];		
			$filterInputOpt=['class'=>"form-control"];					
		}; 
		
		$attTransDetail[]=[		
			'attribute'=>$value[$key]['FIELD'],
			'label'=>$value[$key]['label'],
			'filter'=>$value[$key]['FILTER'],
			'filterType'=>$gvfilterType,
			'filterWidgetOptions'=>$filterWidgetOpt,	
			'filterInputOptions'=>$filterInputOpt,								
			'hAlign'=>'right',
			'vAlign'=>'middle',
			//'mergeHeader'=>true,
			'noWrap'=>true,	
			'value'=>function($data)use($key,$value){
				$x=$value[$key]['FIELD'];
				return $data->$x;
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
			//'pageSummaryFunc'=>GridView::F_SUM,
			//'pageSummary'=>true,
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
]);	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row" style="font-family: tahoma ;font-size: 8pt;">		
			<?=$gvTransDetail?>
		</div>
	</div>
</div>