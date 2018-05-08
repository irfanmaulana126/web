<?php
use yii\helpers\Html;
use yii\web\View;
use kartik\widgets\Growl;
use yii\widgets\Breadcrumbs;

use frontend\assets\AppAssetBackendBorder;
AppAssetBackendBorder::register($this);

$this->title="Prodak";
	$this->params['breadcrumbs'][] =$this->title;
	$vewBreadcrumb=Breadcrumbs::widget([
		'homeLink' => [
			'label' => Html::encode(Yii::t('yii', 'Home')),
			'url' => Yii::$app->homeUrl,
		],
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]);
?>
<?php if (Yii::$app->session->hasFlash('error')) {
			echo Growl::widget([
                'type' => Growl::TYPE_DANGER,
                'title' => 'Oh snap!',
                'icon' => 'glyphicon glyphicon-remove-sign',
				'body' => Yii::$app->session->getFlash('error'),
				'showSeparator' => true,
                'delay' => 500,
                'pluginOptions' => [
                    'showProgressbar' => true,
                    'placement' => [
                        'from' => 'top',
                        'align' => 'right',
                    ]
                ]
			]);
		}?>
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
"><img src="/logo-dashboard2.png" width="800px" alt=""></div>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
<div class="col-md-12">
<h5><?=$vewBreadcrumb ?></h5>
<section class="content-header">
    <h1>
    Produk<small>Menu</small>
    </h1>
</section>
<br>
</div>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
	<div class="col-md-6">
        <div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
            <h3>Semua Produk</h3>
            <p>Merupakan seluruh data produk yang anda miliki serta dapat untuk menambah, mengubah, menghapus produk yang anda inginkan </p>
            <?= Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-produk']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
        </div>
        <div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
            <h3>Stock Produk</h3>
            <p>Merupakan menu yang ditujukan untuk menambahkan stok pada setiap produk serta dapa melihat jumlah produk yang dimiliki</p>
            <?= Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-stock']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
        </div>
        <div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
            <h3>Dicount produk</h3>
            <p>Merupakan data produk yang memilki discount serta bertujuan untuk menambahkan discount disetiap produk yang dinginkan berdasarkan tanggal yang diinginkan</p>
            <?= Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-discount']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
        </div>
        <div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
            <h3>Customer</h3>
            <p>Merupakan data pelanggan disetiap toko yang anda miliki dan dapat melakukan pendataan seperti penambahan, pengubahan serta penghapusan data pelanggan</p>
            <?= Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-customer']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
        </div>
        <div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
            <h3>Produk PPOB</h3>
            <p>Merupakan seluruh data produk ppob yang terdaftar pada aplikasi Kontor Gampang</p>
            <?= Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-ppob']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
        </div>
    </div>      
    <div class="col-md-6">
		<div class="row">
			<div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
				<h3>Harga Produk</h3>
				<p>Merupakan menu yang digunkan untuk melakukan pengaturan harga berdasarkan tanggal yang diinginkan</p>
				<?= Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-harga']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
			</div>
            <div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
				<h3>Promo Produk</h3>
				<p>Merupakan data produk yang memiliki promo serta dapat menambahkan promo pada setiap produk berdasarkan tanggal yang diinginkan</p>
				<?= Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-promo']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
			</div>
			<div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
				<h3>Group Produk</h3>
				<p>Merupakan data group produk yang anda miliki anda dapat menambahkan group produk yang anda inginkan bertujuan untuk melakukan grouping pada setiap produk anda</p>
				<?= Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-group']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
			</div>
			<div class="w3-card-2 w3-round w3-white w3-left col-md-12" style="margin-bottom:15px">
				<h3>Supplier</h3>
				<p>Merupakan data supplier yang anda miliki dan juga dapat melakukan penambahan, perubahan serta penghapusan supplier</p>
				<?= Html::button('Detail',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-supplier']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Detail']);?>
			</div>        
		</div>   
    </div>   
	</div>
</div>