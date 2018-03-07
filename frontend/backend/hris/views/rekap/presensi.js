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

	
	$('.next-step, .prev-step').on('click', function (e){
		var $activeTab = $('.tab-pane.active');
		
		
	if ( $(e.target).hasClass('next-step') )
	{
		var nextTab = $activeTab.next('.tab-pane').attr('id');
		$('[href="#'+ nextTab +'"]').addClass('btn-info').removeClass('btn-default');
		$('[href="#'+ nextTab +'"]').tab('show');
	}
	else
	{
		var prevTab = $activeTab.prev('.tab-pane').attr('id');
		 $('[href="#'+ prevTab +'"]').addClass('btn-info').removeClass('btn-default');
		 $('[href="#'+ prevTab +'"]').tab('show');
	  }
	});
   });