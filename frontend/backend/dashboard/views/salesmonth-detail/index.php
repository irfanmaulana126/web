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

$this->title = 'dashboard/salesmonth';
$this->params['breadcrumbs'][] = $this->title;

$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
$btn_srchChart1=DatePicker::widget([
    'name' => 'check_issue_date', 
    'options' => ['placeholder' => 'Pilih Tahun&Bulan ...','id'=>'tahunbulan'],
    'convertFormat' => true,
    'pluginOptions' => [
        'autoclose'=>true,
        'startView'=>'years',
        'minViewMode'=>'months',
        'format' => 'yyyy-M-d',
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

	$salesMonthDetail= Chart::Widget([
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/sales-bulanan-perstore',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,//'170726220936',
			'STORE_ID'=>'170726220936.0001',
			'TGL'=>date("Y-m-d"),//'2018-03-12'
		],
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'msline',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'msline-salesmonth-detail',								//unix name render
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'265px',
	]);	
	
	$produkTransaksiMonth= Chart::Widget([
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/sales-bulanan-produk-perstore',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,
			'STORE_ID'=>Yii::$app->user->identity->ACCESS_GROUP.'.0001',
			'TAHUN'=>date("Y"),
			'BULAN'=>date("m"),
		],
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'bar2d',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'produk-transaksi-month',								//unix name render
		'autoRender'=>true,
		// 'width'=>'100%',
		// 'height'=>'150%',
		'autoResize'=>true,
	]);	
	
	$produkRefundMonth= Chart::Widget([
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/sales-bulanan-produkrefund-perstore',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,
			'STORE_ID'=>Yii::$app->user->identity->ACCESS_GROUP.'.0001',
			'TAHUN'=>date("Y"),
			'BULAN'=>date("m"),
		],
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'bar2d',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'produk-refund-month',								//unix name render
		'autoRender'=>true,
		// 'width'=>'100%',
		// 'height'=>'150%'
		'autoResize'=>true,
	]);	
	
	function tombolKembali(){
		$title= Yii::t('app','');
		$url = Url::toRoute(['/dashboard']);
		$options1 = [
					'id'=>'back-month-detail',
					'class'=>"btn btn-xs",
					'title'=>'Kembali'
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
				
				<div class="pull-left" style="padding-left:10px;font-size:15px;color:#7e7e7e;float:left'">
					<!--<a href="https://www.w3schools.com">Rincian Per-Toko</a>!-->
					<?php echo tombolKembali()?>
				</div>
				
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
							<?=$salesMonthDetail?>
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
										<?=$produkTransaksiMonth?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div style="min-height:100px">
								<div class="row" style="padding-top:10px">
									<div class="w3-card-2 w3-round w3-white w3-center">	
										<?=$produkRefundMonth?>
									</div>
								</div>						
							</div>						
						</div>
				
			</div>
		</div>
</div>

<?php
$this->registerJs("
$('#tahunbulan, #store').change(function() { 
    //==FILTER DATA ==
	var tgl,storeId,accessGroup='';
	//--TAHUN/BULAN
 	var thnbulan = document.getElementById('tahunbulan').value;
	var myDate = new Date(thnbulan); 
	//console.log(myDate.getFullYear());
	//console.log(myDate.getMonth()+1);
    var storeId = document.getElementById('store').value;
	var store = storeId.split('.');
	var accessGroup = store[0];
	//console.log('ACCESS_GROUP='+accessGroup+';STORE_ID='+storeId+';TGL='+tgl);
	
    if ((thnbulan!=='') && (storeId!=='')) {
			
		//=== INIT SALES BULANAN PRODUK TRANSAKSI ===
		var ptrProdukTransaksiBulanan = document.getElementById('produk-transaksi-month');
		var spnIdProdukTransaksiBulanan= ptrProdukTransaksiBulanan.getElementsByTagName('span');
		var chartIdProdukTransaksiBulanan= spnIdProdukTransaksiBulanan[0].id; 
		console.log(ptrProdukTransaksiBulanan);
		var updateChartProdukTransaksiBulanan = document.getElementById(chartIdProdukTransaksiBulanan);		
		//==AJAX POST DATA [PRODUK BULANAN]===
		$.ajax({
			  url: 'https://production.kontrolgampang.com/laporan/sales-charts/sales-bulanan-produk-perstore',
			  type: 'POST',
			  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TAHUN':myDate.getFullYear(),'BULAN':myDate.getMonth()+1},
			  dataType:'json',
			  success: function(data) {
					//alert(data['dataset'][0]['data']);
					//console.log(data['dataset'][0]['data']);
					//=== RESIZE ===
					var dataget =data['dataset'][0]['data'];				
					//alert(dataget.length);
					var cnt=dataget.length<5?5:dataget.length;
					//alert(cnt);
					updateChartProdukTransaksiBulanan.style.height=(cnt*30)+'px';
					
					//===UPDATE CHART ====
					if (data['dataset'][0]['data']!==''){							
						updateChartProdukTransaksiBulanan.setChartData({
							chart: data['chart'],
							data: data['dataset'][0]['data']
						});	
					}else{
						updateChartProdukTransaksiBulanan.style.height='150px';
						updateChartProdukTransaksiBulanan.setChartData({
							chart: data['chart'],
							data:[{}]
						});						
					}					
			  }			   
		}); 
		
		//=== INIT SALES BULANAN PRODUK REFUND ===
		var ptrProdukRefundBulanan = document.getElementById('produk-refund-month');
		var spnIdProdukRefundBulanan= ptrProdukRefundBulanan.getElementsByTagName('span');
		var chartIdProdukRefundBulanan= spnIdProdukRefundBulanan[0].id; 
		console.log(ptrProdukRefundBulanan);
		var updateChartProdukRefundBulanan = document.getElementById(chartIdProdukRefundBulanan);
		//==AJAX POST DATA [PRODUK REFUND]===
		$.ajax({
			  url: 'https://production.kontrolgampang.com/laporan/sales-charts/sales-bulanan-produkrefund-perstore',
			  type: 'POST',
			  data: {'ACCESS_GROUP':accessGroup,'STORE_ID':storeId,'TAHUN':myDate.getFullYear(),'BULAN':myDate.getMonth()+1},
			  dataType:'json',
			  success: function(data) {
					//alert(data['dataset'][0]['data']);
					//console.log(data['dataset'][0]['data']);
					//=== RESIZE ===
					var dataGet =data['dataset'][0]['data'];				
					//alert(dataGet.length);
					var cnt=dataGet.length<5?5:dataGet.length;
					//alert(cnt);
					updateChartProdukRefundBulanan.style.height=(cnt*30)+'px';
					
					//===UPDATE CHART ====
					if (data['dataset'][0]['data']!==''){							
						updateChartProdukRefundBulanan.setChartData({
							chart: data['chart'],
							data: data['dataset'][0]['data']
						});	
					}else{
						updateChartProdukRefundBulanan.style.height='150px';
						updateChartProdukRefundBulanan.setChartData({
							chart: data['chart'],
							data:[{}]
						});						
					}					
			  }			   
		});  
		
	};     
});
	
",View::POS_READY);
 

?>