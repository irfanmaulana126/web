<?php
use yii\helpers\Html;
use yii\web\View;
$this->title="Prodak";
?>

<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
<section class="content-header">
    <h1>
    Produk<small>Menu</small>
    </h1>
</section>
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
	<div class="col-md-6">
        <div class="col-md-12">
            <h3>Semua Produk</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis soluta vero quae nobis voluptatum perspiciatis labore sunt? Blanditiis rerum pariatur doloremque voluptatum dolore ducimus accusamus et mollitia? Natus, debitis dolore!</p>
            <?= Html::button('Lanjut',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-produk']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Lanjut']);?>
        </div>
        <div class="col-md-12">
            <h3>Dicount produk</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis soluta vero quae nobis voluptatum perspiciatis labore sunt? Blanditiis rerum pariatur doloremque voluptatum dolore ducimus accusamus et mollitia? Natus, debitis dolore!</p>
            <?= Html::button('Lanjut',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-discount']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Lanjut']);?>
        </div>
        <div class="col-md-12">
            <h3>Stock Produk</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, dolore magnam omnis ex rem mollitia dolorem molestias animi quo, ut doloribus aliquid numquam voluptates sapiente adipisci, assumenda quibusdam blanditiis rerum.</p>
            <?= Html::button('Lanjut',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-stock']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Lanjut']);?>
        </div>
        <div class="col-md-12">
            <h3>Customer</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, dolore magnam omnis ex rem mollitia dolorem molestias animi quo, ut doloribus aliquid numquam voluptates sapiente adipisci, assumenda quibusdam blanditiis rerum.</p>
            <?= Html::button('Lanjut',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-customer']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Lanjut']);?>
        </div>
    </div>      
    <div class="col-md-6">
        <div class="col-md-12">
            <h3>Promo Produk</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, dolore magnam omnis ex rem mollitia dolorem molestias animi quo, ut doloribus aliquid numquam voluptates sapiente adipisci, assumenda quibusdam blanditiis rerum.</p>
            <?= Html::button('Lanjut',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-promo']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Lanjut']);?>
        </div>
        <div class="col-md-12">
            <h3>Harga Produk</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis soluta vero quae nobis voluptatum perspiciatis labore sunt? Blanditiis rerum pariatur doloremque voluptatum dolore ducimus accusamus et mollitia? Natus, debitis dolore!</p>
            <?= Html::button('Lanjut',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-harga']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Lanjut']);?>
        </div>
        <div class="col-md-12">
            <h3>Group Produk</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis soluta vero quae nobis voluptatum perspiciatis labore sunt? Blanditiis rerum pariatur doloremque voluptatum dolore ducimus accusamus et mollitia? Natus, debitis dolore!</p>
            <?= Html::button('Lanjut',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-group']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Lanjut']);?>
        </div>
        <div class="col-md-12">
            <h3>Supplier</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis soluta vero quae nobis voluptatum perspiciatis labore sunt? Blanditiis rerum pariatur doloremque voluptatum dolore ducimus accusamus et mollitia? Natus, debitis dolore!</p>
            <?= Html::button('Lanjut',['onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(['/master/data-barang/index-supplier']) . "';",'id'=>'jurnal-button-akun','data-pjax' => false,'class'=>"btn bg-purple btn-flat margin",'title'=>'Lanjut']);?>
        </div>
        
    </div>   
	</div>
</div>