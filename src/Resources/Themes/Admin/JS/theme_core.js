$(document).ready(function(){
	$('.tooltip-inner').css({
		'white-space'	:	'pre-wrap'
	});
	$('[data-original-title]').css({
		'white-space'	:	'pre-wrap'
	});

	if($('#adm-auth').hasClass("container-fluid")){
		$('#adm-auth.container-fluid').addClass("border badge-success b_i f_20 mx-auto tac");
	};

});
/*
$(document).ready(function(){
	$("body").attr('id','page-top');
	$("img.ap-error").addClass(" mx-auto d-block");
	$("img.ap-error").addClass(" mx-auto d-block");
	$("img.ap-error").css({
		"border-top"	:	"2px solid #0094ff",
		"border-right"	:	"1px solid #0094ff",
		"border-bottom"	:	"2px solid #0094ff",
		"border-left"	:	"1px solid #0094ff"
	});

//	$("#content-wrapper").css({
//		"float": "left",
//		"position": "relative",
//		"width": "1210px",
//		"margin": "0 55px 10px 10px"
//	});
});
*/