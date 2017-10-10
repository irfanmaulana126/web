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
			'attribute' =>'ACCESS_ID',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'BANK_NM',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'BANK_NO',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'NOMINAL_STORAN',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'SISA_STORAN',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'DCRP_DETIL',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute'=>'imageNm',
			//'value'=>Html::img($modelStoran['imageNm'],['width'=>'120','height'=>'120']),
			'value'=>Html::button(Html::img($modelStoran['imageNm'],['width'=>'120','height'=>'120']), [
						'value'=>url::to(['/laporan/mutasi/disply-image','id'=>$modelStoran->OPENCLOSE_ID]),
						'id'=>'modal-view-button',
						'data-pjax' => true,
						'class'=>"btn btn-warning btn-xs",
						'title'=>'Refresh'
				
			]),
			// function($model){	
				// $base64 ='data:image/jpg;charset=utf-8;base64,'.$model['imageNm'];
			// },			
			'format' => 'raw',	
			// 'format' => ['image',['width'=>'150','height'=>'150']],	
			// 'type' => DetailView::INPUT_FILEINPUT,
			// 'widgetOptions'=>[
				// 'pluginOptions' => [
					// 'showPreview' => true,
					// 'showCaption' => false,
					// 'showRemove' => false,
					// 'showUpload' => false,
				// ],					
			// ],			
		],	      
		
		/*[
			'attribute' =>'TGL_CLOSE',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'ACCESS_ID',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'CASHINDRAWER',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'ADDCASH',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'SELLCASH',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'TOTALCASH',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'ALAMAT',
			'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		
		[		
			'attribute' =>'PROVINCE_NM',			
			'format'=>'raw',
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
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		],
		[
			'attribute' =>'PIC',
			//'type'=>DetailView::INPUT_TEXTAREA,
			'labelColOptions' => ['style' => 'text-align:right;width: 30%'],
			//'displayOnly'=>true,	
			'format'=>'raw', 
            //'value'=>'<kbd>'.$modelToko->ITEM_NM.'</kbd>',
		]	 */	
	];
	
	
	
	$dvStoreData=DetailView::widget([
		'id'=>'dv-storean-data',
		'model' => $modelStoran,
		'attributes'=>$attSroreData,
		'condensed'=>true,
		'hover'=>true,
		'panel'=>[
			'heading'=>'<b>Tutup Pembukuan & Bukti Storan </b>',
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
	

	
	
?>
<div style="height:100%;font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="row" >
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?=$dvStoreData ?>	
		</div>
	</div>
</div>

