<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\View;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\TransPenjualanHeaderSummaryMonthlySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trans Penjualan Header Summary Monthlies';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$this->registerCss("
	#arus-masuk-monthofyear .kv-panel {
		//min-height: 340px;
		height: 300px;
	}
	#arus-masuk-monthofyear .kv-grid-container{
		height:452px
	}
");

$this->registerJs("
	 // var x = document.getElementById('tahun').value;
	 // console.log(x);
	 document.getElementById('tahun').onchange = function() { 
		var x = document.getElementById('tahun').value;
			$.pjax.reload({
				url:'/laporan/arus-uang/index?id='+x, 
				container: '#arus-masuk-monthofyear',
				timeout: 1000,
			}).done(function () {
				$.pjax.reload({container: '#arus-keluar-monthofyear'});
			});
		
		console.log('Changed!'+x); 
	 }
",View::POS_READY);

	$btn_srchChart1=DatePicker::widget([
		'name' => 'check_issue_date', 
		'options' => ['placeholder' => 'Pilih Tahun ...','id'=>'tahun'],
		'convertFormat' => true,
		'pluginOptions' => [
			'autoclose'=>true,
			'startView'=>'years',
			'minViewMode'=>'years',
			'format' => 'yyyy',
			// 'todayHighlight' => true,
			 'todayHighlight' => true
		]
	]);
	$btn_srchChart="<div style='padding-bottom:3px;float:right'> Periode Tahun".$btn_srchChart1."</div>";
	
	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row">	
			<div style="height:20px;text-align:center;font-family: tahoma ;font-size: 10pt;">	
					<?php								
						echo '<b>RINGKASAN ARUS KEUANGAN <br>'.$cari['thn'].'</b>';				
					?>		
			</div>
			<div class="col-xs-4 col-sm-4 col-lg-4 pull-right">
				<?=$btn_srchChart?>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		
	</div>
</div>

