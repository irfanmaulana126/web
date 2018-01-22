<?php
use kartik\helpers\Html;
use kartik\detail\DetailView;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use kartik\widgets\ActiveField;
use kartik\widgets\ActiveForm;
// print_r($modelToko);
// die();
	//Difinition Status.
	/* $aryStt= [
	  ['STATUS' => 0, 'STT_NM' => 'Trial'],		  
	  ['STATUS' => 1, 'STT_NM' => 'Active'],
	  ['STATUS' => 2, 'STT_NM' => 'Deactive'],
	  ['STATUS' => 3, 'STT_NM' => 'Deleted'],
	];
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	 */
	//Result Status value.
	/* function sttMsg($stt){
		if($stt==0){ //TRIAL
			 return Html::decode('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-check fa-stack-1x" style="color:#ee0b0b"></i>
					</span> Trial','',['title'=>'Trial']);
		}elseif($stt==1){
			 return Html::decode('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-check fa-stack-1x" style="color:#05944d"></i>
					</span> Active','',['title'=>'Active']);
		}elseif($stt==2){
			return Html::decode('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-remove fa-stack-1x" style="color:#01190d"></i>
					</span> Deactive','',['title'=>'Deactive']);
		}elseif($stt==3){
			return Html::decode('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-close fa-stack-1x" style="color:#ee0b0b"></i>
					</span> Delete','',['title'=>'Delete']);
		}
	};	 */
	
	$attSroreData=[	
		[
			'attribute' =>'STORE_NM',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            'value'=>''.(empty($modelToko['STORE_NM'])) ? '':$modelToko['STORE_NM'] .'',
		],
		[
			'attribute' =>'ALAMAT',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            'value'=>''.(empty($modelToko['ALAMAT'])) ? '':$modelToko['ALAMAT'].'',
		],
		
		[		
			'attribute' =>'PROVINCE_NM',			
			'format'=>'raw',
			'value'=>''.(empty($modelToko['PROVINCE_NM'])) ? '':$modelToko['PROVINCE_NM'].'',
			'type'=>DetailView::INPUT_SELECT2,
			'widgetOptions'=>[
				//'data'=>$aryLocate,
				'options'=>['id'=>'locate-view-store-id','placeholder'=>'Select ...'],
				'pluginOptions'=>['allowClear'=>true],
			],	
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
		],
		[	
			'attribute' =>'CITY_NAME',			
			'format'=>'raw',
			'value'=>''.(empty($modelToko['CITY_NAME'])) ? '':$modelToko['CITY_NAME'].'',
			'type'=>DetailView::INPUT_DEPDROP,
			'widgetOptions'=>[
				'options'=>['id'=>'locate-viewsub-store-id','placeholder'=>'Select ...'],
				'pluginOptions' => [
					'depends'=>['locate-view-store-id'],
					'url'=>Url::to(['/efenbi-rasasayang/store/locate-sub']),
					//'initialize'=>true,
					'loadingText' => 'Loading data ...',
				],
			],	
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
		], 
		[
			'attribute' =>'TLP',
			//'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            'value'=>''.(empty($modelToko['TLP'])) ? '':$modelToko['TLP'].'',
		],
		[
			'attribute' =>'PIC',
			//'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            'value'=>''.(empty($modelToko['PIC'])) ? '':$modelToko['PIC'].'',
		]		
	];
	
	$attSroreInfo=[
		[
			'attribute' =>'STORE_ID',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'displayOnly'=>true,	
			'format'=>'raw', 
            'value'=>'<kbd>'.$modelToko['STORE_ID'].'</kbd>',
		],
		[
			'attribute' =>'CREATE_BY',
			'format'=>'raw', 
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'displayOnly'=>true,
			'value'=>''.(empty($modelToko['CREATE_BY'])) ? '':$modelToko['CREATE_BY'].'',
		],
		[
			'attribute' =>'UPDATE_BY',
			'format'=>'raw', 
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'displayOnly'=>true,
			'value'=>''.(empty($modelToko['UPDATE_BY'])) ? '':$modelToko['UPDATE_BY'].'',
		],		
		[
			'attribute' =>'CREATE_AT',
			'format'=>'raw',
			'value'=>''.(empty($modelToko['CREATE_AT'])) ? '':$modelToko['CREATE_AT'].'',
			'type'=>DetailView::INPUT_DATETIME,
			'widgetOptions' => [
				'pluginOptions'=>Yii::$app->gv->gvPliginDate()
			],
			'labelColOptions' => ['style' => 'text-align:right;width: 30%']
		],		
		[
			'attribute' =>'UPDATE_AT',
			'format'=>'raw',
			'value'=>''.(empty($modelToko['UPDATE_AT'])) ? '':$modelToko['UPDATE_AT'].'',
			'displayOnly'=>true,
			'type'=>DetailView::INPUT_DATE,
			'widgetOptions' => [
				'pluginOptions'=>Yii::$app->gv->gvPliginDate()
			],
			'labelColOptions' => ['style' => 'text-align:right;width: 30%']
		],
		// [
			// 'attribute' =>'ttltems',
			// 'format'=>'raw', 
			// 'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			// 'displayOnly'=>true,
		// ],
		// [
			// 'attribute' =>'Expired',
			// 'format'=>'raw', 
			// 'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			// 'displayOnly'=>true,
			// 'value'=> $modelToko->Expired.' '.'days',
		// ],
		 [
			'attribute' =>'STATUS',			
			'format'=>'raw',
			//'value'=>$modelToko->STATUS==0?'Disable':($modelToko->STATUS==1?'Enable':'Unknown'),
			'value'=>sttMsg($modelToko['STATUS']),
			'type'=>DetailView::INPUT_SELECT2,
			'widgetOptions'=>[
				'data'=>Yii::$app->gv->gvStatusArray(),//$valStt
				'options'=>['id'=>'status-review-id','placeholder'=>'Select ...'],
				'pluginOptions'=>['allowClear'=>true],
			],	
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
		] 
	];
		
	
	
	$dvStoreData=DetailView::widget([
		'id'=>'dv-store-data',
		'model' => $modelToko,
		'attributes'=>$attSroreData,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
			'heading'=>'<b>Outlet Data </b>',
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'mode'=>DetailView::MODE_VIEW,
		//'buttons1'=>'{update}',
		'buttons1'=>'',
		'buttons2'=>'{view}{save}',		
		/* 'saveOptions'=>[ 
			'id' =>'editBtn1',
			'value'=>'/marketing/sales-promo/review?id='.$model->ID,
			'params' => ['custom_param' => true],
		],	 */	
	]);
	
	$dvStoreInfo=DetailView::widget([
		'id'=>'dv-store-info',
		'model' => $modelToko,
		'attributes'=>$attSroreInfo,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
			'heading'=>'<b>System Info</b>',
			'type'=>DetailView::TYPE_INFO,
		],
		'mode'=>DetailView::MODE_VIEW,
		'buttons1'=>'',
		'buttons2'=>'{view}{save}'
	]);
	
	
	
?>
<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="row" >
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<?=$dvStoreData ?>		
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<?=$dvStoreInfo ?>			
		</div>
	</div>
</div>

