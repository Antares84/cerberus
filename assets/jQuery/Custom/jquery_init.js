$(document).ready(function(e){
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
	// Tabs
	$("#tabs_profile").tabs();
	$("#tabs_nav").tabs();
	$("#tabs").tabs();
	$("#tabs2").tabs();
	// jQuery Datepicker
	$(".jQuery-Date").datepicker({
		changeMonth:true,
		changeYear:true,
		yearRange: "1940:2012"
	});
	// AP Sidenav Show/hide
	$('#sidebarCollapse').on('click',function(){
		$('#sidebar').toggleClass('active');
		$(this).toggleClass('active');
	});
});

// Prevent Enter Key Usage On Forms
$('form input').keydown(function(e){
	if(e.keyCode==13){
		var inputs=$(this).parents("form").eq(0).find(":input");

		if(inputs[inputs.index(this)+1]!=null){
			inputs[inputs.index(this)+1].focus();
		}
		e.preventDefault();
		return false;
	}
});