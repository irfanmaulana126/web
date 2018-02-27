/**
 * ===============================
 * JS Modal Import
 * Author	: ptr.nov2gmail.com
 * Update	: 05/09/2017
 * Version	: 2.1
 * ===============================
*/


$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#jurnal-button-akun', function(ehead){ 			  
	$('#jurnal-button-akun-modal').modal('show')	
	.find('#jurnal-button-akun-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/*
 * BUTTON UPLOAD FORMAT.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#jurnal-button-group', function(ehead){ 			  
	$('#jurnal-button-group-modal').modal('show')
	.find('#jurnal-button-group-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/**
 * create button
 */
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#jurnal-tambah-button-create', function(ehead){ 			  
	$('#create-jurnal-tambah-button-modal').modal('show')
	.find('#create-jurnal-tambah-button-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/*
 * BUTTON update
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#jurnal-tambah-button-edit', function(ehead){ 			  
	$('#edit-jurnal-tambah-button-modal').modal('show')
	.find('#edit-jurnal-tambah-button-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/*
 * jurnal tambah View.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#jurnal-tambah-button-view', function(ehead){ 			  
	$('#view-jurnal-tambah-button-modal').modal('show')
	.find('#view-jurnal-tambah-button-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});