$(document).ready(function(){
	// Msg Array Reload
	$(".msg_container").load(location.href + " .msg_data");
	// WOW
//	new WOW().init();
	// Dropdowns
	$('.dropdown-toggle').dropdown();
	// Tooltips
	$('[data-toggle="tooltip"]').tooltip(); 
	// Pre-loader
	setTimeout(function(){
		$('body').addClass('loaded');
	}, 3000);
});

// Tabs
$("#tabs_profile").tabs();
$("#tabs_nav").tabs();
$(function(){
	$("#tabs").tabs();
});
$(function(){
	$("#tabs2").tabs();
});
$(function(){
	$("#tabs2-h").tabs();
});
$(function(){
	$("#tabs2-e").tabs();
});
$(function(){
	$("#tabs2-n").tabs();
});
$(function(){
	$("#tabs2-v").tabs();
});