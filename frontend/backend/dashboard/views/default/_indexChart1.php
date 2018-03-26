<?php
use kartik\helpers\Html;	
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\Request;
use yii\web\View;
use GuzzleHttp\Client;
//use GuzzleHttp\RequestOptions;

use ptrnov\fusionchart\Chart;
use frontend\assets\AppAssetBackendBorder;
AppAssetBackendBorder::register($this);

	$hourly3DaysTafik= Chart::Widget([
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/frek-trans-day-group',
		'metode'=>'POST',
		'param'=>[
			//'ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,//'170726220936',
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],//'170726220936',
			'TGL'=>date("Y-m-d"),//'2018-03-13'
		],
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
	
	//=MONTHLY SALES
	$monthlySales= Chart::Widget([
		//'urlSource'=> '/dashboard/data/monthy-sales',
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/sales-charts/sales-bulanan-group',
		'metode'=>'POST',
		'param'=>[
			//'ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,//'170726220936',
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],//'170726220936',
			'THN'=>date("Y"),//'2018-02-27'
		],
		// 'urlSource'=> '/dashboard/data/monthy-sales?ACCESS_GROUP=170726220936&TAHUN=2018&BULAN=1',
		// 'urlSource'=> '/dashboard/data/test?ACCESS_GROUP=170726220936&TAHUN=2018&BULAN=1',
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'msline',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'msline-sales-monthly',								//unix name render
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'300px',
	]);	
	
	//=WEEKLY SALES
	$weeklySales= Chart::Widget([
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/sales-charts/sales-mingguan-group',
		'metode'=>'POST',
		'param'=>[
			//'ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,//'170726220936',
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],//'170726220936',
			'BULAN'=>date("m"),
			'TAHUN'=>date("Y")
		],
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'msline',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'msline-sales-weekly',								//unix name render
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
 $produkCnt=100;
 
//data: {'ACCESS_GROUP':'".Yii::$app->user->identity->ACCESS_GROUP."'},
$this->registerJs("
	$(document).ready(function (){
		// var data1 = '170726220936';
		// var form = new FormData();
		// form.append('ACCESS_GROUP', '170726220936');		
		var jsonDataCnt = $.ajax({
			url: 'https://production.kontrolgampang.com/laporan/counters/per-access-group',
			type: 'POST',
			data: {'ACCESS_GROUP':'".Yii::$app->getUserOpt->user()['ACCESS_GROUP']."'},
			dataType:'json',
			async: false,
		    global: false			
		}).responseText;	
		var myDataChart= JSON.parse(jsonDataCnt);
		var fieldData =myDataChart['PER_ACCESS_GROUP'][0];
		//console.log(fieldData['ACCESS_GROUP']);

		//=== COUNT JUMLAH_PRODAK ===
		document.getElementById('jumlah-produk-id').innerHTML=fieldData['CNT_PRODUK'];
		$('.jumlah-produk').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldData['CNT_PRODUK']);	
				}
			});
		});
		
		//==== COUNT JUMLAH_KARYAWAN =====
		document.getElementById('jumlah-karyawan-id').innerHTML=fieldData['CNT_KARYAWAN'];
		$('.jumlah-karyawan').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldData['CNT_KARYAWAN']);	
				}
			});		
		});
		
		//==== COUNT JUMLAH_KARYAWAN AKTIF=====
		document.getElementById('jumlah-karyawan-aktif-id').innerHTML=fieldData['CNT_KARYAWAN_AKTIF'];
		$('.jumlah-karyawan-aktif').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldData['CNT_KARYAWAN_AKTIF']);	
				}
			});
		});
		
		//==== COUNT JUMLAH CUSTOMER =====
		document.getElementById('jumlah-customer-id').innerHTML=fieldData['CNT_CUS_MEMBER'];
		$('.jumlah-customer').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldData['CNT_CUS_MEMBER']);	
				}
			});
		});
		
		//==== COUNT JUMLAH_TOKO =====
		document.getElementById('jumlah-toko-id').innerHTML=fieldData['CNT_STORE'];
		$('.jumlah-toko').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldData['CNT_STORE']);		
				}
			});
		});
		//==== COUNT JUMLAH_TOKO_AKTIF =====
		document.getElementById('jumlah-toko-aktif-id').innerHTML=fieldData['CNT_STORE_AKTIF'];
		$('.jumlah-toko-aktif').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldData['CNT_STORE_AKTIF']);		
				}
			});
		});
		//==== COUNT JUMLAH PERANGKAT TOKO_AKTIF =====
		document.getElementById('jumlah-perangkat-aktif-id').innerHTML=fieldData['CNT_PERNGKAT_AKTIF'];
		$('.jumlah-perangkat-aktif').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldData['CNT_PERNGKAT_AKTIF']);
				}
			});
		});
	
		//==== COUNT TRAFIK TRANSAKSI HARIAN =====
		document.getElementById('frekuensi-transaksi-harian-id').innerHTML=fieldData['CNT_JUMLAH_TRANSAKSI'];
		$('.frekuensi-transaksi-harian').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldData['CNT_JUMLAH_TRANSAKSI']);
				}
			});
		});
		
		//==== COUNT PENJUALAN HARIAN =====
		document.getElementById('penjualan-harian-id').innerHTML=fieldData['CNT_PENJUALAN_HARIAN'];
		$('.penjualan-harian').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					var nilaiHarian=fieldData['CNT_PENJUALAN_HARIAN']!=null?fieldData['CNT_PENJUALAN_HARIAN']:'0';
					$(this).text(nilaiHarian.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,'));
				}
			});
		});	
		
		//==== COUNT PENJUALAN MINGGUAN =====
		document.getElementById('penjualan-mingguan-id').innerHTML=fieldData['CNT_PENJUALAN_MINGGUAN'];
		$('.penjualan-mingguan').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {					
					var nilaiMingguan=fieldData['CNT_PENJUALAN_MINGGUAN']!=null?fieldData['CNT_PENJUALAN_MINGGUAN']:'0';
					$(this).text(nilaiMingguan.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,'));
				}
			});
		});
		
		//==== COUNT PENJUALAN BULANAN =====
		document.getElementById('penjualan-bulanan-id').innerHTML=fieldData['CNT_PENJUALAN_BULANAN'];
		$('.penjualan-bulanan').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					var nilaiBulanan=fieldData['CNT_PENJUALAN_BULANAN']!=null?fieldData['CNT_PENJUALAN_BULANAN']:'0';
					$(this).text(nilaiBulanan.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,'));
				}
			});
		});
	});

