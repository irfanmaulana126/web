<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use kartik\builder\Form;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\web\View;


			// STORE_STT,
			// DATE_START,
			// DATE_END,
			// ITEM_ID,
			// 'ITEM_NM',
			// 'SATUAN',
			//'DEFAULT_STOCK',
			// DEFAULT_HARGA,
			// ITEM_STT,
			// STORE_CREARE_BY,STORE_CREARE_AT,STORE_UPDATE_BY, STORE_UPDATE_AT,
			// ITEM_CREARE_BY,ITEM_CREARE_AT, ITEM_UPDATE_BY, ITEM_UPDATE_AT
	$bColor='rgba(87,114,111, 1)';
	$pageNm='<span class="fa-stack fa-xs text-right">				  
				  <i class="fa fa-share fa-1x"></i>
				</span><b>All-Items Outlet</b>
	';
	$gvAttStoreItems=[
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-home fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> ALL PRODUK </b>',
			'content'=>$Action,
			'active'=>true
		],
?>

<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">
			<div class="pull-right">
			</div>
		</div>
		<div class="row">
			<?=$tabIndex?>
		</div>
	</div>
</div>