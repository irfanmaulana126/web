
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
use frontend\backend\master\models\ProductHargaSearch;
$this->title="Prodak - Harga";
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
	#gv-all-data-prodak-harga-item .kv-grid-container{
		height:400px
	}
	#gv-all-data-prodak-harga-item .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #000;
	}
	#gv-all-data-prodak-harga-item .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");
function sttMsgDscp($stt){
	if($stt==0){ //TRIAL
		 return Html::a('<span class="fa-stack fa-xl">
					<i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					<i class="fa fa-check fa-stack-1x" style="color:#ff9800"></i>
				</span>','',['title'=>'Pending']);
	}elseif($stt==1){
		 return Html::a('<span class="fa-stack fa-xl">
					<i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					<i class="fa fa-check fa-stack-1x" style="color:#4caf50"></i>
				</span>','',['title'=>'Active']);
	}elseif($stt==2){
		return Html::a('<span class="fa-stack fa-xl">
						<i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
						<i class="fa fa-close fa-stack-1x" style="color:#ee0b0b"></i>
					</span>','',['title'=>'Delete']);
	}
};	
	
	$dscLabel='<b>* STATUS</b> : '.sttMsgDscp(0).'=Pending. '.sttMsgDscp(1).'=Active. '.sttMsgDscp(2).'=Delete. ';
	$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
	$bColor='rgb(76, 131, 255)';
	$pageNm='<span class="fa-stack fa-xs text-right">				  
				  <i class="fa fa-share fa-1x"></i>
				</span><b>HISTORI HARGA PRODUCT <span style="color:white">('.strtoupper($product->PRODUCT_NM).')</span></b>
	';
	$gvAttProdakHargaItem=[
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
			'label'=>'Nama Produk',
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
		//DEFAULT_STOCK
		[
			'attribute'=>'PERIODE_TGL1',
			'label'=>'TGL AWAL',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'filterType'=>GridView::FILTER_DATE,
			'filterWidgetOptions'=>['pluginOptions' => [				
				'format' => 'yyyy-mm-dd',					 
				'autoclose' => true,
				'todayHighlight' => true,
				//'format' => 'dd-mm-yyyy hh:mm',
				'autoWidget' => false,
				//'todayBtn' => true,
			]
		],
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		],
		//DEFAULT_HARGA
		[
			'attribute'=>'PERIODE_TGL2',
			'label'=>'TGL AKHIR',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'filterType'=>GridView::FILTER_DATE,
			'filterWidgetOptions'=>['pluginOptions' => [				
				'format' => 'yyyy-mm-dd',					 
				'autoclose' => true,
				'todayHighlight' => true,
				//'format' => 'dd-mm-yyyy hh:mm',
				'autoWidget' => false,
				//'todayBtn' => true,
			]
		],
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
			
		],		
		//SATUAN
		[
			'attribute'=>'HARGA_JUAL',
			//'label'=>'Cutomer',
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
		//SATUAN
		[
			'attribute'=>'HPP',
			'label'=>'HPP',
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
			'label'=>'STATUS',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format' => 'raw',	
			'value'=>function($model, $key, $index, $grid){
				if($model['PERIODE_TGL2']<date('Y-m-d')&&$model['CURRENT_PRICE']!=$model['HARGA_JUAL']){
					return Html::a('<span class="fa-stack fa-xl">
							<i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
							<i class="fa fa-close fa-stack-1x" style="color:#ee0b0b"></i>
						</span>','',['title'=>'Delete']);
				}
				else if($model['CURRENT_PRICE']==$model['HARGA_JUAL']) {
					return Html::a('<span class="fa-stack fa-xl">
					<i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					<i class="fa fa-check fa-stack-1x" style="color:#4caf50"></i>
				  </span>','',['title'=>'Active']);
				}	
				else{
					return Html::a('<span class="fa-stack fa-xl">
					<i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					<i class="fa fa-check fa-stack-1x" style="color:#ff9800"></i>
				  </span>','',['title'=>'Pending']);
				}},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','100px',''),
			
		],
	];
	
	$gvAttProdakHargaItemButton[]=[			
		//ACTION
		'class' => 'kartik\grid\ActionColumn',
		'template' => '{view}{edit}',
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
				return  tombolViewHarga($url, $model);
			},
			'edit' =>function($url, $model,$key){
				if($model['PERIODE_TGL2']<date('Y-m-d')&&$model['CURRENT_PRICE']!=$model['HARGA_JUAL']){
					return '';
				}
				else if($model['CURRENT_PRICE']==$model['HARGA_JUAL']) {
					return  tombolEditHarga($url, $model);
				}	
				else{
					return  tombolEditHarga($url, $model);
				}				
			},
			'hapus' =>function($url, $model,$key){
				return  tombolHapusHarga($url, $model);
			}
		],
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$bColor,'#ffffff'),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','10px',''),
	]; 
	$gvAllProdakHarga=GridView::widget([
		'id'=>'gv-all-data-prodak-harga-item',
		'dataProvider' => $dataProviderHarga,
		'filterModel' => $searchModelHarga,
		'columns'=>$gvAttProdakHargaItem,				
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-all-data-prodak-harga-item',
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
		'rowOptions' => function($model, $key, $index, $grid){
            if($model['PERIODE_TGL2']<date('Y-m-d')&&$model['CURRENT_PRICE']!=$model['HARGA_JUAL']){
				return ['class' => 'danger'];
			}
			else if($model['CURRENT_PRICE']==$model['HARGA_JUAL']) {
				return ['class' => 'success'];
			}	
			else{
				return ['class' => 'warning'];
			}	
        },
		'panel' => [
			// 'heading'=>false,
			'heading'=>$pageNm,
			'type'=>'success',
			'before'=>false,
			// 'before'=>'<div class="pull-right">'.tombolImportExcelHarga().' '.tombolExportExcelHarga().' '.tombolHarga($product->ACCESS_GROUP,$product->PRODUCT_ID,$product->STORE_ID).'</div>',
			'before'=>$dscLabel.'<div class="pull-right">'.tombolHarga($product->ACCESS_GROUP,$product->PRODUCT_ID,$product->STORE_ID).'</div>',
			'showFooter'=>false,
		],
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]); 	
	$produk=$this->render('produk_detail_harga',[
		'searchModel' => $searchModel,
		'dataProvider' => $dataProvider,
	]);
?>

<div class="container-fluid">
<?=$vewBreadcrumb?>
<div  style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
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
		<?=$gvAllProdakHarga?>
	</div>
	</div>
</div>
</div>
