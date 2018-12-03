// jQuery Functions For Ticket System
(function ($) {
	$('.openable').on("click", function (event) {
		event.preventDefault();
		$(this).parent().next().slideDown();
		$(this).parent().find('a:first').addClass("opened");
		$(this).addClass('closable').removeClass('openable');
	});
	$('.closable').on("click", function (event) {
		event.preventDefault();
		$(this).parent().next().slideUp();
		$(this).parent().find('a:first').removeClass("opened");
		$(this).addClass('openable').removeClass('closable');
	});
	$('.state').on("change", function (event) {
		event.preventDefault();
		$(this).parent().submit();
	});
})(jQuery);