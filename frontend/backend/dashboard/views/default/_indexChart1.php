<?php
use kartik\helpers\Html;	
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\Request;
use yii\web\View;
use GuzzleHttp\Client;

use ptrnov\fusionchart\Chart;
use frontend\assets\AppAssetBackendBorder;
AppAssetBackendBorder::register($this);


//$client = new \GuzzleHttp\Client();
$client = new Client([
	'headers' => [ 'Content-Type' => 'application/json' ]
]);
$dataBody = [			
		"ACCESS_GROUP" => "170726220936"		
];
$res = $client->post('192.168.212.101/laporan/counters/per-access-group',
					[
						'body' =>json_encode($dataBody)
					]);
// echo $res->getStatusCode();
// echo $res->getBody();
//$data=$res->getBody();
//echo $data->CNT_STORE_AKTIF;
// $data1=json_decode($res->getBody());
// $data2=json_decode($res->getBody())->PER_ACCESS_GROUP;
$data=json_decode($res->getBody())->PER_ACCESS_GROUP[0];
//$rslt=$data->ACCESS_GROUP;

	//print_r($data);

	


	$hourly3DaysTafik= Chart::Widget([
		//'urlSource'=>'/dashboard/data/daily-transaksi',
		//'urlSource'=>'/dashboard/data/test?ACCESS_GROUP=170726220936&TAHUN=2018&BULAN=1&TGL=2018-01-23',
		 // 'urlSource'=>'/dashboard/data/daily-transaksi?ACCESS_GROUP=170726220936&TGL=2018-02-01',
		//'urlSource'=>'/dashboard/data/daily-transaksi',
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/frek-trans-day-group',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>'170726220936',
			'TGL'=>'2018-02-27'
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

	//=WEEKLY SALES
	$weeklySales= Chart::Widget([
		// 'urlSource'=> '/dashboard/data/weekly-sales?ACCESS_GROUP=170726220936&TAHUN=2018&BULAN=2',
		'urlSource'=> '/dashboard/data/weekly-sales',
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'msline',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'msline-sales-weekly',								//unix name render
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'300px',
	]);	 
	
	//=MONTHLY SALES
	$monthlySales= Chart::Widget([
		'urlSource'=> '/dashboard/data/monthy-sales',
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
	
	
	//$loadingSpinner1=Spinner::widget(['id'=>'spn1-load-road','preset' => 'large', 'align' => 'center', 'color' => 'blue']);
	 

 $this->registerCss("
	.count-ptr
		{
		   color:black;
		}	
 ");
 
$this->registerJs("
	$(document).ready(function () {
		var data1 = '170726220936';
		var form = new FormData();
		form.append('ACCESS_GROUP', '170726220936');
		
		/* var  jsonData= $.ajax({
		  url: 'http://production.kontrolgampang.com/laporan/counters/per-access-group',
		  type: 'GET',
		  'data':form,
		  dataType:'json',
		  async: false,
		  global: false
		}).responseText;
		var myDataChart= jsonData;
		console.log(myDataChart); */
		/* var settings = {
			
		  'async': true,
		  'crossDomain': true,
		  'cache': false,
		  // 'beforeSend': function(request) {
			// request.setRequestHeader('X-Forwarded-Proto', 'http');
		  // },
		  'url': 'http://192.168.212.101/laporan/counters/per-access-group',
		 // 'url': 'http://production.kontrolgampang.com/laporan/counters/per-access-group')',
		  'method': 'POST',
		  'processData': false,
		  'contentType': 'application/x-www-form-urlencoded; charset=UTF-8',	
		  'mimeType': 'multipart/form-data',
		  'data':form
		}
		$.ajax(settings).done(function (response) {
		  console.log(response);
		});  */
	});
							
	// var settings = {
	  // 'async': true,
	  // 'crossDomain': true,
	  // 'url': 'http://production.kontrolgampang.com/laporan/counters/per-access-group',
	  // 'method': 'POST',
	  // 'headers': {
		  // 'Cache-Control: no-cache, no-store, must-revalidate';
		  // 'Pragma: no-cache';
		  // 'Expires: 0';
	  // },
	  // 'processData': false,
	  // 'contentType': false,
	  // 'mimeType': 'multipart/form-data',
	  // 'data':form
	// }
	// $.ajax(settings).done(function (response) {
	  // console.log(response);
	// });
	/* $.ajax({
		url: 'http://production.kontrolgampang.com/laporan/counters/per-access-group',
		async: true,
		crossDomain: true,
		type : 'POST',
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',		
		//data: {ACCESS_GROUP:data1,tgl:data2},
		data: {ACCESS_GROUP:data1},
		// processData: false,
		// contentType: false,
		dataType: 'json',
	processData: false,
		contentType: false,
		mimeType: 'multipart/form-data',
		success  : function(result) {
			console.log(value);
								
		}
	}); */

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
				$(this).text('".number_format('100')."');	//TOTAL_PENJUALAN
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
				$(this).text('".number_format('100')."');	//JUMLAH_TRANSAKSI
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
				$(this).text('".number_format('100')."');	//RATA_RATA_PENJUALAN
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
				$(this).text('".number_format($data->CNT_PRODUK)."');	//JUMLAH_PRODAK
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
				$(this).text('".number_format($data->CNT_KARYAWAN)."');	//JUMLAH_KARYAWAN
			}
		});
	});
	$('.jumlah-karyawan-aktif').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($data->CNT_KARYAWAN_AKTIF)."');	//JUMLAH_KARYAWAN_AKTIF
			}
		});
	});
	$('.jumlah-customer').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($data->CNT_CUS_MEMBER)."');	//JUMLAH_KARYAWAN_AKTIF
			}
		});
	});
	$('.jumlah-toko').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($data->CNT_STORE)."');		//JUMLAH_TOKO
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
				$(this).text('".number_format($data->CNT_STORE_AKTIF)."');		//JUMLAH_TOKO_AKTIF
			}
		});
	});
	$('.jumlah-perangkat-aktif').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($data->CNT_PERNGKAT_AKTIF)."');		//JUMLAH_TOKO_AKTIF
			}
		});
	});
	$('.frekuensi-transaksi-harian').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 5000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($data->CNT_JUMLAH_TRANSAKSI)."');		//FREKUENSI TRANSAKSI HARIAN
			}
		});
	});
	$('.penjualan-harian').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 5000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($data->CNT_PENJUALAN_HARIAN)."');		//PENJUALAN HARIAN
			}
		});
	});	
	$('.penjualan-mingguan').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 5000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($data->CNT_PENJUALAN_MINGGUAN)."');		//PENJUALAN MINGGUAN
			}
		});
	});
	$('.penjualan-bulanan').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 5000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			},
			complete: function() {
				$(this).text('".number_format($data->CNT_PENJUALAN_BULANAN)."');		//PENJUALAN MINGGUAN
			}
		});
	});
