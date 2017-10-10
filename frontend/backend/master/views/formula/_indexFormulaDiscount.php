<?php
use yii\helpers\Html;
use kartik\widgets\Select2;
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
use yii\web\Request;
use yii\db\ActiveRecord;
use yii\data\ArrayDataProvider;
use kartik\detail\DetailView;

use frontend\backend\master\models\ItemFdiscount;
use frontend\backend\master\models\ItemFdiscountSearch;
use frontend\backend\master\models\Item;
use frontend\backend\master\models\ItemSearch;

	$searchModel = new ItemFdiscountSearch(['ITEM_ID'=>$paramCariItem]);
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	$searchModelItemInfo = new ItemSearch(['ID'=>$paramCariItem]);
	$dataProviderItemInfo = $searchModelItemInfo->search(Yii::$app->request->queryParams);
	$modelItemInfo= $dataProviderItemInfo->getModels()[0];
	
	$attViewFDiscount=[	
		[
			'columns' => [
				[
					'attribute'=>'ITEM_ID', 
					'label'=>'ITEM_ID',
					//'value'=> $dataProvider[0]['ITEM_ID'],
					'displayOnly'=>true,
					'valueColOptions'=>['style'=>'width:30%;font-family: tahoma ;font-size: 8pt;'], 
					'labelColOptions'=>['style'=>'width:130px;font-family: tahoma ;font-size: 8pt;'], 
				],
				[
					'attribute'=>'OUTLET_CODE', 
					'format'=>'raw',
					'label'=>'START TIME',
					'valueColOptions'=>['style'=>'font-family: tahoma ;font-size: 8pt;'], 
					'labelColOptions'=>['style'=>'width:130px; font-family: tahoma ;font-size: 8pt;'], 
					'displayOnly'=>true
				],
			],
		],
		[
			'columns' => [
				[
					'attribute'=>'ITEM_NM', 
					'label'=>'SALES ACCESS_UNIX',
					'valueColOptions'=>['style'=>'width:30%;font-family: tahoma ;font-size: 8pt;'], 
					'labelColOptions'=>['style'=>'width:130px;font-family: tahoma ;font-size: 8pt;'], 
					'displayOnly'=>true
				],
				[
					'attribute'=>'SATUAN',
					'format'=>'raw',
					'label'=>'END TIME',
					'valueColOptions'=>['style'=>'font-family: tahoma ;font-size: 8pt;'], 
					'labelColOptions'=>['style'=>'width:130px;font-family: tahoma ;font-size: 8pt;'], 
					'displayOnly'=>true
				],
			],
		]			
	];

	$dvViewFDiscount=DetailView::widget([
		'id'=>'dv-fdiscount-view',
		'model' => $modelItemInfo,
		'attributes'=>$attViewFDiscount,
		'condensed'=>true,
		'hover'=>true,
		// 'panel'=>false,
		// 'mode'=>DetailView::MODE_VIEW,
		
	]);
	
	$bColorDiscount='rgba(133, 240, 51, 1)';
	$gvAttDiscount=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>tombolCreateDiscount(),
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColorDiscount,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		//ITEM NAME
		[
			'attribute'=>'ITEM_ID',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorDiscount),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
		,//HARI
		[
			'attribute'=>'HARI',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorDiscount),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
		,//HARI
		[
			'attribute'=>'HARI',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorDiscount),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]	
		,//PERIODE_TGL1
		[
			'attribute'=>'PERIODE_TGL1',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorDiscount),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]	
		,//PERIODE_TGL2
		[
			'attribute'=>'PERIODE_TGL2',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorDiscount),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]	
	
	];

	$gvDiscountPerStore=GridView::widget([
		'id'=>'gv-discount-detail',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttDiscount,	
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-discount-detail',
		    ],						  
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>true,
		'bordered'=>true,
		'striped'=>true,
		'autoXlFormat'=>true,
		'export' => false,
		'toolbar' => false,
		'panel'=>[
			'heading'=>$dvViewFDiscount.'<style="',
			'type'=>'success',
			'before'=>false,
			'footer'=>false,			
		],		
		'summary'=>false,
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]); 
	
?>
<?=$gvDiscountPerStore?>
