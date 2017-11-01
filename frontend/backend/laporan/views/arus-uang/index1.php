<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\TransPenjualanHeaderSummaryMonthlySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trans Penjualan Header Summary Monthlies';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php
$this->registerCss("
	
	#arus-masuk-bulanan .kv-grid-container{
		height:230px
	}
	#arus-keluar-bulanan .kv-grid-container{
		height:220px
	}
");

$this->registerJs("
	 // var x = document.getElementById('tahun').value;
	 // console.log(x);
	 document.getElementById('tahun').onchange = function() { 
		var x = document.getElementById('tahun').value;
			$.pjax.reload({
				url:'/laporan/arus-uang/index?id='+x, 
				container: '#arus-masuk-monthofyear',
				timeout: 1000,
			}).done(function () {
				$.pjax.reload({container: '#arus-keluar-monthofyear'});
			});
		
		console.log('Changed!'+x); 
	 }
",View::POS_READY);

	$aryBln= [
	  ['ID' => 1, 'BLN' => 'Januari'],		  
	  ['ID' => 2, 'BLN' => 'Februari'],
	  ['ID' => 3, 'BLN' => 'Maret'],
	  ['ID' => 4, 'BLN' => 'April'],
	  ['ID' => 5, 'BLN' => 'Mei'],
	  ['ID' => 6, 'BLN' => 'Juni'],
	  ['ID' => 7, 'BLN' => 'Juli'],
	  ['ID' => 8, 'BLN' => 'Agustus'],
	  ['ID' => 9, 'BLN' => 'September'],
	  ['ID' => 10, 'BLN' => 'Oktober'],
	  ['ID' => 11, 'BLN' => 'November'],
	  ['ID' => 12, 'BLN' => 'Desember']
	];	
	$valBulan = ArrayHelper::map($aryBln, 'ID', 'BLN');
	
	// Multiple select without model
	$btn_srchBulan1=Select2::widget([
			'name' => 'state_2',
			//'value' => '',
			'size' => Select2::SMALL,
			'data' => $valBulan,
			'hideSearch' => false,
			'theme' => Select2::THEME_KRAJEE,//THEME_DEFAULT,//THEME_CLASSIC,//THEME_BOOTSTRAP,//THEME_KRAJEE,
			'pluginOptions' => [
				'allowClear' => true
			],
			'options' => [
				'id'=>'tahun',
				'multiple' => false, 'placeholder'=>'pilih bulan...'
			]
		]);
	$btn_srchBulan="<br><div style='width:150px;padding-bottom:3px;float:right'>".$btn_srchBulan1."</div>";
	
	$aryFieldMasuk= [		  
		['ID' =>0, 'ATTR' =>['FIELD'=>'TAHUN','SIZE' => '50px','label'=>'TAHUN','align'=>'center','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],
		['ID' =>1, 'ATTR' =>['FIELD'=>'BULAN','SIZE' => '80px','label'=>'BULAN','align'=>'center','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],
		['ID' =>2, 'ATTR' =>['FIELD'=>'storeNm','SIZE' => '80px','label'=>'STORE','align'=>'left','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],
		['ID' =>3, 'ATTR' =>['FIELD'=>'TOTAL_SALES','SIZE' => '80px','label'=>'Penjualan','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		['ID' =>4, 'ATTR' =>['FIELD'=>'TTL_TUNAI','SIZE' => '80px','label'=>'Tunai','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		['ID' =>5, 'ATTR' =>['FIELD'=>'TTL_DEBET','SIZE' => '80px','label'=>'Debet','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		['ID' =>6, 'ATTR' =>['FIELD'=>'TTL_KREDIT','SIZE' => '80px','label'=>'Kredit','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		['ID' =>7, 'ATTR' =>['FIELD'=>'TTL_EMONEY','SIZE' => '80px','label'=>'EMoney','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		['ID' =>8, 'ATTR' =>['FIELD'=>'TOTAL_PRODUCT','SIZE' => '80px','label'=>'Produk','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		['ID' =>9, 'ATTR' =>['FIELD'=>'JUMLAH_TRANSAKSI','SIZE' => '80px','label'=>'Transaksi','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		['ID' =>10, 'ATTR' =>['FIELD'=>'CNT_TUNAI','SIZE' => '80px','label'=>'Tunai','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		['ID' =>11, 'ATTR' =>['FIELD'=>'CNT_DEBET','SIZE' => '80px','label'=>'Debet','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		['ID' =>12, 'ATTR' =>['FIELD'=>'CNT_KREDIT','SIZE' => '80px','label'=>'Kredit','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		['ID' =>13, 'ATTR' =>['FIELD'=>'CNT_EMONEY','SIZE' => '80px','label'=>'EMoney','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],
		
	];	
	$valFieldsMasuk = ArrayHelper::map($aryFieldMasuk, 'ID', 'ATTR'); 
	
	
	
	
	/*OTHER ATTRIBUTE*/
	foreach($valFieldsMasuk as $key =>$value[]){	
		$attDinamikMasuk[]=[		
			'attribute'=>$value[$key]['FIELD'],
			'label'=>$value[$key]['label'],
			'filter'=>$value[$key]['FILTER'],							
			'hAlign'=>'right',
			'vAlign'=>'middle',
			//'mergeHeader'=>true,
			'noWrap'=>true,	
			'value'=>function($data)use($key,$value){
				$x=$value[$key]['FIELD'];
				// if($x=='IN_WAKTU' OR $x=='OUT_WAKTU'){
					// return $data->$x;
				// }else{
					// return $data->$x;
				// }
				if ($data->$x==null){
					return 0;
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
				]
			],	
		];	
	};	
	$arusMasukBulanan= GridView::widget([
		'id'=>'arus-masuk-bulanan',
		'dataProvider' => $dataProvider,
	   // 'filterModel' => $searchModel,
	   'beforeHeader'=>[
				'0'=>[					
					'columns'=>[
						['content'=>'DATA INFO','options'=>['colspan'=>3,'class'=>'text-center info','style'=>'font-family: tahoma ;font-size: 6pt;']],
						['content'=>'TOTAL','options'=>['colspan'=>5,'class'=>'text-center success','style'=>'font-family: tahoma ;font-size: 6pt;']],
						['content'=>'JUMLAH','options'=>['colspan'=>6,'class'=>'text-center danger','style'=>'font-family: tahoma ;font-size: 6pt;']],
									
					],					
				],				
				
		],
		'columns' =>$attDinamikMasuk,
		'toolbar' =>false,
		'panel'=>[
			'heading'=>false,
			//'type'=>'info',
			'after'=>false,
			'before'=>'ARUS KAS MASUK',
			'footer'=>false,
			
		],
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>true,
				'id'=>'arus-masuk-bulanan',
			],
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>false,
		'bordered'=>true,
		'striped'=>false,
		'showPageSummary' => true,
	]); 
	
	
	
	$aryFieldKeluar= [		  
		['ID' =>0, 'ATTR' =>['FIELD'=>'TAHUN','SIZE' => '50px','label'=>'TAHUN','align'=>'center','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],
		['ID' =>1, 'ATTR' =>['FIELD'=>'BULAN','SIZE' => '80px','label'=>'BULAN','align'=>'center','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],
		['ID' =>2, 'ATTR' =>['FIELD'=>'storeNm','SIZE' => '80px','label'=>'STORE','align'=>'left','mergeHeader'=>false,'FILTER'=>false,'format'=>'raw','pageSummary'=>false]],		
		['ID' =>3, 'ATTR' =>['FIELD'=>'totalPengeluaran','SIZE' => '80px','label'=>'Pengeluaran','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],		
		['ID' =>4, 'ATTR' =>['FIELD'=>'TTL_1','SIZE' => '80px','label'=>'Langanan','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],		
		['ID' =>5, 'ATTR' =>['FIELD'=>'TTL_2','SIZE' => '80px','label'=>'Deposit','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],		
		['ID' =>6, 'ATTR' =>['FIELD'=>'TTL_3','SIZE' => '80px','label'=>'Modal.Kasir','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],		
		['ID' =>7, 'ATTR' =>['FIELD'=>'TTL_4','SIZE' => '80px','label'=>'Payroll','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],		
		['ID' =>8, 'ATTR' =>['FIELD'=>'TTL_5','SIZE' => '80px','label'=>'Pembelian ','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],		
		['ID' =>9, 'ATTR' =>['FIELD'=>'TTL_6','SIZE' => '80px','label'=>'Ops.Listrik','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],		
		['ID' =>10, 'ATTR' =>['FIELD'=>'TTL_7','SIZE' => '80px','label'=>'Ops.Air','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],		
		['ID' =>11, 'ATTR' =>['FIELD'=>'TTL_8','SIZE' => '80px','label'=>'Ops.Transport','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],		
		['ID' =>12, 'ATTR' =>['FIELD'=>'TTL_9','SIZE' => '80px','label'=>'Lain.Lain','align'=>'right','mergeHeader'=>false,'FILTER'=>false,'format'=>['decimal', 2],'pageSummary'=>true]],		
	];	
	$valFieldsKeluar = ArrayHelper::map($aryFieldKeluar, 'ID', 'ATTR'); 
	
	/*OTHER ATTRIBUTE*/
	foreach($valFieldsKeluar as $key1 =>$value1[]){	
		$attDinamikKeluar[]=[		
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
					if ($data->$x==null){
						return 0;
					}else{
						return $data->$x;
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
	
	$arusKeluarBulanan= GridView::widget([
		'id'=>'arus-keluar-bulanan',
		'dataProvider' => $dataProviderKeluar,
	   // 'filterModel' => $searchModel,
	   'beforeHeader'=>[
			'0'=>[					
				'columns'=>[
					['content'=>'DATA INFO','options'=>['colspan'=>3,'class'=>'text-center info','style'=>'font-family: tahoma ;font-size: 6pt;']],
					['content'=>'TOTAL','options'=>['colspan'=>1,'class'=>'text-center success','style'=>'font-family: tahoma ;font-size: 6pt;']],
					['content'=>'DETAIl PENGELUARAN','options'=>['colspan'=>10,'class'=>'text-center danger','style'=>'font-family: tahoma ;font-size: 6pt;']],
								
				],					
			],								
		],
		'columns' =>$attDinamikKeluar,
		'toolbar' =>false,
		'panel'=>[
			'heading'=>false,
			//'type'=>'info',
			'after'=>false,
			'before'=>'ARUS KAS KELUAR',
			'footer'=>false,
			
		],
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>true,
				'id'=>'arus-keluar-bulanan',
			],
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>false,
		'bordered'=>false,
		'striped'=>false,
		'showPageSummary' => true,
	]);  
	
	
	function tombolBack(){
		$title = Yii::t('app', 'Back');
		$url =  Url::toRoute(['/laporan/arus-uang']);
		$options = ['id'=>'laporan-lv1-back',
				  'data-pjax' => 0,
				  //'class'=>"btn btn-info btn-xs",
				 // 'style'=>'margin-left:50px'
				];
		$icon = '
				<span class="fa-stack fa-sm text-left">
				  <i class="fa fa-circle fa-stack-2x" style="color:#ffffff"></i>
				  <i class="fa fa-mail-reply fa-stack-1x" style="color:#CA0605"></i>
				</span>		
		';
		$label = $icon . ' ' . $title;
		return $content = Html::a($label,$url,$options);
	}
	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div style="height:20px;text-align:center;font-family: tahoma ;font-size: 10pt;">
			<div class="row">
				<?php
					$model=$dataProvider->getModels();				
					echo '<b>RINGKASAN ARUS KEUANGAN <br>'.$model[0]['BULAN'].' '.$cari['thn'].'</b>';				
				?>	
									
			</div>
			
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row">	
			<?php echo tombolBack().' '.$btn_srchBulan?>
			<?=$arusMasukBulanan?>				
			<?=$arusKeluarBulanan?>						
		</div>
	</div>
</div>

