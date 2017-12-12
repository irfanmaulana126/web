<?php
use kartik\helpers\Html;	
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\Request;
use yii\web\View;
use ptrnov\fusionchart\Chart;
use frontend\assets\AppAssetBackendBorder;
AppAssetBackendBorder::register($this);

use frontend\backend\dashboard\models\TransPenjualanHeaderSummaryDailySearch;
use frontend\backend\dashboard\models\TransPenjualanHeaderSummaryDaily;
use frontend\backend\laporan\models\RptDailyChartSearch;

		$searchModel = new RptDailyChartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$model=$dataProvider->getModels();
		
		// $searchModelDaily = new TransPenjualanHeaderSummaryDailySearch();
        // $dataProviderDaily = $searchModelDaily->search(['TGL'=>'2017-11-01']);
		$modelDaily= TransPenjualanHeaderSummaryDaily::find()
		->select('SUM(TOTAL_SALES) AS TOTAL_SALES,SUM(JUMLAH_TRANSAKSI) AS JUMLAH_TRANSAKSI,SUM(TOTAL_PRODUCT) AS TOTAL_PRODUCT')
		->where(['TGL'=>date("Y-m-d"),'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP']])->groupBy('ACCESS_GROUP')->one();
		// $modelDaily=$dataProviderDaily->getModels();
		// print_r($modelDaily);
		// die();

// $xaxis=0;
// $canvasEndY=200;

//global $xaxis;
//global $canvasEndY;


	$hourly3DaysTafik= Chart::Widget([
		'urlSource'=>'/dashboard/data/daily-transaksi',
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'msline',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'msline-sss-hour-3daystrafik',								//unix name render
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'265px',
		'chartOption'=>[				
			'caption'=>'Daily Customers Visits',			//Header Title
			'subCaption'=>'Custommer Call, Active Customer, Efictif Customer',			//Sub Title
			'xaxisName'=>'Parents',							//Title Bawah/ posisi x
			'yaxisName'=>'Total Child ', 					//Title Samping/ posisi y									
			'theme'=>'fint',								//Theme
			'is2D'=>"0",
			'showValues'=> "1",
			'palettecolors'=> "#583e78,#008ee4,#f8bd19,#e44a00,#6baa01,#ff2e2e",
			'bgColor'=> "#ffffff",							//color Background / warna latar 
			'showBorder'=> "0",								//border box outside atau garis kotak luar
			'showCanvasBorder'=> "0",						//border box inside atau garis kotak dalam	
		],
	]);	

	/* $weeklyTafik= Chart::Widget([
		'urlSource'=> url::base().'/dashboard/foodtown/weekly-sales',
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'column2d',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'mscolumn2d-sss-weekly-trafik',								//unix name render
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'160px',
		'chartOption'=>[				
			'caption'=>'Daily Customers Visits',			//Header Title
			'subCaption'=>'Custommer Call, Active Customer, Efictif Customer',			//Sub Title
			'xaxisName'=>'Parents',							//Title Bawah/ posisi x
			'yaxisName'=>'Total Child ', 					//Title Samping/ posisi y									
			'theme'=>'fint',								//Theme
			'is2D'=>"0",
			'showValues'=> "1",
			'palettecolors'=> "#583e78,#008ee4,#f8bd19,#e44a00,#6baa01,#ff2e2e",
			'bgColor'=> "#ffffff",							//color Background / warna latar 
			'showBorder'=> "0",								//border box outside atau garis kotak luar
			'showCanvasBorder'=> "0",						//border box inside atau garis kotak dalam	
		],
	]);	 */	

	//DISTRIBUTOR SALES PO
	$distSalesPo= Chart::Widget([
		'urlSource'=> '/dashboard/data/monthy-sales',
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'msline',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'msline-sales-monthly',								//unix name render
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'300px',
	]);	 
	//$loadingSpinner1=Spinner::widget(['id'=>'spn1-load-road','preset' => 'large', 'align' => 'center', 'color' => 'blue']);
	 

 $this->registerCss("
	.count-ptr
		{
		   color:black;
		}	
 ");
 
$this->registerJs("
	$('.count-grand-total-hari').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($modelDaily['TOTAL_SALES'])."');	//TOTAL_PENJUALAN
			}
		});
	});
	$('.count-trans-total-hari').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($modelDaily['JUMLAH_TRANSAKSI'])."');	//JUMLAH_TRANSAKSI
			}
		});
	});
	$('.rata-rata-penjualan').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($modelDaily['TOTAL_SALES'])."');	//RATA_RATA_PENJUALAN
			}
		});
	});
	$('.jumlah-produk').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($modelDaily['TOTAL_PRODUCT'])."');	//JUMLAH_PRODAK
			}
		});
	});
	$('.jumlah-karyawan').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($model[6]->Val_Cnt)."');	//JUMLAH_KARYAWAN
			}
		});
	});
	$('.jumlah-toko-aktif').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($model[4]->Val_Cnt)."');	//JUMLAH_TOKO_AKTIF
			}
		});
	});
",$this::POS_END);

