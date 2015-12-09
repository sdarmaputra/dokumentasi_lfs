function switchElement(to_hide, to_show) {
	$('#'+to_hide).hide();
	$('#'+to_show).show();
}

function navigateDashboard(to_hide_menu, to_hide, to_show_menu, to_show) {
	switchElement(to_hide, to_show);
	$('#'+to_hide_menu).removeClass('active');
	$('#'+to_show_menu).addClass('active');
}