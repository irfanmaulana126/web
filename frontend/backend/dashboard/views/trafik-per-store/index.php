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
AppAssetBackendBorder::register($this);
ChartAsset::register($this);

use frontend\backend\dashboard\models\StoreKasirSearch;
use common\models\Store;

$this->title = 'dashboard/trafik';
$this->params['breadcrumbs'][] = $this->title;


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
$btn_srchChart2= Select2::widget([
    'name' => 'state_10',
    'data' =>  ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->all(),'STORE_ID','STORE_NM'),
	'options' => ['placeholder' => 'Pilih Toko ...','id'=>'store'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);

	$hourly3DaysTafik= Chart::Widget([
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/frek-trans-day-store',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>'170726220936',
			'STORE_ID'=>'170726220936.0001',
			'TGL'=>date("Y-m-d"),//'2018-03-12'
		],
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'msline',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'msline-sss-hour-3daystrafik',								//unix name render
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'265px',
	]);	
	
	$produkBar2d= Chart::Widget([
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/produk-daily-transaksi',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>'170726220936',
			'STORE_ID'=>'170726220936.0001',
			'TGL'=>date("Y-m-d"),//'2018-03-12'
		],
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'bar2d',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'pie3d-produk',								//unix name render
		'autoRender'=>true,
		// 'width'=>'100%',
		// 'height'=>'150%',
		'autoResize'=>true,
	]);	
	
	$produkBar2dRefund= Chart::Widget([
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/produk-daily-refund',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>'170726220936',
			'STORE_ID'=>'170726220936.0001',
			'TGL'=>date("Y-m-d"),//'2018-02-14'
		],
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'bar2d',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'bar2d-produk-refund',								//unix name render
		'autoRender'=>true,
		// 'width'=>'100%',
		// 'height'=>'150%'
		'autoResize'=>true,
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
?>

<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt;">	
		<div class="col-sm-12 col-md-12 col-lg-12">		
			<div class="row">
				<div style="float:left">
					<?php //echo 'dashboard '.'<span class="fa fa-md fa fa-chevron-right text-left"></span>'.' '.Yii::$app->controller->id;?>
				</div>
				<div class="text-right" style="padding-right:10px;padding-bottom:10px;font-size:15px;color:#7e7e7e">
					<!--<a href="https://www.w3schools.com">Rincian Per-Toko</a>!-->
					<?php echo tombolKembali()?>
				</div>
				<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div>
						<div style='padding-bottom:3px;width:200px;float:left'><?=$btn_srchChart1?></div>
						<div style='padding-bottom:3px;width:200px;float:left;padding-left:5px'><?=$btn_srchChart2?></div>
					</div>				
				</div>	
			</div>	
			</div>	
			<div class="row">
				<div class="w3-card-2 w3-round w3-white w3-center" style="margin-top:10px">	
					<?php //echo = Html::encode($this->title) ?>								
					<div style="min-height:265px">
						<div style="height:300px;">
							<?=$hourly3DaysTafik?>
						</div>
					</div>
					<div id="loaderPtr"></div>					
				</div>		
			</div>			
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12" style="padding-bottom:10px;">
			<div class="row">
				
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div style="min-height:300px">
								<div class="row" style="padding-top:10px;padding-right:10px">
									<div class="w3-card-2 w3-round w3-white w3-center">	
										<?=$produkBar2d?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div style="min-height:100px">
								<div class="row" style="padding-top:10px">
									<div class="w3-card-2 w3-round w3-white w3-center">	
										<?=$produkBar2dRefund?>
									</div>
								</div>						
							</div>						
						</div>
				
			</div>
		</div>
</div>

<?php
$this->registerJs("
$('#tanggal, #store').change(function() { 
    //==FILTER DATA ==
	var tgl,storeId,accessGroup='';
    var tgl = document.getElementById('tanggal').value;
    var storeId = document.getElementById('store').value;
	var store = storeId.split('.');
	var accessGroup = store[0];
	//console.log('ACCESS_GROUP='+accessGroup+';STORE_ID='+storeId+';TGL='+tgl);
	
    if ((tgl!=='') && (storeId!=='')) {
		//=== INIT FUSIONCHAT PRODUK TRANSAKSI ===
		var ptrProdukTransaksi = document.getElementById('pie3d-produk');
		var spnIdProdukTransaksi= ptrProdukTransaksi.getElementsByTagName('span');
		var chartIdProdukTransaksi= spnIdProdukTransaksi[0].id; 
		console.log(ptrProdukTransaksi);
		var updateChartProdukTransaksi = document.getElementById(chartIdProdukTransaksi);
		
		//==AJAX POST DATA [PRODUK TRANSAKSI]===
		$.ajax({
			  url: 'https://production.kontrolgampang.com/laporan/sales-charts/produk-daily-transaksi',
			  type: 'POST',
			  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl},
			  dataType:'json',
			  success: function(data) {
					//alert(data['dataset'][0]['data']);
					//console.log(data['dataset'][0]['data']);
					//=== RESIZE ===
					var dataget =data['dataset'][0]['data'];				
					//alert(dataget.length);
					var cnt=dataget.length<5?5:dataget.length;
					//alert(cnt);
					updateChartProdukTransaksi.style.height=(cnt*30)+'px';
					
					//===UPDATE CHART ====
					if (data['dataset'][0]['data']!==''){							
						updateChartProdukTransaksi.setChartData({
							chart: data['chart'],
							data: data['dataset'][0]['data']
						});	
					}else{
						updateChartProdukTransaksi.style.height='150px';
						updateChartProdukTransaksi.setChartData({
							chart: data['chart'],
							data:[{}]
						});						
					}					
			  }			   
		}); 
		
		//=== INIT FUSIONCHAT PRODUK REFUND ===
		var ptrProdukRefund = document.getElementById('bar2d-produk-refund');
		var spnIdProdukRefund= ptrProdukRefund.getElementsByTagName('span');
		var chartIdProdukRefund= spnIdProdukRefund[0].id; 
		console.log(ptrProdukRefund);
		var updateChartProdukRefund = document.getElementById(chartIdProdukRefund);
		//==AJAX POST DATA [PRODUK REFUND]===
		$.ajax({
			  url: 'https://production.kontrolgampang.com/laporan/sales-charts/produk-daily-refund',
			  type: 'POST',
			  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl},
			  dataType:'json',
			  success: function(data) {
					//alert(data['dataset'][0]['data']);
					//console.log(data['dataset'][0]['data']);
					//=== RESIZE ===
					var dataGet =data['dataset'][0]['data'];				
					//alert(dataGet.length);
					var cnt=dataGet.length<5?5:dataGet.length;
					//alert(cnt);
					updateChartProdukRefund.style.height=(cnt*30)+'px';
					
					//===UPDATE CHART ====
					if (data['dataset'][0]['data']!==''){							
						updateChartProdukRefund.setChartData({
							chart: data['chart'],
							data: data['dataset'][0]['data']
						});	
					}else{
						updateChartProdukRefund.style.height='150px';
						updateChartProdukRefund.setChartData({
							chart: data['chart'],
							data:[{}]
						});						
					}					
			  }			   
		}); 
		//=== INIT FUSIONCHAT TRAFIK ===
		var ptrTrafix = document.getElementById('msline-sss-hour-3daystrafik');
		var spnIdTrafix= ptrTrafix.getElementsByTagName('span');
		var chartIdTrafix= spnIdTrafix[0].id; 
		console.log(chartIdTrafix);
		var updateChartTrafix = document.getElementById(chartIdTrafix);
		//==AJAX POST DATA [TRAFIK]===
		$.ajax({
			  url: 'https://production.kontrolgampang.com/laporan/sales-charts/frek-trans-day-store',
			  type: 'POST',
			  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TGL':tgl},
			  dataType:'json',
			  success: function(data) {
				//===UPDATE CHART ====
				if (data['dataset'][0]['data']!==''){							
					updateChartTrafix.setChartData({
						chart: data['chart'],
						categories:data['categories'],
						dataset: data['dataset']
					});	
				}else{
					updateChartTrafix.setChartData({
						chart: data['chart'],
						categories:data['categories'],
						data:[{}]
					});						
				}					
			  }			   
		}); 
	};     
});
 