",$this::POS_END);

?>
<div>  		
	<!-- KIRI !-->
	<div class="col-lg-3 col-md-3">
		<div class="row">					
			<div class="w3-card-2 w3-round w3-white w3-center"  style="height:60px">
				<div class="panel-heading">
					<div class="row" >
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:rgba(94, 251, 86, 1)"></i>
								  <i class="fa fa-money fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:1px">
							<dl>								
								<dt class="penjualan-harian" style="font-size:12px;color:#7e7e7e">
									<h6 id="penjualan-harian-id"></h6>
								</dt>
								<dd style="font-size:10px;color:#7e7e7e">PENJUALAN PRODUK HARIAN (IDR)</dd>								
							</dl>							
						</div>
					</div>
				</div>	
			</div>
			<div class="w3-card-2 w3-round w3-white w3-center"  style="margin-top:5px;height:60px">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:rgba(53, 157, 228, 0.4)"></i>
								  <i class="fa fa-money fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:1px">
							<dl>								
								<dt class="penjualan-harian" style="font-size:12px;color:#7e7e7e">
									<h6 id="penjualan-harian-id"></h6>
								</dt>
								<dd style="font-size:10px;color:#7e7e7e">PENJUALAN PPOB HARIAN (IDR)</dd>								
							</dl>							
						</div>
					</div>
				</div>	
			</div>		
			<div class="w3-card-2 w3-round w3-white w3-center"  style="margin-top:5px;height:60px">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:rgba(94, 251, 86, 1)"></i>
								  <i class="fa fa-sign-in fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:1px">
							<dl>
								<dt class="penjualan-bulanan" style="font-size:12px;color:#7e7e7e">
									<h1 id="penjualan-bulanan-id"></h1>
								</dt>
								<dd style="font-size:10px;color:#7e7e7e">STORAN HARIAN (IDR)</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>					
			<div class="w3-card-2 w3-round w3-white w3-center"  style="padding-right:10px;margin-top:5px;height:60px">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:rgba(149, 61, 250, 1)"></i>
								  <i class="fa fa-binoculars fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:1px">
							<dl>
								<dt class="penjualan-mingguan" style="font-size:12px;color:#7e7e7e">
									<h1 id="penjualan-mingguan-id"></h1>
								</dt>
								<dd style="font-size:10px;color:#7e7e7e">PENJUALAN MINGGUAN (IDR)</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>					
			<div class="w3-card-2 w3-round w3-white w3-center"  style="padding-right:10px;margin-top:5px;margin-bottom:5px;height:60px">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:rgba(251, 130, 86, 1)"></i>
								  <i class="fa fa-binoculars fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:1px">
							<dl>
								<dt class="penjualan-bulanan" style="font-size:12px;color:#7e7e7e">
									<h1 id="penjualan-bulanan-id"></h1>
								</dt>
								<dd style="font-size:10px;color:#7e7e7e">PENJUALAN BULANAN (IDR)</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>							
		</div>
	</div>
	<!-- TENGAH !-->
	<div class="col-lg-7 col-md-7" >
		<div class="row">		
			<div class="col-sm-12 col-md-12 col-lg-12" style="margin-bottom:5px;padding-left:18px;padding-right:18px;">			
				<div class="row">	
					<div class="w3-card-2 w3-round w3-white w3-center" >				
						<div class="panel-heading">
								<div style="min-height:250px;">
									<div style="height:275px">
										<?=$hourly3DaysTafik?>
									</div>
								</div>
								<div class="text-right" style="padding-right:10px;font-size:12px;color:#7e7e7e">
									<?php echo tombolViewModalDetailPerStore().tombolDetailPerStore()?>
								</div>							
						</div>							
					</div>							
				</div>				
			</div>				
		</div>	
	</div>	
	<!-- KANAN !-->
	<div class="col-lg-2 col-md-2">
		<div class="row">
			<div class="w3-card-2 w3-round w3-white w3-center"  style="height:60px">
				<div class="panel-heading">
					<div class="row" >
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:#0ec1db"></i>
								  <i class="fa fa-dashboard fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:15px">
							<dl>
								<dt class="frekuensi-transaksi-harian" style="font-size:14px;color:#7e7e7e">
									<h1 id="frekuensi-transaksi-harian-id"></h1>
								</dt>
								<dd style="font-size:10px;color:#7e7e7e">KUNJUNGAN</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>		
			<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:5px;height:60px">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:red"></i>
								  <i class="fa fa-laptop fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:15px">
							<dl>
								<dt style="font-size:12px;color:#7e7e7e">
									<div class="jumlah-toko" style="float:left"><h1 id="jumlah-toko-id"></div>
									<div style="float:left">/</div>
									<div class="jumlah-toko-aktif" style="float:left"><h1 id="jumlah-toko-aktif-id"></div>	
									<div style="float:left">/</div>
									<div class="jumlah-perangkat-aktif"><h1 id="jumlah-perangkat-aktif-id"></h1></div>									
								</dt> 
								<dd style="font-size:10px;color:#7e7e7e">TOKO</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>	
			<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:5px;height:60px">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:yellow"></i>
								  <i class="fa fa-cubes fa-stack-1x" style="color:black"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:15px">
							<dl style="font-size:12px;color:#7e7e7e" style="padding-left:2px">
								<dt class="jumlah-produk" style="font-size:13px;color:#7e7e7e">
									<h1 id='jumlah-produk-id'></h1></dt>
								<dd style="font-size:10px;color:#7e7e7e">PRODUK</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>
			<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:5px;height:60px">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:#64F298"></i>
								  <i class="fa fa-users fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left" style="padding-left:15px">
							<dl>
								<dt style="font-size:12px;color:#7e7e7e">
									<div class="jumlah-karyawan" style="float:left">
										<h5 id="jumlah-karyawan-id"></h5>
									</div>
									<div style="float:left">/</div>
									<div class="jumlah-karyawan-aktif"><h5 id="jumlah-karyawan-aktif-id"></h5></div>						
								</dt>
								<dd style="font-size:10px;color:#7e7e7e">KARYAWAN</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>	
			<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:5px;height:60px">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:rgba(71, 80, 250, 1)"></i>
								  <i class="fa fa-address-card-o fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:15px">
							<dl>
								<dt style="font-size:12px;color:#7e7e7e">
									<div class="jumlah-customer"><h5 id="jumlah-customer-id"></h5></div>		
								</dt>
								<dd style="font-size:10px;color:#7e7e7e">MEMBER</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>	
		</div>
	</div>
	<div class="col-lg-12 col-md-12">
		<div class="row">
			<div class="panel-heading ">
				<div class="row">
					<div style="min-height:260px"><?php //$loadingSpinner1?>
						<div style="height:260px">
							<?=$monthlySales?>						
						</div>
					<div class="text-left" style="padding-left:10px;font-size:12px;color:#7e7e7e">
						<?php echo tombolDetailSalesBulananPerStore().tombolViewModalSalesBulananPerStore()?>
					</div>							
					</div>
				</div>	
			</div>			
		</div>			
	</div>	
	<div class="col-lg-12 col-md-12">
		<div class="row">
			<div class="panel-heading">
				<div class="row">
					<div style="min-height:300px">
						<div style="height:260px">
							<?=$weeklySales?>
						</div>
						<div class="text-left" style="padding-left:10px;font-size:12px;color:#7e7e7e">
						<?php echo tombolDetailSalesMingguanPerStore().tombolViewModalSalesMingguanPerStore()?>
					</div>
					</div>
				</div>
			</div>				
		</div>	
	</div>		
