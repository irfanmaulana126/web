<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;

$this->title = 'Ringakasan Laporan';
?>

<section class="content-header">
    <h1>
    Laporan
    <small>Bisnis Anda</small>
    </h1>
</section>
<br>
<div class="container-fluid">
    <div class="col-md-6">
        <div class="col-md-12">
            <h3>Laporan Arus Uang</h3>
            <p>Laporan ini mengukur kas yang telah dihasilkan atau digunakan oleh suatu perusahaan dan menunjukkan detail pergerakannya dalam suatu periode.</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/laporan/index-arus']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="col-md-12">
            <h3>Laporan Jurnal</h3>
            <p>Daftar semua jurnal per transaksi yang terjadi dalam periode waktu. Hal ini berguna untuk melacak di mana transaksi Anda masuk ke masing-masing rekening</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/laporan/index-jurnal']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="col-md-12">
            <h3>Laporan Neraca</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, dolore magnam omnis ex rem mollitia dolorem molestias animi quo, ut doloribus aliquid numquam voluptates sapiente adipisci, assumenda quibusdam blanditiis rerum.</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/laporan/index-neraca']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="col-md-12">
            <h3>Laporan Donasi</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, dolore magnam omnis ex rem mollitia dolorem molestias animi quo, ut doloribus aliquid numquam voluptates sapiente adipisci, assumenda quibusdam blanditiis rerum.</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/laporan/index-donasi']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
    </div>      
    <div class="col-md-6">
        <div class="col-md-12">
            <h3>Laporan Penjualan</h3>
            <p>Menunjukkan daftar kronologis dari semua faktur dan pembayaran untuk rentang tanggal yang dipilih.</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/laporan/index-penjualan']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="col-md-12">
            <h3>Buku Besar</h3>
            <p>Laporan ini menampilkan semua transaksi yang telah dilakukan untuk suatu periode. Laporan ini bermanfaat jika Anda memerlukandaftar kronologis untuk semua transaksi yang telah dilakukan oleh perusahaan Anda.</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/laporan/index-buku']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="col-md-12">
            <h3>Laporan PPOB</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, dolore magnam omnis ex rem mollitia dolorem molestias animi quo, ut doloribus aliquid numquam voluptates sapiente adipisci, assumenda quibusdam blanditiis rerum.</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/laporan/index-ppob']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="col-md-12">
            <h3>Laporan Dompet</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, dolore magnam omnis ex rem mollitia dolorem molestias animi quo, ut doloribus aliquid numquam voluptates sapiente adipisci, assumenda quibusdam blanditiis rerum.</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/laporan/index-dompet']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
    </div>      
</div>