$(document).ready(function(){
	if($('nav#main').hasClass('nav--sub')){
		$('nav#main.nav--sub').addClass('fixed-top');
		$('nav#main.nav--main').addClass('nav_fixed_m_39');
		$('nav#main').parent().find('.page-wrapper').css({
			'margin-top'	:	'90px'
		});
	}
	else if($('nav#main').hasClass('nav--main')){
		$('nav#main.nav--main').addClass('fixed-top');
		$('nav#main').parent().find('.page-wrapper').css({
			'margin-top'	:	'40px'
		});
		
	};

	if($('#auth').hasClass("cms_login")){
		$('.cms_login').addClass("border border_concave content_bg mx-auto");
		$('.cms_login').css({
			"width":"50%"
		});
	};

	if($('#adm-auth').hasClass("container-fluid")){
		$('#adm-auth.container-fluid').addClass("border badge-success b_i f_20 mx-auto tac");
	};

/*
	$("#content.container").css({
		"display": "none"
	});
	$( "#content.container" ).addClass("no_padding");

	/*	$("#content-wrapper").css({
		"float": "left",
		"position": "relative",
		"width": "1210px",
		"margin": "0 55px 10px 10px"
	});
*/
});