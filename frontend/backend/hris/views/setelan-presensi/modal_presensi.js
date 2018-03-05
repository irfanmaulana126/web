/**
 * ===============================
 * JS Modal store
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ===============================
*/

/*
 * BUTTON edit
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#presensi-button-jam', function(ehead){ 			  
	$('#presensi-button-jam-modal').modal('show')
	.find('#presensi-button-jam-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/*
 * BUTTON edit
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#karyawan-button-row-edit-periode', function(ehead){ 			  
	$('#karyawan-button-row-edit-periode-modal').modal('show')
	.find('#karyawan-button-row-edit-periode-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/*
 * BUTTON edit
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#karyawan-button-row-edit-potongan', function(ehead){ 			  
	$('#karyawan-button-row-edit-potongan-modal').modal('show')
	.find('#karyawan-button-row-edit-potongan-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});