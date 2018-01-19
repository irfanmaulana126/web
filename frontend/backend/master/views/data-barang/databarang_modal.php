<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\base\DynamicModel;

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
	
	#databarang-button-row-discount-modal .modal-header {
		background: linear-gradient(to bottom right, red, yellow);
	}
	#databarang-button-row-promo-modal .modal-header {
		background: linear-gradient(to bottom right, red, yellow);
	}
	#databarang-button-row-harga-modal .modal-header {
		background: linear-gradient(to bottom right, red, yellow);
	}
");

/**
 * ===============================
 * MODAL 
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ==============================
*/
	$modalHeaderColor='#fbfbfb';//' rgba(74, 206, 231, 1)';
	
	/*
	 * BUTTON - FORM CREATE
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'databarang-button-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:red"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> TAMBAH BARANG</b>
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
		echo "<div id='databarang-button-content'></div>";
	Modal::end();
	
	/*
	 * BUTTON - REVIEW KARYAWAN
	*/
	Modal::begin([
		'id' => 'databarang-button-row-view-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:red"></i>
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
				<i class="fa fa-circle fa-stack-2x " style="color:red"></i>
				<i class="fa fa-search fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> UBAH DATA BARANG</b>
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
		echo "<div id='databarang-button-row-harga-content'></div>";
	Modal::end();
?>