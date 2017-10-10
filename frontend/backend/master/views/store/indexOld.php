<?php
use kartik\helpers\Html;
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
use common\models\LocateProvince;
use common\models\LocateKota;

//print_r($userProvinsi);
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
	.modal-content { 
		border-radius: 50;
	}
");

$this->registerJs($this->render('modal_store.js'),View::POS_READY);
echo $this->render('modal_store'); //echo difinition
	
	//Difinition Status.
	$aryStt= [
	  ['STATUS' => 0, 'STT_NM' => 'Trial'],		  
	  ['STATUS' => 1, 'STT_NM' => 'Active'],
	  ['STATUS' => 2, 'STT_NM' => 'Deactive'],
	  ['STATUS' => 3, 'STT_NM' => 'Deleted'],
	];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	
	$dscLabel='[<b>STATUS</b>]: '.sttMsg(0).'=Trial. '.sttMsg(1).'=Active. '.sttMsg(2).'=Deactive. '.sttMsg(3).'=Delete.';
	$dscAction='[<b>ACTION</b>]: 
				<font color=red>Items</font>=CRUD Items/double click tabel row; 
				<font color=red>View</font>=Detail Tampilan Outlet;  
				<font color=red>Review</font>=Review & Update Outlet; 
				<font color=red>Payment</font>=Pembayaran & Langanan Outlet;
	';
	//Result Status value.
	function sttMsg($stt){
		if($stt==0){ //TRIAL
			 return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-check fa-stack-1x" style="color:#ee0b0b"></i>
					</span>','',['title'=>'Trial']);
		}elseif($stt==1){
			 return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-check fa-stack-1x" style="color:#05944d"></i>
					</span>','',['title'=>'Active']);
		}elseif($stt==2){
			return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-remove fa-stack-1x" style="color:#01190d"></i>
					</span>','',['title'=>'Deactive']);
		}elseif($stt==3){
			return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-close fa-stack-1x" style="color:#ee0b0b"></i>
					</span>','',['title'=>'Delete']);
		}
	};	
	
	// if ($model->STATUS == 0) {
				  // return Html::a('
					// <span class="fa-stack fa-xl">
					  // <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  // <i class="fa fa-close fa-stack-1x" style="color:#0f39ab"></i>
					// </span>','',['title'=>'Running']);
				// } else if ($model->STATUS == 1) {
				  // return Html::a('<span class="fa-stack fa-xl">
					  // <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  // <i class="fa fa-check fa-stack-1x" style="color:#ee0b0b"></i>
					// </span>','',['title'=>'Finish']);
				// }
	
	
	
	
	$bColor='rgba(87,114,111, 1)';
	$gvAttributeItem=[
		// [
			// 'class'=>'kartik\grid\SerialColumn',
			// 'contentOptions'=>['class'=>'kartik-sheet-style'],
			// 'width'=>'10px',
			// 'header'=>'No',
			// 'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColor,'#ffffff'),
			// 'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		// ],	
		//ACTION
		[
			'class' => 'kartik\grid\ActionColumn',
			'template' => '{product}{view}{review}{payment}',
			'header'=>'ACTION',
			'dropdown' => true,
			'dropdownOptions'=>[
				'class'=>'pull-left dropdown',
				'style'=>'text-align:center;background-color:#E6E6FA'				
			],
			'dropdownButton'=>[
				'label'=>'ACTION',
				'class'=>'btn btn-info btn-xs',
				'style'=>'width:100%;'		
			],
			'buttons' => [
				'product' =>function ($url, $model){
				  return  tombolProduct($url, $model);
				},
				/* 'view' =>function ($url, $model){
				  return  tombolView($url, $model);
				},
				'review' =>function($url, $model,$key){
					//if($model->STATUS!=1){ //Jika sudah close tidak bisa di edit.
						return  tombolReview($url, $model);
					//}					
				},
				'payment' =>function($url, $model,$key){
					//if($model->STATUS!=1){ //Jika sudah close tidak bisa di edit.
						return  tombolPayment($model);
					//}					
				} */
			], 
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','0',''),
		],
		//'STATUS',
		 [
			'attribute'=>'STATUS',
			'filterType'=>GridView::FILTER_SELECT2,
			'filterWidgetOptions'=>[
				'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
			],
			'filterInputOptions'=>['placeholder'=>'Select'],
			'filter'=>$valStt,//Yii::$app->gv->gvStatusArray(),
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px',$bColor),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format' => 'raw',	
			'value'=>function($model){
				return sttMsg($model->STATUS);				 
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','50','')			
		], 
		
		//KD_BARCODE
		/* [
			'attribute'=>'STORE_ID',
			'filterType'=>false,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->STORE_ID, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		], */
		//OUTLET_NM
		[
			'attribute'=>'STORE_NM',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'format'=>'html',
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->STORE_NM, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),
			
		],		
		
		//PROVINCE
		[
			'attribute'=>'PROVINCE_NM',
			// 'filter' => $aryProvinsi,
			// 'filterType'=>GridView::FILTER_SELECT2,
			// 'filterWidgetOptions'=>[
				// 'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
			// ],
			// 'filterInputOptions'=>['placeholder'=>'Cari Provinsi'],
			// 'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->PROVINCE_NM, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],		
		//CITY
		[
			'attribute'=>'CITY_NAME',
			// 'filter' => $aryKota,
			// 'filterType'=>GridView::FILTER_SELECT2,
			// 'filterWidgetOptions'=>[
				// 'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
			// ],
			// 'filterInputOptions'=>['placeholder'=>'Cari Kota'],	
			// 'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),						
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->CITY_NAME, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],		
		//INDUSTRY_GRP_NM
		[
			'attribute'=>'INDUSTRY_GRP_NM',
			// 'filter' => $aryKota,
			// 'filterType'=>GridView::FILTER_SELECT2,
			// 'filterWidgetOptions'=>[
				// 'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
			// ],
			// 'filterInputOptions'=>['placeholder'=>'Cari Kota'],	
			// 'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),						
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->INDUSTRY_GRP_NM, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],
		//INDUSTRY_NM
		[
			'attribute'=>'INDUSTRY_NM',
			// 'filter' => $aryKota,
			// 'filterType'=>GridView::FILTER_SELECT2,
			// 'filterWidgetOptions'=>[
				// 'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
			// ],
			// 'filterInputOptions'=>['placeholder'=>'Cari Kota'],	
			// 'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),						
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->INDUSTRY_NM, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],			
		//DATE_START.
		 [
			'attribute'=>'DATE_START',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->DATE_START, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],	
		//DATE_END.
		[
			'attribute'=>'DATE_END',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->DATE_END, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],		
		//STORE TLP.
		/* [
			'attribute'=>'TLP',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->TLP, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],		
		//STORE FAX.
		[
			'attribute'=>'FAX',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->FAX, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],	 */ 
		//ALAMAT.
		/* [
			'attribute'=>'ALAMAT',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', $data->ALAMAT, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),
			
		],		 */
		//EXPIRED.
		// [
			// 'attribute'=>'EXPIRED',
			// 'label'=>'EXPIRED',
			// 'filterType'=>true,
			// 'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			// 'hAlign'=>'right',
			// 'vAlign'=>'middle',
			// 'mergeHeader'=>false,
			// 'noWrap'=>false,
			// 'format'=>'raw',
			// 'value'=>function($data) {				
					// return Html::tag('div', $data->EXPIRED . ' days', ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			// },
			// 'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor,'#ffffff'),
			// 'contentOptions'=>Yii::$app->gv->gvContainBody('right','50px',''),
			
		// ],	
		
		
	];

	$gvStore=GridView::widget([
		'id'=>'gv-store',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttributeItem,	
		'rowOptions'   => function ($model, $key, $index, $grid) {
			//$urlDestination=Url::to(['/efenbi-rasasayang/item-group/index', 'id' => $model->ID]);
			$urlDestination=Url::to(['/master/product', 'storeid' => $model->STORE_ID]);
			return ['ondblclick' =>'location.href="'.$urlDestination.'"'];
			// return ['id'=>	[$model->ID],'ondblclick' =>function(){				
				// return 'location.href="'.$urlDestination.'"';
			// }];
		},		 
		'pjax'=>true,
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
		'toolbar' => [
			''
		],
		'summary'=>false,
		'panel' => [
			//'heading'=>false,
			'heading'=>'
				<span class="fa-stack fa-sm">
				  <i class="fa fa-circle-thin fa-stack-2x" style="color:#25ca4f"></i>
				  <i class="fa fa-television fa-stack-1x"></i>
				</span> List Outlet'.'   <div style="float:right">	</div>',  
			'type'=>'default',
			'before'=>false,
			'after'=>false,
			'footer'=>'<div>'.$dscLabel.'</div><div>'.$dscAction.'</div>',
			//'before'=> tombolCreate().' '.tombolRefresh().' '.tombolExportExcel(),
			//'before'=> tombolReqStore(),
			'showFooter'=>'aas',
		], 
		// 'floatOverflowContainer'=>true,
		// 'floatHeader'=>true,
	]); 
	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">
			<?=$gvStore?>
		</div>		
	</div>
</div>