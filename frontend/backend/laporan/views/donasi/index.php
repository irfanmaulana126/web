
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
use yii\web\View;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;

$incTmp=0;
$splt=0;

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
	#gv-all-data-store-item .kv-grid-container{
		height:400px
	}
	#gv-all-data-store-item .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #000;
	}
	#gv-all-data-store-item .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");	

$this->registerJs("
	//var x = document.getElementById('tahun').value;
	//console.log(x);
	$('#tahun').change(function() { 
		var x = document.getElementById('tahun').value;
		$.pjax.reload({
			url:'/laporan/donasi/index?tgl='+x, 
			container: '#gv-all-data-store-item',
			//timeout: 1000,
		})
		
		//console.log('Changed!'+x+y); 
	});	

",View::POS_READY);
$this->title='LAPORAN DONASI';
	$this->registerJs($this->render('donasi_script.js'),View::POS_READY);
	echo $this->render('/donasi/donasi_modal');
    echo $this->render('/donasi/donasi_button');
	$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
    $bColor='rgb(76, 131, 255)';
	$pageNm='<b>LAPORAN DONASI</b>
	';
	
	$colorHeader='rgba(230, 230, 230, 1)';
	$colorHeader1='rgba(140, 140, 140, 1)';
	$colorHeader2='rgba(230, 230, 230, 1)';
	$dinamikField=$dataProvider->getModels();
	//$tanggal=$dinamikField[0]['TAHUN'].'-'.$dinamikField[0]['BULAN'].'-01';
	
	
$paramCari=Yii::$app->getRequest()->getQueryParam('tgl');
$tanggal = (empty($paramCari)) ? date('Y-n') : $paramCari ;
$btn_srchChart1=DatePicker::widget([
    'name' => 'check_issue_date', 
	'options' => ['placeholder' => 'Pilih Tahun ...','id'=>'tahun'],
	'value'=>$tanggal,
    'convertFormat' => true,
    'pluginOptions' => [
        'autoclose'=>true,
        'startView'=>'years',
        'minViewMode'=>'months',
        'format' => 'yyyy-n',
        // 'todayHighlight' => true,
         'todayHighlight' => true
    ]
]);
	$attDinamikField[] =[			
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'10px',
					'font-family'=>'verdana, arial, sans-serif',
					'font-size'=>'9px',
					//'background-color'=>$bColor,
				]
			],
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'10px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9px',
				]
			],					
	];
	
	$aryFieldColomn[]=['ID' =>0, 'ATTR' =>['FIELD'=>'STORE_ID','WIDTH'=>'100px','SIZE' => '10px','label'=>'TOKO','align'=>'left','group'=>true,'pageSummary'=>false]];
	// $aryFieldColomn[]=['ID' =>1, 'ATTR' =>['FIELD'=>'STORE_NM','SIZE' => '12px','label'=>'TOKO','align'=>'left','group'=>false,'pageSummary'=>false]];
	$headerContent1[]=['content'=>'DATA TOKO','options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white']];
	$inc=1;
	/* ==================
	 * QTY STOCK COLUMN
	 * ================== */
	 if($dinamikField){
        foreach($dinamikField[0] as $rows => $val){
			//unset($splt);
			//$ambilField[]=$rows; 		
			$splt=explode('_',$rows);	
			if($splt[0]=='IN'){
				$nmField1[]=$rows;		//FULL FIELD NAME
				$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
				$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'WIDTH'=>'50px','SIZE'=>'7px','label'=>'JUMLAH DONASI','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>$colorHeader]];
				$inc=$inc+1;
				$headerContent1[]=['content'=>$splt[1],'options'=>['class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white']];			
			}	
		};
	 }else{
		 for ($i=1;$i<=31;$i++){
			$aryFieldColomn[]=['ID' =>$incTmp, 'ATTR' =>['FIELD'=>$i,'SIZE' => '7px','label'=>$i,'align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>$colorHeader]];
			$incTmp=$incTmp+1;
		 }
		$headerContent1[]=['content'=>$splt[1],'options'=>['class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white']];			
	};
	 
	
	$valFields = ArrayHelper::map($aryFieldColomn, 'ID', 'ATTR');
	foreach($valFields as $key =>$value[]){	
		if ($value[$key]['FIELD']=='STORE_NM'){
			$attDinamikField[]=[
				'attribute'=>$value[$key]['FIELD'],
				'label'=>$value[$key]['label'],
				// 'filterType'=>$gvfilterType,
				// 'filter'=>$gvfilter,
				// 'filterWidgetOptions'=>$filterWidgetOpt,	
				//'filterInputOptions'=>$filterInputOpt,
				// 'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],	
				// 'filterInputOptions'=>['placeholder'=>'-Pilih-'],
				// 'filter'=>ArrayHelper::map(Product::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['PRODUCT_ID'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->all(),'PRODUCT_NM','PRODUCT_NM'),
				// 'filterType'=>GridView::FILTER_SELECT2,
				// 'filterOptions'=>[],				
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'hidden'=>false,
				'noWrap'=>true,	
				'format'=>'raw',	
				'value'=>function($data)use($key,$value){
					$x=$value[$key]['FIELD'];	
					$splt=explode('_',$x);
					//if($splt[0]=='SISA'){					
					if($x=='STORE_ID'){
						return $data['STORE_NM'];
					}else{						
						if($data[$x]){
							return $data[$x];
						}else{
							return 0;
						}						
					}		
				},							
				'headerOptions'=>[		
					'style'=>[									
						'text-align'=>'center',
						'width'=>$value[$key]['WIDTH'],
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8px',
						//'background-color'=>$value[$key]['BCOLOR'],
						//'color'=>'#5a96e7'
					]
				],
				'contentOptions'=>[
					'style'=>[
						'text-align'=>$value[$key]['align'],
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>$value[$key]['SIZE'],
						'font-weight'=>'bold',
					]
				],	
				
			];
		}else{
			$attDinamikField[]=[		
				'attribute'=>$value[$key]['FIELD'],
				'label'=>$value[$key]['label'],
				// 'filterType'=>$gvfilterType,
				// 'filter'=>$gvfilter,
				// 'filterWidgetOptions'=>$filterWidgetOpt,	
				//'filterInputOptions'=>$filterInputOpt,				
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'noWrap'=>true,	
				'value'=>function($data)use($key,$value){
					$x=$value[$key]['FIELD'];	
					$splt=explode('_',$x);
					//if($splt[0]=='SISA'){					
					if($x=='STORE_ID'){
						return $data['STORE_NM'];
					}else{						
						if($data[$x]){
							return $data[$x];
						}else{
							return 0;
						}						
					}		
				},					
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'20px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8px',
						//'background-color'=>$value[$key]['BCOLOR'],
					]
				],  
				//'format'=>['decimal', 2],
				'format' => 'raw',
				'contentOptions'=>[
					'style'=>[
						'text-align'=>$value[$key]['align'],
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>$value[$key]['SIZE'],
						'font-weight'=>'bold',
						]
				],										
			];	
		}
	};
	$gvAllStoreItem=GridView::widget([
		'id'=>'gv-all-data-store-item',
		'dataProvider' => $dataProvider,
        'beforeHeader'=>[
			'0'=>[					
				'columns'=>$headerContent1,
			]
		],
		'columns' =>$attDinamikField,				
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-all-data-store-item',
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
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-4 col-sm-4 col-lg-4 pull-right" style="margin-right:-15px">
				<?=$btn_srchChart1?>
			</div>	
	<?=tombolKembali()?>
	<div style="height:20px;text-align:center;font-family: tahoma ;font-size: 10pt;;padding-top:10px">	
                    <?php		                    		
						echo '<b>LAPORAN DONASI<br>'.date("F Y",strtotime($tanggal)).'</b>';				
					?>		
			</div>
		<div class="pull-right">
				<?=tombolExportExcel()?>	
		</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;padding-top:10px">
		<div class="row">	
			<?=$gvAllStoreItem?>
		</div>
	</div>
</div>

