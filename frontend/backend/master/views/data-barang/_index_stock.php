<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use kartik\widgets\Spinner;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use yii\web\View;
use kartik\widgets\Alert;
use frontend\backend\master\models\ProductStockSearch;
$this->title="Prodak - Stock";
$this->params['breadcrumbs'][] = ['label'=>'Produk', 'url' => ['/master/data-barang']];
$this->params['breadcrumbs'][] =  $this->title;
$vewBreadcrumb=Breadcrumbs::widget([
	'homeLink' => [
		'label' => Html::encode(Yii::t('yii', 'Home')),
		'url' => Yii::$app->homeUrl,
	],
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
$this->registerJs($this->render('databarang_script.js'),View::POS_READY);

echo $this->render('databarang_button'); //echo difinition
echo $this->render('databarang_modal'); //echo difinition
$this->registerCss("
	:link {
		color: #fdfdfd;
	}
	/* mouse over link */
	a:hover {
		color: #5a96e7;
	}
	/* selected link */
	a:active {
		color: blue;
	}
	#gv-all-data-prodak-stock-item .kv-grid-container{
		height:450px
	}
	#gv-all-data-prodak-stock-item .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #000;
	}
	#gv-all-data-prodak-stock-item .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");
	$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
	$bColor='rgb(76, 131, 255)';
	$pageNm='<span class="fa-stack fa-xs text-right">				  
				  <i class="fa fa-share fa-1x"></i>
				</span><b>STOCK PRODUCT <span style="color:white">('.strtoupper($product->PRODUCT_NM).')</span></b>
	';
	$gvAttProdakStockItems=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],	
		[
			'attribute'=>'PRODUCT_NM',
			'label'=>'NAMA PRODUK',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','200px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'group'=>true,
			'groupedRow'=>true,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','200px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','200px',''),
			
		],
		//SATUAN
		[
			'attribute'=>'INPUT_TIME',
			'label'=>'WAKTU',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],
		[
			'attribute'=>'SUPPLIER_NM',
			'label'=>'SUPPLIER',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('LEFT','100px',''),
			
		],
		[
			'attribute'=>'INPUT_STOCK',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		],
	];
	
	$gvAttProdakStockItemsButton[]=[			
		//ACTION
		'class' => 'kartik\grid\ActionColumn',
		'template' => '{view}{edit}{hapus}',
		'header'=>'ACTION',
		'dropdown' => true,
		'dropdownOptions'=>[
			'class'=>'pull-right dropdown',
			'style'=>'width:100%;background-color:#E6E6FA'				
		],
		'dropdownButton'=>[
			'label'=>'ACTION',
			'class'=>'btn btn-info btn-xs',
			'style'=>'width:100%'		
		],
		'buttons' => [
			'view' =>function ($url, $model){
				return  tombolView($url, $model);
			},
			'edit' =>function($url, $model,$key){
				//if($model->STATUS!=1){ //Jika sudah close tidak bisa di edit.
				return  tombolEdit($url, $model);
				//}					
			},
			'hapus' =>function($url, $model,$key){
				return  tombolHapus($url, $model);
			}
		],
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$bColor,'#ffffff'),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','10px',''),
	]; 
	$gvAllProdakStockItem=GridView::widget([
		'id'=>'gv-all-data-prodak-stock-item',
		'dataProvider' => $dataProviderStock,
		'filterModel' => $searchModelStock,
		'columns'=>$gvAttProdakStockItems,				
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-all-data-prodak-stock-item',
		    ],						  
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>true,
		'bordered'=>true,
		'striped'=>true,
		'autoXlFormat'=>true,
		'export' => false,
		'panel'=>[''],
		'toolbar' => false,
		'panel' => [
			// 'heading'=>false,
			'heading'=>$pageNm.'<div class="pull-right">'.tombolStock($product->ACCESS_GROUP,$product->PRODUCT_ID,$product->STORE_ID).'</div>',
			'type'=>'success',
			'before'=>false,
			// 'before'=>'<div class="pull-right">'.tombolImportExcelStock().' '.tombolExportExcelStock().' '.tombolStock($product->ACCESS_GROUP,$product->PRODUCT_ID,$product->STORE_ID).'</div>',
			// 'before'=>'<div class="pull-right">'.tombolStock($product->ACCESS_GROUP,$product->PRODUCT_ID,$product->STORE_ID).'</div>',
			'showFooter'=>true,
		],
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]); 	
	$produk=$this->render('produk_detail_stock',[
		'searchModel' => $searchModel,
		'dataProvider' => $dataProvider,
	]);
?>

<div class="container-fluid">
<?=$vewBreadcrumb?>
<div style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
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
		<div style="margin-top: -10px;margin-bottom: 10px;">
		<?php//tombolKembali()?>
	</div>
	<div class="row">
	<div class="col-md-4">
		<?=$produk?>
	</div>
	<div class="col-md-8">	
		<?=$gvAllProdakStockItem?>
	</div>
</div>
</div>
</div>