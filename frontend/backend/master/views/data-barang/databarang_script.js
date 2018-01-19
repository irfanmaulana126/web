<<<<<<< HEAD
/**
 * ===============================
 * JS Modal Import
 * Author	: ptr.nov2gmail.com
 * Update	: 05/09/2017
 * Version	: 2.1
 * ===============================
*/

/*
 * BUTTON SEARCH PERIODE
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button', function(ehead){ 			  
	$('#databarang-button-modal').modal('show')
	.find('#databarang-button-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
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
=======
/**
 * ===============================
 * JS Modal Import
 * Author	: ptr.nov2gmail.com
 * Update	: 05/09/2017
 * Version	: 2.1
 * ===============================
*/

/*
 * BUTTON SEARCH PERIODE
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#databarang-button', function(ehead){ 			  
	$('#databarang-button-modal').modal('show')
	.find('#databarang-button-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
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
>>>>>>> 03b7298828a56a329b4bbb8516315fe6d61c91ca
});