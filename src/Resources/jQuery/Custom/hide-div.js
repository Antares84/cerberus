/*
	Used to hide divs when not logged in.
	More divs can be added to the list if needed
*/

/* Hide Sidebar */
if($('#auth').length){
	$('#sidebar-left-wrapper').hide();
}
if($('#auth-reg').length){
	$('#sidebar-left-wrapper').hide();
}
if($('.profile').length){
	$('#sidebar-left-wrapper').hide();
	var profile = document.querySelector(".profile");
		profile.style.width = "1215px";

	var content_wrapper = document.querySelector("#content-wrapper");
		content_wrapper.style.margin = "0 55px 15px 5px";
//	profile.style.backgroundColor = "#D93600";
//	document.getElementsByTagName("STYLE");
//	document.getElementById("content");
//	profile.style.width = "1280px";
}
if($('.hide').length){
	$('.side').hide();
}