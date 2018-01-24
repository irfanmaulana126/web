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
use yii\data\ArrayDataProvider;
use yii\web\View;
use kartik\widgets\Alert;
$this->title="Setelan Presensi";
// $this->registerJs($this->render('databarang_script.js'),View::POS_READY);
// echo $this->render('databarang_button'); //echo difinition
// echo $this->render('databarang_modal'); //echo difinition
	$this->registerCss("
		#expand-menu :link {
			color:black;
		}
		//mouse over link
		#expand-menu a:hover {
			color: black;
		}
		//selected link
		a:active {
			color: black;
		}
		.kv-panel {
			//min-height: 340px;
			height: 300px;
		}
		#expand-menu .kv-grid-container{
			height:250px
		}
		#w6 :link {
			color: black;
		}
		/* mouse over link */
		#w6-container a:hover {
			color: #5a96e7;
		}
		/* selected link */
		#w6-container a:active {
			color: blue;
		}
	");

	$headerColor='rgba(128, 179, 178, 1)';
	$Action=$this->render('_index_izin',[
	'searchModelIzin' => $searchModelIzin,
	'dataProviderIzin' => $dataProviderIzin,
	]);
	$Action2=$this->render('_index_jam',[
	'searchModelJam' => $searchModelJam,
	'dataProviderJam' => $dataProviderJam,
		]);
	$Action3=$this->render('_index_periode',[
	'searchModelPeriode' => $searchModelPeriode,
	'dataProviderPeriode' => $dataProviderPeriode,
	]);
	$Action4=$this->render('_index_pot',[		
	'searchModelPot' => $searchModelPot,
	'dataProviderPot' => $dataProviderPot,
	]);
	
	$items = [
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-medkit fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> SETTING IZIN </b>',
			'content'=>$Action,
			'active'=>true
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-calendar fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> SETTING SHIFT </b>',
			'content'=>$Action2
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-calendar-check-o fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> SETTING PERIODE </b>',
			'content'=>$Action3
		],
		[
			'label'=>'<span class="fa-stack fa-sm text-left">
			<b class="fa fa-circle fa-stack-2x" style="color:#40B0B5"></b>
			<b class="fa fa-calculator fa-stack-1x" style="color:#FEFEFE"></b>
		  </span><b> SETTING POTONGAN </b>',
			'content'=>$Action4
		],
	];
	
	$tabIndex=TabsX::widget([
		'items'=>$items,
		'enableStickyTabs'=>true,
		'encodeLabels'=>false
	]);
// 	$test=ProductSearch::find()->where(['ACCESS_GROUP'=>Yii::$app->user->identity->ACCESS_GROUP])->orderBy(['ACCESS_GROUP'=>SORT_DESC,'PRODUCT_SIZE_UNIT'=>SORT_DESC,'STORE_ID'=>SORT_DESC])->all();
// print_r($test);die();
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
			<?=$tabIndex?>
</div>