<?php
use yii\helpers\Html;
use kartik\widgets\Select2;
use kartik\grid\GridView;
//use kartik\grid\SideNav;
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
$this->title="Penggajian Rekap";
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
	#gv-penggajian-rekap .kv-grid-container{
			height:500px
	}
	#gv-store .kv-grid-container{
			height:500px
	}
	#gv-penggajian-rekap .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #444;
	}
	#gv-penggajian-rekap .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#gv-store .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: black;
	}
	#gv-store.panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");


$headerColor='rgba(128, 179, 178, 1)';
$this->registerJs($this->render('penggajianrekap_script.js'),View::POS_READY);
echo $this->render('penggajianrekap_button'); //echo difinition
echo $this->render('penggajianrekap_modal'); //echo difinition
echo $this->render('penggajianrekap_column'); //echo difinition

	
	
	$bColor='rgba(87,114,111, 1)';
	$pageNm='<span class="fa-stack fa-xs text-left" style="float:left">
			  <b class="fa fa-money fa-stack-2x" style="color:#000000"></b>
			 </span> <div style="float:left;padding:10px 20px 0px 5px;color: black;"><b> REKAP PENGGAJIAN</b></div> 
	 ';
	
	$attDinamikField=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','5px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','5px',''),
		],
	];
	
	foreach(tombolAryColumn() as $key =>$value[]){			
		$attDinamikField[]=[
			'attribute'=>$value[$key]['ATR_FIELD'],
			'label'=>$value[$key]['ATR_LABEL'],
			'filter'=>$value[$key]['FILTER'],
			'filterType'=>$value[$key]['FILTER_TYPE'],
			'filterWidgetOptions'=>$value[$key]['FILTER_WIDGET_OPTION'],	
			'filterInputOptions'=>$value[$key]['FILTER_INPUT_OPTION'],
			'filterOptions'=>$value[$key]['FILTER_OPTION'],
			'mergeHeader'=>$value[$key]['ATR_HEADER_MERGE'],
			'hAlign'=>$value[$key]['H_VALIGN'],
			'vAlign'=>$value[$key]['V_VALIGN'],
			//'hidden'=>false,
			'noWrap'=>false,	
			'format'=>$value[$key]['ATR_FORMAT'],
			'value'=>function($data)use($value,$key){
				$val=$value[$key]['ATR_FIELD'];	
				/* $splt=explode('_',$val);
				if($splt[0]=='SISA'){					
					//return 'NAMA TOKO :  '.$data->$val;	 	 //USE ActiveData	
					// return 'NAMA TOKO';						 //KONSTANTA
					return 'NAMA TOKO :  '.$data[$val];		 	 //USE ArrayData
				}elseif($val=='STORE_ID'){
					//return 'NAMA TOKO :  '.$data->{'storeNm'};		 //USE ActiveData	
					// return 'NAMA TOKO';						 //KONSTANTA
					return 'NAMA TOKO :  '.$data[$val];		 //USE ArrayData
				}elseif($val=='STATUS'){
					if ($data->STATUS == 0) {
					  return Html::a('
						<span class="fa-stack fa-xl">
						  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
						  <i class="fa fa-close fa-stack-1x" style="color:#ee0b0b"></i>
						</span>','',['title'=>'KELUAR']);
					}else if ($data->STATUS == 1) {
					  return Html::a('<span class="fa-stack fa-xl">
						  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
						  <i class="fa fa-check fa-stack-1x" style="color:#0f39ab"></i>
						</span>','',['title'=>'AKTIF']);
					}
				}elseif($val=='SHIFT_IN' OR $val=='SHIFT_OUT'){
						return date("H:i:s", strtotime($data->{$val}));
						*/	
				if($val=='STORE_ID'){
					return 'NAMA TOKO :  '. $data['STORE_NM'];		 //USE ArrayData						
				}else{		 			
					if($data[$val]){					
						//return $data->{$val};			//USE ActiveData					
						//return $data->NAMA_DPN;		//USE ActiveData					
						//return $data['NAMA_DPN'];		//USE ArrayData
						return  $data[$val];			//USE ArrayData
					}else{
						return '0';
					}						
				}		
			},	 				
			'headerOptions'=>[		
				'style'=>[		
					'width'=>$value[$key]['H_WIDTH'],
					'text-align'=>$value[$key]['H_ALIGN'],				
					'font-size'=>$value[$key]['H_FONT_SIZE'],				
					'color'=>$value[$key]['H_FONT_COLOR'],
					'background-color'=>$value[$key]['H_BG_COLOR'],
					'font-family'=>'tahoma, arial, sans-serif',	
					'font-weight'=>'bold',	
					// 'hAlign'=>$value[$key]['H_VALIGN'],
					// 'vertical-align'=>$value[$key]['V_VALIGN']	
				]
			],
			'contentOptions'=>[
				'style'=>[
					'font-size'=>$value[$key]['C_FONT_SIZE'],
					'text-align'=>$value[$key]['C_ALIGN'],
					'color'=>$value[$key]['C_FONT_COLOR'],
					'background-color'=>$value[$key]['C_BG_COLOR'],
					'font-family'=>'tahoma, arial, sans-serif',						
					'font-weight'=>$value[$key]['C_FONT_BOLD'],
				]
			],				
			'group'=>$value[$key]['ATR_GROUP'],
			'groupedRow'=>$value[$key]['ATR_GROUPROW'],	
			'groupFooter'=>function($model, $key, $index, $widget){ 
				return [
					'mergeColumns'=>[[2,12]], 
					'content'=>[             // content to show in each summary cell
						2=>'TOTAL KESELURUHAN',
						13=>GridView::F_SUM,14=>GridView::F_SUM,15=>GridView::F_SUM										
					],
					'contentFormats'=>[      // content html attributes for each summary cell
						13=>['format'=>'number', 'decimals'=>2],
						14=>['format'=>'number', 'decimals'=>2],
						15=>['format'=>'number', 'decimals'=>2],
					],
					'contentOptions'=>[      // content html attributes for each summary cell
						2=>['style'=>'text-align:right;font-size:11px;font-weight:bold;color:#243852'],
						// 6=>['style'=>'font-variant:small-caps;text-align:right;color:white','font-size'=>'8pt'],
						// 8=>['style'=>'font-variant:small-caps;text-align:right;color:white','font-size'=>'8pt'],
						// 9=>['style'=>'font-variant:small-caps;text-align:right;color:white','font-size'=>'8pt'],
					],
					'options'=>['class'=>'danger','style'=>'font-weight:bold;font-size:10px;text-align:right;']
				];
			},
		];
	};
	
	$attDinamikFields[]=[			
		//ACTION
		'class' => 'kartik\grid\ActionColumn',
		'template' => '{view}{edit}{reminder}{deny}',
		'header'=>'ACTION',
		'dropdown' => true,
		'dropdownOptions'=>[
			'class'=>'pull-right dropdown',
			'style'=>'width:100%;background-color:#E6E6FA'				
		],
		'dropdownButton'=>[
			'label'=>'ACTION',
			'class'=>'btn btn-info btn-xs',
			'style'=>'width:100%'		
		],
		'buttons' => [
			'view' =>function ($url, $model){
				return  tombolView($url, $model);
			},
			'edit' =>function($url, $model,$key){
				//if($model->STATUS!=1){ //Jika sudah close tidak bisa di edit.
				return  tombolEdit($url, $model);
				//}					
			},
			'deny' =>function($url, $model,$key){
				//return  tombolDeny($url, $model);
			}
		],
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$bColor,'#ffffff'),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','10px',''),
	]; 

