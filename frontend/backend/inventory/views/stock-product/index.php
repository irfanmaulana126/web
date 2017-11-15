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
					'font-size'=>'8px',
				]
			],					
	];
	
	$aryFieldColomn[]=['ID' =>0, 'ATTR' =>['FIELD'=>'STORE_NM','SIZE' => '12px','label'=>'STORE_NM','align'=>'left']];
	$aryFieldColomn[]=['ID' =>1, 'ATTR' =>['FIELD'=>'PRODUCT_NM','SIZE' => '12px','label'=>'PRODUCT_NM','align'=>'left']];
	$headerContent1[]=['content'=>'DATA PRODUK','options'=>['colspan'=>3,'class'=>'text-center','style'=>'background-color:'.$colorHeader1.';font-family: tahoma ;font-size: 6pt;']];
				
	$inc=2;
	/* ==================
	 * QTY STOCK COLUMN
	 * ================== */
	 if($dinamikField){
		foreach($dinamikField[0] as $rows => $val){
			//unset($splt);
			//$ambilField[]=$rows; 		
			$splt=explode('_',$rows);	
			if($splt[0]=='QTY'){
				$nmField1[]=$rows;		//FULL FIELD NAME
				$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
				$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE' => '6px','label'=>date('d', strtotime($splt[1])),'align'=>'center','BCOLOR'=>$colorHeader]];
				$inc=$inc+1;
			}
		};
		$headerContent1[]=['content'=>'STOK','options'=>['colspan'=>$inc,'class'=>'text-center','style'=>'background-color:'.$colorHeader1.';font-family: tahoma ;font-size: 6pt;']];		
	 }else{
		 for ($i=1;$i<=31;$i++){
			$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$i,'SIZE' => '6px','label'=>$i,'align'=>'center','BCOLOR'=>$colorHeader]];
			$inc=$inc+1;
		 }
		 $headerContent1[]=['content'=>'STOK','options'=>['colspan'=>$i,'class'=>'text-center','style'=>'background-color:'.$colorHeader1.';font-family: tahoma ;font-size: 6pt;']];			
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
						'text-align'=>$value[$key]['align'],
						//'width'=>'12px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'7pt',
						//'background-color'=>'rgba(13, 127, 3, 0.1)',
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
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'20px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'7pt',
						'background-color'=>$value[$key]['BCOLOR'],
					]
				],  
				'format'=>['decimal', 2],
				'contentOptions'=>[
					'style'=>[
						'text-align'=>$value[$key]['align'],
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'7px',
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