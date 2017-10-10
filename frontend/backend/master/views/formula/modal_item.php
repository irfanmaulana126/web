<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/**
* ===============================
 * Button Permission.
 * Modul ID	: 12
 * Author	: ptr.nov2gmail.com
 * Update	: 01/02/2017
 * Version	: 2.1
 * ===============================
*/
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
		button span {
		  pointer-events: none;  //Disable Span in Button.
		}
	");
	
	/*
	 * Backgroun Icon Color.
	*/
	function bgIconColor(){
		return '#f08f2e';//kuning.
		//return '#1eaac2';//biru Laut.
	}
	
	//Link Button BACK
	function tombolBack(){
		$title = Yii::t('app', 'Back');
		$url =  Url::toRoute(['/master/item','outlet_code'=>'0001']);
		$options = ['id'=>'item-formula-harga-back',
				  'data-pjax' => 0,
				  'class'=>"btn btn-default btn-xs",
				 // 'style'=>'margin-left:50px'
				];
		$icon = '
				<span class="fa-stack fa-sm text-left">
				  <i class="fa fa-circle fa-stack-2x" style="color:#ffffff"></i>
				  <i class="fa fa-history fa-stack-1x style="color:#ffffff"></i>
				</span>
		
		';
		$label = $icon . ' ' . $title;

		return $content = Html::a($label,$url,$options);
	}
	
	/*
	 * Button - FHarga CREATE.
	*/
	function tombolCreateHarga(){
		// if(getPermission()){
			// if(getPermission()->BTN_CREATE==1){
				//$title1 = Yii::t('app', ' New');
				$url = Url::toRoute(['/master/formula/create-harga']);
				$options1 = ['value'=>$url,
							'id'=>'item-formula-harga-button-create',
							'class'=>"btn btn-default btn-xs"  
				];
				$icon1 = '
						<span class="fa-stack fa-sm text-justify">
						  <i class="fa fa-circle fa-stack-2x" style="color:#ffffff"></i>
						  <i class="fa fa-plus fa-stack-1x style="color:red"></i>
						</span>			
				';
				$label1 = $icon1 . ' ' ;//. $title1;
				$content = Html::button($label1,$options1);
				return $content;
			// }
		// }
	}
	
	/*
	 * Button - FDiscount CREATE.
	*/
	function tombolCreateDiscount(){
		// if(getPermission()){
			// if(getPermission()->BTN_CREATE==1){
				//$title1 = Yii::t('app', ' New');
				$url = Url::toRoute(['/master/formula/create-discount']);
				$options1 = ['value'=>$url,
							'id'=>'item-formula-discount-button-create',
							'class'=>"btn btn-default btn-xs"  
				];
				$icon1 = '
						<span class="fa-stack fa-sm text-justify">
						  <i class="fa fa-circle fa-stack-2x" style="color:#ffffff"></i>
						  <i class="fa fa-plus fa-stack-1x style="color:red"></i>
						</span>			
				';
				$label1 = $icon1 . ' ' ;//. $title1;
				$content = Html::button($label1,$options1);
				return $content;
			// }
		// }
	}
		
/**
* ===============================
 * Button & Link Modal item
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ===============================
*/
	/*
	 * Item FHarga - CREATE.
	*/
	$modalHeaderColorHarga='rgba(80, 150, 241, 1)';//' rgba(74, 206, 231, 1)';
	Modal::begin([
		'id' => 'item-formula-harga-modal-create',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:'.bgIconColor().'"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Add Items Harga </b>
		',		
		'size' =>'modal-dm',
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColorHarga,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
	echo "<div id='item-formula-harga-modal-content-create'></div>";
	Modal::end();
	
	/*
	 * Item FDiscount - CREATE.
	*/
	$modalHeaderColorDiscount='rgba(133, 240, 51, 1)';//' rgba(74, 206, 231, 1)';
	Modal::begin([
		'id' => 'item-formula-discount-modal-create',
		'header' => '
			<span class="fa-stack fa-xs">																	
				<i class="fa fa-circle fa-stack-2x " style="color:'.bgIconColor().'"></i>
				<i class="fa fa-plus fa-stack-1x" style="color:#fbfbfb"></i>
			</span><b> Add Discount Formula </b>
		',		
		'size' =>'modal-dm',
		'headerOptions'=>[
			'style'=> 'border-radius:5px; background-color:'.$modalHeaderColorDiscount,
		],
		'clientOptions' => [
			'backdrop' => FALSE, //Static=disable, false=enable
			'keyboard' => TRUE,	// Kyboard 
		]
	]);
	echo "<div id='item-formula-discount-modal-content-create'></div>";
	Modal::end();
?>