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
use frontend\backend\laporan\models\TransOpenclose;
use frontend\backend\laporan\models\TransStoran;

$this->registerCss("
		#book-openclose .kv-grid-table :link {
			color: #fdfdfd;
		}
		#openclose .kv-grid-table :link {
			color: #fdfdfd;
		}
		
		#openclose .kv-grid-table .actual-delete :link {
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
			height:570px
		}
		.tmp-button-delete a:hover {
			color:red;
		}
	");
$this->title = 'Trans Opencloses';
$this->params['breadcrumbs'][] = $this->title;
	$aryStt= [
		['STATUS' => 0, 'STT_NM' => 'OPEN'],		  
		['STATUS' => 1, 'STT_NM' => 'CLOSE'],
		['STATUS' => 2, 'STT_NM' => 'ACTIVE']
	];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	
	$aryFieldTmp= [		  
		['ID' =>0, 'ATTR' =>['FIELD'=>'storeNm','SIZE' => '180px','label'=>'Toko','align'=>'left','mergeHeader'=>false,'FILTER'=>true,'filterColspn'=>0]],		  
		['ID' =>1, 'ATTR' =>['FIELD'=>'TGL_OPEN','SIZE' => '6px','label'=>'Waktu Buka','align'=>'center','mergeHeader'=>false,'FILTER'=>true,'filterColspn'=>2]],	
		['ID' =>2, 'ATTR' =>['FIELD'=>'TGL_CLOSE','SIZE' => '6px','label'=>'Waktu Tutup','align'=>'center','mergeHeader'=>true,'FILTER'=>false,'filterColspn'=>0]],
		//['ID' =>3, 'ATTR' =>['FIELD'=>'STATUS','SIZE' => '6px','label'=>'Status','align'=>'center','mergeHeader'=>true,'FILTER'=>true]]			
		// ['ID' =>3, 'ATTR' =>['FIELD'=>'CASHINDRAWER','SIZE' => '6px','label'=>'Kas Laci','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		// ['ID' =>4, 'ATTR' =>['FIELD'=>'ADDCASH','SIZE' => '6px','label'=>'Kas Tambahan','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		// ['ID' =>5, 'ATTR' =>['FIELD'=>'SELLCASH','SIZE' => '6px','label'=>'Penjualan','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],
		// ['ID' =>6, 'ATTR' =>['FIELD'=>'TOTALCASH','SIZE' => '6px','label'=>'Total','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		// ['ID' =>7, 'ATTR' =>['FIELD'=>'TOTALCASH_ACTUAL','SIZE' => '6px','label'=>'Tgl.Masuk','align'=>'center','mergeHeader'=>true,'FILTER'=>true]],	
		
	];	
	$valFieldsTmp = ArrayHelper::map($aryFieldTmp, 'ID', 'ATTR'); 
	$bColor='rgba(87,114,111, 1)';
	$attLapOpenClosing[] =[			
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
	foreach($valFieldsTmp as $key =>$value[]){	
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
		}elseif($value[$key]['FIELD']=='TGL_OPEN'){
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
		}else{
			$gvfilterType=false;
			//$gvfilter=true;
			$filterWidgetOpt=[];		
			$filterInputOpt=['class'=>"form-control"];	
			$filterOptions=[				
				'style'=>'background-color:rgba(255, 255, 255, 1); align:center'
			];	
		}; 
		
		$attLapOpenClosing[]=[		
			'attribute'=>$value[$key]['FIELD'],
			'label'=>$value[$key]['label'],
			'filter'=>$value[$key]['FILTER'],
			'filterType'=>$gvfilterType,
			'filterWidgetOptions'=>$filterWidgetOpt,	
			'filterInputOptions'=>$filterInputOpt,
			'filterOptions'=>$filterOptions,
			'hAlign'=>'right',
			'vAlign'=>'top',
			//'mergeHeader'=>true,
			'noWrap'=>false,	
			'value'=>function($data)use($key,$value){
				$x=$value[$key]['FIELD'];
				if($x=='TGL_CLOSE'){
					if($data->TGL_CLOSE==''){
						return 'Belum Close';
					}else{
						return $data->$x;
					}
				}else{
					return $data->$x;
				}
				
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
	$attLapOpenClosing[]=[
		'attribute'=>'STATUS',
		'filterType'=>GridView::FILTER_SELECT2,
		'filterWidgetOptions'=>[
			'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
		],
		'filterInputOptions'=>['placeholder'=>'Select'],
		'filter'=>$valStt,//Yii::$app->gv->gvStatusArray(),
		'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px',$bColor),
		'hAlign'=>'right',
		'vAlign'=>'middle',
		'mergeHeader'=>false,
		'noWrap'=>false,
		'format' => 'raw',	
		'value'=>function($model){
			if($model->STATUS==0){
				return 'OPEN';
			}elseif($model->STATUS==1){
				return 'CLOSE';
			}elseif($model->STATUS==2){
				return 'ACTIVE';
			}				 
		},
		//gvContainHeader($align,$width,$bColor)
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50',$bColor),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','50','')			
	];
/* ==================================
 * GridViews Body
 *
 * ===================================
 */			
 $bookCloseOpen= GridView::widget([
	'id'=>'book-openclose',
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' =>$attLapOpenClosing,	
	'filterRowOptions'=>['style'=>'background-color:'.$bColor.'; align:center'],
	'rowOptions'=> function ($model, $key, $index, $grid) {
		return ['id' => $model->ID,'onclick' => '$.pjax.reload({
				url: "'.Url::to(['/laporan/mutasi/index']).'?id="+this.id,
				//container: "#book-openclose",
				container: "#dv-mutasi-data",
				//timeout: 1000,
			}).done(function() {
				$.pjax.reload({container:"#dv-storean-data"})
			});
		'];
	},	
	'toolbar' => [
		'{export}',
	],	
	'panel'=>[
		//'heading'=>$pageNm.'  '.tombolCreate().' '.tombolExportFormat($paramUrl).' '.tombolUpload().' '.tombolSync(),					
		//'heading'=>tombolRefresh().' '.tombolClear().' '.tombolCreateTmp().' '.tombolCreatePeriode().' '.tombolExportFormat($paramUrl).' -> '.tombolUpload().' -> '.tombolSync().' '.$perode,					
		'heading'=>'Laporan Mutasi dan Setoran',
		'type'=>'info',
		'after'=>false,
		'before'=>false,
		'footer'=>false,
	],
	'pjax'=>true,
	'pjaxSettings'=>[
		'options'=>[
			'enablePushState'=>true,
			'id'=>'book-openclose',
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
	//'floatHeader'=>false,
]);	
	$model= TransOpenclose::find()->where(['ID'=>$paramCari])->one();
	if($model){
		$modelStoran= TransStoran::find()->where(['OPENCLOSE_ID'=>$model->OPENCLOSE_ID])->one();
	}else{
		$model=$dataProvider->getModels()[0];
		
	};
	
	$detailMutasi= Yii::$app->controller->renderPartial('_detailMutasi',[
			'modelToko'=>$model
		]);
		$modelStoran= TransStoran::find()->where(['OPENCLOSE_ID'=>$model->OPENCLOSE_ID])->one();
		$detailStoran= Yii::$app->controller->renderPartial('_detailStoran',[
			'modelStoran'=>$modelStoran
		]);
	//print_r($model);

?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-8 col-sm-8 col-lg-8" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">		
		<?=$bookCloseOpen?>
		</div>
	</div>	
	<div class="col-xs-4 col-sm-4 col-lg-4" style="font-family: tahoma ;font-size: 9pt;">			
		<?=$detailMutasi?>
		<?=$detailStoran?>
	</div>
</div>

<?php
	$this->registerCss("
		/**
		 * CSS - Border radius Sudut.
		 * piter novian [ptr.nov@gmail.com].
		 * 'clientOptions' => [
		 *		'backdrop' => FALSE, //Static=disable, false=enable
		 *		'keyboard' => TRUE,	// Kyboard 
		 *	]
		*/
		.modal-content { 
			border-radius: 5px;
		}
		
	");
	
	$this->registerJs("
		$.fn.modal.Constructor.prototype.enforceFocus = function(){};
		$(document).on('click','#modal-view-button', function(ehead){ 			  
			$('#modal-view').modal('show')
			.find('#modalContent').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
			//.load(ehead.target.value);
			.load($(this).attr('value'));
		});
	",View::POS_READY); 

	Modal::begin([
		'id' => 'modal-view',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:black"></i>
				<i class="fa fa-image fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> BUKTI SETORAN </b>
		',	
		'size' => Modal::SIZE_LARGE,
		//'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:rgba(129, 192, 223, 0.55)',
			//'toggleButton' => ['label' => 'click me'],
		],
		//'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
	echo "<div id='modalContent'></div>";
	Modal::end();	
?>