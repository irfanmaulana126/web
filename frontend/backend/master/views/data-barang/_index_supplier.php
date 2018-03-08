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
use kartik\widgets\Alert;
use frontend\backend\master\models\Product;
$this->title="supplier";
$this->registerJs($this->render('databarang_script.js'),View::POS_READY);

echo $this->render('databarang_button'); //echo difinition
echo $this->render('databarang_modal'); //echo difinition
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
	#gv-all-data-supplier-item .kv-grid-container{
		height:400px
	}
	#gv-all-data-supplier-item .panel-heading {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
		color: #000;
	}
	#gv-all-data-supplier-item .panel-footer {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");
	$user = (empty(Yii::$app->user->identity->ACCESS_GROUP)) ? '' : Yii::$app->user->identity->ACCESS_GROUP;
    $bColor='rgb(76, 131, 255)';
	$pageNm='<span class="fa-stack fa-xs text-right">				  
				  <i class="fa fa-share fa-1x"></i>
				</span><b>SUPPLIER</b>
	';
	$gvAttsupplierItem=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
        //ITEM_ID
		[
			'attribute'=>'SUPPLIER_ID',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
		],		
		[
			'attribute'=>'SUPPLIER_NM',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
		],		
		[
			'attribute'=>'EMAIL',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
		],		
		[
			'attribute'=>'ALAMAT',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format'=>'raw',
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','100px',''),
		],		
	];
	
	$gvAttsupplierItem[]=[			
		//ACTION
		'class' => 'kartik\grid\ActionColumn',
		'template' => '{view}{edit}{hapus}{discount}{promo}{harga}{stock}',
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
			'view' =>function ($url, $model){
				return  tombolViewsup($url, $model);
			},
			'edit' =>function($url, $model,$key){
				//if($model->STATUS!=1){ //Jika sudah close tidak bisa di edit.
				return  tombolEditsup($url, $model);
				//}					
			},
			'hapus' =>function($url, $model,$key){
				return  tombolHapussup($url, $model);
			},
		],
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$bColor,'#ffffff'),
		'contentOptions'=>Yii::$app->gv->gvContainBody('center','10px',''),
	]; 
	$gvAllStoreItem=GridView::widget([
		'id'=>'gv-all-data-supplier-item',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttsupplierItem,				
		'pjax'=>0,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-all-data-supplier-item',
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
			'heading'=>'<div class="pull-right">'.tombolCreatesup().'&nbsp;</div>'.$pageNm,
			// 'heading'=>'<div class="pull-right">'.tombolExportExcel().' '.tombolImportExcel().' '.tombolCreatesup().'&nbsp;</div>'.$pageNm,
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
		<?=tombolKembali()?>
		<br>
		<br
	<?=$gvAllStoreItem?>
</div>
