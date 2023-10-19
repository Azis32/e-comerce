$(document).ready(function(){
	var jumpTo = window.location.hash;

	if(jumpTo) {
		var toLoad = jumpTo.replace('#','');
		$('.halaman').load('hal/' + toLoad + '.php');
	} else {
		$('.halaman').load('hal/utama.php');
	}
	console.log(window.location.hash);

	$('a.tombol').on('click', function(){
		var page = $(this).attr('href'),
			newPage = page.replace('#','');

		$('a.tombol').removeClass('active').blur();

		var status= $('.halaman').load('hal/' + newPage + '.php').fadeIn('slow');
		history.pushState('','',page);
		return false;
	});
	//$('.datatable-sms').DataTable();
	//$('#dt-mahasiswa').DataTable();
}).ajaxComplete(function(){
	$('a.tombol').on('click', function(){
		var page = $(this).attr('href'),
			newPage = page.replace('#','');

		$('a.tombol').removeClass('active').blur();

		var status= $('.halaman').load('hal/' + newPage + '.php').fadeIn('slow');
		history.pushState('','',page);
		return false;
	})
});
