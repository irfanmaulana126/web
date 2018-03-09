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
	]);	
	
	$produkBar2d= Chart::Widget([
		'urlSource'=>'https://production.kontrolgampang.com/laporan/sales-charts/frek-trans-day-store',
		'metode'=>'POST',
		'param'=>[
			'ACCESS_GROUP'=>'170726220936',
			'TGL'=>'2018-02-27'
		],
		'userid'=>'piter@lukison.com',
		'dataArray'=>'[]',//$actionChartGrantPilotproject,				//array scource model or manual array or sqlquery
		'dataField'=>'[]',//['label','value'],							//field['label','value'], normaly value is numeric
		'type'=>'bar2d',//msline//'bar3d',//'gantt',					//Chart Type 
		'renderid'=>'bar2d-produk',								//unix name render
		'autoRender'=>true,
		'width'=>'100%',
		'height'=>'465px'
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
					<?php echo 'dashboard '.'<span class="fa fa-md fa fa-chevron-right text-left"></span>'.Yii::$app->controller->id;?>
					<div class="text-right" style="padding-right:10px;font-size:15px;color:#7e7e7e">
						<!--<a href="https://www.w3schools.com">Rincian Per-Toko</a>!-->
						<?php echo tombolKembali()?>
					</div>
				<div class="w3-card-2 w3-round w3-white w3-center">	
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
		<div class="col-sm-12 col-md-12 col-lg-12">
			<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6" style="min-height:265px">
						<div class="row" style="padding-top:10px">
							<div class="w3-card-2 w3-round w3-white w3-center">	
								<?=$produkBar2d?>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6" style="min-height:265px">
						<div class="row">
							<?php//=$produkBar2d?>
						</div>
					</div>
			</div>
		</div>
</div>