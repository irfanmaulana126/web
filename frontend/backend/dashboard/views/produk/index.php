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
	
	$this->title = 'produk';
	$this->params['breadcrumbs'][] = ['label'=>$this->title, 'url' => ['/dashboard/produk']];
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
	$icon2 = '<span class="fa fa-md fa fa-chevron-right text-left"></span>';
	
	//==== BAR AND STAKE CHART ==
	// $viewStackedbar2d= Chart::Widget([
		// 'urlSource'=> 'https://production.kontrolgampang.com/laporan/contoh-charts/stackedbar2d',
		// 'metode'=>'POST',
		// 'param'=>[
			// 'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			// 'THN'=>date("Y"),
		// ],
		// 'type'=>'stackedbar2d',						
		// 'renderid'=>'stackedbar2d-bulanan_id1',				
		// 'autoRender'=>true,
		// 'width'=>'100%',
		// 'height'=>'250px',
	// ]);	
	
	/* =======  MONTHLY ==========
	 * === BAR AND STAKE CHART ===
	 * === Top 10 Produk  QTY  ===
	 *============================
	*/
	$viewMonthTop10Qty= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/produk-charts/bulanan-top-produk',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),//'2018-03-01',
			'PILIH'=>'QTY',
		],
		'type'=>'stackedbar2d',						
		'renderid'=>'month-top10-qty',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'350px',
	]);		
	/* =============   MONTHLY   ==============
	 * === 		BAR AND STAKE CHART 		===
	 * === Top 10 Produk  HPP & HARGA JUAL  ===
	 *=========================================
	*/
	$viewMonthTop10HppJual= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/produk-charts/bulanan-top-produk',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),//'2018-03-01',
			'PILIH'=>'HPPJUAL',
		],
		'type'=>'stackedbar2d',						
		'renderid'=>'month-top10-hppjual',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'350px',
	]);	
	
	/* ========  WEEKLY  =========
	 * === BAR AND STAKE CHART ===
	 * === Top 10 Produk  QTY  ===
	 *============================
	*/
	$viewWeekTop10Qty= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/produk-charts/mingguan-top-produk',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),//'2018-03-01',
			'PILIH'=>'QTY',
		],
		'type'=>'stackedbar2d',						
		'renderid'=>'week-top10-qty',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'350px',
	]);		
	/* =============   WEEKLY   ==============
	 * === 		BAR AND STAKE CHART 		===
	 * === Top 10 Produk  HPP & HARGA JUAL  ===
	 *=========================================
	*/
	$viewWeekTop10HppJual= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/produk-charts/mingguan-top-produk',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),//'2018-03-01',
			'PILIH'=>'HPPJUAL',
		],
		'type'=>'stackedbar2d',						
		'renderid'=>'week-top10-hppjual',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'350px',
	]);	
	
	/* ========== DAILY ==========
	 * === BAR AND STAKE CHART ===
	 * === Top 10 Produk  QTY  ===
	 *============================
	*/
	$viewDailyTop10Qty= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/produk-charts/harian-top-produk',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),//'2018-03-01',
			'PILIH'=>'QTY',
		],
		'type'=>'stackedbar2d',						
		'renderid'=>'day-top10-qty',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'350px',
	]);		
	/* ==============   DAILY   ===============
	 * === 		BAR AND STAKE CHART 		===
	 * === Top 10 Produk  HPP & HARGA JUAL  ===
	 *=========================================
	*/
	$viewDailyTop10HppJual= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/produk-charts/harian-top-produk',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),//'2018-03-01',
			'PILIH'=>'HPPJUAL',
		],
		'type'=>'stackedbar2d',						
		'renderid'=>'day-top10-hppjual',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'350px',
	]);	
		
	/* ======== LEVEL BUFFER PRODUK QTY =======
	 * === 		BAR AND STAKE CHART 		===
	 * === Top 10 Produk  HPP & HARGA JUAL  ===
	 *=========================================
	*/
	$viewLeverBufferProdukQty= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/produk-charts/level-buffer-produk',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),//'2018-03-01',
			'PILIH'=>'QTY',
		],
		'type'=>'stackedbar2d',						
		'renderid'=>'level-buffer-produk-qty',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'350px',
	]);	
	/* ===== LEVEL BUFFER PRODUK HPP&HARGAJUAL =====
	 * === 		   BAR AND STAKE CHART 	  		 ===
	 * === 	 Top 10 Produk  HPP & HARGA JUAL     ===
	 * =============================================
	*/
	$viewLeverBufferProdukHppJual= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/produk-charts/level-buffer-produk',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],
			'TGL'=>date("Y-m-d"),//'2018-03-01',
			'PILIH'=>'HPPJUAL',
		],
		'type'=>'stackedbar2d',						
		'renderid'=>'level-buffer-produk-hppjual',				
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'350px',
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
			<!-- TOP PRODUK - MONTHLY !-->
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-6">
					<div class="row">
						<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
							<div style="min-height:265px">
								<div style="height:350px;">
									<div style="padding-top:0px">
										<?=$viewMonthTop10Qty?>
									</div>
								</div>
							</div>
						</div>								
					</div>								
				</div>				
				<div class="col-sm-6 col-md-6 col-lg-6">
					<div class="row">
						<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
							<div style="min-height:265px">
								<div style="height:350px;">
									<div style="padding-top:0px">
										<?=$viewMonthTop10HppJual?>
									</div>
								</div>
							</div>
						</div>								
					</div>								
				</div>					
			</div>	
			<!-- TOP PRODUK - WEEKLY !-->
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-6">
					<div class="row">
						<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
							<div style="min-height:265px">
								<div style="height:350px;">
									<div style="padding-top:0px">
										<?=$viewWeekTop10Qty?>
									</div>
								</div>
							</div>
						</div>								
					</div>								
				</div>				
				<div class="col-sm-6 col-md-6 col-lg-6">
					<div class="row">
						<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
							<div style="min-height:265px">
								<div style="height:350px;">
									<div style="padding-top:0px">
										<?=$viewWeekTop10HppJual?>
									</div>
								</div>
							</div>
						</div>								
					</div>								
				</div>					
			</div>	
			<!-- TOP PRODUK - DAILY !-->
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-6">
					<div class="row">
						<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
							<div style="min-height:265px">
								<div style="height:350px;">
									<div style="padding-top:0px">
										<?=$viewDailyTop10Qty?>
									</div>
								</div>
							</div>
						</div>								
					</div>								
				</div>				
				<div class="col-sm-6 col-md-6 col-lg-6">
					<div class="row">
						<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
							<div style="min-height:265px">
								<div style="height:350px;">
									<div style="padding-top:0px">
										<?=$viewDailyTop10HppJual?>
									</div>
								</div>
							</div>
						</div>								
					</div>								
				</div>					
			</div>		
			<!-- LEVEL BUFFER PRODUK!-->
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-6">
					<div class="row">
						<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
							<div style="min-height:265px">
								<div style="height:350px;">
									<div style="padding-top:0px">
										<?=$viewLeverBufferProdukQty?>
									</div>
								</div>
							</div>
						</div>								
					</div>								
				</div>				
				<div class="col-sm-6 col-md-6 col-lg-6">
					<div class="row">
						<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
							<div style="min-height:265px">
								<div style="height:350px;">
									<div style="padding-top:0px">
										<?=$viewLeverBufferProdukHppJual?>
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
				
				//=== MONTHLY TOP 100 QTY ===
				var ptrProdukQtyTop = document.getElementById('month-top10-qty');
				var spnIdProdukQtyTop= ptrProdukQtyTop.getElementsByTagName('span');
				var chartIdProdukQtyTop= spnIdProdukQtyTop[0].id; 
				//console.log(ptrProdukQtyTop);
				var updateChartProdukQtyTop = document.getElementById(chartIdProdukQtyTop);
				//==AJAX POST DATA [PRODUK TRANSAKSI]===
				$.ajax({
					  url: 'https://production.kontrolgampang.com/laporan/produk-charts/bulanan-top-produk',
					  type: 'POST',
					  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl,'PILIH':'QTY'},
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
				
				//=== MONTHLY TOP 100 HPP & HARGA JUAL ===
				var ptrProdukQtyTopHppJual = document.getElementById('month-top10-hppjual');
				var spnIdProdukQtyTopHppJual= ptrProdukQtyTopHppJual.getElementsByTagName('span');
				var chartIdProdukQtyTopHppJual= spnIdProdukQtyTopHppJual[0].id; 
				//console.log(ptrProdukQtyTopHppJual);
				var updateChartProdukQtyTopHppJual = document.getElementById(chartIdProdukQtyTopHppJual);
				//==AJAX POST DATA [PRODUK TRANSAKSI]===
				$.ajax({
					  url: 'https://production.kontrolgampang.com/laporan/produk-charts/bulanan-top-produk',
					  type: 'POST',
					  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl,'PILIH':'HPPJUAL'},
					  dataType:'json',
					  success: function(data) {
							//alert(data['dataset'][0]['data']);
							//console.log(data['dataset'][0]['data']);
							//=== RESIZE ===
							//var dataget =data['dataset'][0]['data'];				
							//alert(dataget.length);
							//var cnt=dataget.length<5?5:dataget.length;
							//alert(cnt);
							//updateChartProdukQtyTopHppJual.style.height=(cnt*30)+'px';
							
							//===UPDATE CHART ====
							if (data['dataset'][0]['data']!==''){							
								updateChartProdukQtyTopHppJual.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									dataset: data['dataset']
								});	
							}else{
								updateChartProdukQtyTopHppJual.style.height='150px';
								updateChartProdukQtyTopHppJual.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									data:[{}]
								});						
							}					
					  }			   
				}); 
				
				//=== WEEKLY TOP 100 QTY ===
				var ptrWeekProdukQtyTop = document.getElementById('week-top10-qty');
				var spnIdWeekProdukQtyTop= ptrWeekProdukQtyTop.getElementsByTagName('span');
				var chartIdWeekProdukQtyTop= spnIdWeekProdukQtyTop[0].id; 
				//console.log(ptrWeekProdukQtyTop);
				var updateWeekChartProdukQtyTop = document.getElementById(chartIdWeekProdukQtyTop);
				//==AJAX POST DATA [PRODUK TRANSAKSI]===
				$.ajax({
					  url: 'https://production.kontrolgampang.com/laporan/produk-charts/mingguan-top-produk',
					  type: 'POST',
					  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl,'PILIH':'QTY'},
					  dataType:'json',
					  success: function(data) {
							//alert(data['dataset'][0]['data']);
							//console.log(data['dataset'][0]['data']);
							//=== RESIZE ===
							//var dataget =data['dataset'][0]['data'];				
							//alert(dataget.length);
							//var cnt=dataget.length<5?5:dataget.length;
							//alert(cnt);
							//updateWeekChartProdukQtyTop.style.height=(cnt*30)+'px';
							
							//===UPDATE CHART ====
							if (data['dataset'][0]['data']!==''){							
								updateWeekChartProdukQtyTop.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									dataset: data['dataset']
								});	
							}else{
								updateWeekChartProdukQtyTop.style.height='150px';
								updateWeekChartProdukQtyTop.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									data:[{}]
								});						
							}					
					  }			   
				}); 
				
				//=== WEEKLY TOP 100 HPP & HARGA JUAL ===
				var ptrWeekProdukQtyTopHppJual = document.getElementById('week-top10-hppjual');
				var spnIdWeekProdukQtyTopHppJual= ptrWeekProdukQtyTopHppJual.getElementsByTagName('span');
				var chartIdWeekProdukQtyTopHppJual= spnIdWeekProdukQtyTopHppJual[0].id; 
				//console.log(ptrWeekProdukQtyTopHppJual);
				var updateWeekChartProdukQtyTopHppJual = document.getElementById(chartIdWeekProdukQtyTopHppJual);
				//==AJAX POST DATA [PRODUK TRANSAKSI]===
				$.ajax({
					  url: 'https://production.kontrolgampang.com/laporan/produk-charts/mingguan-top-produk',
					  type: 'POST',
					  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl,'PILIH':'HPPJUAL'},
					  dataType:'json',
					  success: function(data) {
							//alert(data['dataset'][0]['data']);
							//console.log(data['dataset'][0]['data']);
							//=== RESIZE ===
							//var dataget =data['dataset'][0]['data'];				
							//alert(dataget.length);
							//var cnt=dataget.length<5?5:dataget.length;
							//alert(cnt);
							//updateWeekChartProdukQtyTopHppJual.style.height=(cnt*30)+'px';
							
							//===UPDATE CHART ====
							if (data['dataset'][0]['data']!==''){							
								updateWeekChartProdukQtyTopHppJual.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									dataset: data['dataset']
								});	
							}else{
								updateWeekChartProdukQtyTopHppJual.style.height='150px';
								updateWeekChartProdukQtyTopHppJual.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									data:[{}]
								});						
							}					
					  }			   
				}); 
				
				//=== DAILY TOP 100 QTY ===
				var ptrDayProdukQtyTop = document.getElementById('day-top10-qty');
				var spnIdDayProdukQtyTop= ptrDayProdukQtyTop.getElementsByTagName('span');
				var chartIdDayProdukQtyTop= spnIdDayProdukQtyTop[0].id; 
				//console.log(ptrDayProdukQtyTop);
				var updateDayChartProdukQtyTop = document.getElementById(chartIdDayProdukQtyTop);
				//==AJAX POST DATA [PRODUK TRANSAKSI]===
				$.ajax({
					  url: 'https://production.kontrolgampang.com/laporan/produk-charts/harian-top-produk',
					  type: 'POST',
					  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl,'PILIH':'QTY'},
					  dataType:'json',
					  success: function(data) {
							//alert(data['dataset'][0]['data']);
							//console.log(data['dataset'][0]['data']);
							//=== RESIZE ===
							//var dataget =data['dataset'][0]['data'];				
							//alert(dataget.length);
							//var cnt=dataget.length<5?5:dataget.length;
							//alert(cnt);
							//updateDayChartProdukQtyTop.style.height=(cnt*30)+'px';
							
							//===UPDATE CHART ====
							if (data['dataset'][0]['data']!==''){							
								updateDayChartProdukQtyTop.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									dataset: data['dataset']
								});	
							}else{
								updateDayChartProdukQtyTop.style.height='150px';
								updateDayChartProdukQtyTop.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									data:[{}]
								});						
							}					
					  }			   
				}); 
				
				//=== DAILY TOP 100 HPP & HARGA JUAL ===
				var ptrDayProdukQtyTopHppJual = document.getElementById('day-top10-hppjual');
				var spnIdDayProdukQtyTopHppJual= ptrDayProdukQtyTopHppJual.getElementsByTagName('span');
				var chartIdDayProdukQtyTopHppJual= spnIdDayProdukQtyTopHppJual[0].id; 
				//console.log(ptrDayProdukQtyTopHppJual);
				var updateDayChartProdukQtyTopHppJual = document.getElementById(chartIdDayProdukQtyTopHppJual);
				//==AJAX POST DATA [PRODUK TRANSAKSI]===
				$.ajax({
					  url: 'https://production.kontrolgampang.com/laporan/produk-charts/harian-top-produk',
					  type: 'POST',
					  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl,'PILIH':'HPPJUAL'},
					  dataType:'json',
					  success: function(data) {
							//alert(data['dataset'][0]['data']);
							//console.log(data['dataset'][0]['data']);
							//=== RESIZE ===
							//var dataget =data['dataset'][0]['data'];				
							//alert(dataget.length);
							//var cnt=dataget.length<5?5:dataget.length;
							//alert(cnt);
							//updateDayChartProdukQtyTopHppJual.style.height=(cnt*30)+'px';
							
							//===UPDATE CHART ====
							if (data['dataset'][0]['data']!==''){							
								updateDayChartProdukQtyTopHppJual.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									dataset: data['dataset']
								});	
							}else{
								updateDayChartProdukQtyTopHppJual.style.height='150px';
								updateDayChartProdukQtyTopHppJual.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									data:[{}]
								});						
							}					
					  }			   
				}); 
				
				//=== LEVEL BUFFER PRODUK QTY ===
				var ptrLBufferProdukQty = document.getElementById('level-buffer-produk-qty');
				var spnIdLBufferProdukQty= ptrLBufferProdukQty.getElementsByTagName('span');
				var chartIdLBufferProdukQty= spnIdLBufferProdukQty[0].id; 
				//console.log(ptrLBufferProdukQty);
				var updateLBufferChartProdukQty = document.getElementById(chartIdLBufferProdukQty);
				//==AJAX POST DATA [PRODUK TRANSAKSI]===
				$.ajax({
					  url: 'https://production.kontrolgampang.com/laporan/produk-charts/level-buffer-produk',
					  type: 'POST',
					  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl,'PILIH':'QTY'},
					  dataType:'json',
					  success: function(data) {
							//alert(data['dataset'][0]['data']);
							//console.log(data['dataset'][0]['data']);
							//=== RESIZE ===
							//var dataget =data['dataset'][0]['data'];				
							//alert(dataget.length);
							//var cnt=dataget.length<5?5:dataget.length;
							//alert(cnt);
							//updateLBufferChartProdukQty.style.height=(cnt*30)+'px';
							
							//===UPDATE CHART ====
							if (data['dataset'][0]['data']!==''){							
								updateLBufferChartProdukQty.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									dataset: data['dataset']
								});	
							}else{
								updateLBufferChartProdukQty.style.height='150px';
								updateLBufferChartProdukQty.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									data:[{}]
								});						
							}					
					  }			   
				}); 
				
				//=== LEVEL BUFFER PRODUK HPP & HARGA JUAL ===
				var ptrLBufferProdukQtyHppJual = document.getElementById('level-buffer-produk-hppjual');
				var spnIdLBufferProdukQtyHppJual= ptrLBufferProdukQtyHppJual.getElementsByTagName('span');
				var chartIdLBufferProdukQtyHppJual= spnIdLBufferProdukQtyHppJual[0].id; 
				//console.log(ptrLBufferProdukQtyHppJual);
				var updateLBufferChartProdukQtyHppJual = document.getElementById(chartIdLBufferProdukQtyHppJual);
				//==AJAX POST DATA [PRODUK TRANSAKSI]===
				$.ajax({
					  url: 'https://production.kontrolgampang.com/laporan/produk-charts/level-buffer-produk',
					  type: 'POST',
					  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl,'PILIH':'HPPJUAL'},
					  dataType:'json',
					  success: function(data) {
							//alert(data['dataset'][0]['data']);
							//console.log(data['dataset'][0]['data']);
							//=== RESIZE ===
							//var dataget =data['dataset'][0]['data'];				
							//alert(dataget.length);
							//var cnt=dataget.length<5?5:dataget.length;
							//alert(cnt);
							//updateLBufferChartProdukQtyHppJual.style.height=(cnt*30)+'px';
							
							//===UPDATE CHART ====
							if (data['dataset'][0]['data']!==''){							
								updateLBufferChartProdukQtyHppJual.setChartData({
									chart: data['chart'],
									categories: data['categories'],
									dataset: data['dataset']
								});	
							}else{
								updateLBufferChartProdukQtyHppJual.style.height='150px';
								updateLBufferChartProdukQtyHppJual.setChartData({
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