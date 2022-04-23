$(function() {
	$('input[name="daterange"]')
		.daterangepicker({
			opens: 'center',
			locale: {
				format: 'DD/MM/YYYY'
			}
		});

	$('#btn_create').click(event => {
		$('#btn_edit, #btn_close').toggleClass('active', false).change();
	});

	$('#btn_edit').click(event => {
		$('#btn_close').toggleClass('active', false);
		$('#btn_edit').toggleClass('active');
		$('#btn_edit, #btn_close').change();
	}).change(() => {
		if ($('#btn_edit').hasClass('active')) $('.btn_edit').addClass("d-flex").removeClass("d-none");
		else $('.btn_edit').addClass("d-none").removeClass("d-flex");
	});

	$('#btn_close').click(event => {
		$('#btn_edit').toggleClass('active', false);
		$('#btn_close').toggleClass('active');
		$('#btn_edit, #btn_close').change();
	}).change(() => {
		if ($('#btn_close').hasClass('active')) $('.btn_close').addClass("d-flex").removeClass("d-none");
		else $('.btn_close').addClass("d-none").removeClass("d-flex");
	});
});

window.initMap = () => {
	let AzrieliLocation = { lat: 32.07458646100024, lng: 34.79189151265392 }
	let map = new google.maps.Map(document.getElementById("map"), {
		center: AzrieliLocation,
		zoom: 16,
	});
	const marker = new google.maps.Marker({
		position: AzrieliLocation,
		map: map,
	});
};