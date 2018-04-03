<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use ptrnov\fusionchart\Chart;
use ptrnov\fusionchart\ChartAsset;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use kartik\widgets\Growl;
use yii\web\View;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use frontend\assets\AppAssetBackendBorder;
use common\models\Store;
use yii\widgets\Breadcrumbs;

	AppAssetBackendBorder::register($this);
	ChartAsset::register($this);
	
	$this->title = 'penjualan-harian';
	$this->params['breadcrumbs'][] = ['label'=>$this->title, 'url' => ['//dashboard/penjualan-harian']];
	$vewBreadcrumb=Breadcrumbs::widget([
		'homeLink' => [
			'label' => Html::encode(Yii::t('yii', 'Dashboard')),
			'url' => Yii::$app->homeUrl,
		],
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]);

	$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
	$btn_srchChart1=DatePicker::widget([
		'name' => 'check_issue_date', 
		'options' => ['placeholder' => 'Pilih Tanggal ...','id'=>'tanggal'],
		'convertFormat' => true,
		'pluginOptions' => [
			'autoclose'=>true,
			//'startView'=>'month',
			//'minViewMode'=>'months',
			'format' => 'yyyy-M-d',
			// 'todayHighlight' => true,
			 'todayHighlight' => true
		]
	]);
	$dataStore=Store::find()->select('STORE_ID,STORE_NM')->where(['ACCESS_GROUP'=>$user])->orderBy(['STORE_ID'=>SORT_ASC])->all();
	$aryStore[]=['STORE_ID'=>$user,'STORE_NM'=>'ALL'];
	foreach ($dataStore as $row){
		$aryStore[]=['STORE_ID'=>$row->STORE_ID,'STORE_NM'=>$row->STORE_NM];
	}
		
	$btn_srchChart2= Select2::widget([
		'name' => 'state_10',
		'data' =>  ArrayHelper::map($aryStore,'STORE_ID','STORE_NM'),
		'options' => ['placeholder' => 'Pilih Toko ...','id'=>'store'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]);
	
	function tombolKembali(){
		$title= Yii::t('app','');
		$url = Url::toRoute(['/dashboard']);
		$options1 = [
					'id'=>'back-trafik',
					'class'=>"btn btn-xs",
					'title'=>'Kembali Chart Awal'
		];
		$icon1 = '<span class="fa-stack fa-md text-left">
				  <b class="fa fa-circle fa-stack-2x" style="color:black"></b>
				  <b class="fa fa fa fa-mail-reply fa-stack-1x" style="color:white"></b>
				</span>
		';
		$label1 = $icon1.' '.$title ;
		$content = Html::a($label1,$url,$options1);
		return $content;	
	}
	$icon2 = '<span class="fa fa-md fa fa-chevron-right text-left"></span>';
	
	//==== COMBINASI colum2d Mscombidy2d
	$viewDetailSalesHarian= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/sales-charts/detail-sales-harian',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),
		],
		'type'=>'mscombidy2d',						
		'renderid'=>'detailsales-harian',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'300px',
	]);	
	
	//==== DONAT CHART - PEMBAYARAN TUNAN/NON-TUNAI HARIAN==
	$viewTunaiNonTunai= Chart::Widget([
		//'urlSource'=> 'https://production.kontrolgampang.com/laporan/contoh-charts/doughnut3d',
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/sales-charts/detail-sales-harian-tunai',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),
		],
		'type'=>'doughnut3d',						
		'renderid'=>'viewtunan-nontunai-harian',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'250px',
	]);	
	
	//==== PIE CHART - TRANSAKSI BANK HARIAN==
	$viewTransaksiBank= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/contoh-charts/pie3d',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'THN'=>date("Y-m-d"),
		],
		'type'=>'pie3d',						
		'renderid'=>'transaksi-bank-harian',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'250px',
	]);	
	
?>

