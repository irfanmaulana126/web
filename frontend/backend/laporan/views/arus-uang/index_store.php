<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use frontend\backend\laporan\models\JurnalTemplateDetailSearch;
use kartik\date\DatePicker;
use yii\web\View;
use kartik\widgets\Select2;
use common\models\Store;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTemplateTitleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title="Ringkasan Arus Keuangan Per-Toko";
$this->params['breadcrumbs'][] = ['label'=>'Laporan Menu', 'url' => ['/laporan']];
$this->params['breadcrumbs'][] = ['label'=>'Arus Uang', 'url' => ['/laporan/arus-uang']];
	$this->params['breadcrumbs'][] =  $this->title;
	$vewBreadcrumb=Breadcrumbs::widget([
		'homeLink' => [
			'label' => Html::encode(Yii::t('yii', 'Home')),
			'url' => Yii::$app->homeUrl,
		],
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]);
$this->registerJs("
	//var x = document.getElementById('tahun').value;
	//console.log(x);
	$('#tahun, #store').change(function() { 
		var x = document.getElementById('tahun').value;
		var y = document.getElementById('store').value;
		$.pjax.reload({
			url:'/laporan/arus-uang/store-arus?tgl='+x+'&store='+y, 
			container: '#arus-masuk-store',
			//timeout: 1000,
		});
		
		//console.log('Changed!'+x+y); 
	});	

",View::POS_READY);
$paramCari=Yii::$app->getRequest()->getQueryParam('tgl');
$tanggal = (empty($paramCari)) ? date('Y-n') : $paramCari ;
$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
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
<div class="jurnal-template-title-index">
<div class="container-fluid">
<?=$vewBreadcrumb ?>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-lg-12">
				<?=$btn_srchChart2?>
			<div class="col-xs-4 col-sm-4 col-lg-4 pull-right">
				<?=$btn_srchChart?>
			</div>		
			<div style="float:right">
				<?php
				$title= Yii::t('app','');
				$url = Url::toRoute(['/laporan/arus-uang/arus-kas-cetakpdf']);
				$options1 = [
							'id'=>'pdf',
							'class'=>"btn btn-xs",
							'title'=>'Print PDF',
							'target' => '_blank',	
				];
				$icon1 = '<span class="fa-stack fa-lg text-left">
						  <b class="fa fa-circle fa-stack-2x" style="color:red"></b>
						  <b class="fa fa fa fa-file-pdf-o fa-stack-1x" style="color:white"></b>
						  </span>
						  ';
						  $label1 = $icon1.' '.$title ;
						  echo $content = Html::a($label1,$url,$options1);
						  ?>	
			</div>	
			<div style="float:right">
				<?php
				// $title= Yii::t('app','');
				// $url = Url::toRoute(['/laporan/arus-uang']);
				// $options1 = [
				// 			'id'=>'back-trafik',
				// 			'class'=>"btn btn-xs",
				// 			'title'=>'Kembali Menu Laporan'
				// ];
				// $icon1 = '<span class="fa-stack fa-md text-left">
				// 		  <b class="fa fa-circle fa-stack-2x" style="color:black"></b>
				// 		  <b class="fa fa fa fa-mail-reply fa-stack-1x" style="color:white"></b>
				// 		  </span>
				// 		  ';
				// 		  $label1 = $icon1.' '.$title ;
				// 		  echo $content = Html::a($label1,$url,$options1);
						  ?>	
			</div>	
				
		</div>			
		</div>
		<div style="text-align:center;font-family: tahoma ;font-size: 10pt;;padding-top:30px">	
                    <?php		                    
                        //$tanggal=explode('-',$cari);				
						//echo '<b>RINGKASAN ARUS KEUANGAN <br>'.$retVal.' '.date("F Y",strtotime($cari)).'</b>';
						echo '<b><h5><b>RINGKASAN ARUS KEUANGAN <br>Nama Toko: '.strtoupper($store->STORE_NM).'</b></h5><div id="tanggal">'.date("F",strtotime($tanggal)).' '.date("Y",strtotime($tanggal)).'<div>';		
					?>		
			</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;padding-top:20px;margin-bottom:50px">
		
		<div class="row">
		<div class="text-right" style="margin-bottom:10px">
			</div>
			<?php      
			    // $colorHeader='rgba(208, 218, 230, 1)';
				$colorHeader='#ffc107';
			    $colorHeaderGroup='#ffeb3b';
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
					'id'=>'arus-masuk-store',
					'dataProvider' => $dataProvider,
					'summary'=>false,
					//'showHeader'=>false,
					'showPageSummary' => true,
					'rowOptions'   => function ($model, $key, $index, $grid)use($cari,$store) {
						$btnclick= ['ondblclick' =>'location.href="'.Url::to(['/laporan/arus-uang/detail-bulan-store?akunkode='.$model['AKUN_CODE'].'&bulan='.$cari['TAHUN'].'-'.$cari['BULAN'].'&store='.$store->STORE_ID.'']).'"'];
						return $btnclick;
					},					
					'pjax'=>true,
					'pjaxSettings'=>[
						'options'=>[
							'enablePushState'=>true,
							'id'=>'arus-masuk-store',
						],
					],			
					'bordered'=>true,
					'hover'=>true,
					'bordered'=>true,
					'hover'=>true,
					'striped'=>false,	
					//'responsiveWrap'=>true,
					//'autoXlFormat'=>true,  
					/*  'export'=>[
						'fontAwesome' => true,
						'showConfirmAlert' => false,
						'target' => kartik\grid\GridView::TARGET_BLANK,
					],
					'exportConfig' => [
						kartik\export\ExportMenu::EXCEL => true,
						kartik\export\ExportMenu::PDF => true,
					],  
					'toolbar' => [
						'{export}',
					],  
					'panel'=>[
						'type'=>false,
						'heading'=>false
					],      */
					'export'=>[
						'fontAwesome' => true,
						'showConfirmAlert' => false,
						'target' => GridView::TARGET_BLANK,
						// 'target' => GridView::TARGET_POPUP,
						// 'target' => GridView::TARGET_SELF,
					],
					'exportConfig' => [
						kartik\export\ExportMenu::EXCEL => true,
						GridView::PDF => [
							'showHeader' => true,
							'mime' => 'application/pdf',
							'filename' => 'ExportArusUang',
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
										<b><h5><b>RINGKASAN ARUS KEUANGAN</b></h5><div id="tanggal">'.date("F",strtotime($tanggal)).' '.date("Y",strtotime($tanggal)).'<div>
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
							/* [	
								'class' => 'kartik\grid\ExpandRowColumn',
								'value'=>function($model,$key,$index,$column){
									return GridView::ROW_EXPANDED;
								},								
								'detail'=> function($model,$key,$index,$column)use($tanggal,$retVal,$retValid)
								{     								   
									$searchModel =  new JurnalTemplateDetailSearch(['YEAR_AT'=>$tanggal[0],'MONTH_AT'=>$tanggal[1],'STORE_ID'=>$retValid]);
									$searchModel->RPT_TITLE_ID = $model->RPT_TITLE_ID;
									$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

									return Yii::$app->controller->renderPartial('/arus-uang/index_detail',[
										'searchModel'=>$searchModel,
										'dataProvider'=>$dataProvider,
										'modelView'=>$dataProvider->getModels(),
										'store'=>$retValid
									]);
								},
								'defaultHeaderState'=>false,
								//'detailRowCssClass'=>'default',
								'detailRowCssClass'=>'info',
								'expandOneOnly'=>false,
								'expandIcon'=>'<span class="fa fa-file-text"></span>',
								'collapseIcon'=>'<span class="fa fa-file-text-o"></span>',
								//'enableRowClick'=>false,
							],   */      
							[
								'attribute' => 'RPT_TITLE_NM',
								'label' => false,	
								'group'=>true,
								'groupedRow'=>true,
								'groupOddCssClass'=>[
									'style'=>[
										'background-color'=>$colorHeaderGroup,
									]
								],		
								'groupEvenCssClass'=>[
									'style'=>[
										'background-color'=>$colorHeaderGroup,
									]
								],		
								'contentOptions'=>[
									'style'=>[
											'text-align'=>'left',
											'font-family'=>'font-family: verdana, arial, sans-serif',
											'font-weight'=>'bold',
											'font-size'=>'9pt',
											'background-color'=>$colorHeaderGroup,
											
									]
								],																			
								'groupFooter'=>function($model, $key, $index, $widget)use($footerColor){ 
									return [
										//'mergeColumns'=>[[1,1]], 
										'content'=>[             // content to show in each summary cell
											1=>'Jumlah',
											2=>GridView::F_SUM,
											3=>GridView::F_SUM,
										],
										'contentFormats'=>[     
											2=>['format'=>'number','decimals'=>2],
											3=>['format'=>'number','decimals'=>2]
										] 	,
										'contentOptions'=>[      // content html attributes for each summary cell
											1=>['style'=>'text-align:right;font-size:12px;'],
											2=>['style'=>'text-align:right;font-size:10px;text-decoration:underline'],
											3=>['style'=>'text-align:right;font-size:10px;text-decoration:underline'],
										],
										'options'=>[
											//'class'=>'warning',
											'style'=>'background-color:'.$footerColor.';font-weight:bold;font-size:10px;text-align:right;
										']
									];
								},								
							],
							[
								'attribute' => 'AKUN_NM',
								'label' => false,
								'format'=>'raw',
								'value'=>
								function($model)use($store,$cari){
									//$icon='<span class="fa fa fa-circle-o">  '.Html::a($model->AKUN_NM,'/laporan/arus-uang/detail-bulan?akunkode='.$model->AKUN_CODE.'&bulan='.$model->YEAR_AT.'-'.$model->MONTH_AT.'&store='.$store.'').' </span>';
									return Html::tag('div', $model['AKUN_NM'], ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;color:blue']);				
									// return Html::a($model['AKUN_NM'],'/laporan/arus-uang/detail-bulan-store?akunkode='.$model['AKUN_CODE'].'&bulan='.$cari['TAHUN'].'-'.$cari['BULAN'].'&store='.$store->STORE_ID.'');
								},	
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
								'attribute' => 'DEBET',
								'label' =>'PEMASUKAN',
								'format'=>['decimal', 2],									
								/* 'value'=>function($model){
									if ($model->CAL_FORMULA==0){ 		//MINUS
										return '('.number_format($model->JUMLAH,2).')';
									}elseif($model->CAL_FORMULA==1){ 	//PLUS
										return number_format($model->JUMLAH,2);
									}elseif($model->CAL_FORMULA==2){ 	//PERKALIAN
										return number_format($model->JUMLAH,2);
									}else{
										return number_format(0,2);
									}
									
								 },	 */
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
								'attribute' => 'KREDIT',
								'label' =>'PENGELUARAN',
								'format'=>['decimal', 2],									
								/* 'value'=>function($model){
									if ($model->CAL_FORMULA==0){ 		//MINUS
										return '('.number_format($model->JUMLAH,2).')';
									}elseif($model->CAL_FORMULA==1){ 	//PLUS
										return number_format($model->JUMLAH,2);
									}elseif($model->CAL_FORMULA==2){ 	//PERKALIAN
										return number_format($model->JUMLAH,2);
									}else{
										return number_format(0,2);
									}
									
								 },	 */
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

