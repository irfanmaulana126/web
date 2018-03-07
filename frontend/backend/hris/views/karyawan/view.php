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

	//Difinition Status.
	$aryStt= [
	  ['STATUS' => 0, 'STT_NM' => 'Trial'],		  
	  ['STATUS' => 1, 'STT_NM' => 'Active'],
	  ['STATUS' => 2, 'STT_NM' => 'Deactive'],
	  ['STATUS' => 3, 'STT_NM' => 'Deleted'],
	];
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	
	//Result Status value.
	function sttMsg($stt){
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
	};	
	
	$attSroreData=[	
		[
			'attribute' =>'Namakaryawan',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'attribute' =>'KTP',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'attribute' =>'Ttl',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'attribute' =>'GENDER',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'attribute' =>'STS_NIKAH',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'attribute' =>'Nomer',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'attribute' =>'EMAIL',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'attribute' =>'UPAH_HARIAN',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'attribute' =>'ALAMAT',
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			'format'=>'raw', 
		],
		[
			'columns' => [
				[
					'attribute'=>'STT_POT_TELAT', 
					'displayOnly'=>true,
					'value'=>($model->STT_POT_TELAT==1) ? 'DIBAYAR' : 'TIDAK DIBAYAR',
					'valueColOptions'=>['style'=>'width:30%']
				],
				[
					'attribute'=>'STT_POT_PULANG', 
					'format'=>'raw', 
					'value'=>($model->STT_POT_PULANG==1) ? 'DIBAYAR' : 'TIDAK DIBAYAR',
					'valueColOptions'=>['style'=>'width:30%'], 
					'displayOnly'=>true
				],
			],
		],
		[
			'columns' => [
				[
					'attribute'=>'STT_IZIN',
					'displayOnly'=>true,
					'value'=>($model->STT_IZIN==1) ? 'DIBAYAR' : 'TIDAK DIBAYAR',
					'valueColOptions'=>['style'=>'width:30%']
				],
				[
					'attribute'=>'STT_LEMBUR', 
					'format'=>'raw', 
					'value'=>($model->STT_LEMBUR==1) ? 'DIBAYAR' : 'TIDAK DIBAYAR' ,
					'valueColOptions'=>['style'=>'width:30%'], 
					'displayOnly'=>true
				],
			],
		],
	];
	
	
	
	$dvStoreData=DetailView::widget([
		'id'=>'dv-store-data',
		'model' => $model,
		'attributes'=>$attSroreData,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
			'heading'=>'<b>Detail Karyawan </b>',
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
<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="row" >
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?=$dvStoreData ?>		
		</div>
	</div>
</div>

