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
use kartik\widgets\Alert;

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
		#w7 :link {
			color: black;
		}
		/* mouse over link */
		#w7-container a:hover {
			color: #5a96e7;
		}
		/* selected link */
		#w7-container a:active {
			color: blue;
		}
	");

	// $headerColor='rgba(128, 179, 178, 1)';

	$Action=$this->render('_index_all_product',[
		'searchModel'=>$searchModel,
		'dataProvider' => $dataProvider
	]);
	$Action2=$this->render('_index_discount',[
		'searchModelDiscount'=>$searchModelDiscount,
		'dataProviderDiscount' => $dataProviderDiscount,
		]);
	$Action3=$this->render('_index_promo',[
		'searchModelPromo'=>$searchModelPromo,
		'dataProviderPromo' => $dataProviderPromo,
	]);
	$Action4=$this->render('_index_stock',[		
		'searchModelStock'=>$searchModelStock,
		'dataProviderStock' => $dataProviderStock,
	]);
	$Action5=$this->render('_index_harga',[
		'searchModelHarga'=>$searchModelHarga,
		'dataProviderHarga' => $dataProviderHarga,
	]);
	$Action6=$this->render('_index_product_group',[
		'searchModelGroup'=>$searchModelGroup,
		'dataProviderGroup' => $dataProviderGroup,
	]);
	
	$items = [
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-product-hunt fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> ALL PRODUK </b>',
			'content'=>$Action,
			'active'=>true
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-cubes fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> PRODUK DISCOUNT </b>',
			'content'=>$Action2
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-gift fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> PRODUK PROMO </b>',
			'content'=>$Action3
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-tags fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> STOCK PRODUCT </b>',
			'content'=>$Action4
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-money fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> HISTORI HARGA  </b>',
			'content'=>$Action5
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-folder-open fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> PRODUCT GROUP </b>',
			'content'=>$Action6
		],
	];
	
	$tabIndex=TabsX::widget([
		'items'=>$items,
		'enableStickyTabs'=>true,
		'encodeLabels'=>false
	]);
// 	$test=ProductSearch::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP])->orderBy(['ACCESS_GROUP'=>SORT_DESC,'PRODUCT_SIZE_UNIT'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->all();
// print_r($test);die();
?>

<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
		<?php if (Yii::$app->session->hasFlash('success')){ ?>
			<?php
				echo Alert::widget([
					'type' => Alert::TYPE_SUCCESS,
					'title' => 'Well done!',
					'icon' => 'glyphicon glyphicon-ok-sign',
					'body' => Yii::$app->session->getFlash('success'),
					'showSeparator' => true,
					'delay' => 1000
				]);
			?>
		<?php } elseif (Yii::$app->session->hasFlash('error')) {
			echo Alert::widget([
				'type' => Alert::TYPE_DANGER,
				'title' => 'Oh snap!',
				'icon' => 'glyphicon glyphicon-remove-sign',
				'body' => Yii::$app->session->getFlash('error'),
				'showSeparator' => true,
				'delay' => 1000
			]);
		}?>
			<div class="col-xs-4 col-sm-4 col-lg-4 pull-right" style='padding-bottom:3px;float:right'>
				<?php	echo '<label>Check Date</label>';
					echo DatePicker::widget([
						'name' => 'check_issue_date', 
						'value' => date('Y-n'),
						'options' => ['placeholder' => 'Select issue date ...','id'=>'tahun'],
						'convertFormat' => true,
						'pluginOptions' => [
							'autoclose'=>true,
							'startView'=>'year',
							'minViewMode'=>'months',
							// 'todayHighlight' => true,
								'format' => 'yyyy-MM'
						],
					]);
					?>
				</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">			
		</div>
		<div class="row">

		<?=$tabIndex?>
		</div>
	</div>
</div>