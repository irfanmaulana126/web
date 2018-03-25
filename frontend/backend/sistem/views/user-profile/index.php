<?php
use kartik\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\widgets\Spinner;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use yii\web\View;
use kartik\widgets\Alert;
use frontend\backend\sistem\models\Store;

use frontend\assets\AppAssetBackendBorder;
AppAssetBackendBorder::register($this);

$this->title = 'User Profiles';
$headerColor='rgba(128, 179, 178, 1)';
$user = (empty(Yii::$app->user->identity->ACCESS_ID)) ? '' : Yii::$app->user->identity->ACCESS_ID;
$genderx = (empty($dataProvider->gender)) ? '' : $dataProvider->gender;
    
//print_r($userProvinsi);
$this->registerCss("
	.grdiasicolor {    
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
	}
	
	h1 {
		color:green;
	}
	.custom-file-input::-webkit-file-upload-button {
		visibility: hidden;
	}
	.custom-file-input::before {
		content: 'Pilih Foto';
		display: inline-block;
		background: #d2d6de;
		border-radius: 3px;
		padding: 5px 8px;
		outline: none;
		white-space: nowrap;
		-webkit-user-select: none;
		cursor: pointer;
		text-shadow: 1px 1px #666;
		font-weight: 700;
		font-size: 10pt;
	}
	.custom-file-input:hover::before {
		border-color: black;
	}
	.custom-file-input:active::before {
		background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
	}
	.w3-example {    
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		width: 170px;
		height: 220px;    
		margin-left: 15px;
		margin-bottom: 15px;
		border-radius: 5px;
		box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
	}
	.w3-example-box {    
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		// width: 400px;
		// height: 30px;
		border-radius: 5px;
		text-align: center;
		padding-top: 5px;
		box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
	}
	input[type='file']{
		color: transparent;
	}
	.image {
	opacity: 1;
	display: block;
	width: 100%;
	height: auto;
	transition: .5s ease;
	backface-visibility: hidden;
	}
	.tombol {
		padding-top:15px;
		margin-left:40px;
	}
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
	.modal-content { 
		border-radius: 50;
	},
	.kv-panel {
		//min-height: 340px;
		height: 300px;
	}
	#gv-store .kv-grid-container{
		height:200px
	}
	#gv-perangkat .kv-grid-container{
		height:200px
	}
	#gv-store .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color:#000;
	}
	#gv-store .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#gv-perangkat .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color:#000;
	}
	#gv-perangkat .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#dv-info .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color:#000;
	}
	#dv-info .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");