<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt;">	
		<div class="col-sm-12 col-md-12 col-lg-12">		
			<div class="row">
				<div style="float:left">
					<?php //echo 'dashboard '.'<span class="fa fa-md fa fa-chevron-right text-left"></span>'.' '.Yii::$app->controller->id;?>
				</div>
				
				<div class="pull-left" style="padding-left:10px;font-size:15px;color:#7e7e7e;float:left'">
					<!--<a href="https://www.w3schools.com">Rincian Per-Toko</a>!-->
				</div>
				<h5><?=$vewBreadcrumb ?></h5>
				<div class="col-sm-12 col-md-12 col-lg-12 pull-right"  style='float:left'>					
						<div class="pull-right" style='padding-bottom:3px;width:200px;float:left'><?=$btn_srchChart1?></div>
						<div class="pull-right" style='padding-bottom:3px;width:200px;float:left;padding-left:5px'><?=$btn_srchChart2?></div>									
				</div>	
			
			</div>	
			<div class="row">
				<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
					<?php //echo = Html::encode($this->title) ?>								
					<div style="min-height:265px">
						<div style="height:300px;">
							<?=$viewDetailSalesHarian ?>
						</div>
					</div>
								
				</div>		
			</div>					
			<div class="row">
				<div class="col-sm-4 col-md-4 col-lg-4">
					<div class="row">
						<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
							<div style="min-height:265px">
								<div style="height:300px;">
									<div style="padding-top:50px">
										<?=$viewTunaiNonTunai?>
									</div>
								</div>
							</div>
						</div>								
					</div>								
				</div>				
				<div class="col-sm-8 col-md-8 col-lg-8">	
					<div class="row">
						<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
							<div style="min-height:265px">
								<div style="height:300px;">
									<div style="padding-top:10px">
										<?=$viewTransaksiBank ?>
									</div>
								</div>
							</div>
						</div>	
					</div>	
				</div>
			</div>			
		</div>
</div>
<div id="loaderPtr"></div>
<?php
$this->registerJs("
		$('#tanggal, #store').change(function() { 
			// ==FILTER DATA ==
			var tgl,storeId,accessGroup='';
			var tgl = document.getElementById('tanggal').value;
			var storeId = document.getElementById('store').value;
			var store = storeId.split('.');
			var accessGroup = store[0];
			//console.log('ACCESS_GROUP='+accessGroup+';STORE_ID='+storeId+';TGL='+tgl);
			
			if ((tgl!=='') && (storeId!=='')) {
				
				//=== SALES DETAI HARIAN ===
				var ptrProdukQtyTop = document.getElementById('detailsales-harian');
				var spnIdProdukQtyTop= ptrProdukQtyTop.getElementsByTagName('span');
				var chartIdProdukQtyTop= spnIdProdukQtyTop[0].id; 
				//console.log(ptrProdukQtyTop);
				var updateChartProdukQtyTop = document.getElementById(chartIdProdukQtyTop);
				//==AJAX POST DATA [PRODUK TRANSAKSI]===
				$.ajax({
					  url: 'https://production.kontrolgampang.com/laporan/sales-charts/detail-sales-harian',
					  type: 'POST',
					  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl},
					  dataType:'json',
					  success: function(data) {
							//alert(data['dataset'][0]['data']);
							//console.log(data['dataset'][0]['data']);
							//=== RESIZE ===
							//var dataget =data['dataset'][0]['data'];				
							//alert(dataget.length);
							//var cnt=dataget.length<5?5:dataget.length;
							//alert(cnt);
							//updateChartProdukQtyTop.style.height=(cnt*30)+'px';
							
							//===UPDATE CHART ====
							if (data['dataset'][0]['data']!==''){							
								updateChartProdukQtyTop.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									dataset: data['dataset']
								});	
							}else{
								updateChartProdukQtyTop.style.height='150px';
								updateChartProdukQtyTop.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									data:[{}]
								});						
							}					
					  }			   
				}); 
			};     
		});
	",View::POS_READY);
?>
