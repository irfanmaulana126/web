<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use frontend\assets\AppAssetBackendBorder;
AppAssetBackendBorder::register($this);

use yii\widgets\Breadcrumbs;	
	$this->title = 'laporan menu';
	$this->params['breadcrumbs'][] = ['label'=>$this->title, 'url' => ['/laporan']];
	$vewBreadcrumb=Breadcrumbs::widget([
		'homeLink' => [
			'label' => Html::encode(Yii::t('yii', 'Home')),
			'url' => Yii::$app->homeUrl,
		],
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]);

//$this->title = 'Ringakasan Laporan';
?>

<div class="container-fluid">
	<div class="col-md-12">
		<h5><?=$vewBreadcrumb ?></h5>
		<div style="
			position: fixed;
			opacity: 0.02;
			width: 100%;
			max-width: 100%;
			height: auto;
			top: 25%;
			left: 29%;
			display: block;
			margin: inherit;
		">
			<img src="/logo-dashboard2.png" width="800px" alt="">
		</div>
		<section class="content-header">
			<h1>
			Laporan
			<small>Bisnis Anda</small>
			</h1>
		</section>
		<br>
	</div>
    <div class="col-md-6">
        <div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
            <h3>Laporan Arus Uang</h3>
            <p>Laporan ini mengukur kas yang telah dihasilkan atau digunakan oleh suatu perusahaan dan menunjukkan detail pergerakannya dalam suatu periode.</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/arus-uang']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
            <h3>Laporan Jurnal</h3>
            <p>Daftar semua jurnal per transaksi yang terjadi dalam periode waktu. Hal ini berguna untuk melacak di mana transaksi Anda masuk ke masing-masing rekening</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/jurnal-transaksi-bulan']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
            <h3>Laporan Laba Rugi</h3>
            <p>laporan keuangan yang termasuk dalam rangkaian siklus akuntansi yang dihasilkan dalam satu periode akuntansi yang didalamnya menyajikan seluruh unsur pendapatan dan beban perusahaan yang akan menghasilkan kondisi sebenarnya laba .</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/neraca']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
        <div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
            <h3>Laporan Donasi</h3>
            <p>Laporan yang rekaman terhadap donasi yang di lakukan oleh end user sebagai sumbangsih sosial.</p>
            <?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/donasi']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
        </div>
    </div>      
    <div class="col-md-6">
		<div class="row">	
			<div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
				<h3>Laporan Penjualan</h3>
				<p>Menunjukkan daftar kronologis dari semua faktur dan pembayaran untuk rentang tanggal yang dipilih.</p>
				<?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/sales']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
			</div>
			<div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
				<h3>Buku Besar</h3>
				<p>Laporan ini menampilkan semua transaksi yang telah dilakukan untuk suatu periode. Laporan ini bermanfaat jika Anda memerlukandaftar kronologis untuk semua transaksi yang telah dilakukan oleh perusahaan Anda.</p>
				<?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/buku-besar']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
			</div>
			<div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
				<h3>Laporan PPOB</h3>
				<p>PPOB atau singkatan dari Payment Point Online Bank, yang dimana anda dapat melakukan pembayaran. Dengan adanya layanan ini kami membuka kesempatan baru kepada seluruh mitra-mitra kami selain dapat berwirausaha pulsa elektrik dapat juga menjadi agen PPOB membayar tagihan PLN, Telkom, Speedy, dan Flexi Pascabayar melalui SMS seperti anda melakukan transaksi pengisian pulsa.</p>
				<?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/ppob']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
			</div>
			<div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
				<h3>Laporan Dompet</h3>
				<p>Laporan dompet Kontrol Gampang, merupakan laporan topup saldo dompet,transfer ke rekening tujuan, dan laporan potongan terhadap penggunaan fasilitas PPOB dan pembayaran Langanan Kontrol Gampang.</p>
				<?= Html::button('Lihat Laporan',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/laporan/dompet']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Tambah']);?>
			</div>
		</div>
    </div>      
</div>