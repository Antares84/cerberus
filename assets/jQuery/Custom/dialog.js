//	Modal Message Windows
$(document).ready(function( e ) {
	$( "#dialog-confirm" ).dialog({
		resizable: false,
//		height: 500,
//		width: 500,
		modal: false,
		buttons: {
			"Close": function( e ) {
				$( this ).dialog( "close" );
			}
		}
	});
});
//$(document).ready(function(e){
//	$(".login_panel").dialog({
//		appendTo: ".modal_container",
//		autoOpen: false,
//		closeOnEscape: false,
//		draggable: false,
//		dialogClass: "no-close",
//		resizable: false,
//		height: 260,
//		width: 500,
//		modal: true
//	});
//});
$(".trigger").click(function() {
	$(".content").hide();
	$(".sidebar").hide();
	$(".login_panel").dialog("open");
});