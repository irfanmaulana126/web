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

// print_r($dataProvider->getModels()[0]['SISA_2017-11-03']);
// die();

	$colorHeader='rgba(230, 230, 230, 1)';
	$colorHeader1='rgba(140, 140, 140, 1)';
	$colorHeader2='rgba(230, 230, 230, 1)';
	$dinamikField=$dataProvider->getModels();
	
	
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
					'background-color'=>$bColor,
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
	
	$aryFieldColomn[]=['ID' =>0, 'ATTR' =>['FIELD'=>'STORE_NM','SIZE' => '12px','label'=>'TOKO','align'=>'left']];
	$aryFieldColomn[]=['ID' =>1, 'ATTR' =>['FIELD'=>'PRODUCT_NM','SIZE' => '12px','label'=>'PRODUK','align'=>'left']];
	$headerContent1[]=['content'=>'DATA PRODUK','options'=>['colspan'=>3,'class'=>'text-center','style'=>'background-color:'.$colorHeader1.';font-family: tahoma ;font-size: 6pt;']];
	$aryFieldColomn[]=['ID' =>2, 'ATTR' =>['FIELD'=>'TTL_IN','SIZE' => '12px','label'=>'MASUK','align'=>'left']];
	$aryFieldColomn[]=['ID' =>3, 'ATTR' =>['FIELD'=>'TTL_OUT','SIZE' => '12px','label'=>'TERJUAL','align'=>'left']];
	$aryFieldColomn[]=['ID' =>4, 'ATTR' =>['FIELD'=>'TTL_OUT','SIZE' => '12px','label'=>'SISA','align'=>'left']];
	$headerContent1[]=['content'=>'TOTAL QTY STOCK','options'=>['colspan'=>3,'class'=>'text-center','style'=>'background-color:'.$colorHeader1.';font-family: tahoma ;font-size: 6pt;']];
				
	$inc=5;
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
				$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE' => '6px','label'=>'Masuk','align'=>'center','BCOLOR'=>$colorHeader]];
				$inc=$inc+1;
			}
			if($splt[0]=='OUT'){
				$nmField1[]=$rows;		//FULL FIELD NAME
				$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
				$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE' => '6px','label'=>'Keluar','align'=>'center','BCOLOR'=>$colorHeader]];
				$inc=$inc+1;
			}
			if($splt[0]=='SISA'){
				$nmField1[]=$rows;		//FULL FIELD NAME
				$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
				$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE' => '6px','label'=>'Sisa','align'=>'center','BCOLOR'=>$colorHeader]];
				$inc=$inc+1;
				$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>3,'class'=>'text-center','style'=>'background-color:'.$colorHeader1.';font-family: tahoma ;font-size: 6pt;']];		
			}
		};
	 }else{
		 for ($i=1;$i<=31;$i++){
			$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$i,'SIZE' => '6px','label'=>$i,'align'=>'center','BCOLOR'=>$colorHeader]];
			$inc=$inc+1;
		 }
		 $headerContent1[]=['content'=>'STOK TERJUAL','options'=>['colspan'=>$i,'class'=>'text-center','style'=>'background-color:'.$colorHeader1.';font-family: tahoma ;font-size: 6pt;']];			
	 };
	 
	$valFields = ArrayHelper::map($aryFieldColomn, 'ID', 'ATTR');
	foreach($valFields as $key =>$value[]){	
		if ($value[$key]['FIELD']=='PRODUCT_NM' OR $value[$key]['FIELD']=='STORE_NM'){
			$attDinamikField[]=[
				'attribute'=>$value[$key]['FIELD'],
				'label'=>$value[$key]['label'],
				// 'filterType'=>$gvfilterType,
				// 'filter'=>$gvfilter,
				// 'filterWidgetOptions'=>$filterWidgetOpt,	
				//'filterInputOptions'=>$filterInputOpt,				
				'hAlign'=>'right',
				'vAlign'=>'middle',
				//'mergeHeader'=>true,
				'noWrap'=>true,			
				'headerOptions'=>[		
					'style'=>[									
						'text-align'=>'center',
						'width'=>$value[$key]['SIZE'],
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8px',
						'background-color'=>$value[$key]['BCOLOR'],
					]
				],
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'left',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'7pt',
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
				//'mergeHeader'=>true,
				'noWrap'=>true,	
				'value'=>function($data)use($key,$value){
					$x=$value[$key]['FIELD'];
					$splt=explode('_',$x);	
					// if($splt[0]=='SISA'){
						// $l+=$l+12;
						// return $l;
					// }else{						
						if($data[$x]){
							return $data[$x];
						}else{
							return 0;
						}						
					// }		
				},				
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'20px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8px',
						'background-color'=>$value[$key]['BCOLOR'],
					]
				],  
				//'format'=>['decimal', 2],
				'format' => 'raw',
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'7px',
						'font-weight'=>'bold',
						]
				],
				//'pageSummaryFunc'=>GridView::F_SUM,
				//'pageSummary'=>true,
				'pageSummaryOptions' => [
					'style'=>[
							'text-align'=>'right',		
							'font-family'=>'tahoma',
							'font-size'=>'7pt',	
							'text-decoration'=>'underline',
							'font-weight'=>'bold',
							'border-left-color'=>'transparant',		
							'border-left'=>'0px',									
					]
				],	
			];	
		}
	};
	
	
	$gvInvOut= GridView::widget([
		'id'=>'inv-out',
		'dataProvider' => $dataProvider,
		//'filterModel' => $searchModelDetail,
		'filterRowOptions'=>['style'=>'background-color:'.$colorHeader.'; align:center'],
		'beforeHeader'=>[
			'0'=>[					
				'columns'=>$headerContent1,
			]
		],
		'columns' =>$attDinamikField,	
		'toolbar' => [
			'{export}',
		],	
		'panel'=>false,
		// 'panel'=>[
			// 'type'=>'info',
			// 'heading'=>false,
			// 'before'=>false,
			// 'after'=>false,
			// 'footer'=>false,
		// ],
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'inv-out',
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
		'summary'=>false,
	]);
?>
<?=$gvInvOut?>