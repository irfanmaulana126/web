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

use frontend\backend\dashboard\models\StoreKasirSearch;
use common\models\Store;

$this->title = 'dashboard/trafik';
$this->params['breadcrumbs'][] = $this->title;
ChartAsset::register($this);

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
		//'urlSource'=>'/dashboard/data/daily-transaksi',
		//'urlSource'=>'/dashboard/data/test?ACCESS_GROUP=170726220936&TAHUN=2018&BULAN=1&TGL=2018-01-23',
		 // 'urlSource'=>'/dashboard/data/daily-transaksi?ACCESS_GROUP=170726220936&TGL=2018-02-01',
		//'urlSource'=>'/dashboard/data/daily-transaksi',
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/frek-trans-day-group',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>'170726220936',
			'TGL'=>date("Y-m-d"),//'2018-02-27'
		],
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'msline',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'msline-modal-hour-strafik',								//unix name render
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

?>

<!-- TENGAH !-->
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-sm-12 col-md-12 col-lg-12" style="margin-bottom:15px">		
		<?php //echo = Html::encode($this->title) ?>
		<div class="row">		
			<div class="col-sm-12 col-md-12 col-lg-12"  style='margin-top:3px;'>
				<div>
					<div style='padding-bottom:3px;width:200px;float:left'><?=$btn_srchChart1?></div>
					<div style='padding-bottom:3px;width:200px;float:left;padding-left:5px'><?=$btn_srchChart2?></div>
				</div>				
			</div>			
			<div class="w3-card-2 w3-round w3-white w3-center">	
				<div style="min-height:265px">
					<div style="height:300px">
						<?=$hourly3DaysTafik?>
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
		//=== INIT FUSIONCHAT TRAFIK ===
		var ptrTrafix = document.getElementById('msline-modal-hour-strafik');
		var spnIdTrafix= ptrTrafix.getElementsByTagName('span');
		var chartIdTrafix= spnIdTrafix[0].id; 
		console.log(chartIdTrafix);
		var updateChartTrafix = document.getElementById(chartIdTrafix);
		//==AJAX POST DATA [TRAFIK]===
		$.ajax({
			  url: 'https://production.kontrolgampang.com/laporan/sales-charts/frek-trans-day-group',
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
",View::POS_READY);

?>