</div>

<?php
$this->registerJs("
var navDeficeInfo=window.navigator.platform;
//console.log( window.navigator.platform.value);

	//===AUTO UPDATE ==
	setInterval(function(){	
		//==AJAX POST TRAFIK GROUP===
		$.ajax({
			url: 'https://production.kontrolgampang.com/laporan/polling-charts/polling-group',
			type: 'POST',
			data: {'ACCESS_GROUP':'".Yii::$app->getUserOpt->user()['ACCESS_GROUP']."','PERANGKAT':navDeficeInfo},
			dataType:'json',			
			success: function(data) {
				//=== INIT CHART_SALES_MONTH ===
				if (data['POLLING_GROUP']['CHART_TRAFFICK_DAY']==1){
					//=== INIT FUSIONCHAT TRAFIK GROUP ===
					var ptrTrafixGroup = document.getElementById('msline-sss-hour-3daystrafik');
					var spnIdTrafixGroup= ptrTrafixGroup.getElementsByTagName('span');
					var chartIdTrafixGroup= spnIdTrafixGroup[0].id; 
					//console.log(chartIdTrafixGroup);	
					var updateChartTrafixGroup = document.getElementById(chartIdTrafixGroup);					
					$.ajax({
						url: 'https://production.kontrolgampang.com/laporan/sales-charts/frek-trans-day-group',
						type: 'POST',
						data: {'ACCESS_GROUP':'".Yii::$app->getUserOpt->user()['ACCESS_GROUP']."','TGL':'".date("Y-m-d")."','PERANGKAT':navDeficeInfo},
						dataType:'json',
						success: function(data) {
							//===UPDATE CHART ====
							if (data['dataset'][0]['data']!==''){							
								updateChartTrafixGroup.setChartData({
									chart: data['chart'],
									categories:data['categories'],
									dataset: data['dataset']
								});	
							}else{
								updateChartTrafixGroup.setChartData({
									chart: data['chart'],
									categories:data['categories'],
									data:[{}]
								});						
							}					
						}			   
					}); 
				}
			}
		});
	}, 10000);		

	//=== INIT CHART_SALES_MONTH ===
	setInterval(function() {	
		$.ajax({
			//[1]===POLING===
			url: 'https://production.kontrolgampang.com/laporan/polling-charts/polling-group',
			type: 'POST',
			data: {'ACCESS_GROUP':'".Yii::$app->getUserOpt->user()['ACCESS_GROUP']."','PERANGKAT':navDeficeInfo},
			dataType:'json',
			success: function(data) {
				//[2]===POLING CHECK===
				//console.log(data['POLLING_GROUP']['CHART_SALES_MONTH']);				
				if (data['POLLING_GROUP']['CHART_SALES_MONTH']==1){					
					var ptrSalesMonthGroup = document.getElementById('msline-sales-monthly');
					var spnIdptrSalesMonthGroup= ptrSalesMonthGroup.getElementsByTagName('span');
					var chartIdspnIdptrSalesMonthGroup= spnIdptrSalesMonthGroup[0].id; 
					//console.log(chartIdspnIdptrSalesMonthGroup);
					var updateChartchartIdspnIdptrSalesMonthGroup = document.getElementById(chartIdspnIdptrSalesMonthGroup);							
					$.ajax({
						//[4]==AJAX POST SALES MONTH GROUP===	
						  url: 'https://production.kontrolgampang.com/laporan/sales-charts/sales-bulanan-group',
						  type: 'POST',
						  //data: {'ACCESS_GROUP':'170726220936','STORE_ID':'170726220936.0001','TGL':'2018-03-13'},
						  data: {'ACCESS_GROUP':'".Yii::$app->getUserOpt->user()['ACCESS_GROUP']."','TGL':'".date("Y-m-d")."','PERANGKAT':navDeficeInfo},
						  dataType:'json',
						  success: function(data) {
							//===UPDATE CHART ====
							if (data['dataset']!==''){							
								updateChartchartIdspnIdptrSalesMonthGroup.setChartData({
									chart: data['chart'],
									categories:data['categories'],
									dataset: data['dataset']
								});	
							}else{
								updateChartchartIdspnIdptrSalesMonthGroup.setChartData({
									chart: data['chart'],
									categories:data['categories'],
									data:[{}]
								});						
							}					
						  }			   
					});
				}
			}
		});
	}, 10000);

	//=== INIT FUSIONCHAT WEEKLY GROUP ===
	setInterval(function() {		
		var ptrSalesWeekGroup = document.getElementById('msline-sales-weekly');
		var spnIdptrSalesWeekGroup= ptrSalesWeekGroup.getElementsByTagName('span');
		var chartIdspnIdptrSalesWeekGroup= spnIdptrSalesWeekGroup[0].id; 
		//console.log(chartIdspnIdptrSalesWeekGroup);
		var updateChartchartIdspnIdptrSalesWeekGroup = document.getElementById(chartIdspnIdptrSalesWeekGroup);
		//==AJAX POST SALES MINGGUAN GROUP===
		$.ajax({
			  url: 'https://production.kontrolgampang.com/laporan/sales-charts/sales-mingguan-group',
			  type: 'POST',
			  //data: {'ACCESS_GROUP':'170726220936','STORE_ID':'170726220936.0001','TAHUN':'2018','BULAN:'01'},
			  data: {'ACCESS_GROUP':'".Yii::$app->getUserOpt->user()['ACCESS_GROUP']."','TAHUN':'".date("Y")."','BULAN':'".date("m")."'},
			  dataType:'json',
			  success: function(data) {
				//===UPDATE CHART ====
				if (data['dataset']!==''){							
					updateChartchartIdspnIdptrSalesWeekGroup.setChartData({
						chart: data['chart'],
						categories:data['categories'],
						dataset: data['dataset']
					});	
				}else{
					updateChartchartIdspnIdptrSalesWeekGroup.setChartData({
						chart: data['chart'],
						categories:data['categories'],
						data:[{}]
					});						
				}					
			  }			   
		});
	}, 10000);
	
	setInterval(function() {	
	//== COUNTER ===
	// var data1 = '170726220936';
		// var form = new FormData();
		// form.append('ACCESS_GROUP', '170726220936');		
		var jsonDataCntTrg = $.ajax({
			url: 'https://production.kontrolgampang.com/laporan/counters/per-access-group',
			type: 'POST',
			data: {'ACCESS_GROUP':'".Yii::$app->getUserOpt->user()['ACCESS_GROUP']."'},
			dataType:'json',
			async: false,
		    global: false			
		}).responseText;	
		var myDataChartTrg= JSON.parse(jsonDataCntTrg);
		var fieldDataTrg =myDataChartTrg['PER_ACCESS_GROUP'][0];
		//console.log(fieldDataTrg['ACCESS_GROUP']);

		//=== COUNT JUMLAH_PRODAK ===
		$('.jumlah-produk').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldDataTrg['CNT_PRODUK']);	
				}
			});
		});
		//==== COUNT JUMLAH_KARYAWAN =====
		$('.jumlah-karyawan').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldDataTrg['CNT_KARYAWAN']);	
				}
			});		
		});
		
		//==== COUNT JUMLAH_KARYAWAN AKTIF=====
		$('.jumlah-karyawan-aktif').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldDataTrg['CNT_KARYAWAN_AKTIF']);	
				}
			});
		});
		
		//==== COUNT JUMLAH CUSTOMER =====
		$('.jumlah-customer').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldDataTrg['CNT_CUS_MEMBER']);	
				}
			});
		});
		
		//==== COUNT JUMLAH_TOKO =====
		$('.jumlah-toko').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldDataTrg['CNT_STORE']);		
				}
			});
		});
		//==== COUNT JUMLAH_TOKO_AKTIF =====
		$('.jumlah-toko-aktif').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldDataTrg['CNT_STORE_AKTIF']);		
				}
			});
		});
		//==== COUNT JUMLAH PERANGKAT TOKO_AKTIF =====
		$('.jumlah-perangkat-aktif').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldDataTrg['CNT_PERNGKAT_AKTIF']);
				}
			});
		});
	
		//==== COUNT TRAFIK TRANSAKSI HARIAN =====
		$('.frekuensi-transaksi-harian').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					$(this).text(fieldDataTrg['CNT_JUMLAH_TRANSAKSI']);
				}
			});
		});
		
		//==== COUNT PENJUALAN HARIAN =====
		$('.penjualan-harian').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: fieldDataTrg['CNT_PENJUALAN_HARIAN']
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					var nilaiHarian=fieldDataTrg['CNT_PENJUALAN_HARIAN']!=null?fieldDataTrg['CNT_PENJUALAN_HARIAN']:'0';
					$(this).text(nilaiHarian.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,'));
				}
			});
		});	
		
		//==== COUNT PENJUALAN MINGGUAN =====
		$('.penjualan-mingguan').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: fieldDataTrg['CNT_PENJUALAN_MINGGUAN']
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {					
					var nilaiMingguan=fieldDataTrg['CNT_PENJUALAN_MINGGUAN']!=null?fieldDataTrg['CNT_PENJUALAN_MINGGUAN']:'0';
					$(this).text(nilaiMingguan.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,'));
				}
			});
		});
		
		//==== COUNT PENJUALAN BULANAN =====
		$('.penjualan-bulanan').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: fieldDataTrg['CNT_PENJUALAN_BULANAN']
			}, {
				duration: 3000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: function() {
					var nilaiBulanan=fieldDataTrg['CNT_PENJUALAN_BULANAN']!=null?fieldDataTrg['CNT_PENJUALAN_BULANAN']:'0';
					$(this).text(nilaiBulanan.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,'));
				}
			});
		});
		
	
	
}, 10000);",View::POS_READY);
 

?>