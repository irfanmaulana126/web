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

<<<<<<< HEAD
use frontend\backend\master\models\ProductSearch;
$this->title="Prodak";
$this->registerJs($this->render('databarang_script.js'),View::POS_READY);
echo $this->render('databarang_button'); //echo difinition
echo $this->render('databarang_modal'); //echo difinition
	$this->registerCss("
		#expand-menu :link {
			color:black;
		}
		//mouse over link
		#expand-menu a:hover {
			color: black;
		}
		//selected link
		a:active {
			color: black;
		}
		.kv-panel {
			//min-height: 340px;
			height: 300px;
		}
		#expand-menu .kv-grid-container{
			height:250px
		}
		#w5 :link {
			color: black;
		}
		/* mouse over link */
		#w5-container a:hover {
			color: #5a96e7;
		}
		/* selected link */
		#w5-container a:active {
			color: blue;
		}
	");
=======
>>>>>>> d15abbd788fd76058166c6eb84abcc607108a505

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
<<<<<<< HEAD
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-product-hunt fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> PRODUK DISCOUNT </b>',
			'content'=>$Action2
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-users fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> PRODUK PROMO </b>',
			'content'=>$Action3
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-user fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> STOCK PRODUCT </b>',
			'content'=>$Action4
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-user-secret fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> HISTORI HARGA  </b>',
			'content'=>$Action5
		],
	];
	
	$tabIndex=TabsX::widget([
		'items'=>$items,
		'enableStickyTabs'=>true,
		'encodeLabels'=>false
	]);
// 	$test=ProductSearch::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP])->orderBy(['ACCESS_GROUP'=>SORT_DESC,'PRODUCT_SIZE_UNIT'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->all();
// print_r($test);die();
=======
>>>>>>> d15abbd788fd76058166c6eb84abcc607108a505
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