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
	
	#presensi-button-jam-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#karyawan-button-row-edit-periode-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#karyawan-button-row-edit-potongan-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");

	$modalHeaderColor='#fbfbfb';//' rgba(74, 206, 231, 1)';

	/*
	 * BUTTON - Search
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'presensi-button-jam-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:red"></i>
				<i class="fa fa-pencil fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> EDIT JAM SHIFT </b>
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
		echo "<div id='presensi-button-jam-content'></div>";
	Modal::end();
	/*
	 * BUTTON - Search
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'karyawan-button-row-edit-periode-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:red"></i>
				<i class="fa fa-pencil fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> EDIT PERIODE </b>
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
		echo "<div id='karyawan-button-row-edit-periode-content'></div>";
	Modal::end();
	/*
	 * BUTTON - Search
	*/
	Modal::begin([
		//'id' => 'sync_save',
		'id' => 'karyawan-button-row-edit-potongan-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:red"></i>
				<i class="fa fa-pencil fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> EDIT POTONGAN </b>
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
		echo "<div id='karyawan-button-row-edit-potongan-content'></div>";
	Modal::end();
?>