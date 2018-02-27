<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use yii\web\View;
/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTemplateDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
// $this->registerJs("
// // var x = document.getElementById('tahun').value;
// // console.log(x);
// document.getElementById('tahun').onchange = function() { 
//     var x = document.getElementById('tahun').value;
//     $.pjax.reload({
//         url:'/laporan/arus-uang/index?id='+x, 
//         container: '#arus-masuk-monthofyear',
//         timeout: 1000,
//     });
    
//     console.log('Changed!'+x); 
// }
// ",View::POS_READY);


// print_r($modelView);
// die();
?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>false,
		'showHeader'=>false,
		'showPageSummary' => true,
        'columns' => [
            [
                'attribute' => 'AKUN_NM',
                'label' => false,
				'format'=>'raw',
				'value'=>function($model)use($store){
					$icon='<span class="fa fa fa-circle-o">  '.Html::a($model->AKUN_NM,'/laporan/arus-uang/detail-bulan?akunkode='.$model->AKUN_CODE.'&bulan='.$model->MONTH_AT.'&store='.$store.'').' </span>';
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
				//'format'=>['decimal', 2],				
				'format'=>'raw',				
				'value'=>function($model){
					if ($model->CAL_FORMULA==0){ 		//MINUS
						return '('.number_format($model->JUMLAH,2).')';
					}elseif($model->CAL_FORMULA==1){ 	//PLUS
						return number_format($model->JUMLAH,2);
					}elseif($model->CAL_FORMULA==2){ 	//PERKALIAN
						return number_format($model->JUMLAH,2);
					}else{
						return number_format(0,2);
					}
					
				 },	
				'pageSummary'=>function ($summary, $data, $widget)use($modelView){
					$kurangan=0;
					$kurangan=0;
					$tambahan=0;
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
						if($val->CAL_FORMULA==0){
							$kurangan=($kurangan + $val->JUMLAH);
						}elseif($val->CAL_FORMULA==1){
							$tambahan=($tambahan + $val->JUMLAH);
						}elseif($val->CAL_FORMULA==2){
							$kalian=$kalian * ($val->JUMLAH);
						}else{
							$kosong=0;
						}
						$rsltNilaiJumlah=($tambahan-$kurangan);
					};
					if (empty($rsltNilaiJumlah)) {
						return number_format(0,2);
					} else {
						return number_format($rsltNilaiJumlah,2);
					}
					
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