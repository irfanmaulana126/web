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
	
	$this->title = 'penjualan bulanan';
	$this->params['breadcrumbs'][] = ['label'=>$this->title, 'url' => ['/dashboard/penjualan-bulanan']];
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
			'startView'=>'month',
			'minViewMode'=>'months',
			'format' => 'yyyy-M-d',
			// 'todayHighlight' => true,
			 //'todayHighlight' => true
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
	$icon2 = '<span class="fa fa-md fa fa-chevron-right text-left"></span>';
	
	//==== COMBINASI colum2d Mscombidy2d
	$viewDetailSalesBulanan= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/sales-charts/detail-sales-bulanan',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),
		],
		'type'=>'mscombidy2d',						
		'renderid'=>'detail-sales-bulanan',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'300px',
	]);	
	//==== PIE CHART ==
	$viewPie3d= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/contoh-charts/pie3d',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'THN'=>date("Y"),
		],
		'type'=>'pie3d',						
		'renderid'=>'pie3d-bulanan_id1',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'250px',
	]);	
	
	//==== DONAT CHART ==
	$viewDoughnut3d= Chart::Widget([
		//'urlSource'=> 'https://production.kontrolgampang.com/laporan/contoh-charts/doughnut3d',
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/sales-charts/detail-sales-bulanan-tunai',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),
		],
		'type'=>'doughnut3d',						
		'renderid'=>'viewDoughnut3d-bulanan_id1',				
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
							<?=$viewDetailSalesBulanan ?>
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
										<?=$viewDoughnut3d?>
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
										<?=$viewPie3d ?>
									</div>
								</div>
							</div>
						</div>	
					</div>	
				</div>
			</div>			
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12" style="padding-bottom:10px;">
			<div class="row">
				
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div style="min-height:300px">
								<div class="row" style="padding-top:10px;padding-right:10px">
									<div class="w3-card-2 w3-round w3-white w3-center">	
										<?php "data2"; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div style="min-height:100px">
								<div class="row" style="padding-top:10px">
									<div class="w3-card-2 w3-round w3-white w3-center">	
										<?php "data3"; ?>
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
				var ptrProdukQtyTop = document.getElementById('detail-sales-bulanan');
				var spnIdProdukQtyTop= ptrProdukQtyTop.getElementsByTagName('span');
				var chartIdProdukQtyTop= spnIdProdukQtyTop[0].id; 
				//console.log(ptrProdukQtyTop);
				var updateChartProdukQtyTop = document.getElementById(chartIdProdukQtyTop);
				//==AJAX POST DATA [PRODUK TRANSAKSI]===
				$.ajax({
					  url: 'https://production.kontrolgampang.com/laporan/sales-charts/detail-sales-bulanan',
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