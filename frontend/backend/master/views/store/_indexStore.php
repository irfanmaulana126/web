<?php
use kartik\helpers\Html;
use kartik\detail\DetailView;
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
use common\models\Store;
$headerColor='rgba(128, 179, 178, 1)';
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
	},
	.kv-panel {
		//min-height: 340px;
		height: 300px;
	}
	#gv-store .kv-grid-container{
		height:200px
	}
	#gv-store .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color:#000;
	}
	#gv-store .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");
$this->registerJs($this->render('modal_store.js'),View::POS_READY);
echo $this->render('button_store'); //echo difinition
echo $this->render('modal_store'); //echo difinition
	
	
	
	//Difinition Status.
	$aryStt= [
	  ['STATUS' => 0, 'STT_NM' => 'Trial'],		  
	  ['STATUS' => 1, 'STT_NM' => 'Active'],
	  ['STATUS' => 2, 'STT_NM' => 'Deactive'],
	  ['STATUS' => 3, 'STT_NM' => 'Deleted'],
	];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
	$LEVEL = (empty(Yii::$app->user->identity->ACCESS_LEVEL)) ? '' : Yii::$app->user->identity->ACCESS_LEVEL;
	$createStore = (empty($LEVEL=='OWNER')) ? '' : tombolReqStore();
    
	function sttMsgDscp($stt){
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
		
	$dscLabel='<b>* STATUS</b> : '.sttMsgDscp(0).'=Trial. '.sttMsgDscp(1).'=Active. '.sttMsgDscp(2).'=Deactive. '.sttMsgDscp(3).'=Delete. ';
	
	
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
		
		//'STATUS',
		 
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
				// 'IdOptions'=>'tes',
				'attribute'=>'STORE_NM',
				'label'=>'NAMA TOKO',
				'filterType'=>true,
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'mergeHeader'=>false,
				'format'=>'html',
				'noWrap'=>false,
				'format'=>'raw',
				'filter' => ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->all(),'STORE_NM','STORE_NM'),
				'filterType'=>GridView::FILTER_SELECT2,
				'filterWidgetOptions'=>[
					'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
				],
				'filterInputOptions'=>['placeholder'=>'Cari STORE'],
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
				'value'=>function($data) {				
						return Html::tag('div',strtoupper($data->STORE_NM), ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
				},
				'headerOptions'=>Yii::$app->gv->gvContainHeader('center','150px',$headerColor),
				'contentOptions'=>Yii::$app->gv->gvContainBody('left','150px',''),
				
			],		
		
		//PROVINCE
		[
			'attribute'=>'PIC',
			'label'=>'PIC',
			// 'filter' => $aryProvinsi,
			// 'filter' => ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->all(),'PROVINCE_NM','PROVINCE_NM'),
			// 'filterType'=>GridView::FILTER_SELECT2,
			// 'filterWidgetOptions'=>[
			// 	'id'=>'access',
			// 	'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
			// ],
			// 'filterInputOptions'=>['placeholder'=>'Cari Provinsi','id'=>'provinsi'],
			// 'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {				
					return Html::tag('div', strtoupper($data->PIC), ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$headerColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],		
		[
			'attribute'=>'ALAMAT',
			'label'=>'ALAMAT',
			// 'filter' => $aryProvinsi,
			// 'filter' => ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->all(),'PROVINCE_NM','PROVINCE_NM'),
			// 'filterType'=>GridView::FILTER_SELECT2,
			// 'filterWidgetOptions'=>[
			// 	'id'=>'access',
			// 	'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
			// ],
			// 'filterInputOptions'=>['placeholder'=>'Cari Provinsi','id'=>'provinsi'],
			// 'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {	
					$datas = explode(',',$data->ALAMAT);
					$alamat = $datas[0].''.((empty($datas[2]))?'':', '.$datas[2]).''.((empty($datas[3]))?'':', '.$datas[3]);		
					return Html::tag('div', strtoupper($alamat), ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$headerColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],		
		[
			'attribute'=>'TLP',
			'label'=>'TLP',
			// 'filter' => $aryProvinsi,
			// 'filter' => ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->all(),'PROVINCE_NM','PROVINCE_NM'),
			// 'filterType'=>GridView::FILTER_SELECT2,
			// 'filterWidgetOptions'=>[
			// 	'id'=>'access',
			// 	'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
			// ],
			// 'filterInputOptions'=>['placeholder'=>'Cari Provinsi','id'=>'provinsi'],
			// 'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			'value'=>function($data) {	
					return Html::tag('div', strtoupper($data->TLP), ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$headerColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],		
		// [
		// 	'attribute'=>'PROVINCE_NM',
		// 	'label'=>'PROVINSI',
		// 	// 'filter' => $aryProvinsi,
		// 	'filter' => ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->all(),'PROVINCE_NM','PROVINCE_NM'),
		// 	'filterType'=>GridView::FILTER_SELECT2,
		// 	'filterWidgetOptions'=>[
		// 		'id'=>'access',
		// 		'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
		// 	],
		// 	'filterInputOptions'=>['placeholder'=>'Cari Provinsi','id'=>'provinsi'],
		// 	'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
		// 	'hAlign'=>'right',
		// 	'vAlign'=>'middle',
		// 	'mergeHeader'=>false,
		// 	'noWrap'=>false,
		// 	'format'=>'raw',
		// 	'value'=>function($data) {				
		// 			return Html::tag('div', $data->PROVINCE_NM, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
		// 	},
		// 	'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$headerColor),
		// 	'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		// ],		
		//CITY
		// [
		// 	'attribute'=>'CITY_NAME',
		// 	'label'=>'KOTA',
		// 	// 'filter' => $aryKota,
		// 	// 'filter' => TRUE,
		// 	'filterType'=>GridView::FILTER_SELECT2,
		// 	'filterWidgetOptions'=>[
		// 		'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
		// 	],
		// 	'filterInputOptions'=>['placeholder'=>'Cari Kota','id'=>'kota'],	
		// 	'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),						
		// 	'hAlign'=>'right',
		// 	'vAlign'=>'middle',
		// 	'mergeHeader'=>false,
		// 	'noWrap'=>false,
		// 	'format'=>'raw',
		// 	'value'=>function($data) {				
		// 			return Html::tag('div', $data->CITY_NAME, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
		// 	},
		// 	'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$headerColor),
		// 	'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		// ],		
		//INDUSTRY_GRP_NM
		/* [
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
			
		], */
		//INDUSTRY_NM
		/* [
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
			
		],	 */		
		//DATE_START.
		 /* [
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
			
		],	 */
		//DATE_END.
		/* [
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
			
		],		 */
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
	$gvAttributeItem[]=[
		'attribute'=>'STATUS',
		'filterType'=>GridView::FILTER_SELECT2,
		'filterWidgetOptions'=>[
			'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
		],
		'filterInputOptions'=>['placeholder'=>'Select'],
		'filter'=>$valStt,//Yii::$app->gv->gvStatusArray(),
		'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px',$headerColor),
		'hAlign'=>'right',
		'vAlign'=>'middle',
		'mergeHeader'=>false,
		'noWrap'=>false,
		'format' => 'raw',	
		'value'=>function($model){
			return sttMsg($model->STATUS);				 
		},
		//gvContainHeader($align,$width,$bColor)
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50',$headerColor),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','50','')			
	];
	
	
	$gvAttributeItem[]=[
		'class' => 'kartik\grid\ActionColumn',
		// 'template' => '{product}{view}{review}{payment}',
		'template' => '{device}{edit}{delete}',
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
			
			// 'view' =>function ($url, $model){
			//   return  tombolView($url, $model);
			// },
			'edit' =>function ($url, $model){
				if($model->STATUS!=3){
					return  tombolUpdate($url, $model);
				}	
			},
			'delete' =>function ($url, $model){
				if($model->STATUS!=3 && $model->owner=="OWNER"){
					return  tombolDelete($url, $model);
				}	
			},
			'device' =>function($url, $model,$key){
				if($model->STATUS!=3 && $model->STATUS!=2 && $model->owner=="OWNER"){ //Jika sudah close tidak bisa di edit.
					return  tombolCreateKasir($url, $model);
				}					
			},
		], 
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$headerColor,'#ffffff'),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','0',''),
	]; 
	$gvStore=GridView::widget([
		'id'=>'gv-store',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttributeItem,	
		'rowOptions'   => function ($model, $key, $index, $grid) {
			//$urlDestination=Url::to(['/efenbi-rasasayang/item-group/index', 'id' => $model->ID]);
			//$urlDestination=Url::to(['/master/product', 'storeid' => $model->STORE_ID]);
			//if 
			
			$btnclick= ['ondblclick' => '
				document.cookie="STORE_ID" + "=" +'.$model->STORE_ID.';
				$.pjax.reload({
					url: "'.Url::to(["/master/store/"]).'",
					container: "#w20",
					timeout: 1000,
				});	'];
			//$btnclick2= ['ondblclick' =>'location.href="'.$urlDestination.'"'];
			//print_r($btnclick2);
			//die();
			return $btnclick;
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
		'panel' => [
			//'heading'=>false,
			'heading'=>'
				<span class="fa-stack fa-sm">
				  <i class="fa fa-circle-thin fa-stack-2x" style="color:#25ca4f"></i>
				  <i class="fa fa-text-width fa-stack-1x"></i>
				</span> <b>LIST TOKO</b>'.'  <div style="float:right"><div style="font-family: tahoma ;font-size: 8pt;"> </div></div> ',  
			'type'=>'info',
			'before'=>false,
			'after'=>false,
			'before'=>$dscLabel.'<div class="pull-right">'. tombolRefresh().' '.$createStore.' '.tombolRestore().'</div>',// '.tombolExportExcel().'
			// 'before'=> tombolReqStore(),
			'showFooter'=>'aas',
		], 
		// 'floatOverflowContainer'=>true,
		//'floatHeader'=>true,
	]); 
	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">
			<?=$gvStore?>
		</div>		
	</div>
</div>