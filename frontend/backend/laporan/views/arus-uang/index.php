<?php

use yii\helpers\Html;
use kartik\grid\GridView;

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
				'label'=>'Total Penjualan',				
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
				'template' => '{view}',
				'header'=>'Rincian',
							
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
				'label'=>'Pengajian',				
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
						'font-weight'=>'bold',
						'border-left-color'=>'transparant',		
						'border-left'=>'0px',
						//'background-color'=>'rgba(76, 22, 11, 0.36)',
						//'color'=>'white',
					]
				],	
			],
			[
				'attribute'=>'LAIN_LAIN',
				'label'=>'Lain.lain',				
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

