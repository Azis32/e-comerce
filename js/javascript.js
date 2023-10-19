//+function($){
$(document).ready(function(){
	/*var menu_utama = $('#content-page'),
		mu_atas = menu_utama.offset().top;

	$(window).on('scroll', function(){
		var win_atas = $(this).scrollTop();

		if(win_atas >= mu_atas) {
			menu_utama.removeClass('navbar-static-top').addClass('navbar-fixed-top');
		} else {
			menu_utama.removeClass('navbar-fixed-top').addClass('navbar-static-top');
		}		
	});*/
	$('.datatable-sms').DataTable();
	$('#dt-mahasiswa').DataTable();
});
//}(jQuery);