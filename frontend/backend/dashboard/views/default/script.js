/**
 * ===============================
 * JS Modal Import
 * Author	: ptr.nov2gmail.com
 * Update	: 05/09/2017
 * Version	: 2.1
 * ===============================
*/

/*
 * Modal Traffic
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#detail-trafik-modal-button', function(ehead){ 			  
	$('#detail-trafik-modal').modal('show')
	.find('#detail-trafik-modal-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * Modal Sales Bulanan
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#detail-salesbulanan-modal-button', function(ehead){ 			  
	$('#detail-salesbulanan-modal').modal('show')
	.find('#detail-salesbulanan-modal-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});

/*
 * Modal Sales Mingguan
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#detail-salesmingguan-modal-button', function(ehead){ 			  
	$('#detail-salesmingguan-modal').modal('show')
	.find('#detail-salesmingguan-modal-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
