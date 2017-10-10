/**
 * ===============================
 * JS Modal item
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ===============================
*/

/*
 * item- FHarga Create.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#item-formula-harga-button-create', function(ehead){ 			  
	$('#item-formula-harga-modal-create').modal('show')
	.find('#item-formula-harga-modal-content-create').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

/*
 * item- FDiscount Create.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#item-formula-discount-button-create', function(ehead){ 			  
	$('#item-formula-discount-modal-create').modal('show')
	.find('#item-formula-discount-modal-content-create').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

/**
 * ======================================== TIPS ========================================
 * HELPER INCLUDE FILE
 * include 	: index.php [MODAL JS AND CONTENT].
 * File		: modal_item.js And modal_item.php
 * Version	: 2.1
*/
/* 
	$this->registerJs($this->render('modal_item.js'),View::POS_READY);
	echo $this->render('modal_item');
*/

/**
 * HELPER BUTTON 
 * Action 	: Button
 * include	: View
 * Version	: 2.1
*/
/* 
	return  Html::button(Yii::t('app', 
		'<span class="fa-stack fa-xs">																	
			<i class="fa fa-circle fa-stack-2x " style="color:#f08f2e"></i>
			<i class="fa fa-cart-arrow-down fa-stack-1x" style="color:#fbfbfb"></i>
		</span> View Customers'
	),
	['value'=>url::to(['/marketing/sales-promo/view','id'=>$model->ID]),
	'id'=>'item-button-view',
	'class'=>"btn btn-default btn-xs ",      
	'style'=>['text-align'=>'left','width'=>'170px', 'height'=>'25px','border'=> 'none'],
	]); 
*/

/*=========================================================================================*/