<?php

use kartik\helpers\Html;
use kartik\detail\DetailView;
use kartik\editable\Editable;
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
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAssetBackendBorder;
AppAssetBackendBorder::register($this);
$this->title = 'Keanggotaan';
$this->params['breadcrumbs'][] = $this->title;
$vewBreadcrumb=Breadcrumbs::widget([
    'homeLink' => [
        'label' => Html::encode(Yii::t('yii', 'Home')),
        'url' => Yii::$app->homeUrl,
    ],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
$this->registerJs($this->render('presensi.js'),View::POS_READY);
echo $this->render('modal');
	$this->registerCss("
	.process-step .btn:focus{outline:none}
	.process{display:table;width:100%;position:relative}
	.process-row{display:table-row}
	.process-step button[disabled]{opacity:1 !important;filter: alpha(opacity=100) !important}
	.process-row:before{top:40px;bottom:0;position:absolute;content:' ';width:100%;height:1px;background-color:#ccc;z-order:0}
	.process-step{display:table-cell;text-align:center;position:relative}
	.process-step p{margin-top:4px}
    .btn-circle{width:80px;height:80px;text-align:center;font-size:12px;border-radius:50%}
");
?>

<div class="container-fluid" >
<h5><?=$vewBreadcrumb ?></h5>
 <div class="row">
  <div class="process">
   <div class="process-row nav nav-tabs">
    <div class="process-step">
     <button type="button" class="btn btn-info btn-circle" data-toggle="tab" href="#menu1" aria-expanded="false"><i class="fa fa-id-card fa-3x"></i></button>
     <p><small>PERUSAHAAN</small></p>
    </div>
    <div class="process-step">
     <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu2" aria-expanded="false"><i class="fa fa-handshake-o fa-3x"></i></button>
     <p><small>VERIVIKASI DATA</small></p>
    </div>
    <div class="process-step">
     <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu3" aria-expanded="false"><i class="fa fa-cogs fa-3x"></i></button>
     <p><small>SETTING PEMBAYARAN PERANGAKAT</small><br>
        <small>DAN TRANSAKSI DEPOSIT</small>
     </p>
    </div>
    <div class="process-step">
     <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu4" aria-expanded="false"><i class="fa fa-archive fa-3x"></i></button>
     <p><small>INVOICE</small></p>
    </div>
   </div>
  </div>
  <div class="tab-content">
   <div id="menu1" class="tab-pane fade active in">
        <div class="container-fluid">
            <?=$this->render('form_create',[
                'modelRek' => $modelRek,
                'modelcorpImg' => $modelcorpImg,
                'modelcorp' => $modelcorp,
                'modelRekImg' => $modelRekImg,
            ]);?>
        </div>
    </div>
   <div id="menu2" class="tab-pane fade">
        <div class="container-fluid">
            <?=$this->render('form_verifikasi',[
                'modelRek' => $modelRek,
                'modelcorpImg' => $modelcorpImg,
                'modelcorp' => $modelcorp,
                'modelRekImg' => $modelRekImg,
            ]);?>
        </div>
    </div>
   <div id="menu3" class="tab-pane fade">
        <div class="container-fluid">
            <?=$this->render('form_setting',[
                'searchModelperangkat' => $searchModelperangkat,
                'dataProviderperangkat' => $dataProviderperangkat,
            ]);?>
        </div>
    </div>
   <div id="menu4" class="tab-pane fade">
        <div class="container-fluid">
            <?=$this->render('invoice');?>
        </div>
    </div>
  </div>
 </div>
</div>
<br>