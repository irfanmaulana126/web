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
				url:'/inventory/stock-product/change-date?PRODUCT_ID='+'".$PRODUCT_ID."'+'&TGL='+x, 
				container: '#kartu-stok-inv',
				timeout: 1000,
			}).done(function () {
				$.pjax.reload({container: '#kartu-stok-inv'});
			});
		
		console.log('Changed!'+x); 
	 }
",View::POS_READY);
	//echo 'STORE_ID='.$storeId.' ,TGL='.$tgl;
	//print_r($model);
	$aryDataProvider= new ArrayDataProvider([
		'allModels'=>$model,
		'pagination' => [
			'pageSize' => 200,
		]
	]);
	//print_r($aryDataProvider);
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
			'attribute' => 'STOCK_LAST_MONTH',
			'label'=>'STOK LALU',
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
					'text-align'=>'right',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
		[
			'attribute' => 'MASUK',
			'label'=>'STOK MASUK',
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
					'text-align'=>'right',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
		[
			'attribute' => 'TERJUAL',
			'label'=>'STOK TERJUAL',
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
					'text-align'=>'right',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
		[
			'attribute' => 'SISA',
			'label'=>'STOK SISA',
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
					'text-align'=>'right',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
		[
			'attribute' => 'OPNAME',
			'label'=>'STOK OPNAME',
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
					'text-align'=>'right',
					'width'=>'150px',
					'font-family'=>'tahoma, arial, sans-serif',
					'font-size'=>'9pt',
				]
			],
		],
	];
	
	$gvKartuStok= GridView::widget([
		'id'=>'kartu-stok-inv',
		'dataProvider' => $aryDataProvider,
		'columns' =>$attcolumnsField,			
		// 'panel'=>[
			// 'type'=>'info',
			// 'heading'=>$pageNm,
			// 'before'=>false,
			// 'after'=>false			
		// ],
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'kartu-stok-inv',
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
		//'floatHeader'=>false,
		// 'floatHeaderOptions'=>['scrollingTop'=>'200'] 
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]);
	
	//return $gvKartuStok;
	
?>
<div class="container-full">
			<dl>
				<!-- NAMA PRODUK !-->
				<dt style="width:120px; float:left;">NAMA PRODUK</dt>
				<dd>: 
					<?php
						$produkNm=isset($model[0]['produkNm'])==true?$model[0]['produkNm']:0;
						echo $produkNm;
					?>
				</dd>
				<dt style="width:120px; float:left;">BULAN </dt>
				<dd style="width:200px; float:left;">: 
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
				</dd>
			</dl>
		</div>

			<?=$gvKartuStok?> 

</div>