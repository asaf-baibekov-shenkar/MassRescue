window.initMap = () => {
	let mapElement = document.getElementById("map");

	let first_force = forces[0] || { latitude: event.latitude, longitude: event.longitude }
	window.map = new google.maps.Map(mapElement, {
		center: {
			lat: parseFloat(first_force.latitude),
			lng: parseFloat(first_force.longitude)
		},
		zoom: forces[0] == null ? 11 : 14,
	});
	window.mainMapMarkers = forces.map(force => {
		return new google.maps.Marker({
			position: {
				lat: parseFloat(force.latitude),
				lng: parseFloat(force.longitude)
			},
			map: window.map,
		});
	});

	let mapFormElement = document.getElementById("map_form");
	window.map_form = new google.maps.Map(mapFormElement, {
		center: {
			lat: parseFloat(event.latitude),
			lng: parseFloat(event.longitude)
		},
		zoom: 14
	});

	window.formMapMarkers = [];
	window.map_form.addListener("click", (mapsMouseEvent) => {
		window.formMapMarkers.map(marker => { marker.setMap(null) });
		window.formMapMarkers = [];
		let clickedLocation = mapsMouseEvent.latLng.toJSON();
		window.formMapMarkers.push( new google.maps.Marker({ map: map_form, position: clickedLocation }) );
		document.getElementById("InputAddress").value = `${clickedLocation.lat.toFixed(5)}, ${clickedLocation.lng.toFixed(5)}`;
	});

	let mapFormAutocompleteElement = document.getElementById("InputAddress");
	window.searchBox = new google.maps.places.SearchBox(mapFormAutocompleteElement);
	window.searchBox.addListener("places_changed", () => {
		const places = window.searchBox.getPlaces();
		if (places.length == 0) return;
		window.formMapMarkers.forEach((marker) => { marker.setMap(null); });
		window.formMapMarkers = [];
		const bounds = new google.maps.LatLngBounds();
		places.forEach((place) => {
			if (!place.geometry || !place.geometry.location) {
				console.log("Returned place contains no geometry");
				return;
			}
			window.formMapMarkers.push( new google.maps.Marker({ map: map_form, title: place.name, position: place.geometry.location }) );
			if (place.geometry.viewport)
				bounds.union(place.geometry.viewport);
			else
				bounds.extend(place.geometry.location);
		});
		map_form.fitBounds(bounds);
	});
};

$(function() {
	$('#filter .btn').click(function(e) {
		let type = $(this).attr("id").substring(4);
		let latitude = event.latitude
		let longitude = event.longitude
		showModal(event.event_id, type, latitude, longitude)
	});
	$('.cell').hover(function () {
		let index = $(this).attr('index');
		let force = forces.filter(force => force.force_id == index)[0]
		if (typeof google === 'object' && typeof google.maps === 'object')
			window.map.panTo({ lat: parseFloat(force.latitude), lng: parseFloat(force.longitude) });
	}, function () { });
	$('#form-create-force').submit(function(e) {
		e.preventDefault();
		if (window.formMapMarkers.length > 0) {
			let marker = window.formMapMarkers[0]
			$(`input[name="latitude"]`).val(marker.position.lat);
			$(`input[name="longitude"]`).val(marker.position.lng);
		}
		console.log($("#form-create-force").serializeArray());
		$.ajax({
			type: "POST",
			url: window.location.href.split('?')[0] + '/create',
			data: $("#form-create-force").serializeArray(),
			success: function (data) {
				location.reload()
			},
			error: function (data) {
				alert("error");
			}
		});
	})
});

function showModal(event_id, type, latitude, longitude) {
	$('#event-modal').on('show.bs.modal', () => {
		$('#event-modal-title').html(`Add ${type.charAt(0).toUpperCase() + type.slice(1)}`);
		$(`input[name="event_id"]`).val(event_id);
		$(`input[name="type"]`).val(type);
		$('#InputEventName').val('');
		$('#InputDescription').val('');
		$('#create_btn').html("Submit");
		if (typeof google === 'object' && typeof google.maps === 'object') {
			window.formMapMarkers.forEach(marker => { marker.setMap(null); });
			window.map_form.setZoom(12)
			window.map_form.setCenter({ lat: parseFloat(latitude), lng: parseFloat(longitude) });
		}
	})
	$('#event-modal').modal('show');
}