?>
<div>  		
	<!-- KIRI !-->
	<div class="col-lg-3 col-md-3">
		<div class="row">		
			<div class="w3-card-2 w3-round w3-white w3-center">
				<div class="panel-heading">
					<div class="row" >
						<div class="col-lg-3">
							<span class="fa-stack fa-2x">
							  <i class="fa fa-circle fa-stack-2x" style="color:#64F298"></i>
							  <i class="fa fa-money fa-stack-1x" style="color:#FFFFFF"></i>
							</span>
						</div>						
						<div class="col-lg-9 text-left .small">
							<dl>
								
								<dt class="count-grand-total-hari" style="font-size:20px;color:#7e7e7e"><?=$model[0]->Val_Cnt?></dt>
								<dd style="font-size:11px;color:#7e7e7e">PENJUALAN HARIAN (IDR)</dd>
								
							</dl>							
						</div>
					</div>
				</div>	
			</div>	
			<br>
			<div class="w3-card-2 w3-round w3-white w3-center">
				<div class="panel-heading">
					<div class="row" >
						<div class="col-lg-3">
							<span class="fa-stack fa-2x">
							  <i class="fa fa-circle fa-stack-2x" style="color:#0ec1db"></i>
							  <i class="fa fa-dashboard fa-stack-1x" style="color:#FFFFFF"></i>
							</span>
						</div>						
						<div class="col-lg-9 text-left .small">
							<dl>
								<dt class="count-trans-total-hari" style="font-size:20px;color:#7e7e7e"><?=$model[1]->Val_Cnt?></dt>
								<dd style="font-size:11px;color:#7e7e7e">JUMLAH TRANSAKSI</dd>
							</dl>
							
						</div>
					</div>
				</div>	
			</div>	
			<br>
			<div class="w3-card-2 w3-round w3-white w3-center">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3">
							<span class="fa-stack fa-2x">
							  <i class="fa fa-circle fa-stack-2x" style="color:#64F298"></i>
							  <i class="fa fa-arrows-h fa-stack-1x" style="color:#FFFFFF"></i>
							</span>
						</div>						
						<div class="col-lg-9 text-left .small">
							<dl>
								<dt class="rata-rata-penjualan" style="font-size:20px;color:#7e7e7e"><?=$model[2]->Val_Cnt?></dt>
								<dd style="font-size:11px;color:#7e7e7e">RATA-RATA PENJUALAN (IDR)</dd>
							</dl>
							
						</div>
					</div>
				</div>	
			</div>						
		</div>
	</div>
	<!-- TENGAH !-->
	<div class="col-lg-7 col-md-7">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="w3-card-2 w3-round w3-white w3-center">
					<div class="panel-heading">
						<div class="row">
							<div style="min-height:265px"><div style="height:265px"><?=$hourly3DaysTafik?></div></div><div class="clearfix"></div>
						</div>
					</div>	
				</div>				
		</div>				
	</div>	
	<!-- KANAN !-->
	<div class="col-lg-2 col-md-2" style="margin-top:-15px">
		<div class="row">		
			<br>			
			<div class="w3-card-2 w3-round w3-white w3-center">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3">
							<span class="fa-stack fa-2x">
							  <i class="fa fa-circle fa-stack-2x" style="color:red"></i>
							  <i class="fa fa-laptop fa-stack-1x" style="color:#FFFFFF"></i>
							</span>
						</div>						
						<div class="col-lg-9 text-left .small">
							<dl>
								<dt class="jumlah-toko-aktif" style="font-size:18px;color:#7e7e7e;float:left;padding-right:10px"><?=$model[4]->Val_Cnt?></dt> 
								<div style="font-size:18px;color:#7e7e7e;font-weight: bold;"> of <?=(int)$model[3]->Val_Cnt?></div>
								<dd style="font-size:10px;color:#7e7e7e">JUMLAH TOKO</dd>
							</dl>
							
						</div>
					</div>
				</div>	
			</div>	
			<br>	
			<div class="w3-card-2 w3-round w3-white w3-center">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3">
							<span class="fa-stack fa-2x">
							  <i class="fa fa-circle fa-stack-2x" style="color:yellow"></i>
							  <i class="fa fa-cubes fa-stack-1x" style="color:black"></i>
							</span>
						</div>						
						<div class="col-lg-9 text-left .small">
							<dl>
								<dt class="jumlah-produk" style="font-size:18px;color:#7e7e7e"><?=$model[5]->Val_Cnt?></dt>
								<dd style="font-size:10px;color:#7e7e7e">   JUMLAH PRODUK</dd>
							</dl>
							
						</div>
					</div>
				</div>	
			</div>
			<br>			
			<div class="w3-card-2 w3-round w3-white w3-center">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3">
							<span class="fa-stack fa-2x">
							  <i class="fa fa-circle fa-stack-2x" style="color:#64F298"></i>
							  <i class="fa fa-users fa-stack-1x" style="color:#FFFFFF"></i>
							</span>
						</div>						
						<div class="col-lg-9 text-left .small">
							<dl>
								<dt class="jumlah-karyawan" style="font-size:18px;color:#7e7e7e"><?=$model[6]->Val_Cnt?></dt>
								<dd style="font-size:10px;color:#7e7e7e">JUMLAH KARYAWAN</dd>
							</dl>
							
						</div>
					</div>
				</div>	
			</div>	
			<br>			
		</div>
		<br>
	</div>
	<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:0px">
		<div class="panel-heading ">
			<div class="row">
				<div style="min-height:300px"><?php //$loadingSpinner1?><div style="height:300px"><?=$distSalesPo?></div></div><div class="clearfix"></div>
			</div>
		</div>	
	</div>			
</div>