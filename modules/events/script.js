$(function() {
	$('input[name="daterange"]')
		.daterangepicker({
			opens: 'center',
			locale: {
				format: 'DD/MM/YYYY'
			}
		});
});

function initMap() {
	let AzrieliLocation = { lat: 32.07458646100024, lng: 34.79189151265392 }
	let map = new google.maps.Map(document.getElementById("map"), {
		center: AzrieliLocation,
		zoom: 16,
	});
	const marker = new google.maps.Marker({
		position: AzrieliLocation,
		map: map,
	});
}

window.initMap = initMap;