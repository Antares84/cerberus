function importJs_Head(url){
	var head	=	document.getElementsByTagName('head')[0];
	var script	=	document.createElement('script');
	script.type	=	'text/javascript';
	script.src	=	'src/resources/jquery/custom/'+url;

	head.appendChild(script);
}

importJs_Head('Ajax.js');
importJs_Head('Datepicker.js');
importJs_Head('Dropdowns.js');
importJs_Head('Journal.js');
importJs_Head('Messages.js');
importJs_Head('Preloader.js');
importJs_Head('Tabs.js');
importJs_Head('Tooltips.js');
//importJs_Head('Wow.js');

/*
$(document).ready(function(e){
	// AP Sidenav Show/hide
	$('#sidebarCollapse').on('click',function(){
		$('#sidebar').toggleClass('active');
		$(this).toggleClass('active');
	});

	// Toggle the side navigation
	$("#sidebarToggle").on('click',function(e) {
		e.preventDefault();
		$("body").toggleClass("sidebar-toggled");
		$(".sidebar").toggleClass("toggled");
	});
});
*/