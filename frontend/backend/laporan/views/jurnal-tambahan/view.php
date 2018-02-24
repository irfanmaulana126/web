            <!-- 'AKUN_CODE',
            'AKUN_NM',
            'KTG_CODE',
            'KTG_NM',
            'JUMLAH_TOTAL',
            'JUMLAH_PEMBAGIAN',
            'FREKUENSI',
            'FREKUENSI_NM',
            'RANGE_TGL1',
            'RANGE_TGL2',
            'CREATE_AT',
            'UPDATE_AT',
            'MONTH_AT',
            'YEAR_AT', -->
<?php
use kartik\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use kartik\widgets\ActiveField;
use kartik\widgets\ActiveForm;

	
	$attSroreData=[	
		[
			'attribute' =>'JURNAL_ID',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'attribute' =>'ACCESS_GROUP',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		
		[		
			'attribute' =>'STORE_ID',			
			'format'=>'raw',	
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
		],
		[	
			'attribute' =>'TRANS_DATE',			
			'format'=>'raw',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
		], 
		[
			'attribute' =>'STT_PAY',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'attribute' =>'STT_PAY_NM',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
        ]
        // [
		// 	'attribute' =>'STATUS',			
		// 	'format'=>'raw',
		// 	//'value'=>$model->STATUS==0?'Disable':($model->STATUS==1?'Enable':'Unknown'),
		// 	'value'=>sttMsg($model->STATUS),
		// 	'type'=>DetailView::INPUT_SELECT2,
		// 	'widgetOptions'=>[
		// 		'data'=>$valStt,//Yii::$app->gv->gvStatusArray(),
		// 		'options'=>['id'=>'status-review-id','placeholder'=>'Select ...'],
		// 		'pluginOptions'=>['allowClear'=>true],
		// 	],	
		// 	'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
		// ]		
	];
	
	
	
	
	$dvStoreData=DetailView::widget([
		'id'=>'dv-store-data',
		'model' => $model,
		'attributes'=>$attSroreData,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
			'type'=>DetailView::TYPE_INFO,
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
	
	
	
?>
<div style="jurnal-tambahan-view">
    <?=$dvStoreData ?>		
</div>

