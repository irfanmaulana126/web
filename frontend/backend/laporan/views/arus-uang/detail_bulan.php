<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use kartik\widgets\Spinner;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use yii\web\View;
use frontend\backend\master\models\Product;

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
	#gv-all-data-prodak-item .kv-grid-container{
		height:400px
	}
	#gv-all-data-prodak-item .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #000;
	}
	#gv-all-data-prodak-item .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");	

	$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
    $bColor='rgb(76, 131, 255)';
	$pageNm='<b>PRODUCT</b>
	';
	
	$colorHeader='rgba(230, 230, 230, 1)';
	$colorHeader1='rgba(140, 140, 140, 1)';
	$colorHeader2='rgba(230, 230, 230, 1)';
	$dinamikField=$dataProvider->getModels();
	//$tanggal=$dinamikField[0]['TAHUN'].'-'.$dinamikField[0]['BULAN'].'-01';
	
	
	$attDinamikField[] =[			
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
					//'background-color'=>$bColor,
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
	];
	
	$aryFieldColomn[]=['ID' =>0, 'ATTR' =>['FIELD'=>'STORE_ID','WIDTH'=>'100px','SIZE' => '10px','label'=>'TOKO','align'=>'left','group'=>true,'pageSummary'=>false]];
	// $aryFieldColomn[]=['ID' =>1, 'ATTR' =>['FIELD'=>'STORE_NM','SIZE' => '12px','label'=>'TOKO','align'=>'left','group'=>false,'pageSummary'=>false]];
	$aryFieldColomn[]=['ID' =>1, 'ATTR' =>['FIELD'=>'PRODUCT_NM','WIDTH'=>'100px','SIZE' => '7px','label'=>'PRODUK','align'=>'left','group'=>false,'pageSummary'=>false]];
	$headerContent1[]=['content'=>'DATA PRODUK','options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white']];
				
	$inc=2;
	/* ==================
	 * QTY STOCK COLUMN
	 * ================== */
	 if($dinamikField){
		switch ($akunkode) {
			case '1-1001':				
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};
				break;
			case '1-1002':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};
				break;
			case '1-1003':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};	
				break;
			case '2-1001':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};
				break;
			case '3-1001':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};	
				break;			
			case '3-1002':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};	
				break;	
			case '3-1003':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL PPN','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};	
				break;
			case '3-2001':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};
				break;
			case '4-1001':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'REFUND SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'REFUND SUBTTL HARGAJUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};
				break;
			case '5-1001':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};
				break;
			case '5-1002':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};
				break;
			case '5-1003':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};
				break;
			case '5-1004':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};
				break;
			case '5-1005':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};	
				break;
			case '5-1006':
					foreach($dinamikField[0] as $rows => $val){
						//unset($splt);
						//$ambilField[]=$rows; 		
						$splt=explode('_',$rows);
						
						if($splt[0]=='OUT'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL QTY','align'=>'right','group'=>false,'pageSummary'=>true,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
							$headerContent1[]=['content'=>date('Y-m-d', strtotime($splt[1])),'options'=>['colspan'=>2,'class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white','mergeHeader'=>true]];		
						}
						if($splt[0]=='IN'){
							$nmField1[]=$rows;		//FULL FIELD NAME
							$nmLabel[]=$splt[0];	//SPLIT LABEL NAME
							$aryFieldColomn[]=['ID' =>$inc, 'ATTR' =>['FIELD'=>$rows,'SIZE'=>'7px','label'=>'SUBTTL HARGA JUAL','align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>'#d9edf7','mergeHeader'=>true]];
							$inc=$inc+1;
						}	
					};
				break;			
		}				
		
	 }else{
		 for ($i=1;$i<=31;$i++){
			$aryFieldColomn[]=['ID' =>$incTmp, 'ATTR' =>['FIELD'=>$i,'SIZE' => '7px','label'=>$i,'align'=>'right','group'=>false,'pageSummary'=>false,'BCOLOR'=>$colorHeader]];
			$incTmp=$incTmp+1;
		 }
		$headerContent1[]=['content'=>$splt[1],'options'=>['class'=>'text-center','style'=>'background-color:#4988fd;font-family: tahoma ;font-size: 6pt; color:white']];			
	};
	 
	
	$valFields = ArrayHelper::map($aryFieldColomn, 'ID', 'ATTR');
	foreach($valFields as $key =>$value[]){	
		if ($value[$key]['FIELD']=='PRODUCT_NM' OR $value[$key]['FIELD']=='STORE_NM'){
			$attDinamikField[]=[
				'attribute'=>$value[$key]['FIELD'],
				'label'=>$value[$key]['label'],
				// 'filterType'=>$gvfilterType,
				// 'filter'=>$gvfilter,
				// 'filterWidgetOptions'=>$filterWidgetOpt,	
				//'filterInputOptions'=>$filterInputOpt,
				'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],	
				'filterInputOptions'=>['placeholder'=>'-Pilih-'],
				'filter'=>ArrayHelper::map(Product::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['PRODUCT_ID'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->all(),'PRODUCT_NM','PRODUCT_NM'),
				'filterType'=>GridView::FILTER_SELECT2,
				'filterOptions'=>[],				
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'hidden'=>false,
				'noWrap'=>true,	
				'format'=>'raw',	
				'value'=>function($data)use($key,$value){
					$x=$value[$key]['FIELD'];	
					$splt=explode('_',$x);
					//if($splt[0]=='SISA'){					
					if($x=='STORE_ID'){
						return 'NAMA TOKO :  '.$data['STORE_NM'];
					}elseif($x=='PRODUCT_NM'){
						return Html::tag('div', $data['PRODUCT_NM'], ['data-toggle'=>'tooltip','data-placement'=>'right','title'=>'Double click to Kartu Stok ','style'=>'cursor:default;']);				
					}else{						
						if($data[$x]){
							return $data[$x];
						}else{
							return 0;
						}						
					}		
				},							
				'headerOptions'=>[		
					'style'=>[									
						'text-align'=>'center',
						'width'=>$value[$key]['WIDTH'],
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8px',
						//'background-color'=>$value[$key]['BCOLOR'],
						//'color'=>'#5a96e7'
					]
				],
				'contentOptions'=>[
					'style'=>[
						'text-align'=>$value[$key]['align'],
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>$value[$key]['SIZE'],
						'font-weight'=>'bold',
					]
				],				
				'group'=>$value[$key]['group'],
				'groupedRow'=>true,
				'groupFooter'=>function($model, $key, $index, $widget){ 
					return [
						'mergeColumns'=>[[2,2]], 
						'content'=>[             // content to show in each summary cell
							2=>'TOTAL KESELURUHAN',
							3=>GridView::F_SUM,4=>GridView::F_SUM,5=>GridView::F_SUM,6=>GridView::F_SUM,7=>GridView::F_SUM,8=>GridView::F_SUM,9=>GridView::F_SUM,10=>GridView::F_SUM,
							11=>GridView::F_SUM,12=>GridView::F_SUM,13=>GridView::F_SUM,14=>GridView::F_SUM,15=>GridView::F_SUM,16=>GridView::F_SUM,17=>GridView::F_SUM,18=>GridView::F_SUM,19=>GridView::F_SUM,20=>GridView::F_SUM,							
							21=>GridView::F_SUM,22=>GridView::F_SUM,23=>GridView::F_SUM,24=>GridView::F_SUM,25=>GridView::F_SUM,26=>GridView::F_SUM,27=>GridView::F_SUM,28=>GridView::F_SUM,29=>GridView::F_SUM,30=>GridView::F_SUM,
							31=>GridView::F_SUM,32=>GridView::F_SUM,33=>GridView::F_SUM,34=>GridView::F_SUM,35=>GridView::F_SUM,36=>GridView::F_SUM,37=>GridView::F_SUM,38=>GridView::F_SUM,39=>GridView::F_SUM,40=>GridView::F_SUM,												
							41=>GridView::F_SUM,42=>GridView::F_SUM,43=>GridView::F_SUM,44=>GridView::F_SUM,45=>GridView::F_SUM,46=>GridView::F_SUM,47=>GridView::F_SUM,48=>GridView::F_SUM,49=>GridView::F_SUM,50=>GridView::F_SUM,					
							51=>GridView::F_SUM,52=>GridView::F_SUM,53=>GridView::F_SUM,54=>GridView::F_SUM,55=>GridView::F_SUM,56=>GridView::F_SUM,57=>GridView::F_SUM,58=>GridView::F_SUM,59=>GridView::F_SUM,60=>GridView::F_SUM,					
							61=>GridView::F_SUM,62=>GridView::F_SUM,63=>GridView::F_SUM,64=>GridView::F_SUM,65=>GridView::F_SUM,66=>GridView::F_SUM,67=>GridView::F_SUM,68=>GridView::F_SUM,69=>GridView::F_SUM,70=>GridView::F_SUM,					
							71=>GridView::F_SUM,72=>GridView::F_SUM,73=>GridView::F_SUM,74=>GridView::F_SUM,75=>GridView::F_SUM,76=>GridView::F_SUM,77=>GridView::F_SUM,78=>GridView::F_SUM,79=>GridView::F_SUM,80=>GridView::F_SUM,					
							81=>GridView::F_SUM,82=>GridView::F_SUM,83=>GridView::F_SUM,84=>GridView::F_SUM,85=>GridView::F_SUM,86=>GridView::F_SUM,87=>GridView::F_SUM,88=>GridView::F_SUM,89=>GridView::F_SUM,90=>GridView::F_SUM,					
							91=>GridView::F_SUM,92=>GridView::F_SUM,93=>GridView::F_SUM,94=>GridView::F_SUM,95=>GridView::F_SUM,96=>GridView::F_SUM,97=>GridView::F_SUM,98=>GridView::F_SUM,99=>GridView::F_SUM,100=>GridView::F_SUM,																	
						],
						'contentFormats'=>[      // content html attributes for each summary cell
							3=>['format'=>'number','decimals'=>2], 4=>['format'=>'number','decimals'=>2], 5=>['format'=>'number','decimals'=>2], 6=>['format'=>'number','decimals'=>2], 7=>['format'=>'number','decimals'=>2],8=>['format'=>'number','decimals'=>2], 9=>['format'=>'number','decimals'=>2], 10=>['format'=>'number','decimals'=>2], 
							11=>['format'=>'number','decimals'=>2], 12=>['format'=>'number','decimals'=>2],13=>['format'=>'number','decimals'=>2], 14=>['format'=>'number','decimals'=>2], 15=>['format'=>'number','decimals'=>2], 16=>['format'=>'number','decimals'=>2], 17=>['format'=>'number','decimals'=>2], 18=>['format'=>'number','decimals'=>2], 19=>['format'=>'number','decimals'=>2], 20=>['format'=>'number','decimals'=>2], 
							21=>['format'=>'number','decimals'=>2], 22=>['format'=>'number','decimals'=>2],23=>['format'=>'number','decimals'=>2], 24=>['format'=>'number','decimals'=>2], 25=>['format'=>'number','decimals'=>2], 26=>['format'=>'number','decimals'=>2], 27=>['format'=>'number','decimals'=>2], 28=>['format'=>'number','decimals'=>2], 29=>['format'=>'number','decimals'=>2], 30=>['format'=>'number','decimals'=>2], 
							31=>['format'=>'number','decimals'=>2], 32=>['format'=>'number','decimals'=>2],33=>['format'=>'number','decimals'=>2], 34=>['format'=>'number','decimals'=>2], 35=>['format'=>'number','decimals'=>2], 36=>['format'=>'number','decimals'=>2], 37=>['format'=>'number','decimals'=>2], 38=>['format'=>'number','decimals'=>2], 39=>['format'=>'number','decimals'=>2], 40=>['format'=>'number','decimals'=>2], 
							41=>['format'=>'number','decimals'=>2], 42=>['format'=>'number','decimals'=>2],43=>['format'=>'number','decimals'=>2], 44=>['format'=>'number','decimals'=>2], 45=>['format'=>'number','decimals'=>2], 46=>['format'=>'number','decimals'=>2], 47=>['format'=>'number','decimals'=>2], 48=>['format'=>'number','decimals'=>2], 49=>['format'=>'number','decimals'=>2], 50=>['format'=>'number','decimals'=>2], 
							51=>['format'=>'number','decimals'=>2], 52=>['format'=>'number','decimals'=>2],53=>['format'=>'number','decimals'=>2], 54=>['format'=>'number','decimals'=>2], 55=>['format'=>'number','decimals'=>2], 56=>['format'=>'number','decimals'=>2], 57=>['format'=>'number','decimals'=>2], 58=>['format'=>'number','decimals'=>2], 59=>['format'=>'number','decimals'=>2], 60=>['format'=>'number','decimals'=>2], 
							61=>['format'=>'number','decimals'=>2], 62=>['format'=>'number','decimals'=>2],63=>['format'=>'number','decimals'=>2], 64=>['format'=>'number','decimals'=>2], 65=>['format'=>'number','decimals'=>2], 66=>['format'=>'number','decimals'=>2], 67=>['format'=>'number','decimals'=>2], 68=>['format'=>'number','decimals'=>2], 69=>['format'=>'number','decimals'=>2], 70=>['format'=>'number','decimals'=>2], 
							71=>['format'=>'number','decimals'=>2], 72=>['format'=>'number','decimals'=>2],73=>['format'=>'number','decimals'=>2], 74=>['format'=>'number','decimals'=>2], 75=>['format'=>'number','decimals'=>2], 76=>['format'=>'number','decimals'=>2], 77=>['format'=>'number','decimals'=>2], 78=>['format'=>'number','decimals'=>2], 79=>['format'=>'number','decimals'=>2], 80=>['format'=>'number','decimals'=>2], 
							81=>['format'=>'number','decimals'=>2], 82=>['format'=>'number','decimals'=>2],83=>['format'=>'number','decimals'=>2], 84=>['format'=>'number','decimals'=>2], 85=>['format'=>'number','decimals'=>2], 86=>['format'=>'number','decimals'=>2], 87=>['format'=>'number','decimals'=>2], 88=>['format'=>'number','decimals'=>2], 89=>['format'=>'number','decimals'=>2], 90=>['format'=>'number','decimals'=>2], 
							91=>['format'=>'number','decimals'=>2], 92=>['format'=>'number','decimals'=>2],93=>['format'=>'number','decimals'=>2], 94=>['format'=>'number','decimals'=>2], 95=>['format'=>'number','decimals'=>2], 96=>['format'=>'number','decimals'=>2], 97=>['format'=>'number','decimals'=>2], 98=>['format'=>'number','decimals'=>2], 99=>['format'=>'number','decimals'=>2], 100=>['format'=>'number','decimals'=>2], 
						] 	,
						'contentOptions'=>[      // content html attributes for each summary cell
							2=>['style'=>'text-align:right;font-size:9px;font-weight:bold;color:#243852'],
							// 6=>['style'=>'font-variant:small-caps;text-align:right;color:white','font-size'=>'8pt'],
							// 8=>['style'=>'font-variant:small-caps;text-align:right;color:white','font-size'=>'8pt'],
							// 9=>['style'=>'font-variant:small-caps;text-align:right;color:white','font-size'=>'8pt'],
						],
						'options'=>['class'=>'success','style'=>'id:header-sales-trans-x1,font-weight:bold;font-size:8px;text-align:right;']
					];
				},
				
			];
		}else{
			$attDinamikField[]=[		
				'attribute'=>$value[$key]['FIELD'],
				'label'=>$value[$key]['label'],
				// 'filterType'=>$gvfilterType,
				// 'filter'=>$gvfilter,
				// 'filterWidgetOptions'=>$filterWidgetOpt,	
				//'filterInputOptions'=>$filterInputOpt,				
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'noWrap'=>true,	
				'value'=>function($data)use($key,$value){
					$x=$value[$key]['FIELD'];	
					$splt=explode('_',$x);
					//if($splt[0]=='SISA'){					
					if($x=='STORE_ID'){
						return 'NAMA TOKO :  '.$data['STORE_NM'];
					}else{						
						if($data[$x]){
							return $data[$x];
						}else{
							return 0;
						}						
					}		
				},					
				'headerOptions'=>[		
						'style'=>[									
						'text-align'=>'center',
						'width'=>'20px',
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>'8px',
						//'background-color'=>$value[$key]['BCOLOR'],
					]
				],  
				//'format'=>['decimal', 2],
				'format' => 'raw',
				'contentOptions'=>[
					'style'=>[
						'text-align'=>$value[$key]['align'],
						'font-family'=>'tahoma, arial, sans-serif',
						'font-size'=>$value[$key]['SIZE'],
						'font-weight'=>'bold',
						]
				],				
				'group'=>$value[$key]['group'],
				'groupedRow'=>true,
				'groupFooter'=>function($model, $key, $index, $widget){ 
					return [
						'mergeColumns'=>[[2,2]], 
						'content'=>[             // content to show in each summary cell
							2=>'TOTAL KESELURUHAN',
							3=>GridView::F_SUM,4=>GridView::F_SUM,5=>GridView::F_SUM,6=>GridView::F_SUM,7=>GridView::F_SUM,8=>GridView::F_SUM,9=>GridView::F_SUM,10=>GridView::F_SUM,
							11=>GridView::F_SUM,12=>GridView::F_SUM,13=>GridView::F_SUM,14=>GridView::F_SUM,15=>GridView::F_SUM,16=>GridView::F_SUM,17=>GridView::F_SUM,18=>GridView::F_SUM,19=>GridView::F_SUM,20=>GridView::F_SUM,							
							21=>GridView::F_SUM,22=>GridView::F_SUM,23=>GridView::F_SUM,24=>GridView::F_SUM,25=>GridView::F_SUM,26=>GridView::F_SUM,27=>GridView::F_SUM,28=>GridView::F_SUM,29=>GridView::F_SUM,30=>GridView::F_SUM,
							31=>GridView::F_SUM,32=>GridView::F_SUM,33=>GridView::F_SUM,34=>GridView::F_SUM,35=>GridView::F_SUM,36=>GridView::F_SUM,37=>GridView::F_SUM,38=>GridView::F_SUM,39=>GridView::F_SUM,40=>GridView::F_SUM,												
							41=>GridView::F_SUM,42=>GridView::F_SUM,43=>GridView::F_SUM,44=>GridView::F_SUM,45=>GridView::F_SUM,46=>GridView::F_SUM,47=>GridView::F_SUM,48=>GridView::F_SUM,49=>GridView::F_SUM,50=>GridView::F_SUM,					
							51=>GridView::F_SUM,52=>GridView::F_SUM,53=>GridView::F_SUM,54=>GridView::F_SUM,55=>GridView::F_SUM,56=>GridView::F_SUM,57=>GridView::F_SUM,58=>GridView::F_SUM,59=>GridView::F_SUM,60=>GridView::F_SUM,					
							61=>GridView::F_SUM,62=>GridView::F_SUM,63=>GridView::F_SUM,64=>GridView::F_SUM,65=>GridView::F_SUM,66=>GridView::F_SUM,67=>GridView::F_SUM,68=>GridView::F_SUM,69=>GridView::F_SUM,70=>GridView::F_SUM,					
							71=>GridView::F_SUM,72=>GridView::F_SUM,73=>GridView::F_SUM,74=>GridView::F_SUM,75=>GridView::F_SUM,76=>GridView::F_SUM,77=>GridView::F_SUM,78=>GridView::F_SUM,79=>GridView::F_SUM,80=>GridView::F_SUM,					
							81=>GridView::F_SUM,82=>GridView::F_SUM,83=>GridView::F_SUM,84=>GridView::F_SUM,85=>GridView::F_SUM,86=>GridView::F_SUM,87=>GridView::F_SUM,88=>GridView::F_SUM,89=>GridView::F_SUM,90=>GridView::F_SUM,					
							91=>GridView::F_SUM,92=>GridView::F_SUM,93=>GridView::F_SUM,94=>GridView::F_SUM,95=>GridView::F_SUM,96=>GridView::F_SUM,97=>GridView::F_SUM,98=>GridView::F_SUM,99=>GridView::F_SUM,100=>GridView::F_SUM,																	
						],
						'contentFormats'=>[      // content html attributes for each summary cell
							3=>['format'=>'number','decimals'=>2], 4=>['format'=>'number','decimals'=>2], 5=>['format'=>'number','decimals'=>2], 6=>['format'=>'number','decimals'=>2], 7=>['format'=>'number','decimals'=>2],8=>['format'=>'number','decimals'=>2], 9=>['format'=>'number','decimals'=>2], 10=>['format'=>'number','decimals'=>2], 
							11=>['format'=>'number','decimals'=>2], 12=>['format'=>'number','decimals'=>2],13=>['format'=>'number','decimals'=>2], 14=>['format'=>'number','decimals'=>2], 15=>['format'=>'number','decimals'=>2], 16=>['format'=>'number','decimals'=>2], 17=>['format'=>'number','decimals'=>2], 18=>['format'=>'number','decimals'=>2], 19=>['format'=>'number','decimals'=>2], 20=>['format'=>'number','decimals'=>2], 
							21=>['format'=>'number','decimals'=>2], 22=>['format'=>'number','decimals'=>2],23=>['format'=>'number','decimals'=>2], 24=>['format'=>'number','decimals'=>2], 25=>['format'=>'number','decimals'=>2], 26=>['format'=>'number','decimals'=>2], 27=>['format'=>'number','decimals'=>2], 28=>['format'=>'number','decimals'=>2], 29=>['format'=>'number','decimals'=>2], 30=>['format'=>'number','decimals'=>2], 
							31=>['format'=>'number','decimals'=>2], 32=>['format'=>'number','decimals'=>2],33=>['format'=>'number','decimals'=>2], 34=>['format'=>'number','decimals'=>2], 35=>['format'=>'number','decimals'=>2], 36=>['format'=>'number','decimals'=>2], 37=>['format'=>'number','decimals'=>2], 38=>['format'=>'number','decimals'=>2], 39=>['format'=>'number','decimals'=>2], 40=>['format'=>'number','decimals'=>2], 
							41=>['format'=>'number','decimals'=>2], 42=>['format'=>'number','decimals'=>2],43=>['format'=>'number','decimals'=>2], 44=>['format'=>'number','decimals'=>2], 45=>['format'=>'number','decimals'=>2], 46=>['format'=>'number','decimals'=>2], 47=>['format'=>'number','decimals'=>2], 48=>['format'=>'number','decimals'=>2], 49=>['format'=>'number','decimals'=>2], 50=>['format'=>'number','decimals'=>2], 
							51=>['format'=>'number','decimals'=>2], 52=>['format'=>'number','decimals'=>2],53=>['format'=>'number','decimals'=>2], 54=>['format'=>'number','decimals'=>2], 55=>['format'=>'number','decimals'=>2], 56=>['format'=>'number','decimals'=>2], 57=>['format'=>'number','decimals'=>2], 58=>['format'=>'number','decimals'=>2], 59=>['format'=>'number','decimals'=>2], 60=>['format'=>'number','decimals'=>2], 
							61=>['format'=>'number','decimals'=>2], 62=>['format'=>'number','decimals'=>2],63=>['format'=>'number','decimals'=>2], 64=>['format'=>'number','decimals'=>2], 65=>['format'=>'number','decimals'=>2], 66=>['format'=>'number','decimals'=>2], 67=>['format'=>'number','decimals'=>2], 68=>['format'=>'number','decimals'=>2], 69=>['format'=>'number','decimals'=>2], 70=>['format'=>'number','decimals'=>2], 
							71=>['format'=>'number','decimals'=>2], 72=>['format'=>'number','decimals'=>2],73=>['format'=>'number','decimals'=>2], 74=>['format'=>'number','decimals'=>2], 75=>['format'=>'number','decimals'=>2], 76=>['format'=>'number','decimals'=>2], 77=>['format'=>'number','decimals'=>2], 78=>['format'=>'number','decimals'=>2], 79=>['format'=>'number','decimals'=>2], 80=>['format'=>'number','decimals'=>2], 
							81=>['format'=>'number','decimals'=>2], 82=>['format'=>'number','decimals'=>2],83=>['format'=>'number','decimals'=>2], 84=>['format'=>'number','decimals'=>2], 85=>['format'=>'number','decimals'=>2], 86=>['format'=>'number','decimals'=>2], 87=>['format'=>'number','decimals'=>2], 88=>['format'=>'number','decimals'=>2], 89=>['format'=>'number','decimals'=>2], 90=>['format'=>'number','decimals'=>2], 
							91=>['format'=>'number','decimals'=>2], 92=>['format'=>'number','decimals'=>2],93=>['format'=>'number','decimals'=>2], 94=>['format'=>'number','decimals'=>2], 95=>['format'=>'number','decimals'=>2], 96=>['format'=>'number','decimals'=>2], 97=>['format'=>'number','decimals'=>2], 98=>['format'=>'number','decimals'=>2], 99=>['format'=>'number','decimals'=>2], 100=>['format'=>'number','decimals'=>2], 
						] 	,
						'contentOptions'=>[      // content html attributes for each summary cell
							2=>['style'=>'text-align:right;font-size:9px;font-weight:bold;color:#243852'],
							// 6=>['style'=>'font-variant:small-caps;text-align:right;color:white','font-size'=>'8pt'],
							// 8=>['style'=>'font-variant:small-caps;text-align:right;color:white','font-size'=>'8pt'],
							// 9=>['style'=>'font-variant:small-caps;text-align:right;color:white','font-size'=>'8pt'],
						],
						'options'=>['class'=>'success','style'=>'id:header-sales-trans-x1,font-weight:bold;font-size:8px;text-align:right;']
					];
				},
							
			];	
		}
	};
	$gvAllStoreItem=GridView::widget([
		'id'=>'gv-all-data-prodak-item',
		'dataProvider' => $dataProvider,
		'filterRowOptions'=>['style'=>'background-color:'.$colorHeader.'; align:center'],
		'beforeHeader'=>[
			'0'=>[					
				'columns'=>$headerContent1,
			]
		],
		'columns' =>$attDinamikField,				
		'pjax'=>0,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-all-data-prodak-item',
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
		'toolbar' => false,
		'panel' => [
			// 'heading'=>false,
			'heading'=>'<div class="pull-right"></div>'.$pageNm,
			'type'=>'default',
			'before'=>false,
			'showFooter'=>false,
			'after'=>false,
			// 'before'=> tombolReqStore(),
		],
		// 'floatOverflowContainer'=>true,
		// 'floatHeader'=>true,
	]); 	
?>
<div class="jurnal-template-title-index">
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 8pt;">
	<?php 		$title= Yii::t('app','');
				$url = Url::toRoute(['/laporan/arus-uang']);
				$options1 = [
							'id'=>'back-trafik',
							'class'=>"btn btn-xs",
							'title'=>'Kembali Menu Laporan'
				];
				$icon1 = '<span class="fa-stack fa-md text-left">
						  <b class="fa fa-circle fa-stack-2x" style="color:black"></b>
						  <b class="fa fa fa fa-mail-reply fa-stack-1x" style="color:white"></b>
						  </span>
						  ';
						  $label1 = $icon1.' '.$title ;
						  echo $content = Html::a($label1,$url,$options1);
						  ?>
		<div class="row">	
			<div style="height:20px;text-align:center;font-family: tahoma ;font-size: 10pt;;padding-top:10px">	
                    <?php		                    		
						echo '<b>RINGKASAN DETAIL '.strtoupper($akun->AKUN_NM).'<br>PRODUK GLOBAL<br>'.date("F Y",strtotime($tanggal)).'</b>';				
					?>		
			</div>
			<br>
			<br>
			<br>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;padding-top:10px">
		<div class="row">	
			<?=$gvAllStoreItem?>
		</div>
	</div>
</div>


