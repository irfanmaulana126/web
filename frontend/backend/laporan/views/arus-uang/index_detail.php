<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use yii\web\View;
/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTemplateDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJs("
// var x = document.getElementById('tahun').value;
// console.log(x);
document.getElementById('tahun').onchange = function() { 
    var x = document.getElementById('tahun').value;
    $.pjax.reload({
        url:'/laporan/arus-uang/index?id='+x, 
        container: '#arus-masuk-monthofyear',
        timeout: 1000,
    });
    
    console.log('Changed!'+x); 
}
",View::POS_READY);


// print_r($modelView);
// die();
?>
<?= GridView::widget([
		'id'=>'arus-masuk-monthofyear',
        'dataProvider' => $dataProvider,
        'summary'=>false,
		'showHeader'=>false,
        'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>true,
				'id'=>'arus-masuk-monthofyear',
			],
		],
		'showPageSummary' => true,
        'columns' => [
            [
                'attribute' => 'AKUN_NM',
                'label' => false,
				'format'=>'raw',
				'value'=>function($model){
					$icon='<span class="fa fa fa-circle-o">  '.$model->AKUN_NM.' </span>';
					return $icon;
				},
				'headerOptions'=>[
					'style'=>[
						'text-align'=>'center',
						'width'=>'150px',
						'font-family'=>'tahoma',
						'font-size'=>'10pt',
						'background-color'=>'rgba(186, 130, 59, 0.7)',
					]
				],
				'contentOptions'=>[
					'style'=>[
							'text-align'=>'left',
							'width'=>'50%',
							'font-family'=>'tahoma',
							'font-size'=>'10pt',
					]
				],
            ],
            [
                'attribute'=>'JUMLAH',
                'label'=>false,				
				'headerOptions'=>[
					'style'=>[
						'text-align'=>'center',
						'width'=>'50%',
						'font-family'=>'tahoma',
						'font-size'=>'8pt',
						'background-color'=>'#88b3ec',
					]
				],
				'contentOptions'=>[
					'style'=>[
							'text-align'=>'right',
							'width'=>'50%',
							'font-family'=>'tahoma',
							'font-size'=>'10pt',
					]
				],
				'pageSummaryFunc'=>GridView::F_SUM,
				'pageSummary'=>true,
				'format'=>['decimal', 2],
				'pageSummary'=>function ($summary, $data, $widget)use($modelView){
					$a=0;
					//CAL_FORMULA
					//$discountModal=$poHeader->DISCOUNT!=0 ? $poHeader->DISCOUNT:'0.00';
					// $pajakModal=$poHeader->PAJAK!=0 ? $poHeader->PAJAK:'0.00';
					// return '<div>IDR</div >
							// <div>
							// '.$discountModal.'
							// %</div >
							// <div>
							// '.$pajakModal.'
							// %</div >
							// <div>IDR</div >
							// <div>IDR</div >';
					//return $modelView[0]->JUMLAH;
					foreach($modelView as $row => $val){
						//$a[]=$val->JUMLAH;
						$a=$val->JUMLAH;
					};
					return number_format($a,2);
				},
				'pageSummaryOptions' => [
					'style'=>[
							'text-align'=>'right',
							'width'=>'50%',
							'font-family'=>'tahoma',
							'font-size'=>'10pt',
							//'text-decoration'=>'underline',
							//'font-weight'=>'bold',
							//'border-left-color'=>'transparant',
							'border-left'=>'0px',
					]
				],
            ],			
        ],
    ]); ?>