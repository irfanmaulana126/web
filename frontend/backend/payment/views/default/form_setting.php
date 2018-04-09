<?php
use kartik\slider\Slider;
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\editable\Editable;
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
	#gv-perangkat .kv-grid-container{
		height:200px
	}	
	#gv-perangkat .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color:#000;
	}
	#gv-perangkat .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");

$headerColor='rgba(128, 179, 178, 1)';
?>
<div class="row">
    <div class="col-md-6">
        <?=GridView::widget([
			'id'=>'gv-perangkat',
			'dataProvider' => $dataProviderperangkat,
			'columns' => [
				[
					'attribute'=>'KASIR_NM',
					'label'=>'NAMA PERANGKAT',
					'filterType'=>true,
					'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
					'hAlign'=>'right',
					'vAlign'=>'middle',
					'mergeHeader'=>false,
					'format'=>'html',
					'noWrap'=>false,
					'format'=>'raw',
					'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$headerColor),
					'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),
				],
				[
					'attribute'=>'PERANGKAT_UUID',
					'label'=>'UUID',
					'filterType'=>true,
					'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
					'hAlign'=>'right',
					'vAlign'=>'middle',
					'mergeHeader'=>false,
					'format'=>'html',
					'noWrap'=>false,
					'format'=>'raw',
					'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$headerColor),
					'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),
				],
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute'=>'KASIR_STT',
					'label'=>'PEMABAYARAN',
					'refreshGrid'=>true,
					'filterType'=>true,
					'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
					'hAlign'=>'right',
					'vAlign'=>'middle',
					'readonly' => function($model, $key, $index, $widget) {
						return ($model['KASIR_STT']=='0'); // do not allow editing of inactive records
					},
					'editableOptions'=> [
						'header'=>'STATUS PEMBAYARAN', 
						'size'=>'md',
						'inputType' => \kartik\editable\Editable::INPUT_SWITCH,
						'options' => [
							'pluginOptions' => [
								'items'=>[
									'value'=>empty($model->KASIR_STT) ? '1' :'2','uncheck'=>'2'
								],
								'uncheck'=>'2'
								],
						]
				],
					'mergeHeader'=>false,
					'format'=>'html',
					'noWrap'=>false,
					'value'=>function($model)
					{
						if ($model['KASIR_STT']=='1') {
							return 'ACTIVE';
						}elseif($model['KASIR_STT']=='2'){
							return 'DEACTIVE';
						}elseif($model['KASIR_STT']=='0'){
							return'TRIAL/DEMO';
						}else{
							return'-';
						}
					},
					'format'=>'raw',
					'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$headerColor),
					'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),
				],
			],'pjax'=>true,
			'pjaxSettings'=>[
				'options'=>[
					'enablePushState'=>false,
					'id'=>'gv-perangkat',
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
					<i class="fa fa-mobile fa-stack-1x"></i>
					</span> PERANGKAT'.'  <div style="float:right"><div style="font-family: tahoma ;font-size: 8pt;"> </div></div> ',  
				'type'=>'info',
				'before'=>false,
				'after'=>false,
				// 'before'=>$dscLabel.'<div class="pull-right">'. tombolRefresh().' '.tombolExportExcel().' '.tombolReqStore().' '.tombolRestore().'</div>',
				// 'before'=> tombolReqStore(),
				'showFooter'=>'aas',
			], 
			// 'floatOverflowContainer'=>true,
			//'floatHeader'=>true,
		]); ?>
    </div>
    
    <div class="col-md-6">
    </div>

</div>