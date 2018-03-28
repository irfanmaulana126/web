<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use frontend\backend\laporan\models\JurnalTemplateDetailSearch;
use kartik\date\DatePicker;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use kartik\widgets\Select2;
use common\models\Store;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\assets\AppAssetBackendBorder;
AppAssetBackendBorder::register($this);
/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTemplateTitleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJs("
	//var x = document.getElementById('tahun').value;
	//console.log(x);
	$('#tahun').change(function() { 
		var x = document.getElementById('tahun').value;
		$.pjax.reload({
			url:'/laporan/dompet?tgl='+x, 
			container: '#arus-masuk-monthofyear',
			//timeout: 1000,
		}).done(function() {
			$.pjax.reload({container:'#tanggal'})
		});
		
		//console.log('Changed!'+x+y); 
	});	
	// $('#tahun, #store').change(function() { 
	// 	var x = document.getElementById('tahun').value;
	// 	var y = document.getElementById('store').value;
	// 	$.pjax.reload({
	// 		url:'/laporan/arus-uang?tgl='+x+'&store='+y, 
	// 		container: '#arus-masuk-monthofyear',
	// 		//timeout: 1000,
	// 	}).done(function() {
	// 		$.pjax.reload({container:'#tanggal'})
	// 	});
		
	// 	//console.log('Changed!'+x+y); 
	// });	

",View::POS_READY);

$this->registerJs($this->render('dompet_script.js'),View::POS_READY);
echo $this->render('/dompet/dompet_modal');
echo $this->render('/dompet/dompet_button');
$this->title = 'Ringkasan Keuangan Dompet';
$this->params['breadcrumbs'][] = ['label'=>'Laporan Menu', 'url' => ['/laporan']];
$this->params['breadcrumbs'][] = $this->title;
	$vewBreadcrumb=Breadcrumbs::widget([
		'homeLink' => [
			'label' => Html::encode(Yii::t('yii', 'Home')),
			'url' => Yii::$app->homeUrl,
		],
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]);
$paramCari=Yii::$app->getRequest()->getQueryParam('tgl');
$tanggal = (empty($paramCari)) ? date('Y-n') : $paramCari ;
$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
$btn_srchChart1=DatePicker::widget([
    'name' => 'check_issue_date', 
    'options' => ['placeholder' => 'Pilih Tahun ...','id'=>'tahun'],
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
$btn_srchChart2= Select2::widget([
    'name' => 'state_10',
    'data' =>  ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->all(),'STORE_ID','STORE_NM'),
	'options' => ['placeholder' => 'Pilih Toko ...','id'=>'store'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
$btn_srchChart="<div style='padding-bottom:3px;float:right'>".$btn_srchChart1."</div>";
$btn_srchChart2="<div style='padding-bottom:3px;float:right'>".$btn_srchChart2."</div>";
$retVal = (empty($store->STORE_NM)) ? '' : $store->STORE_NM ;
$retValid = (empty($store->STORE_ID)) ? '' : $store->STORE_ID ;
?>
<div class="container-fluid">
<?=$vewBreadcrumb?>
	<div class="col-xs-4 col-sm-4 col-lg-4 pull-right" style="margin-right:-15px">
				<?=$btn_srchChart?>
			</div>	
			<div style="float:right">
				<?php
				// $title= Yii::t('app','');
				// $url = Url::toRoute(['/laporan/arus-uang/arus-kas-cetakpdf']);
				// $options1 = [
				// 			'id'=>'pdf',
				// 			'class'=>"btn btn-xs",
				// 			'title'=>'Print PDF',
				// 			'target' => '_blank',	
				// ];
				// $icon1 = '<span class="fa-stack fa-lg text-left">
				// 		  <b class="fa fa-circle fa-stack-2x" style="color:red"></b>
				// 		  <b class="fa fa fa fa-file-pdf-o fa-stack-1x" style="color:white"></b>
				// 		  </span>
				// 		  ';
				// 		  $label1 = $icon1.' '.$title ;
				// 		  echo $content = Html::a($label1,$url,$options1);
				// 		  ?>	
			</div>	
			<div style="float:right">
            <?php//tombolKembali()?>
			</div>	
	<div style="height:20px;text-align:center;font-family: tahoma ;font-size: 10pt;padding-top:50px">	
					<?php		                    
                        //$tanggal=explode('-',$cari);				
						echo '<b><h5><b>RINGKASAN KEUANGAN DOMPET</b></h5><div id="tanggal">'.date("F",strtotime($tanggal)).' '.date("Y",strtotime($tanggal)).'<div>';		
					?>		
			</div>
		<div class="pull-right">
				<?php//tombolExportExcel()?>	
		</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;padding-top:10px">
		<div class="row">	
		<div class="w3-card-2 w3-round w3-white">
		<?php      
			    // $colorHeader='rgba(208, 218, 230, 1)';
				$colorHeader='#8acef5';
			    $colorHeaderGroup='#bde3f9';
			    //$colorHeaderGroup='#d4fcd7';
				$footerColor='#fdf7ec';//'#fce6c0';//'#eafa8f';//'#defdd8';
				//$searchModel =  new JurnalTemplateDetailSearch(['YEAR_AT'=>$tanggal[0],'MONTH_AT'=>$tanggal[1],'STORE_ID'=>$retValid]);
				//$searchModel =  new JurnalTemplateDetailSearch(['TAHUN'=>'2018','BULAN'=>'2','STORE_ID'=>$retValid]);
				//$searchModel =  new JurnalTemplateDetailSearch();
				// print_r($searchModel);
				// die();
				
				//$searchModel->RPT_TITLE_ID = 'RPT_TITLE_ID';
				//$dataProvider = $searchModel->search(['TAHUN'=>'2018','BULAN'=>'2','STORE_ID'=>$retValid]);
				// $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
				$modelView =$dataProvider->getModels();
				
				 echo GridView::widget([					 
					'id'=>'arus-masuk-monthofyear',
					'dataProvider' => $dataProvider,
					'summary'=>false,
					//'showHeader'=>false,
					'showPageSummary' => true,					
					'pjax'=>true,
					'pjaxSettings'=>[
						'options'=>[
							'enablePushState'=>true,
							'id'=>'arus-masuk-monthofyear',
						],
					],			
					'bordered'=>true,
					'hover'=>true,
					'bordered'=>true,
					'hover'=>true,
					'striped'=>false,	
					'export'=>[
						'fontAwesome' => true,
						'showConfirmAlert' => false,
						'target' => GridView::TARGET_BLANK,
						'filename' => 'ExportArusDompet',
						// 'target' => GridView::TARGET_POPUP,
						// 'target' => GridView::TARGET_SELF,
					],
					'exportConfig' => [
						kartik\export\ExportMenu::EXCEL => true,
						GridView::PDF => [
							'showHeader' => true,
							'mime' => 'application/pdf',
							'filename' => 'ExportArusDompet',
							'config' => [
								'mode' => 'c',
								'format' => 'A4-L',
								'destination' =>true,
								'marginTop' => 10,
								'marginBottom' => 20,									
								'options' => [
									'title' =>'KontrolGampang-Export',
								],
								 'methods' => [
									'SetHeader' => [
										['odd' => 'aaa', 'even' => 'bbb'],
									],
									'SetFooter' => [
										['odd' =>'cccc', 'even' =>'dddd'],
									],
								],
								'contentBefore'=>'
									<div style="text-align:center;font-family: tahoma ;font-size: 10pt;">	
										<b><h5><b>RINGKASAN KEUANGAN DOMPET</b></h5><div id="tanggal">'.date("F",strtotime($tanggal)).' '.date("Y",strtotime($tanggal)).'<div>
									</div>	
									<br>									
								',
								'contentAfter'=>''
							],
							'showFooter' => false,
							'showCaption' => false,
						
						],
					],  
					'toolbar' => [
						'{export}','{toggleData}'
					],   
					'panel'=>[
						'type'=>false,
						'heading'=>false,
						'footer'=>false
					], 
					'columns' => [
							[
								'attribute' => 'TRANSCODE_NM',
								'label' => false,
								'format'=>'raw',
								// 'value'=>
								// function($model){
								// 	//$icon='<span class="fa fa fa-circle-o">  '.Html::a($model->AKUN_NM,'/laporan/arus-uang/detail-bulan?akunkode='.$model->AKUN_CODE.'&bulan='.$model->YEAR_AT.'-'.$model->MONTH_AT.'&store='.$store.'').' </span>';
								// 	return Html::a($model['TRANSCODE_NM']);//,'/laporan/arus-uang/detail-bulan?akunkode='.$model['AKUN_CODE'].'&bulan='.$model['TAHUN'].'-'.$model['BULAN']);
								// },	
								'headerOptions'=>[
									'style'=>[
											'text-align'=>'center',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											//'font-weight'=>'bold',
											'font-size'=>'8pt',
											'background-color'=>$colorHeader,
									]
								],									
								'contentOptions'=>[
									'style'=>[
											'text-align'=>'right',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'font-family: verdana, arial, sans-serif',
											'font-weight'=>'bold',
											'font-size'=>'8pxt',
											//'background-color'=>'#88b3ec',
									]
								],
								'pageSummaryOptions' => [
									'style'=>[
											'text-align'=>'right',
											//'width'=>'60%',
											'font-family'=>'tahoma',
											'font-size'=>'8pt',
											'text-decoration'=>'underline',
											//'font-weight'=>'bold',
											//'border-left-color'=>'transparant',
											'background-color'=>$colorHeader,
											'border-left'=>'0px',
									]									
								],								
							],
							[
								'attribute' => 'MASUK',
								'label' =>'PEMASUKAN',
								'format'=>['decimal', 2],
								'pageSummary'=>true,
								'pageSummaryFunc'=>GridView::F_SUM,									
								'headerOptions'=>[
									'style'=>[
											'text-align'=>'center',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											//'font-weight'=>'bold',
											'font-size'=>'8pt',
											'background-color'=>$colorHeader,
									]
								],	
								'contentOptions'=>[
									'style'=>[
											'text-align'=>'right',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											//'font-weight'=>'bold',
											'font-size'=>'8pt',
											//'background-color'=>'#88b3ec',
									]
								],		
								'pageSummaryOptions' => [
									'style'=>[
											'text-align'=>'right',
											//'width'=>'20%',
											'font-family'=>'tahoma',
											'font-size'=>'8pt',
											'text-decoration'=>'underline',
											//'font-weight'=>'bold',
											//'border-left-color'=>'transparant',
											'background-color'=>$colorHeader,
											'border-left'=>'0px',
									]
									
								],
								
							],
							[
								'attribute' => 'KELUAR',
								'label' =>'PENGELUARAN',
								'format'=>['decimal', 2],	
								'pageSummary'=>true,
								'pageSummaryFunc'=>GridView::F_SUM,								
								'headerOptions'=>[
									'style'=>[
											'text-align'=>'center',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											//'font-weight'=>'bold',
											'font-size'=>'8pt',
											'background-color'=>$colorHeader,
									]
								],	
								'contentOptions'=>[
									'style'=>[
											'text-align'=>'right',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											//'font-weight'=>'bold',
											'font-size'=>'8pt',
											//'background-color'=>'#88b3ec',
									]
								],										
								'pageSummaryOptions' => [
									'style'=>[
											'text-align'=>'right',
											//'width'=>'20%',
											'font-family'=>'tahoma',
											'font-size'=>'8pt',
											'text-decoration'=>'underline',
											//'font-weight'=>'bold',
											//'border-left-color'=>'transparant',
											'background-color'=>$colorHeader,
											'border-left'=>'0px',
									]
									
								],
								
							],
					],
				]); 
			?>
			</div>
		</div>
	</div>
</div>