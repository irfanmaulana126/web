<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\base\DynamicModel;
use kartik\money\MaskMoney;

$this->registerCss("
	/**
	 * CSS - Border radius Sudut.
	 * piter novian [ptr.nov@gmail.com].
	 * 'clientOptions' => [
	 *		'backdrop' => FALSE, //Static=disable, false=enable
	 *		'keyboard' => TRUE,	// Kyboard 
	 *	]
	*/
	.modal-content { 
		border-radius: 5px;
	}
	#store-button-restore-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#paket-model .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#kasir-button-row-bayar-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#store-button-create-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#kasir-button-row-switch-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#store-button-edit-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-view-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-edit-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-edit-porduk-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-discount-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-promo-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-stock-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-harga-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-view-discount-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-edit-discount-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-view-promo-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-edit-promo-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-view-harga-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#databarang-button-row-edit-harga-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");

	$modalHeaderColor='#fbfbfb';//' rgba(74, 206, 231, 1)';

	/*
	 * BUTTON - Search
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'store-button-restore-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:red"></i>
				<i class="fa fa-pencil fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Restore Toko </b>
		',	
		'size' => 'modal-sm',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
			//'toggleButton' => ['label' => 'click me'],
		],
		//'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='store-button-restore-content'></div>";
	Modal::end();

	/*
	 * BUTTON - FORM CREATE
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'store-button-create-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:red"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> TAMBAH STORE</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
			//'toggleButton' => ['label' => 'click me'],
		],
		//'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='store-button-create-content'></div>";
	Modal::end();
	/*
	 * BUTTON - FORM update
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'store-button-edit-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:red"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> TAMBAH STORE</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
			//'toggleButton' => ['label' => 'click me'],
		],
		//'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='store-button-edit-content'></div>";
	Modal::end();
	
	/*
	 * BUTTON - REVIEW KARYAWAN
	*/
	Modal::begin([
		'id' => 'databarang-button-row-view-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> LIHAT BARANG</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-view-content'></div>";
	Modal::end();
	
	/*
	 * BUTTON - EDIT KARYAWAN
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'databarang-button-row-edit-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> UBAH DATA STORE</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
			//'toggleButton' => ['label' => 'click me'],
		],
		//'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-edit-content'></div>";
	Modal::end();
	/*
	 * BUTTON - EDIT KARYAWAN
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'databarang-button-row-edit-porduk-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> UBAH DATA PRODUK</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
			//'toggleButton' => ['label' => 'click me'],
		],
		//'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-edit-porduk-content'></div>";
	Modal::end();
	
	/*
	 * BUTTON - Discount Prodak
	*/
	Modal::begin([
		'id' => 'databarang-button-row-discount-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-cubes fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Discount Prodak </b>
		',	
		'size' => 'modal-lg',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-discount-content'></div>";
	Modal::end();

	/*
	 * BUTTON - Promo Prodak
	*/
	Modal::begin([
		'id' => 'databarang-button-row-promo-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-gift fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Promo Prodak</b>
		',	
		'size' => 'modal-lg',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-promo-content'></div>";
	Modal::end();

	/*
	 * BUTTON - Harga Prodak
	*/
	Modal::begin([
		'id' => 'databarang-button-row-harga-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-money fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Harga Prodak</b>
		',	
		'size' => 'modal-lg',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-harga-content'></div>";
	Modal::end();


	
	/*
	 * BUTTON - REVIEW Discount
	*/
	Modal::begin([
		'id' => 'databarang-button-row-view-discount-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> LIHAT PRODUK DISCOUNT</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-view-discount-content'></div>";
	Modal::end();
	
	/*
	 * BUTTON - EDIT Discount
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'databarang-button-row-edit-discount-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> UBAH PRODUK DISCOUNT</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
			//'toggleButton' => ['label' => 'click me'],
		],
		//'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-edit-discount-content'></div>";
	Modal::end();

	
	/*
	 * BUTTON - REVIEW Promo
	*/
	Modal::begin([
		'id' => 'databarang-button-row-view-promo-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> LIHAT PRODUK PROMO</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-view-promo-content'></div>";
	Modal::end();
	
	/*
	 * BUTTON - EDIT Promo
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'databarang-button-row-edit-promo-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> UBAH PRODUK PROMO</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
			//'toggleButton' => ['label' => 'click me'],
		],
		//'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-edit-promo-content'></div>";
	Modal::end();

	
	/*
	 * BUTTON - REVIEW Harga
	*/
	Modal::begin([
		'id' => 'databarang-button-row-view-harga-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> LIHAT PRODUK HARGA</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-view-harga-content'></div>";
	Modal::end();
	
	/*
	 * BUTTON - EDIT Harga
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'databarang-button-row-edit-harga-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> UBAH PRODUK HARGA</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
			//'toggleButton' => ['label' => 'click me'],
		],
		//'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-edit-harga-content'></div>";
	Modal::end();
	
	/*
	 * BUTTON - Stock
	*/
	Modal::begin([
		'id' => 'databarang-button-row-stock-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-money fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Stock Prodak</b>
		',	
		'size' => 'modal-md',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='databarang-button-row-stock-content'></div>";
	Modal::end();
	/*
	 * BUTTON - Stock
	*/
	Modal::begin([
		'id' => 'kasir-button-row-switch-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-mobile fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Switch UUID</b>
		',	
		'size' => 'modal-sm',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='kasir-button-row-switch-content'></div>";
	Modal::end();
	/*
	 * BUTTON - Stock
	*/
	Modal::begin([
		'id' => 'kasir-button-row-bayar-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-mobile fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> SETTING PEMBAYAYARAN PERANGKAT</b>
		',	
		'size' => 'modal-sm',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
		echo "<div id='kasir-button-row-bayar-content'></div>";
	Modal::end();

	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'paket-model',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:green"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> DAFTAR PAKET</b>
		',	
		'size' => 'modal-lg',
		'options' => ['class'=>'slide'],
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColor,
			//'toggleButton' => ['label' => 'click me'],
		],
		//'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
	
	echo "<div id='paket-conten'></div>";
	Modal::end();