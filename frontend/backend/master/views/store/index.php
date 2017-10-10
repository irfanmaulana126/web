<?php
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use kartik\widgets\Spinner;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use yii\web\View;
use yii\caching\XCache;
use yii\data\ArrayDataProvider;
$headerColor='rgba(128, 179, 178, 1)';
	//print_r($dataModelImport);
	//CSS
	$this->registerCss("
		.kv-grid-table :link {
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
		.modal-content { 
			border-radius: 50;
		}
		
		.tmp-button-delete a:hover {
			color:red;
		}
		
	");
	
	//Modal Ajax
	/* $this->registerJs($this->render('modal_import.js'),View::POS_READY);
	echo $this->render('modal_import'); //echo difinition
	*/
	//Result Status value.
	function sttMsgDscp($stt){
		if($stt==0){ //TRIAL
			 return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-check fa-stack-1x" style="color:#ee0b0b"></i>
					</span>','',['title'=>'Trial']);
		}elseif($stt==1){
			 return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-check fa-stack-1x" style="color:#05944d"></i>
					</span>','',['title'=>'Active']);
		}elseif($stt==2){
			return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-remove fa-stack-1x" style="color:#01190d"></i>
					</span>','',['title'=>'Deactive']);
		}elseif($stt==3){
			return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-close fa-stack-1x" style="color:#ee0b0b"></i>
					</span>','',['title'=>'Delete']);
		}
	};	
		
	$dscLabel='<b>* STATUS</b> : '.sttMsgDscp(0).'=Trial. '.sttMsgDscp(1).'=Active. '.sttMsgDscp(2).'=Deactive. '.sttMsgDscp(3).'=Delete.';
	$dscAction='[<b>ACTION</b>]: 
				<font color=red>Items</font>=CRUD Items/double click tabel row; 
				<font color=red>View</font>=Detail Tampilan Outlet;  
				<font color=red>Review</font>=Review & Update Outlet; 
				<font color=red>Payment</font>=Pembayaran & Langanan Outlet;
	';
	
	/**
	 * Import Data
	*/
	$_indexStore=$this->render('_indexStore',[
		'dataProvider' => $dataProvider,
		'searchModel' => $searchModel			
	]);
	
	$aryData1=[
		'0'=>['id'=>'1','TITTLE_NM'=>'<span class="fa-stack fa-lg text-left">
						  <b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
						  <b class="fa fa-home fa-stack-1x" style="color:#FEFEFE"></b>
						</span><b> RINCIAN TOKO </b>'],
		'1'=>['id'=>'2','TITTLE_NM'=>'<span class="fa-stack fa-lg text-left">
						  <b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
						  <b class="fa fa-product-hunt fa-stack-1x" style="color:#FEFEFE"></b>
						</span><b> DAFTAR PRODUK </b>'],
		'2'=>['id'=>'3','TITTLE_NM'=>'<span class="fa-stack fa-lg text-left">
						  <b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
						  <b class="fa fa-users fa-stack-1x" style="color:#FEFEFE"></b>
						</span><b> DAFTAR PELANGGAN </b>'],
		'3'=>['id'=>'4','TITTLE_NM'=>'<span class="fa-stack fa-lg text-left">
						  <b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
						  <b class="fa fa-user fa-stack-1x" style="color:#FEFEFE"></b>
						</span><b> DAFTAR KARAWAN </b>'],
		'4'=>['id'=>'5','TITTLE_NM'=>'<span class="fa-stack fa-lg text-left">
						  <b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
						  <b class="fa fa-user-secret fa-stack-1x" style="color:#FEFEFE"></b>
						</span><b> DAFTAR USER LOGIN </b>']
	];	
	//$key = 'STORE_ID';
	$cookies = Yii::$app->request->cookies;
	//$data = \Yii::$app->getRequest()->getCookies();//->getValue('STORE_ID');
	$storeId = $cookies->getValue('STORE_ID');
	$storeNm = $cookies->getValue('STORE_NM');
	// print_r($storeNm);
	// die();
	//$data = Yii::$app->cache;
	$aryData2=[
		'0'=>['STORE_ID'=>$storeId],
		'1'=>['STORE_ID'=>$storeId],
		'2'=>['STORE_ID'=>$storeId],
		'3'=>['STORE_ID'=>$storeId],
		'4'=>['STORE_ID'=>$storeId],
	];	
	
	foreach($aryData1 as $rows =>$val){
		$aryMrg[]=ArrayHelper::merge($aryData1[$rows],$aryData2[$rows]);
	};
	// print_r($aryMrg);
	// die();
	$dataProviderMenu= new ArrayDataProvider([	
			'allModels'=>$aryMrg,	
			'pagination' => [
				'pageSize' => count($aryMrg),
			],
		]);
	
	
	
	$_indexExpand=$this->render('_indexExpand',[
		'dataProviderMenu' => $dataProviderMenu,
		'storeNm'=>$storeNm
	]);
	

?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-lg-6" style="font-family: tahoma ;font-size: 8pt;">
			<div class="row">		
			<?=$_indexStore?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-lg-6" style="font-family: tahoma ;font-size: 8pt;">
			<div class="row">	
				<?php echo '<div style="padding-top:20px">'.$dscLabel.'</div>'?>	
				<div  style="padding-top:10px">				
					<?=$_indexExpand?>
				</div>		
			</div>		
		</div>
	</div>
</div>