",$this::POS_END);

?>
<div>  		
	<!-- KIRI !-->
	<div class="col-lg-3 col-md-3" style="margin-bottom:10px">
		<div class="row">					
			<div class="w3-card-2 w3-round w3-white w3-center"  style="padding-top:2px;height:65px">
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
						<div class="col-lg-9 text-left .small" style="padding-left:1px">
							<dl>
								<dt class="frekuensi-transaksi-harian" style="font-size:14px;color:#7e7e7e"><?=$data->CNT_JUMLAH_TRANSAKSI?></dt>
								<dd style="font-size:10px;color:#7e7e7e">FREKUENSI TRANSAKSI HARIAN</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>	
			<br>
			<div class="w3-card-2 w3-round w3-white w3-center"  style="padding-top:2px;height:65px">
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
								<dt class="penjualan-harian" style="font-size:14px;color:#7e7e7e"><?=$data->CNT_PENJUALAN_HARIAN?></dt>
								<dd style="font-size:10px;color:#7e7e7e">PENJUALAN HARIAN (IDR)</dd>								
							</dl>							
						</div>
					</div>
				</div>	
			</div>	
			<br>
			<div class="w3-card-2 w3-round w3-white w3-center"  style="padding-top:2px;height:65px">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:rgba(149, 61, 250, 1)"></i>
								  <i class="fa fa-money fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:1px">
							<dl>
								<dt class="penjualan-mingguan" style="font-size:14px;color:#7e7e7e"><?=$data->CNT_PENJUALAN_MINGGUAN?></dt>
								<dd style="font-size:10px;color:#7e7e7e">PENJUALAN MINGGUAN (IDR)</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>		
			<br>
			<div class="w3-card-2 w3-round w3-white w3-center"  style="padding-top:2px;height:65px">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-3 text-left" style="float:left;padding-left:10px">
							<a href="#">
								<span class="fa-stack fa-2x">
								  <i class="fa fa-circle fa-stack-2x" style="color:rgba(251, 130, 86, 1)"></i>
								  <i class="fa fa-money fa-stack-1x" style="color:#FFFFFF"></i>
								</span>
							</a>
						</div>						
						<div class="col-lg-9 text-left .small" style="padding-left:1px">
							<dl>
								<dt class="penjualan-bulanan" style="font-size:14px;color:#7e7e7e"><?=$data->CNT_PENJUALAN_BULANAN?></dt>
								<dd style="font-size:10px;color:#7e7e7e">PENJUALAN BULANAN (IDR)</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>						
		</div>
	</div>
	<!-- TENGAH !-->
	<div class="col-lg-7 col-md-7" style="margin-bottom:15px" >
		<div class="row">		
			<div class="col-sm-12 col-md-12 col-lg-12" >			
				<div class="row">	
					<div class="w3-card-2 w3-round w3-white w3-center" style="margin-left:5px;margin-right:5px">				
						<div class="panel-heading">
							<div class="row">								
								<div style="min-height:250px"><div style="height:260px"><?=$hourly3DaysTafik?></div></div><div class="clearfix"></div>
								<div class="text-right" style="padding-right:10px;font-size:12px;color:#7e7e7e">
									<!--<a href="https://www.w3schools.com">Rincian Per-Toko</a>!-->
									<?php echo tombolViewModalDetailPerStore().tombolDetailPerStore()?>
								</div>
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
			<div class="w3-card-2 w3-round w3-white w3-center" style="padding-top:2px;height:65px">
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
								<dt style="font-size:13px;color:#7e7e7e">
									<div class="jumlah-toko" style="float:left"><?=$data->CNT_STORE?></div>
									<div style="float:left">/</div>
									<div class="jumlah-toko-aktif" style="float:left"><?=$data->CNT_STORE_AKTIF?></div>	
									<div style="float:left">/</div>
									<div class="jumlah-perangkat-aktif"><?=$data->CNT_PERNGKAT_AKTIF?></div>									
								</dt> 
								<dd style="font-size:10px;color:#7e7e7e">TOKO</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>	
			<br>	
			<div class="w3-card-2 w3-round w3-white w3-center" style="padding-top:0px;height:65px">
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
							<dl style="font-size:13px;color:#7e7e7e" style="padding-left:2px">
								<dt class="jumlah-produk" style="font-size:13px;color:#7e7e7e"><?=$data->CNT_PRODUK?></dt>
								<dd style="font-size:10px;color:#7e7e7e">PRODUK</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>
			<br>			
			<div class="w3-card-2 w3-round w3-white w3-center" style="padding-top:0px;height:68px">
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
								<dt style="font-size:13px;color:#7e7e7e">
									<div class="jumlah-karyawan" style="float:left"><?=$data->CNT_KARYAWAN?></div>
									<div style="float:left">/</div>
									<div class="jumlah-karyawan-aktif"><?=$data->CNT_KARYAWAN_AKTIF?></div>						
								</dt>
								<dd style="font-size:10px;color:#7e7e7e">KARYAWAN</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>	
			<br>	
			<div class="w3-card-2 w3-round w3-white w3-center" style="padding-top:0px;height:65px">
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
								<dt style="font-size:13px;color:#7e7e7e">
									<div class="jumlah-customer"><?=$data->CNT_CUS_MEMBER?></div>		
								</dt>
								<dd style="font-size:10px;color:#7e7e7e">MEMBER</dd>
							</dl>							
						</div>
					</div>
				</div>	
			</div>	
		</div>
		<br>
	</div>
	<div class="col-lg-12 col-md-12">
		<div class="row">
			<div class="panel-heading">
				<div class="row">
					<div style="min-height:300px"><?php //$loadingSpinner1?><div style="height:300px"><?=$weeklySales?></div></div><div class="clearfix"></div>
				</div>
			</div>				
		</div>	
	</div>	
	<div class="col-lg-12 col-md-12">
		<div class="row">
			<div class="panel-heading ">
				<div class="row">
					<div style="min-height:300px"><?php //$loadingSpinner1?><div style="height:300px"><?=$monthlySales?></div></div><div class="clearfix"></div>
				</div>
			</div>	
		</div>			
	</div>			
</div>