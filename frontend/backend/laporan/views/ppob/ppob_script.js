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
$(document).on('click','#ppob-export-excel', function(ehead){ 			  
	$('#ppob-export-excel-modal').modal('show')
	.find('#ppob-export-excel-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/*
 * BUTTON SEARCH PERIODE
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#ppob-store', function(ehead){ 			  
	$('#ppob-store-modal').modal('show')
	.find('#ppob-store-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
