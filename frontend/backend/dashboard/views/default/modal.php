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
	
	#stockmasuk-button-periode-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#stockmasuk-button-card-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#stockopname-button-upload-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#stok-card-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
	#stockmasuk-button-export-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
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
	$modalHeaderColor='rgba(74, 206, 231, 1)';
	
	Modal::begin([
		'id' => 'detail-salesbulanan-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:black"></i>
				<i class="fa fa-bar-chart fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> SALES BULANAN </b>
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
		echo "<div id='detail-salesbulanan-modal-content'></div>";
	Modal::end();
	
	Modal::begin([
		'id' => 'detail-trafik-modal',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:black"></i>
				<i class="fa fa-bar-chart fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> TRAFFIC TRANSACTION </b>
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
		echo "<div id='detail-trafik-modal-content'></div>";
	Modal::end();
?>