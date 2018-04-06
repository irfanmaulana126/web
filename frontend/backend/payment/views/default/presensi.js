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
function localStorageAvailable() {
	if (typeof(Storage) !== "undefined") {
			return true;
	}
	else {
			return false;
	}
}
if (!localStorage.hideAlert) {
  $(function() {
    $("#dialog").alert();
  });
} else {
  $("#dialog").css("display", "none");
}
$(".yes").on("click", function() {
  $("#dialog").alert("close");
});
$(".no").on("click", function() {
  $("#dialog").alert("close");
  localStorage.setItem('hideAlert', true);
});