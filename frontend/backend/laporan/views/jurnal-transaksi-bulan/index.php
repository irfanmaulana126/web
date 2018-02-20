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
use frontend\backend\laporan\models\JurnalTransaksiBulan;

$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;    
// print_r($dataProvider->getModels());
// die();
$this->title = 'Jurnal Transaksi Bulans';
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
		#jurnal-transaksi .kv-grid-container{
			height:400px
		}
		
	#jurnal-transaksi .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color:#000;
	}
	#jurnal-transaksi .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	");
	$this->registerJs($this->render('jurnal_script.js'),View::POS_READY);
	echo $this->render('jurnal_button'); //echo difinition
    echo $this->render('jurnal_modal'); //echo difinition
    $bColor='rgb(76, 131, 255)';	
    $gvAttProdakDiscountItem=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		[
			'attribute'=>'STORE_ID',
			'label'=>'NAMA STORE',
			'filterType'=>true,
			'format'=>'raw',
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','80px'),
			'hAlign'=>'right',
			'vAlign'=>'top',
			'mergeHeader'=>false,
            'group'=>FALSE,
            'value'=>'store.STORE_NM',
			'groupedRow'=>FALSE,
			'noWrap'=>false,
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>[
				'style'=>[
					'text-align'=>'left',
					'color'=>'red',
					'font-family'=>'tahoma, arial, sans-serif',						
					'font-weight'=>'bold',
				],
            ],
            'filter'=>ArrayHelper::map(JurnalTransaksiBulan::find()->where(['ACCESS_GROUP'=>$user])->all(),'store.STORE_NM','store.STORE_NM'),
			'filterType'=>GridView::FILTER_SELECT2,
			'filterWidgetOptions'=>['pluginOptions'=>['allowClear'=>true]],	
			'filterInputOptions'=>['placeholder'=>'-Pilih-'],
			'filterOptions'=>[],
		],	
		[
			'attribute'=>'TAHUN',
			'label'=>'TAHUN',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','200px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','200px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','200px',''),
			
			
		],	
		[
			'attribute'=>'BULAN',
			'label'=>'BULAN',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','200px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','200px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','200px',''),
			
			
		],	
		[
			'attribute'=>'JUMLAH',
			'label'=>'JUMLAH',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','200px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','200px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','200px',''),
			
			
		],	
		//DEFAULT_HARGA
		[
			'attribute'=>'AKUN_CODE',
			'label'=>'AKUN CODE',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
		],
		//DEFAULT_HARGA
		[
			'attribute'=>'AKUN_NM',
			'label'=>'AKUN',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
		],
		
		[
			'attribute'=>'KTG_NM',
			'label'=>'KTG',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],			
		//DEFAULT_STOCK
		[
			'attribute'=>'STT_PAY_NM',
			'label'=>'STATUS PAY',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],
	];
	$pageNm='<span class="fa-stack fa-xs text-left" style="float:left">
			  <b class="fa fa-list-alt fa-stack-2x" style="color:#000000"></b>
			 </span> <div style="float:left;padding:10px 20px 0px 5px"><b>JURNAL TRANSAKSI</b></div> 
			 ';	
	$gvInvOut= GridView::widget([
		'id'=>'jurnal-transaksi',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'columns' =>$gvAttProdakDiscountItem,	
		'toolbar' => [
			'{export}',
		],	
		'panel'=>[
			'type'=>'info',
			'heading'=>$pageNm.'<div style="float:right;padding:0px 10px 0px 5px"></div> ',
			'before'=>false,
			'after'=>false			
		],
		'pjax'=>false,
	    'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'jurnal-transaksi',
			],
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>true,
		'bordered'=>true,
		'striped'=>'4px',
		'autoXlFormat'=>true,
		'export' => false,
		'export'=>[//export like view grid --ptr.nov-
			'fontAwesome'=>true,
			'showConfirmAlert'=>false,
			'target'=>GridView::TARGET_BLANK
		],
		'summary'=>false,
		//'floatHeader'=>false,
		// 'floatHeaderOptions'=>['scrollingTop'=>'200'] 
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]);
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
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


    
<div class="row">
<div class="col-md-12">
<div class="pull-right">
        <?= tombolViewAkun().' '.tombolViewGroup();?>
	</div>
 </div>
 <br>    
 <br>    
<div class="col-md-12">
    <?=$gvInvOut?>
</div>    
	
    </div>
    	  </div>
