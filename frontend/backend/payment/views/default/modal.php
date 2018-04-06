<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
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
	#userprofile-button-row-bank-modal .modal-header {
		background: linear-gradient( 135deg, #2AFADF 10%, #4C83FF 100%);
	}
");
$modalHeaderColor='#fbfbfb';
Modal::begin([
    'id' => 'userprofile-button-row-bank-modal',
    'header' => '
        <span class="fa-stack fa-xs">																	
            <i class="fa fa-circle fa-stack-2x " style="color:green"></i>
            <i class="fa fa-credit-card fa-stack-1x" style="color:#fbfbfb"></i>
        </span><b> ACCOUNT BANK</b>
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
    echo "<div id='userprofile-button-row-bank-content'></div>";
Modal::end();
?>