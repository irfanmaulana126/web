
<?php
use kartik\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\editable\Editable;
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
use kartik\widgets\SwitchInput;
use frontend\backend\master\models\Product;

$this->title="Data Gaji";
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
	#gv-izin-presensi .kv-grid-container{
		height:400px
	}
	#gv-izin-presensi .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #444;
	}
	#gv-izin-presensi .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");
			
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
			// 'class' => 'kartik\grid\EditableColumn',
			'attribute'=>'STORE_ID',
			'filterType'=>true,
			'format'=>'raw',
			'hAlign'=>'right',
			'vAlign'=>'top',
			'mergeHeader'=>false,
			'group'=>true,
			'groupedRow'=>true,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],		
		//SATUAN
		[
			'attribute'=>'IZIN_NM',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],
		//DEFAULT_STOCK
		[
			'class' => 'kartik\grid\EditableColumn',
			'attribute'=>'IZIN_STT',
			//'label'=>'Cutomer',
			'editableOptions'=> [
					'header'=>'STATUS PEMBAYARAN', 
					'asPopover' => true,
					'size'=>'md',
					'inputType' => \kartik\editable\Editable::INPUT_SWITCH,
					'options' => [
						'pluginOptions' => [
							'items'=>[
								'value'=>empty($model->IZIN_STT) ? '0' : '1',
							]
						]
					]
			],
			'filterType'=>true,
			'value'=>function($model) {				
				$retVal = ($model->IZIN_STT==1) ? 'DIBAYAR' : 'TIDAK DIBAYAR' ;
				return	$retVal;			
			},
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],
	];
	$gvAttProdakItembutton[]=[			
		//ACTION
		'class' => 'kartik\grid\ActionColumn',
		'template' => '{view}{edit}{hapus}{discount}{promo}{harga}',
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
				// return  tombolView($url, $model);
			},
			'edit' =>function($url, $model,$key){
				//if($model->STATUS!=1){ //Jika sudah close tidak bisa di edit.
				// return  tombolEdit($url, $model);
				//}					
			},
			'hapus' =>function($url, $model,$key){
				// return  tombolHapus($url, $model);
			},
		],
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$bColor,'#ffffff'),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','10px',''),
	]; 
	$gvAllStoreItem=GridView::widget([
		'id'=>'gv-izin-presensi',
        'dataProvider' => $dataProviderIzin,
        'filterModel' => $searchModelIzin,
		'columns'=>$gvAttProdakItem,				
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-izin-presensi',
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
			'heading'=>'<div style="float:right"> </div> &nbsp'.$pageNm,
			'type'=>'default',
			'before'=>false,
			'showFooter'=>false,
		],
		// 'floatOverflowContainer'=>true,
		// 'floatHeader'=>true,
	]); 	
?>

        <?=$gvAllStoreItem?>