$gvPenggajianRekap=GridView::widget([
	'id'=>'gv-penggajian-rekap',
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'beforeHeader'=>[
		[
			'columns'=>[
				['content'=>'DATA KARYAWAN', 'options'=>[
						'colspan'=>2,
						'style'=>[
							'width'=>'10px',
							'text-align'=>'center',
							'font-family'=>'tahoma',
							'font-size'=>'8pt',
							'background-color'=>'#FFB400',
						]
					]
				],
				['content'=>'TOTAL JAM POTONGAN', 'options'=>[
						'colspan'=>2,
						'style'=>[
							'width'=>'10px',
							'text-align'=>'center',
							'font-family'=>'tahoma',
							'font-size'=>'8pt',
							'background-color'=>'#FFB400',
						]
					]
				],
				 ['content'=>'TOTAL PERSEN POTONGAN', 'options'=>[
						'colspan'=>2,
						'style'=>[
							'width'=>'10px',
							'text-align'=>'center',
							'font-family'=>'tahoma',
							'font-size'=>'8pt',
							'background-color'=>'#FFB400',
						]
					]
				],
				['content'=>'TOTAL NILAI POTONGAN', 'options'=>[
						'colspan'=>2,
						'style'=>[
							'width'=>'10px',
							'text-align'=>'center',
							'font-family'=>'tahoma',
							'font-size'=>'8pt',
							'background-color'=>'#FFB400',
						]
					]
				],
				['content'=>'TOTAL LEMBURAN', 'options'=>[
						'colspan'=>3,
						'style'=>[
							'width'=>'10px',
							'text-align'=>'center',
							'font-family'=>'tahoma',
							'font-size'=>'8pt',
							'background-color'=>'#FFB400',
						]
					]
				],
				['content'=>'TOTAL PENGGAJIAN', 'options'=>[
						'colspan'=>5,
						'style'=>[
							'width'=>'10px',
							'text-align'=>'center',
							'font-family'=>'tahoma',
							'font-size'=>'8pt',
							'background-color'=>'#FFB400',
						]
					]
				]
			],
		]
	],  
	'columns'=>$attDinamikField,				
	'pjax'=>true,
	'pjaxSettings'=>[
		'options'=>[
			'enablePushState'=>false,
			'id'=>'gv-penggajian-rekap',
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
		//'heading'=>false,
		//'heading'=>tombolBack().'<div style="float:right"> '.tombolCreate().' '.tombolExportExcel().'</div>',  
		'heading'=>$pageNm.'<div style="float:right;padding:0px 10px 0px 5px;color: black;"> '.tombolSearchPeriode($store).' '.tombolExportExcel($store).' '.periodePersensi($date). '   '.'</div>',  
		// 'heading'=>$pageNm.'<div style="float:right;padding:0px 10px 0px 5px">'.tombolCreate().' '.tombolExportExcel().' '.periodePersensi(). '   '.'</div>',  
		'type'=>'info',
		//'before'=> tombolBack().'<div style="float:right"> '.tombolCreate().' '.tombolExportExcel().'</div>',
		'before'=>false,
		'showFooter'=>false,
		
	],
	'summary'=>false,
	'floatOverflowContainer'=>false,
	'floatHeader'=>false,
]); 	

function sttMsg($stt){
	if($stt==0){ //TRIAL
		 return Html::a('<span class="fa-stack fa-xl">
				  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
				  <i class="fa fa-check fa-stack-1x" style="color:#ee0b0b"></i>
				</span>','',['title'=>'Trial']);
	}elseif($stt==1){
		 return Html::a('<span class="fa-stack fa-xl">
				  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
				  <i class="fa fa-check fa-stack-1x" style="color:#05944d"></i>
				</span>','',['title'=>'Active']);
	}elseif($stt==2){
		return Html::a('<span class="fa-stack fa-xl">
				  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
				  <i class="fa fa-remove fa-stack-1x" style="color:#01190d"></i>
				</span>','',['title'=>'Deactive']);
	}elseif($stt==3){
		return Html::a('<span class="fa-stack fa-xl">
				  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
				  <i class="fa fa-close fa-stack-1x" style="color:#ee0b0b"></i>
				</span>','',['title'=>'Delete']);
	}
};	
$gvAttributeItem=[
	[
		'attribute'=>'STORE_NM',
		'label'=>'NAMA TOKO',
		'filterType'=>true,
		'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
		'hAlign'=>'right',
		'vAlign'=>'middle',
		'mergeHeader'=>false,
		'format'=>'html',
		'noWrap'=>false,
		'format'=>'raw',
		'value'=>function($data) {				
			return Html::tag('div', $data->STORE_NM, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
		},
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$headerColor),
		'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),
		
	],		
		
];
$gvAttributeItem[]=[
	'attribute'=>'STATUS',
	'hAlign'=>'right',
	'vAlign'=>'middle',
	'mergeHeader'=>false,
	'noWrap'=>false,
	'format' => 'raw',	
	'value'=>function($model){
		return sttMsg($model->STATUS);				 
	},
	'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50',$headerColor),
	'contentOptions'=>Yii::$app->gv->gvContainBody('center','50','')			
	];
	$gvStore=GridView::widget([
		'id'=>'gv-store',
		'dataProvider' => $dataProviderstore,
		// 'filterModel' => $searchModelstore,
		'columns'=>$gvAttributeItem,		 
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-store',
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
		'toolbar' => [
			''
		],
		'rowOptions'   => function ($model, $key, $index, $grid) {			
			$btnclick= ['onclick' => '
				$.pjax.reload({
                    url: "'.Url::to(["/hris/penggajian-rekap/"]).'?storeid='.$model->STORE_ID.'",
					container: "#gv-penggajian-rekap",
					//timeout: 1000,
				});
			'];
			return $btnclick;
		},
		'panel' => [
			//'heading'=>false,
			'heading'=>'
				<span class="fa-stack fa-sm">
				  <i class="fa fa-circle-thin fa-stack-2x" style="color:#25ca4f"></i>
				  <i class="fa fa-text-width fa-stack-1x"></i>
				</span> LIST TOKO'.'  <div style="float:right"><div style="font-family: tahoma ;font-size: 8pt;"> </div></div> ',  
			'type'=>'info',
			'before'=>false,
			'after'=>false,
			// 'before'=>$dscLabel.'<div class="pull-right">'. tombolRefresh().' '.tombolExportExcel().' '.tombolReqStore().' '.tombolRestore().'</div>',
			// 'before'=> tombolReqStore(),
			'showFooter'=>'aas',
		], 
		'summary'=>false
		// 'floatOverflowContainer'=>true,
		//'floatHeader'=>true,
	]); 
?>

<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
<?=tombolKembali()?>
		<div class="row">
			<div class="col-md-3">
				<?=$gvStore?>
			</div>
			<div class="col-md-9">
				<?=$gvPenggajianRekap?>
			</div>
			<?php //echo SideNav::widget(['items' => $items, 'headingOptions' => ['class'=>'head-style']]); ?>
		</div>
</div>