$this->registerJs($this->render('modal_store.js'),View::POS_READY);
echo $this->render('button_store'); //echo difinition
echo $this->render('modal_store'); //echo difinition
		
	//Difinition Status.
	$aryStt= [
	  ['STATUS' => 0, 'STT_NM' => 'Trial'],		  
	  ['STATUS' => 1, 'STT_NM' => 'Active'],
	  ['STATUS' => 2, 'STT_NM' => 'Deactive'],
	  ['STATUS' => 3, 'STT_NM' => 'Deleted'],
	];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
    
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
		
	$dscLabel='<b>* STATUS</b> : '.sttMsgDscp(0).'=Trial. '.sttMsgDscp(1).'=Active. '.sttMsgDscp(2).'=Deactive. '.sttMsgDscp(3).'=Delete. ';
	
	
	//Result Status value.
	function sttMsg($stt){
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
		
	$bColor='rgba(87,114,111, 1)';
		
	$gvAttributeItem=[
			[
				'attribute'=>'STORE_NM',
				'label'=>'NAMA TOKO',
				'filterType'=>true,
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
				'hAlign'=>'right',
				'vAlign'=>'middle',
				'mergeHeader'=>false,
				'format'=>'html',
				'noWrap'=>false,
				'format'=>'raw',
				'filter' => ArrayHelper::map(Store::find()->where(['ACCESS_GROUP'=>$user])->orderBy(['STATUS'=>SORT_ASC])->all(),'STORE_NM','STORE_NM'),
				'filterType'=>GridView::FILTER_SELECT2,
				'filterWidgetOptions'=>[
					'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
				],
				'value'=>function($data) {				
					return Html::tag('div', $data->STORE_NM, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
				},
				'filterInputOptions'=>['placeholder'=>'Cari STORE'],
				'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
				'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$headerColor),
				'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),
				
			],		
				
	];
	$gvAttributeItem[]=[
		'attribute'=>'STATUS',
		'filterType'=>GridView::FILTER_SELECT2,
		'filterWidgetOptions'=>[
			'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
		],
		'filterInputOptions'=>['placeholder'=>'Select'],
		'filter'=>$valStt,//Yii::$app->gv->gvStatusArray(),
		'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px',$headerColor),
		'hAlign'=>'right',
		'vAlign'=>'middle',
		'mergeHeader'=>false,
		'noWrap'=>false,
		'format' => 'raw',	
		'value'=>function($model){
			return sttMsg($model->STATUS);				 
		},
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50',$headerColor),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','50','')			
	];
	
	
	$gvAttributeItemS[]=[
		'class' => 'kartik\grid\ActionColumn',
		'template' => '{review}{payment}{edit}{delete}',
		'header'=>'ACTION',
		'dropdown' => true,
		'dropdownOptions'=>[
			'class'=>'pull-right dropdown',
			'style'=>'width:100%;background-color:#E6E6FA'				
		],
		'dropdownButton'=>[
			'label'=>'ACTION',
			'class'=>'btn btn-info btn-xs',
			'style'=>'width:100%'		
		],
		'buttons' => [
			'edit' =>function ($url, $model){
				if($model->STATUS!=3){
					return  tombolUpdate($url, $model);
				}	
			},
			'delete' =>function ($url, $model){
				if($model->STATUS!=3 && $model->owner=="OWNER"){
					return  tombolDelete($url, $model);
				}	
			},
			'review' =>function($url, $model,$key){
				if($model->STATUS!=1){ //Jika sudah close tidak bisa di edit.
					return  tombolReview($url, $model);
				}					
			},
			'payment' =>function($url, $model,$key){
				if($model->STATUS!=1 && $model->DATE_END>=date('Y-m-d')){ //Jika sudah close tidak bisa di edit.
					return  tombolPayment($model);
				}					
			}
		], 
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$headerColor,'#ffffff'),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','0',''),
	]; 
	$gvStore=GridView::widget([
		'id'=>'gv-store',
		'dataProvider' => $dataProviderstore,
		// 'filterModel' => $searchModelstore,
		'columns'=>$gvAttributeItem,		 
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-store',
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
		'rowOptions'   => function ($model, $key, $index, $grid) {			
			$btnclick= ['onclick' => '
				$.pjax.reload({
                    url: "'.Url::to(["/sistem/user-profile/"]).'?storeid='.$model->STORE_ID.'",
					container: "#gv-perangkat",
					//timeout: 1000,
				});
			'];
			return $btnclick;
		},
		'panel' => [
			//'heading'=>false,
			'heading'=>'
				<span class="fa-stack fa-sm">
				  <i class="fa fa-circle-thin fa-stack-2x" style="color:#25ca4f"></i>
				  <i class="fa fa-text-width fa-stack-1x"></i>
				</span> LIST TOKO'.'  <div style="float:right"><div style="font-family: tahoma ;font-size: 8pt;"> </div></div> ',  
			'type'=>'info',
			'before'=>false,
			'after'=>false,
			// 'before'=>$dscLabel.'<div class="pull-right">'. tombolRefresh().' '.tombolExportExcel().' '.tombolReqStore().' '.tombolRestore().'</div>',
			// 'before'=> tombolReqStore(),
			'showFooter'=>'aas',
		], 
		// 'floatOverflowContainer'=>true,
		//'floatHeader'=>true,
	]); 
	
?>

<div class="container-fluid">
<div class="user-profile-index">	
	<?php if (Yii::$app->session->hasFlash('success')){ ?>
			<?php
				echo Alert::widget([
					'type' => Alert::TYPE_SUCCESS,
					'title' => 'Well done!',
					'icon' => 'glyphicon glyphicon-ok-sign',
					'body' => Yii::$app->session->getFlash('success'),
					'showSeparator' => true,
					'delay' => 1000
				]);
			?>
		<?php } elseif (Yii::$app->session->hasFlash('error')) {
			echo Alert::widget([
				'type' => Alert::TYPE_DANGER,
				'title' => 'Oh snap!',
				'icon' => 'glyphicon glyphicon-remove-sign',
				'body' => Yii::$app->session->getFlash('error'),
				'showSeparator' => true,
				'delay' => 1000
			]);
		}?>
		
<div class="row" style="margin-left:1px">
	<div class="w3-card-2 w3-round grdiasicolor w3-left col-md-2 col-md-2">
		<div class="penampung" style="padding-top: 10px;">
				<?php if(empty($dataProviderimage->ACCESS_IMAGE)){?>
					<img src="https://www.mautic.org/media/images/default_avatar.png" alt="Your Avatar" class="image img-circle" style="width:150px;height:150px;margin-left:-3px">
				<?php }else{?>
					<img src="<?php echo $dataProviderimage->ACCESS_IMAGE;?>" alt="Your Avatar" class="image img-circle" style="width:150px;height:150px;margin-left:-3px">
				<?php }?>
		</div>
		<div class="tombol">
			<?php $form = ActiveForm::begin([
				'method' => 'post',
				'action' =>['/sistem/user-image/update?ACCESS_ID='.$user.''],
				'options'=>['enctype'=>'multipart/form-data'],
				]); ?>
				<?= $form->field($dataProviderimage, 'ACCESS_IMAGE')->fileInput(['onchange'=>'this.form.submit()', 'class'=>'custom-file-input', 'accept'=>'image/x-png,image/gif,image/jpeg'])->label(false); ?>
			<?php ActiveForm::end(); ?>
		</div>
	</div>

    <div class="col-md-10 col-md-10">
		<div class="w3-card-2 w3-round w3-white w3-left">
			<?php if(!empty($user)){ ?>
				<?php echo DetailView::widget([
					'id'=>'dv-info',
					'model'=>$dataProvider,
					'condensed'=>true,
					'hAlign'=>'left',
					'hover'=>true,
					'panel'=>[
						'heading'=>'<b>Detail Profile</b>',
						'type'=>DetailView::TYPE_INFO,
					],
					'mode'=>DetailView::MODE_VIEW,
					'buttons1'=>'',
					'buttons2'=>'{view}{save}',		
					'attributes' =>[
						[
							'columns' => [
								[
									'attribute'=>'nama',
									'label'=>'Nama Lengkap',
									'enableEditMode'=>false,
									'displayOnly'=>true,
									'valueColOptions'=>['style'=>'width:30%']
								],
								[
									'attribute'=>'gender',
									'value'=> (($genderx)==1)?"Laki-Laki":
									(($genderx==2)?"Perempuan":"Harap perbaiki data"),
									'label'=>'Jenis Kelamin',
									'enableEditMode'=>false,
									'displayOnly'=>true,
									'valueColOptions'=>['style'=>'width:30%']
								],
							],
						],
						[
							'columns' => [
								[
									'attribute'=>'ktp',
									'label'=>'KTP',
									'enableEditMode'=>false,
									'displayOnly'=>true,
									'valueColOptions'=>['style'=>'width:30%']
								],
								[
									'attribute'=>'hp',
									'label'=>'Telepon',
									'enableEditMode'=>false,
									'displayOnly'=>true,
									'valueColOptions'=>['style'=>'width:30%']
								],
							],
						],
						[
							'columns' => [
								[
									'attribute'=>'ttl',
									'label'=>'Tempat/Tanggal Lahir',
									'enableEditMode'=>false,
									'displayOnly'=>true,
									'valueColOptions'=>['style'=>'width:30%']
								],
								[
									'attribute'=>'email',
									'label'=>'Email',
									'enableEditMode'=>false,
									'displayOnly'=>true,
									'valueColOptions'=>['style'=>'width:30%']
								],
							],
						],
						[
							'columns' => [
								[
									'attribute'=>'alamat',
									'label'=>'Alamat',
									'enableEditMode'=>false,
									'displayOnly'=>true,
									'valueColOptions'=>['style'=>'width:80%']
								],
							],
						],
					]
				]);?>
				<?php } ?>
			<div class="col-md-8">
				<p>Besar file: Maksimal 51200 bytes/500KB
					Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG</p>
			</div>
			<div class="col-md-4">
			<div class="pull-right">		
				<?php echo tombolEditProfile($dataProvider);?>
				<?php echo tombolChange($dataProvider);?>
			</div>
			</div>
			
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-5 col-md-12">
		<div class="w3-example-box"><b> Isi Dompet Kamu per Tanggal <?php echo date('d-m-Y');?> adalah </b> </div> 
		<?php if(empty($dataProvidersaldo->SALDO_DOMPET)){?>
			<h1>Rp 0,-</h1>
		<?php }else{?>
			<h1>Rp <?php echo $dataProvidersaldo->SALDO_DOMPET;?>,-</h1>
		<?php }?>
	</div>
	
	<div class="row">
	<div class="col-md-6">
		<div class="col-md-8 col-md-8">
		ID Virtual Acount Anda : <?php echo (empty($dataProvidersaldo->VA_ID)) ? '<kbd>-</kbd>' : '<span class="label label-warning">'.$dataProvidersaldo->VA_ID.'</span>'; ?>
		<br>
		<br>
		Saldo Mengendap : Rp <?php echo (empty($dataProvidersaldo->SALDO_MENEGNDAP)) ? '<kbd>-</kbd>' : '<span class="label label-info">'.$dataProvidersaldo->SALDO_MENEGNDAP.'</span>'; ?>
		<br>
		<br>
		Saldo Jualan : Rp <?php echo (empty($dataProvidersaldo->SALDO_JUALAN)) ? '<kbd>-</kbd>' : '<span class="label label-primary">'.$dataProvidersaldo->SALDO_JUALAN.'</span>'; ?>
		</div>
	<div class="col-md-2 col-md-2">
	<div class="">
		<div style="margin-bottom: 10px;margin-top: 10px;">
			<?php if(empty($dataProviderekening)){
				echo tombolCountBankProfile($dataProvider);
			}else{
				echo Html::beginTag('div', ['class'=>'btn-group']);
				echo Html::button('<span class="fa fa-credit-card fa-lg"></span> Account Bank <span class="caret"></span></button>', 
				['type'=>'button', 'class'=>'btn btn-success dropdown-toggle btn-md', 'data-toggle'=>'dropdown']);
				echo Html::beginTag('ul', ['class'=>'dropdown-menu','role'=>'menu']);
					echo tombolCountBankProfileDropdownDetail($dataProvider);
					echo tombolCountBankProfileDropdownUpdate($dataProvider);
				echo Html::endTag('ul');
				echo Html::endTag('div');
			}?>
		</div>
		
		<?php echo tombolHistoriDompet($dataProvider);?>
		</div>
		
	</div>
	</div>
	</div>
</div>
<hr>
	<div class="row">
		<div class="col-md-6">
			<?php if (!empty(Yii::$app->user->identity->ACCESS_LEVEL)=="OWNER") {?>
					<?=$gvStore?>
			<?php } ?>
		</div>
	<div class="col-md-6">
		<?php if (!empty(Yii::$app->user->identity->ACCESS_LEVEL)=="OWNER") {?>
			<?= GridView::widget([
			'id'=>'gv-perangkat',
			'dataProvider' => $dataProviderKasir,
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
		]);  ?>
        <?php } ?>
	</div>

	</div>
        
    </div>
	</div>