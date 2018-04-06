/**
 * ===============================
 * JS Modal store
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ===============================
*/
$(function(){
	$('.btn-circle').on('click',function(){
	  $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
	  $(this).addClass('btn-info').removeClass('btn-default').blur();
	});
});

/*
 * BUTTON HISTORI
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};
//$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
$(document).on('click','#userprofile-button-row-bank', function(ehead){ 			  
	$('#userprofile-button-row-bank-modal').modal('show')
	.find('#userprofile-button-row-bank-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	//.load(ehead.target.value);
	.load($(this).attr('value'));
});
/*
 * BUTTON SEARCH PERIODE
*/
// $.fn.modal.Constructor.prototype.enforceFocus = function(){};
// //$.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';	
// $(document).on('click','#edit', function(ehead){ 			  
// 	$('#edit-modal').modal('show')
// 	.find('#edit-content').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
// 	//.load(ehead.target.value);
// 	.load($(this).attr('value'));
// });
// $('#edit-modal').on('hidden.bs.modal', function (e) {
// 	// reload page when modal closed
// 	location.reload(true);
// 	});
// function localStorageAvailable() {
// 	if (typeof(Storage) !== "undefined") {
// 			return true;
// 	}
// 	else {
// 			return false;
// 	}
// }
// if (!localStorage.hideAlert) {
//   $(function() {
//     $("#dialog").alert();
//   });
// } else {
//   $("#dialog").css("display", "none");
// }
// $(".yes").on("click", function() {
//   $("#dialog").alert("close");
// });
// $(".no").on("click", function() {
//   $("#dialog").alert("close");
//   localStorage.setItem('hideAlert', true);
// });