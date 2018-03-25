<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use frontend\backend\laporan\models\JurnalTemplateDetailSearch;
use kartik\date\DatePicker;
use yii\web\View;
use kartik\widgets\Select2;
use common\models\Store;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
$retVal = (empty($store->STORE_NM)) ? '' : $store->STORE_NM ;
$retValid = (empty($store->STORE_ID)) ? '' : $store->STORE_ID ;
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
		<div class="row">
			
		</div>
		<div style="text-align:center;font-family: tahoma ;font-size: 10pt;;padding-top:50px">	
			<?php		                    
				//$tanggal=explode('-',$cari);				
				//echo '<b>RINGKASAN ARUS KEUANGAN <br>'.$retVal.' '.date("F Y",strtotime($cari)).'</b>';
				echo '<b><h5><b>RINGKASAN ARUS KEUANGAN</b></h5>'.date("F",strtotime($cari['BULAN'])).' '.date("Y",strtotime($cari['TAHUN']));		
			?>		
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;padding-top:20px;margin-bottom:50px">
		<div class="row">
		
			<?php      
			    $colorHeader='rgba(208, 218, 230, 1)';
			    $colorHeaderGroup='#d4fcd7';
				//$searchModel =  new JurnalTemplateDetailSearch(['YEAR_AT'=>$tanggal[0],'MONTH_AT'=>$tanggal[1],'STORE_ID'=>$retValid]);
				//$searchModel =  new JurnalTemplateDetailSearch(['TAHUN'=>'2018','BULAN'=>'2','STORE_ID'=>$retValid]);
				//$searchModel =  new JurnalTemplateDetailSearch();
				// print_r($searchModel);
				// die();
				
				//$searchModel->RPT_TITLE_ID = 'RPT_TITLE_ID';
				//$dataProvider = $searchModel->search(['TAHUN'=>'2018','BULAN'=>'2','STORE_ID'=>$retValid]);
				// $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
				$modelView =$dataProvider->getModels();
				
				 echo GridView::widget([					 
					'id'=>'arus-masuk-monthofyear-pdf',
					'dataProvider' => $dataProvider,
					'summary'=>false,
					//'showHeader'=>false,
					'showPageSummary' => true,					
					'pjax'=>true,
					'pjaxSettings'=>[
						'options'=>[
							'enablePushState'=>true,
							'id'=>'arus-masuk-monthofyear-pdf',
						],
					],						
					'columns' => [
							/* [	
								'class' => 'kartik\grid\ExpandRowColumn',
								'value'=>function($model,$key,$index,$column){
									return GridView::ROW_EXPANDED;
								},								
								'detail'=> function($model,$key,$index,$column)use($tanggal,$retVal,$retValid)
								{     								   
									$searchModel =  new JurnalTemplateDetailSearch(['YEAR_AT'=>$tanggal[0],'MONTH_AT'=>$tanggal[1],'STORE_ID'=>$retValid]);
									$searchModel->RPT_TITLE_ID = $model->RPT_TITLE_ID;
									$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

									return Yii::$app->controller->renderPartial('/arus-uang/index_detail',[
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
							],   */      
							[
								'attribute' => 'RPT_TITLE_NM',
								'label' => false,	
								'noWrap'=>true,
								'group'=>true,
								'groupedRow'=>true,
								'groupOddCssClass'=>[
									'style'=>[
										'background-color'=>$colorHeaderGroup,
									]
								],		
								'groupEvenCssClass'=>[
									'style'=>[
										'background-color'=>$colorHeaderGroup,
									]
								],		
								'contentOptions'=>[
									'style'=>[
											'text-align'=>'left',
											'font-family'=>'font-family: verdana, arial, sans-serif',
											'font-weight'=>'bold',
											'font-size'=>'9pt',
											'background-color'=>$colorHeaderGroup,
											
									]
								],																			
								'groupFooter'=>function($model, $key, $index, $widget){ 
									return [
										//'mergeColumns'=>[[1,1]], 
										'content'=>[             // content to show in each summary cell
											1=>'Jumlah',
											2=>GridView::F_SUM,
											3=>GridView::F_SUM,
										],
										'contentFormats'=>[     
											2=>['format'=>'number','decimals'=>2],
											3=>['format'=>'number','decimals'=>2]
										] 	,
										'contentOptions'=>[      // content html attributes for each summary cell
											1=>['style'=>'text-align:right;font-size:12px;'],
											2=>['style'=>'text-align:right;font-size:10px;text-decoration:underline'],
											3=>['style'=>'text-align:right;font-size:10px;text-decoration:underline'],
										],
										'options'=>[
											'class'=>'warning',
											'style'=>'font-weight:bold;font-size:10px;text-align:right;
										']
									];
								},								
							],
							[
								'attribute' => 'AKUN_NM',
								'label' => false,
								'format'=>'raw',
								'value'=>function($model)use($store){
									//$icon='<span class="fa fa fa-circle-o">  '.Html::a($model->AKUN_NM,'/laporan/arus-uang/detail-bulan?akunkode='.$model->AKUN_CODE.'&bulan='.$model->YEAR_AT.'-'.$model->MONTH_AT.'&store='.$store.'').' </span>';
									return Html::a($model['AKUN_NM'],'#');
									//return $model['AKUN_NM'];
								},	
								'headerOptions'=>[
									'style'=>[
											'text-align'=>'center',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											//'font-weight'=>'bold',
											'font-size'=>'8pt',
											'background-color'=>$colorHeader,
									]
								],									
								'contentOptions'=>[
									'style'=>[
											'text-align'=>'right',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'font-family: verdana, arial, sans-serif',
											'font-weight'=>'bold',
											'font-size'=>'8pxt',
											//'background-color'=>'#88b3ec',
									]
								],
								'pageSummaryOptions' => [
									'style'=>[
											'text-align'=>'right',
											//'width'=>'60%',
											'font-family'=>'tahoma',
											'font-size'=>'8pt',
											'text-decoration'=>'underline',
											//'font-weight'=>'bold',
											//'border-left-color'=>'transparant',
											'background-color'=>$colorHeader,
											'border-left'=>'0px',
									]									
								],								
							],
							[
								'attribute' => 'DEBET',
								'label' =>'PEMASUKAN',
								'format'=>['decimal', 2],									
								/* 'value'=>function($model){
									if ($model->CAL_FORMULA==0){ 		//MINUS
										return '('.number_format($model->JUMLAH,2).')';
									}elseif($model->CAL_FORMULA==1){ 	//PLUS
										return number_format($model->JUMLAH,2);
									}elseif($model->CAL_FORMULA==2){ 	//PERKALIAN
										return number_format($model->JUMLAH,2);
									}else{
										return number_format(0,2);
									}
									
								 },	 */
								'pageSummary'=>true,
								'pageSummaryFunc'=>GridView::F_SUM,									
								'headerOptions'=>[
									'style'=>[
											'text-align'=>'center',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											//'font-weight'=>'bold',
											'font-size'=>'8pt',
											'background-color'=>$colorHeader,
									]
								],	
								'contentOptions'=>[
									'style'=>[
											'text-align'=>'right',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											//'font-weight'=>'bold',
											'font-size'=>'8pt',
											//'background-color'=>'#88b3ec',
									]
								],		
								'pageSummaryOptions' => [
									'style'=>[
											'text-align'=>'right',
											//'width'=>'20%',
											'font-family'=>'tahoma',
											'font-size'=>'8pt',
											'text-decoration'=>'underline',
											//'font-weight'=>'bold',
											//'border-left-color'=>'transparant',
											'background-color'=>$colorHeader,
											'border-left'=>'0px',
									]
									
								],
								
							],
							[
								'attribute' => 'KREDIT',
								'label' =>'PENGELUARAN',
								'format'=>['decimal', 2],									
								/* 'value'=>function($model){
									if ($model->CAL_FORMULA==0){ 		//MINUS
										return '('.number_format($model->JUMLAH,2).')';
									}elseif($model->CAL_FORMULA==1){ 	//PLUS
										return number_format($model->JUMLAH,2);
									}elseif($model->CAL_FORMULA==2){ 	//PERKALIAN
										return number_format($model->JUMLAH,2);
									}else{
										return number_format(0,2);
									}
									
								 },	 */
								'pageSummary'=>true,
								'pageSummaryFunc'=>GridView::F_SUM,								
								'headerOptions'=>[
									'style'=>[
											'text-align'=>'center',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											//'font-weight'=>'bold',
											'font-size'=>'8pt',
											'background-color'=>$colorHeader,
									]
								],	
								'contentOptions'=>[
									'style'=>[
											'text-align'=>'right',
											//'width'=>'150px',
											//'padding-left'=>'-100px',
											'font-family'=>'tahoma',
											//'font-weight'=>'bold',
											'font-size'=>'8pt',
											//'background-color'=>'#88b3ec',
									]
								],										
								'pageSummaryOptions' => [
									'style'=>[
											'text-align'=>'right',
											//'width'=>'20%',
											'font-family'=>'tahoma',
											'font-size'=>'8pt',
											'text-decoration'=>'underline',
											//'font-weight'=>'bold',
											//'border-left-color'=>'transparant',
											'background-color'=>$colorHeader,
											'border-left'=>'0px',
									]
									
								],
								
							],
					],
				]); 
			?>
		</div>
	</div>
</div>

