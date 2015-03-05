
$('div.activate .pure-button').on('click', function (event) {
	if (!$(this).hasClass('pure-button-active')) {
		$(this).parent().find('.pure-button-active').removeClass('pure-button-active');
		$(this).addClass('pure-button-active');
	}
});
