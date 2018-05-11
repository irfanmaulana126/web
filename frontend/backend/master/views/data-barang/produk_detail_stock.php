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
use frontend\backend\master\models\Product;
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
	#gv-all-data-prodak-item .kv-grid-container{
		height:400px
	}
	#gv-all-data-prodak-item .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #000;
	}
	#gv-all-data-prodak-item .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	td.kv-group-odd {
		background-color: #70c0ff!important;
	}
	td.kv-group-even {
		background-color: #70c0ff!important;
	}
");
	$colorPluginOptions =  [
		'showPalette' => true,
		'showPaletteOnly' => true,
		'showSelectionPalette' => true,
		'showAlpha' => false,
		'allowEmpty' => false,
		'preferredFormat' => 'name',
		'palette' => [
			[
				"white", "black", "grey", "silver", "gold", "brown", 
			],
			[
				"red", "orange", "yellow", "indigo", "maroon", "pink"
			],
			[
				"blue", "green", "violet", "cyan", "magenta", "purple", 
			],
		]
	];		
	$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
    $bColor='rgb(76, 131, 255)';
	$pageNm='<span class="fa-stack fa-xs text-right">				  
				  <i class="fa fa-share fa-1x"></i>
				</span><b>All-PRODUCT</b>
	';
	$gvAttProdakItem=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		//ITEM_ID
		[
			'attribute'=>'store.STORE_NM',
			'filterType'=>true,
			'format'=>'raw',
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','80px'),
			'hAlign'=>'right',
			'vAlign'=>'top',
			'mergeHeader'=>false,
			'group'=>true,
			'groupedRow'=>true,
			'noWrap'=>false,
			'value' => function ($model, $key, $index, $widget) {
				if (empty($model->STORE_NM)) {
					return '-';
				} else {
					return "Nama Toko : <span class='label label-success' style='font-size: 7pt;'>".strtoupper($model->STORE_NM)."</span> ";
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'left',
					'font-family'=>'tahoma, arial, sans-serif',						
					'font-weight'=>'bold',
				],
			]
		],				
		//ITEM NAME
		[
			'attribute'=>'PRODUCT_NM',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'format'=>'raw',
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','200px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'filter'=>ArrayHelper::map(Product::find()->joinWith('store','store.STORE_ID=product.STORE_ID')->where(['product.ACCESS_GROUP'=>$user,'store.STATUS'=>1,'product.STATUS'=>1])->orderBy(['PRODUCT_ID'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->all(),'PRODUCT_NM','PRODUCT_NM'),
			'filterType'=>GridView::FILTER_SELECT2,
			'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],	
			'filterInputOptions'=>['placeholder'=>'-Pilih-'],
			'filterOptions'=>[],
			'value'=>function($data) {				
				return Html::tag('div', strtoupper($data->PRODUCT_NM), ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'click to Product Items ','style'=>'cursor:default;']);				
			},	
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','200px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','200px',''),			
		],		
			
	];
	
	$gvAllStoreItem=GridView::widget([
		'id'=>'gv-all-data-prodak-item',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttProdakItem,			
		'rowOptions'   => function ($model, $key, $index, $grid) {
			//$urlDestination=Url::to(['/efenbi-rasasayang/item-group/index', 'id' => $model->ID]);
			//$urlDestination=Url::to(['/master/product', 'storeid' => $model->STORE_ID]);
			//if 
			
			$btnclick= ['ondblclick' => '
				$.pjax.reload({
					url: "'.Url::to(["/master/data-barang/index-stock?productid=".$model->PRODUCT_ID.""]).'",
					container: "#gv-all-data-prodak-stock-item",
					timeout: 1000,
				});	'];
			//$btnclick2= ['ondblclick' =>'location.href="'.$urlDestination.'"'];
			//print_r($btnclick2);
			//die();
			return $btnclick;
		},		
		'pjax'=>0,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-store',
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
			'heading'=>$pageNm,
			'type'=>'default',
			'before'=>false,
			'showFooter'=>false,
			'after'=>false,
			// 'before'=> tombolReqStore(),
		],
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]); 	
?>
<?=$gvAllStoreItem?>