<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use kartik\builder\Form;
use yii\helpers\Url;
use yii\web\View;
use kartik\widgets\Alert;
use yii\data\ArrayDataProvider;

$this->registerJs("
	 // var x = document.getElementById('tahun').value;
	 // console.log(x);
	 document.getElementById('tahun').onchange = function() { 
		var x = document.getElementById('tahun').value;
			$.pjax.reload({
				url:'/sistem/user-profile/histori-dompet?ACCESS_GROUP='+".$model[0]["ACCESS_GROUP"]."+'&TGL='+x, 
				container: '#histori',
				timeout: 1000,
			}).done(function () {
				$.pjax.reload({container: '#histori'});
			});
		
		console.log('Changed!'+x); 
	 }
",View::POS_READY);
	//echo 'STORE_ID='.$storeId.' ,TGL='.$tgl;
	//print_r($model);
	$aryDataProvider= new ArrayDataProvider([
		'allModels'=>$model,
		'pagination' => [
			'pageSize' => 10,
		]
    ]);
    
	// print_r($aryDataProvider);die();
	//$attcolumnsField='';
	$attcolumnsField =[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'10px',
					'font-family'=>'verdana, arial, sans-serif',
					'font-size'=>'9px',
					'background-color'=>'#faf2cd',
				]
			],
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'10px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9px',
				]
			],	
		],
		[
			'attribute' => 'STORE_ID',
			'label'=>'STORE_ID',
			'hAlign'=>'left',
            // 'vAlign'=>'middle',
            'group'=>true,
            'groupedRow'=>true,
			'headerOptions'=>[
				'style'=>[
					'text-align'=>'left',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
					'background-color'=>'rgba(97, 211, 96, 0.3)',
				]
			],
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'left',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
		[
			'attribute' => 'TGL',
			'label'=>'TGL',
			'hAlign'=>'left',
			'vAlign'=>'middle',
			'headerOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
					'background-color'=>'rgba(97, 211, 96, 0.3)',
				]
			],
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
		
		[
			'attribute' => 'TRANSCODE_NM',
			'label'=>'TRANSCODE_NM',
			'hAlign'=>'left',
			'vAlign'=>'middle',
			'headerOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
					'background-color'=>'rgba(97, 211, 96, 0.3)',
				]
			],
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
		[
			'attribute' => 'TRANS_TYPE_NM',
			'label'=>'TRANS_TYPE_NM',
			'hAlign'=>'left',
			'vAlign'=>'middle',
			'headerOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
					'background-color'=>'rgba(97, 211, 96, 0.3)',
				]
			],
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
		[
			'attribute' => 'TGL',
			'label'=>'TGL',
			'hAlign'=>'left',
			'vAlign'=>'middle',
			'headerOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
					'background-color'=>'rgba(97, 211, 96, 0.3)',
				]
			],
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
		[
			'attribute' => 'JUMLAH',
			'label'=>'JUMLAH',
			'hAlign'=>'left',
			'vAlign'=>'middle',
			'headerOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
					'background-color'=>'rgba(97, 211, 96, 0.3)',
				]
			],
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'center',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
	];
	
	$gvKartuStok= GridView::widget([
		'id'=>'histori',
		'dataProvider' => $aryDataProvider,
		'columns' =>$attcolumnsField,			
		'panel'=>[
			'type'=>'info',
			// 'heading'=>$pageNm,
			'before'=>false,
			'after'=>false			
		],
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>true,
				'id'=>'histori',
			],
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>true,
		'bordered'=>true,
		'striped'=>'4px',
		'autoXlFormat'=>true,
		'export' => false,
		'summary'=>false,
		'floatHeader'=>false,
		'floatHeaderOptions'=>['scrollingTop'=>'200'],
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]);
	
	//return $gvKartuStok;
	
?>
<div class="container-full">
			<dl>
				<!-- TAHUN !-->
				<dt style="width:120px; float:left;">TAHUN</dt>
				<dd>: <?php
						$tahun=isset($model[0]['TGL'])==true?$model[0]['TGL']:0;
						echo date('Y', strtotime($tahun));
					?>
				</dd>
				<!-- BULAN !-->
				<dt style="width:120px; float:left;">BULAN </dt>
				<dd> <div style="width:190px;">:
                <?php
                        $bulan=isset($model[0]['TGL'])==true?$model[0]['TGL']:0;
                        echo DatePicker::widget([
                            'name' => 'check_issue_date', 
                            'value' => date('F-Y', strtotime($bulan)),
                            'options' => ['placeholder' => 'Pilih Tahun ...','id'=>'tahun'],
                            'convertFormat' => true,
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'startView'=>'month',
                                'minViewMode'=>'year',
                                'format' => 'yyyy-MM',
                                // 'todayHighlight' => true,
                                'todayHighlight' => true
                            ]
                        ]);
					?>
                </div>
				</dd>
			
			</dl>
		</div>

			<?=$gvKartuStok?> 

</div>