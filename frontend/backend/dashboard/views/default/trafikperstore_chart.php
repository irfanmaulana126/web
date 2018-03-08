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
use frontend\assets\AppAssetBackendBorder;
AppAssetBackendBorder::register($this);

use frontend\backend\dashboard\models\StoreKasirSearch;
$this->title = 'dashboard/trafik';
$this->params['breadcrumbs'][] = $this->title;
ChartAsset::register($this);

	$hourly3DaysTafik= Chart::Widget([
		//'urlSource'=>'/dashboard/data/daily-transaksi',
		//'urlSource'=>'/dashboard/data/test?ACCESS_GROUP=170726220936&TAHUN=2018&BULAN=1&TGL=2018-01-23',
		 // 'urlSource'=>'/dashboard/data/daily-transaksi?ACCESS_GROUP=170726220936&TGL=2018-02-01',
		//'urlSource'=>'/dashboard/data/daily-transaksi',
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/frek-trans-day-store',
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

?>

<!-- TENGAH !-->
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-sm-12 col-md-12 col-lg-12" style="margin-bottom:15px">		
		<?php //echo = Html::encode($this->title) ?>
		<div class="row">		
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