//===AUTO UPDATE ==
/* setInterval(function() {
  //=== INIT FUSIONCHAT TRAFIK ===
	var ptrTrafix = document.getElementById('msline-sss-hour-3daystrafik');
	var spnIdTrafix= ptrTrafix.getElementsByTagName('span');
	var chartIdTrafix= spnIdTrafix[0].id; 
	console.log(chartIdTrafix);
	var updateChartTrafix = document.getElementById(chartIdTrafix);
	//==AJAX POST DATA [TRAFIK]===
	$.ajax({
		  url: 'https://production.kontrolgampang.com/laporan/sales-charts/frek-trans-day-store',
		  type: 'POST',
		  data: {'ACCESS_GROUP':'170726220936','STORE_ID':'170726220936.0001','TGL':'2018-03-13'},
		  dataType:'json',
		  success: function(data) {
			//===UPDATE CHART ====
			if (data['dataset'][0]['data']!==''){							
				updateChartTrafix.setChartData({
					chart: data['chart'],
					categories:data['categories'],
					dataset: data['dataset']
				});	
			}else{
				updateChartTrafix.setChartData({
					chart: data['chart'],
					categories:data['categories'],
					data:[{}]
				});						
			}					
		  }			   
	}); 
	//console.log('test loop');
}, 10000);  */
	
	
	
",View::POS_READY);
 

?>