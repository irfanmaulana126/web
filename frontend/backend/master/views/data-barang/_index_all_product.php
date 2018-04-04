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
use frontend\backend\master\models\Product;
$this->title="All Prodak";
$this->registerJs($this->render('databarang_script.js'),View::POS_READY);
$this->params['breadcrumbs'][] = ['label'=>'Produk', 'url' => ['/master/data-barang']];
$this->params['breadcrumbs'][] =  $this->title;
$vewBreadcrumb=Breadcrumbs::widget([
	'homeLink' => [
		'label' => Html::encode(Yii::t('yii', 'Home')),
		'url' => Yii::$app->homeUrl,
	],
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
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
	#gv-all-data-prodak-item .kv-grid-container{
		height:600px
	}
	#gv-all-data-prodak-item .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #000;
	}
	#gv-all-data-prodak-item .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
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
		//Grouping STORE
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
					return "Nama Toko : <span class='label label-success'>".$model->STORE_NM."</span> ";
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'left',
					'color'=>'red',
					'font-family'=>'tahoma, arial, sans-serif',						
					'font-weight'=>'bold',
				],
			]
		],		
		//PRODUK NAME
		[
			'attribute'=>'PRODUCT_NM',
			'label'=>'Produk',
			'filterType'=>true,
			'format'=>'raw',
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','200px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'filter'=>ArrayHelper::map(Product::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['PRODUCT_ID'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->all(),'PRODUCT_NM','PRODUCT_NM'),
			'filterType'=>GridView::FILTER_SELECT2,
			'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],	
			'filterInputOptions'=>['placeholder'=>'-Pilih-'],
			'filterOptions'=>[],
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','200px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','200px',''),			
		],	
		//GARGA HPP
		[
			'attribute'=>'CURRENT_HPP',
			'label'=>'HPP',
			'filterType'=>false,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>true,
			'format'=>'raw',
			'value' => function ($model, $key, $index, $widget) {
				if (empty($model->CURRENT_PRICE)) {
					return 0;
				} else {
					return $model->CURRENT_PRICE;
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		],		
		//GARGA JUAL
		[
			'attribute'=>'CURRENT_PRICE',
			'label'=>'Harga Jual',
			'filterType'=>false,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>true,
			'format'=>'raw',
			'value' => function ($model, $key, $index, $widget) {
				if (empty($model->CURRENT_PRICE)) {
					return 0;
				} else {
					return $model->CURRENT_PRICE;
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		],		
		
		//SATUAN
		[
			'attribute'=>'PRODUCT_WARNA',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value' => function ($model, $key, $index, $widget) {
				if (empty($model->PRODUCT_WARNA)) {
					return '-';
				} else {
					return "<span class='badge' style='background-color: {$model->PRODUCT_WARNA}'> </span>  <code>" . $model->PRODUCT_WARNA . '</code>';
				}
			},
			'width' => '8%',
			'filterType' => GridView::FILTER_COLOR,
			'filterWidgetOptions' => [
				'showDefaultPalette' => false,
				'pluginOptions' => $colorPluginOptions,
			],
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],
		//DEFAULT_HARGA,		
		[
			'attribute'=>'INDUSTRY_GRP_NM',
			//'label'=>'Cutomer',
			'filterType'=>false,
			//'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value' => function ($model, $key, $index, $widget) {
				if (empty($model->INDUSTRY_GRP_NM)) {
					return '-';
				} else {
					return $model->INDUSTRY_GRP_NM;
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
		],	
		[
			'attribute'=>'INDUSTRY_NM',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value' => function ($model, $key, $index, $widget) {
				if (empty($model->INDUSTRY_NM)) {
					return '-';
				} else {
					return $model->INDUSTRY_NM;
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		],
		[
			'attribute'=>'PRODUCT_SIZE_UNIT',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'filter'=>ArrayHelper::map(Product::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['PRODUCT_SIZE_UNIT'=>SORT_DESC])->all(),'PRODUCT_SIZE_UNIT','PRODUCT_SIZE_UNIT'),
			'filterType'=>GridView::FILTER_SELECT2,
			'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],	
			'filterInputOptions'=>['placeholder'=>'-Pilih-'],
			'filterOptions'=>[],
			'value' => function ($model, $key, $index, $widget) {
				if (empty($model->PRODUCT_SIZE_UNIT)) {
					return '-';
				} else {
					return $model->PRODUCT_SIZE_UNIT;
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		],
		[
			'attribute'=>'PRODUCT_SIZE',
			//'label'=>'Cutomer',
			'filterType'=>true,
			// 'filterType'=>GridView::FILTER_MONEY,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value' => function ($model, $key, $index, $widget) {
				if (empty($model->PRODUCT_SIZE)) {
					return 0;
				} else {
					return $model->PRODUCT_SIZE;
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		],		
		[
			'attribute'=>'STOCK_LEVEL',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value' => function ($model, $key, $index, $widget) {
				if (empty($model->STOCK_LEVEL)) {
					return 0;
				} else {
					return $model->STOCK_LEVEL;
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		],		
		[
			'attribute'=>'CURRENT_STOCK',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value' => function ($model, $key, $index, $widget) {
				if (empty($model->CURRENT_STOCK)) {
					return 0;
				} else {
					return $model->CURRENT_STOCK;
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		],		
	];
	
	$gvAttProdakItem[]=[			
		//ACTION
		'class' => 'kartik\grid\ActionColumn',
		'template' => '{view}{edit}{hapus}{discount}{promo}{harga}{stock}',
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
			},
		],
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$bColor,'#ffffff'),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','10px',''),
	]; 
	$gvAllStoreItem=GridView::widget([
		'id'=>'gv-all-data-prodak-item',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttProdakItem,				
		'pjax'=>0,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-all-data-prodak-item',
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
			'heading'=>'<div class="pull-right">'/*.tombolKembali().*/.' '.tombolExportExcel().' '.tombolImportExcel().' '.tombolCreate().'&nbsp;</div>'.$pageNm,
			'type'=>'default',
			'before'=>false,
			'showFooter'=>false,
			'after'=>false,
			// 'before'=> tombolReqStore(),
		],
		'summary'=>false,
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]); 	
?>

<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
<h5><?=$vewBreadcrumb ?></h5>
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
		}elseif (Yii::$app->session->hasFlash('warning')) {
			echo Alert::widget([
				'type' => Alert::TYPE_WARNING,
				'title' => 'Warning!',
				'icon' => 'glyphicon glyphicon-exclamation-sign',
				'body' =>  Yii::$app->session->getFlash('warning'),
				'showSeparator' => true,
				'delay' => 3000
			]);
		}?>
		<div style="margin-top: -10px;margin-bottom: 10px;">
		<?php//=tombolKembali()?>
	</div>
	<?=$gvAllStoreItem?>
</div>
