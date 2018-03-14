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

$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
$btn_srchChart1=DatePicker::widget([
    'name' => 'check_issue_date', 
    'options' => ['placeholder' => 'Pilih Tanggal ...','id'=>'tahunbulan'],
    'convertFormat' => true,
    'pluginOptions' => [
        'autoclose'=>true,
        'startView'=>'years',
        'minViewMode'=>'months',
        //'format' => 'yyyy',
        'format' => 'yyyy-M-d',
        // 'todayHighlight' => true,
         'todayHighlight' => true
    ]
]);
	//= SALES MINGGUAN
	$monthlySales= Chart::Widget([
		//'urlSource'=> '/dashboard/data/monthy-sales',
		'urlSource'=> 'https://production.kontrolgampang.com/laporan/sales-charts/sales-mingguan-group',
		'metode'=>'POST',
		'param'=>[
			//'ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP,//'170726220936',
			'ACCESS_GROUP'=>Yii::$app->getUserOpt->user()['ACCESS_GROUP'],//'170726220936',
			'BULAN'=>date("m"),
			'TAHUN'=>date("Y")
		],
		// 'urlSource'=> '/dashboard/data/monthy-sales?ACCESS_GROUP=170726220936&TAHUN=2018&BULAN=1',
		// 'urlSource'=> '/dashboard/data/test?ACCESS_GROUP=170726220936&TAHUN=2018&BULAN=1',
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'msline',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'msline-sales-mingguan-modal',								//unix name render
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'300px',
	]);	

?>

<!-- TENGAH !-->
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-sm-12 col-md-12 col-lg-12" style="margin-bottom:15px">		
		<?php //echo = Html::encode($this->title) ?>
		<div class="row">		
			<div class="col-sm-12 col-md-12 col-lg-12 pull-left"  style='margin-top:3px;float:left'>						
					<div class="pull-left" style='padding-bottom:3px;width:200px;float:left'><?=$btn_srchChart1?></div>					
			</div>				
			<div class="w3-card-2 w3-round w3-white w3-center">	
				<div style="min-height:265px">
					<div style="height:360px">
						<?=$monthlySales?>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>	
<?php
// data: {'ACCESS_GROUP':'".Yii::$app->user->identity->ACCESS_GROUP."','THN':thn},
$this->registerJs("
$('#tahunbulan').change(function() { 
    //==FILTER DATA ==
	//var thn='';//,storeId,accessGroup='';
    var thnbulan = document.getElementById('tahunbulan').value;
	var myDate = new Date(thnbulan); 
	//console.log(myDate.getFullYear());
    // var storeId = document.getElementById('store').value;
	// var store = storeId.split('.');
	// var accessGroup = store[0];
	//console.log('ACCESS_GROUP='+accessGroup+';STORE_ID='+storeId+';TGL='+tgl);
	
    //if ((tgl!=='') && (storeId!=='')) {
    if (thnbulan!==''){
		//=== INIT FUSIONCHAT SALES MONTH GROUP ===
		var ptrSalesWeekGroup = document.getElementById('msline-sales-mingguan-modal');
		var spnIdptrSalesWeekGroup= ptrSalesWeekGroup.getElementsByTagName('span');
		var chartIdspnIdptrSalesWeekGroup= spnIdptrSalesWeekGroup[0].id; 
		//console.log(chartIdspnIdptrSalesWeekGroup);
		var updateChartchartIdspnIdptrSalesWeekGroup = document.getElementById(chartIdspnIdptrSalesWeekGroup);
		//==AJAX POST SALES MINGGUAN GROUP===
		$.ajax({
			  url: 'https://production.kontrolgampang.com/laporan/sales-charts/sales-mingguan-group',
			  type: 'POST',
			  data: {'ACCESS_GROUP':'".Yii::$app->getUserOpt->user()['ACCESS_GROUP']."','TAHUN':myDate.getFullYear(),'BULAN':myDate.getMonth()+1},
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
	};     
});
",View::POS_READY);

?>