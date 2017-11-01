<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\View;

	$aryFieldAbsensi= [		  
		['ID' =>0, 'ATTR' =>['FIELD'=>'KARYAWAN_ID','SIZE' => '40px','label'=>'KARYAWAN_ID','align'=>'center','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],
		['ID' =>1, 'ATTR' =>['FIELD'=>'KARYAWAN','SIZE' => '80px','label'=>'KARYAWAN','align'=>'left','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],
		['ID' =>2, 'ATTR' =>['FIELD'=>'TGL','SIZE' => '80px','label'=>'TGL','align'=>'center','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],		
		['ID' =>3, 'ATTR' =>['FIELD'=>'MASUK','SIZE' => '80px','label'=>'MASUK','align'=>'center','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],		
		['ID' =>4, 'ATTR' =>['FIELD'=>'KELUAR','SIZE' => '80px','label'=>'KELUAR','align'=>'center','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],		
		['ID' =>5, 'ATTR' =>['FIELD'=>'LONGITUDE','SIZE' => '80px','label'=>'LONGITUDE','align'=>'center','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],		
		['ID' =>6, 'ATTR' =>['FIELD'=>'LATITUDE','SIZE' => '80px','label'=>'LATITUDE','align'=>'center','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],		
	];	
	$valFieldsAbsensi = ArrayHelper::map($aryFieldAbsensi, 'ID', 'ATTR'); 
	
	/*OTHER ATTRIBUTE*/
	foreach($valFieldsAbsensi as $key1 =>$value1[]){	
		$attDinamikAbsensi[]=[		
			'attribute'=>$value1[$key1]['FIELD'],
			'label'=>$value1[$key1]['label'],
			'filter'=>$value1[$key1]['FILTER'],							
			'hAlign'=>'right',
			'vAlign'=>'middle',
			//'mergeHeader'=>true,
			'noWrap'=>true,	
			'value'=>function($data)use($key1,$value1){
				$x=$value1[$key1]['FIELD'];
				// if($x=='PENGELUARAN'){
					// return $data->$x;
					// return $data->TTL_2;
				// }else{
					if ($data[$x]==null){
						return 0;
					}else{
						return $data[$x];
					};
				// };
				
			},
			'noWrap'=>false,	
			'mergeHeader'=>$value1[$key1]['mergeHeader'],
			'headerOptions'=>[		
					'style'=>[									
					'text-align'=>'center',
					'width'=>$value1[$key1]['SIZE'],
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'8pt',
					'background-color'=>$bColor,
				]
			],  
			'contentOptions'=>[
				'style'=>[
					'text-align'=>$value1[$key1]['align'],
					//'width'=>'12px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'8pt',
					//'background-color'=>'rgba(13, 127, 3, 0.1)',
				]
			],
			'format'=>$value1[$key1]['format'],
			'pageSummaryFunc'=>GridView::F_SUM,
			'pageSummary'=>$value1[$key1]['pageSummary'],
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
	
	$gvListAbsensi= GridView::widget([
		'id'=>'list-absensi',
		'dataProvider' => $dataProvider,
	   // 'filterModel' => $searchModel,
	   // 'beforeHeader'=>[
			// '0'=>[					
				// 'columns'=>[
					// ['content'=>'DATA INFO','options'=>['colspan'=>3,'class'=>'text-center info','style'=>'font-family: tahoma ;font-size: 6pt;']],
					// ['content'=>'TOTAL','options'=>['colspan'=>1,'class'=>'text-center success','style'=>'font-family: tahoma ;font-size: 6pt;']],
					// ['content'=>'DETAIl PENGELUARAN','options'=>['colspan'=>10,'class'=>'text-center danger','style'=>'font-family: tahoma ;font-size: 6pt;']],
								
				// ],					
			// ],								
		// ],
		'columns' =>$attDinamikAbsensi,
		'toolbar' =>false,
		'panel'=>[
			'heading'=>false,
			//'type'=>'info',
			'after'=>false,
			'before'=>'LIST ABSENSI KARYAWAN',
			'footer'=>false,
			
		],
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>true,
				'id'=>'list-absensi',
			],
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>false,
		'bordered'=>false,
		'striped'=>false,
		'showPageSummary' => true,
	]);  

?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<?=$gvListAbsensi?>
	</div>
</div>


