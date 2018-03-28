<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\web\View;
use yii\widgets\Breadcrumbs;

$this->title = 'Ringakasan HRD';
$this->params['breadcrumbs'][] = $this->title;
$vewBreadcrumb=Breadcrumbs::widget([
    'homeLink' => [
        'label' => Html::encode(Yii::t('yii', 'Home')),
        'url' => Yii::$app->homeUrl,
    ],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
$this->registerJs($this->render('presensi.js'),View::POS_READY);
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

<h5><?=$vewBreadcrumb ?></h5>
<section class="content-header">
    <h1>
    HRD <small>Ringakasan</small>
    </h1>
</section>
<br>
<div class="container-fluid" >
 <div class="row">
  <div class="process">
   <div class="process-row nav nav-tabs">
    <div class="process-step">
     <button type="button" class="btn btn-info btn-circle" data-toggle="tab" href="#menu1"><i class="fa fa-users fa-3x"></i></button>
     <p><small>DATA KARYAWAN</small></p>
    </div>
    <div class="process-step">
     <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu2"><i class="fa fa-cogs fa-3x"></i></button>
     <p><small>SETTING</small></p>
    </div>
    <div class="process-step">
     <button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu3"><i class="fa fa-file-text fa-3x"></i></button>
     <p><small>REKAP DATA KARYAWAN</small></p>
    </div>
   </div>
  </div>
  <div class="tab-content">
   <div id="menu1" class="tab-pane fade active in">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="col-md-12">
                <h3>Data Karyawan</h3>
                <p>Merupakan keselurahan data pegawai anda berdasarkan store yang dimiliki pada menu ini anda dapat menambahkan, mengubah serta menghapus data karyawan</p>
                <?=Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/rekap/index-karyawan']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
            </div>
        </div>      
        <div class="col-md-6">
            <div class="col-md-12">
                <h3>Data Gaji Karyawan</h3>
                <p>Merupakan menu untuk menentukan gaji serta pengaturan presensi setiap karyawan.</p>
                <?=Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/rekap/index-gaji']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
            </div>
        </div>      
    </div>
   </div>
   <div id="menu2" class="tab-pane fade">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="col-md-12">
                <h3>Setelan Persensi</h3>
                <p>Pengaturan anda terhadap penggajian pegawai anda.</p>
                <?=Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/rekap/index-presensi']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
            </div>
        </div>      
        <div class="col-md-6">
            <div class="col-md-12">
                <h3>Log Persensi</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, dolore magnam omnis ex rem mollitia dolorem molestias animi quo, ut doloribus aliquid numquam voluptates sapiente adipisci, assumenda quibusdam blanditiis rerum.</p>
                <?=Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/rekap/index-log']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
            </div>
        </div>      
    </div>
   </div>
   <div id="menu3" class="tab-pane fade">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="col-md-12">
                <h3>Rekap Persensi</h3>
                <p>Pencatatan hasil keselurahan absen kariyawan anda.</p>
                <?=Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/rekap/index-absen']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
            </div>
        </div>      
        <div class="col-md-6">
            <div class="col-md-12">
                <h3>Rekap Penggajian</h3>
                <p>rekapitulasi penggajian karyawan yang anda miliki.</p>
                <?=Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/rekap/index-penggajian']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
            </div>
        </div>      
    </div>
   </div>
  </div>
 </div>
</div>
<br>
<!-- <div class="container-fluid">
    <div class="col-md-6">
        <div class="col-md-12">
            <h3>Rekap Persensi</h3>
            <p>Pencatatan hasil keselurahan absen kariyawan anda.</p>
            <?php // Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/absen-rekap']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="col-md-12">
            <h3>Data Karyawan</h3>
            <p>Merupakan keselurahan data pegawai anda berdasarkan store yang dimiliki pada menu ini anda dapat menambahkan, mengubah serta menghapus data karyawan</p>
            <?php // Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/karyawan']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="col-md-12">
            <h3>Setelan Persensi</h3>
            <p>Pengaturan anda terhadap penggajian pegawai anda.</p>
            <?php // Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/setelan-presensi']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
        </div>
    </div>      
    <div class="col-md-6">
        <div class="col-md-12">
            <h3>Rekap Penggajian</h3>
            <p>rekapitulasi penggajian karyawan yang anda miliki.</p>
            <?php // Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/penggajian-rekap']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
        </div>
        <div class="col-md-12">
            <h3>Data Gaji Karyawan</h3>
            <p>Merupakan menu untuk menentukan gaji serta pengaturan presensi setiap karyawan.</p>
            <?php // Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/list-gaji']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
        </div>
        <div class="col-md-12">
            <h3>Log Persensi</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, dolore magnam omnis ex rem mollitia dolorem molestias animi quo, ut doloribus aliquid numquam voluptates sapiente adipisci, assumenda quibusdam blanditiis rerum.</p>
            <?php // Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/hris/log-presensi']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
        </div>
    </div>      
</div> -->