<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use frontend\backend\laporan\models\JurnalTemplateDetailSearch;
use kartik\date\DatePicker;
use yii\web\View;
use kartik\widgets\Select2;
use common\models\Store;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTemplateTitleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Ringakasan Penjualan';
$this->registerJs("
// var x = document.getElementById('tahun').value;
// console.log(x);
$('#tahun, #store').change(function() { 
    var x = document.getElementById('tahun').value;
    var y = document.getElementById('store').value;
    $.pjax.reload({
        url:'/laporan/arus-uang/index?store='+y+'&id='+x, 
        container: '#arus-masuk-monthofyear',
        timeout: 1000,
    })
    
    console.log('Changed!'+x+y); 
});
",View::POS_READY);
$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
$btn_srchChart1=DatePicker::widget([
    'name' => 'check_issue_date', 
    'options' => ['placeholder' => 'Pilih Tahun ...','id'=>'tahun'],
    'convertFormat' => true,
    'pluginOptions' => [
        'autoclose'=>true,
        'startView'=>'years',
        'minViewMode'=>'months',
        'format' => 'yyyy-n',
        // 'todayHighlight' => true,
         'todayHighlight' => true
    ]
]);
$btn_srchChart2= Select2::widget([
    'name' => 'state_10',
    'data' =>  ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->all(),'STORE_ID','STORE_NM'),
	'options' => ['placeholder' => 'Select a store ...','id'=>'store'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
$btn_srchChart="<div style='padding-bottom:3px;float:right'> Periode Tahun".$btn_srchChart1."</div>";
$btn_srchChart2="<div style='padding-bottom:3px;float:right'> Store".$btn_srchChart2."</div>";
$retVal = (empty($store->STORE_NM)) ? '' : $store->STORE_NM ;
$retValid = (empty($store->STORE_ID)) ? '' : $store->STORE_ID ;
?>
<div class="jurnal-template-title-index">
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row">	
			<div style="height:20px;text-align:center;font-family: tahoma ;font-size: 10pt;;padding-top:10px">	
                    <?php		                    
                        $tanggal=explode('-',$cari);				
						echo '<b>RINGKASAN PENJUALAN <br>'.$retVal.' '.date('F',$tanggal[1]).' '.$tanggal[0].'</b>';				
					?>		
			</div>
			<br>
			<br>
			<br>
			<div class="col-xs-4 col-sm-4 col-lg-4 pull-right">
				<?=$btn_srchChart?>
			</div>
				<?=$btn_srchChart2?>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;padding-top:10px">
		<div class="row">	
			<?php         
				 echo GridView::widget([					 
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
					'columns' => [
							[	
								'class' => 'kartik\grid\ExpandRowColumn',
								'value'=>function($model,$key,$index,$column){
									return GridView::ROW_EXPANDED;
								},								
								'detail'=> function($model,$key,$index,$column)use($tanggal,$retVal,$retValid)
								{     								   
									$searchModel =  new JurnalTemplateDetailSearch(['YEAR_AT'=>$tanggal[0],'MONTH_AT'=>$tanggal[1],'STORE_ID'=>$retVal]);
									$searchModel->RPT_TITLE_ID = $model->RPT_TITLE_ID;
									$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

									return Yii::$app->controller->renderPartial('index_detail',[
										'searchModel'=>$searchModel,
										'dataProvider'=>$dataProvider,
										'modelView'=>$dataProvider->getModels(),
										'store'=>$retValid
									]);
								},
								'defaultHeaderState'=>false,
								//'detailRowCssClass'=>'default',
								'detailRowCssClass'=>'info',
								'expandOneOnly'=>false,
								'expandIcon'=>'<span class="fa fa-file-text"></span>',
								'collapseIcon'=>'<span class="fa fa-file-text-o"></span>',
								//'enableRowClick'=>false,
							],        
							[
								'attribute' => 'RPT_TITLE_NM',
								'label' => false,
								//'mergeHeader'=>true,
								'value'=>function($model){
									return $model->RPT_TITLE_NM.' [IDR]';
								},
								'contentOptions'=>[
									'style'=>[
											'text-align'=>'left',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											'font-weight'=>'bold',
											'font-size'=>'10pt',
											'background-color'=>'#88b3ec',
									]
								],								
							],
					],
				]); 
			?>
		</div>
	</div>
</div>

