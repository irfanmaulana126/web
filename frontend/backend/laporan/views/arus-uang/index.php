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
	#arus-masuk-monthofyear .kv-panel {
		//min-height: 340px;
		height: 300px;
	}
	#arus-masuk-monthofyear .kv-grid-container{
		height:452px
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

	$aryHari= [
	  ['ID' => 2017, 'HARI' => '2017'],		  
	  ['ID' => 2018, 'HARI' => '2018'],
	  ['ID' => 2019, 'HARI' => '2019'],
	  ['ID' => 2020, 'HARI' => '2020'],
	  ['ID' => 2021, 'HARI' => '2021'],
	  ['ID' => 2022, 'HARI' => '2022'],
	  ['ID' => 2023, 'HARI' => '2023']
	];	
	$valHari = ArrayHelper::map($aryHari, 'ID', 'HARI');
	
	// Multiple select without model
	$btn_srchChart1=Select2::widget([
			'name' => 'state_2',
			//'value' => '',
			'size' => Select2::SMALL,
			'data' => $valHari,
			'hideSearch' => false,
			'theme' => Select2::THEME_KRAJEE,//THEME_DEFAULT,//THEME_CLASSIC,//THEME_BOOTSTRAP,//THEME_KRAJEE,
			'pluginOptions' => [
				'allowClear' => true
			],
			'options' => [
				'id'=>'tahun',
				'multiple' => false, 'placeholder'=>'pilih tahun...'
			]
		]);
	$btn_srchChart="<div style='padding-bottom:3px;float:right'> Periode Tahun".$btn_srchChart1."</div>";
	
	$arusMasuk= GridView::widget([
		'id'=>'arus-masuk-monthofyear',
		'dataProvider' => $dataProvider,
	   // 'filterModel' => $searchModel,
		'columns' => [
			[	
				'attribute'=>'BULAN_NM',
				'label'=>'Bulan',	
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'60px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right	',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
			],
			[
				'attribute'=>'TOTAL_SALES',
				'label'=>'Total.Penjualan',				
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'80px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
				'format'=>['decimal', 2],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
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
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],	
			],
			[
				'attribute'=>'PENJUALAN_TUNAI',
				'label'=>'Tunai',				
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'80px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
				'format'=>['decimal', 2],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
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
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],	
			],
			[
				'attribute'=>'PENJUALAN_EDC',
				'label'=>'EDC',				
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'80px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
				'format'=>['decimal', 2],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
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
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],	
			],
		    [
				'class' => 'kartik\grid\ActionColumn',
				'template' => '{review}',
				'header'=>'Rincian',
				'buttons' => [
				'review' =>function ($url,$model)use($cari){
						// return Html:button('<span class="glyphicon glyphicon-info-sign"></span>',['/laporan/arus-uang/detail-lev1','id'=>$model->TAHUN], [
									// 'title' => Yii::t('app', 'Detail'),
						// ]);
						$title1 = Yii::t('app', ' Detail');
						$url = Url::toRoute(['/laporan/arus-uang/detail-lev1','id'=>$cari['thn'],'bln'=>$model['BULAN_ID']]);
						$options1 = [
									'id'=>'import-button-export-excel',
									'data-pjax' => true,
									//'class'=>"btn btn-info btn-sm"  
						];
						$icon1 = '';//'<span class="fa fa-clone fa-lg"></span>';
						$label1 = $icon1 . ' ' . $title1;
						$content = Html::a($label1,$url,$options1);
						return $content;
						
						
					}
				],
							
			]
		],
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
				'id'=>'arus-masuk-monthofyear',
			],
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>false,
		'bordered'=>false,
		'striped'=>false,
		'showPageSummary' => true,
	]); 
	
	$arusKeluar= GridView::widget([
		'id'=>'arus-keluar-monthofyear',
		'dataProvider' => $dataProvider,
	   // 'filterModel' => $searchModel,
		'columns' => [
			[	
				'attribute'=>'TOTAL_KELUAR',
				'label'=>'Total.Pengeluaran',	
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'80px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right	',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
				'format'=>['decimal', 2],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
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
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],
			],
			[
				'attribute'=>'LANGANAN',
				'label'=>'Langganan',				
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'80px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
				'format'=>['decimal', 2],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
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
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],	
			],
			[
				'attribute'=>'DEPOSIT',
				'label'=>'Deposit',				
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'80px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
				'format'=>['decimal', 2],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
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
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],	
			],
			[
				'attribute'=>'MODAL_KASIR',
				'label'=>'Modal.Kasir',				
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'80px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
				'format'=>['decimal', 2],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
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
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],	
			],
			[
				'attribute'=>'PAYROLL',
				'label'=>'Penggajian',				
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'80px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
				'format'=>['decimal', 2],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
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
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],	
			],
		    [
				'attribute'=>'OPS',
				'label'=>'Operasional',				
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'80px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
				'format'=>['decimal', 2],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
				'pageSummaryOptions' => [
					'style'=>[
						'text-align'=>'right',		
						//'width'=>'12px',
						'font-family'=>'tahoma',
						'font-size'=>'8pt',	
						'text-decoration'=>'underline',
						'fon	t-weight'=>'bold',
						'border-left-color'=>'transparant',		
						'border-left'=>'0px',
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],	
			],
			[
				'attribute'=>'LAIN_LAIN',
				'label'=>'Lain2',				
				'noWrap'=>false,	
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'80px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt'
					]
				],  
				'contentOptions'=>[
					'style'=>[
						'text-align'=>'right',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8pt',						
					]
				],
				'format'=>['decimal', 2],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
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
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],	
			],
		    [
				'class' => 'kartik\grid\ActionColumn',
				'template' => '{view}',
				'header'=>'Rincian',
							
			]
		],
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
				'id'=>'arus-kelusr-monthofyear',
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
		<div class="row">	
			<div style="height:20px;text-align:center;font-family: tahoma ;font-size: 10pt;">	
					<?php								
						echo '<b>RINGKASAN ARUS KEUANGAN <br>'.$cari['thn'].'</b>';				
					?>		
			</div>
			<div>
				<?=$btn_srchChart?>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row">	
			<div class="col-xs-12 col-sm-5 col-lg-5" style="font-family: tahoma ;font-size: 8pt;">
				<?=$arusMasuk?>				
			</div>
			<div class="col-xs-12 col-sm-7 col-lg-7" style="font-family: tahoma ;font-size: 8pt;">
				<div class="row">	
					<?=$arusKeluar?>				
				</div>
			</div>
		</div>
	</div>
</div>

