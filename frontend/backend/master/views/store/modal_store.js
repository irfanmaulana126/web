/**
 * ===============================
 * JS Modal store
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ===============================
*/

/*
 * BUTTON CREATE
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#store-button-create', function(ehead){ 			  
	$('#store-button-create-modal').modal('show')
	.find('#store-button-create-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/*
 * BUTTON update
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#store-button-edit', function(ehead){ 			  
	$('#store-button-edit-modal').modal('show')
	.find('#store-button-edit-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/*
 * deepdrop
*/
$('#provinsi').change(function() { 
	change();
 });
 function change()
 {
	 var selectValue=$('#provinsi').val();
	 $('#kota').empty();
	 $.post('/master/store/kota?prov='+selectValue,
		function(data){
			$('select#kota').html(data);
		});

 };
/*
 * store-View.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#store-button-view', function(ehead){ 			  
	$('#store-modal-view').modal('show')
	.find('#store-modal-content-view').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * store-REview.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#store-button-review', function(ehead){ 			  
	$('#store-modal-review').modal('show')
	.find('#store-modal-content-review').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

/*
 * store-Export-Excel.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#store-button-export-excel', function(ehead){ 			  
	$('#store-modal-export-excel').modal('show')
	.find('#store-modal-content-export-excel').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#store-button-restore', function(ehead){ 			  
	$('#store-button-restore-modal').modal('show')
	.find('#store-button-restore-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});


/*
 * BUTTON VIEW KARYAWAN
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-view', function(ehead){ 			  
	$('#databarang-button-row-view-modal').modal('show')
	.find('#databarang-button-row-view-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * BUTTON EDIT KARYAWAN
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-edit', function(ehead){ 			  
	$('#databarang-button-row-edit-modal').modal('show')
	.find('#databarang-button-row-edit-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * BUTTON Discount KARYAWAN
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-discount', function(ehead){ 			  
	$('#databarang-button-row-discount-modal').modal('show')
	.find('#databarang-button-row-discount-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * BUTTON Harga KARYAWAN
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-harga', function(ehead){ 			  
	$('#databarang-button-row-harga-modal').modal('show')
	.find('#databarang-button-row-harga-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * BUTTON Promo KARYAWAN
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-promo', function(ehead){ 			  
	$('#databarang-button-row-promo-modal').modal('show')
	.find('#databarang-button-row-promo-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});


/*
 * BUTTON VIEW Discount
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-view-discount', function(ehead){ 			  
	$('#databarang-button-row-view-discount-modal').modal('show')
	.find('#databarang-button-row-view-discount-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * BUTTON EDIT Discount
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-edit-discount', function(ehead){ 			  
	$('#databarang-button-row-edit-discount-modal').modal('show')
	.find('#databarang-button-row-edit-discount-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});


/*
 * BUTTON VIEW Harga
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-view-harga', function(ehead){ 			  
	$('#databarang-button-row-view-harga-modal').modal('show')
	.find('#databarang-button-row-view-harga-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * BUTTON VIEW Harga
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-view-promo', function(ehead){ 			  
	$('#databarang-button-row-view-promo-modal').modal('show')
	.find('#databarang-button-row-view-promo-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * BUTTON EDIT Harga
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-edit-harga', function(ehead){ 			  
	$('#databarang-button-row-edit-harga-modal').modal('show')
	.find('#databarang-button-row-edit-harga-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * BUTTON EDIT Promo
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button-row-edit-promo', function(ehead){ 			  
	$('#databarang-button-row-edit-promo-modal').modal('show')
	.find('#databarang-button-row-edit-promo-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/**
 * ======================================== TIPS ========================================
 * HELPER INCLUDE FILE
 * include 	: index.php [MODAL JS AND CONTENT].
 * File		: modal_store.js And modal_store.php
 * Version	: 2.1
*/
/* 
	$this->registerJs($this->render('modal_store.js'),View::POS_READY);
	echo $this->render('modal_store');
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
	'id'=>'store-button-view',
	'class'=>"btn btn-default btn-xs ",      
	'style'=>['text-align'=>'left','width'=>'170px', 'height'=>'25px','border'=> 'none'],
	]); 
*/

/*=========================================================================================*/