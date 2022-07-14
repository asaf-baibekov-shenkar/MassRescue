window.initMap = () => {
	let first_force = forces[0] || { latitude: event.latitude, longitude: event.longitude }
	
	let mapElement = document.getElementById("map");
	window.map = new google.maps.Map(mapElement, {
		center: {
			lat: parseFloat(first_force.latitude),
			lng: parseFloat(first_force.longitude)
		},
		zoom: forces[0] == null ? 11 : 15,
		mapTypeId: google.maps.MapTypeId.HYBRID
	});
	window.mainMapMarkers = [];

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

	presentForces($('#list'), crudEnum.read, window.event, window.forces, window.map);
};

$(document).on('DOMNodeInserted', '.cell', function () {

	$(this).hover(function () {
		let index = $(this).attr('index');
		let force = window.forces.filter(force => force.force_id == index)[0]
		if (typeof google === 'object' && typeof google.maps === 'object')
			window.map.panTo({ lat: parseFloat(force.latitude), lng: parseFloat(force.longitude) });
	}, function () { });

	$('.btn_edit').click(function(e) { 
		e.stopPropagation();
		let index = $(this).parent().parent().attr('index');
		let force = forces.filter(force => force.force_id == index)[0]
		let forceName = force.title;
		let forceDescription = force.subtitle;
		let forceType = force.type;
		let latitude = force.latitude
		let longitude = force.longitude
		showModal(window.event.event_id, force.force_id, forceType, forceName, forceDescription, latitude, longitude);
	});

	$('.btn_close').click(function(event) { 
		event.stopPropagation();
		let index = $(this).parent().parent().attr('index');
		let formData = new FormData();
		formData.append('event_id', window.event.event_id);
		formData.append('force_id', index);
		showSpinner();
		fetch(window.location.href.split('?')[0] + '/removeForce', { method: 'POST', body: formData })
			.then(() => fetchForces(crudEnum.delete))
			.catch(error => console.log("error: ", error))
			.finally(() => { hideSpinner() })
	});
});

$(function() {
	$('#filter .btn').click(function(e) {
		let type = $(this).attr("id").substring(4);
		let latitude = event.latitude
		let longitude = event.longitude
		showModal(window.event.event_id, -1, type, latitude, longitude)
	});
	$('#form-create-force').submit(function(e) {
		e.preventDefault();
		let index = parseInt($(this).parent().attr('index'));
		if (window.formMapMarkers.length > 0) {
			let marker = window.formMapMarkers[0]
			$(`input[name="latitude"]`).val(marker.position.lat());
			$(`input[name="longitude"]`).val(marker.position.lng());
		}
		console.log($("#form-create-force").serializeArray());
		const data = formToFormData(document.getElementById('form-create-force'));
		showSpinner();
		fetch(window.location.href.split('?')[0] + (index <= 0 ? '/create' : '/updateForce'), { method: 'POST', body: data })
			.then(() => fetchForces((index <= 0 ? crudEnum.create : crudEnum.update)))
			.catch(error => console.log("error: ", error))
			.finally(() => { hideSpinner() })
	})
});

function fetchForces(crud_state) { 
	showSpinner();
	return fetch(window.location.href.split('?')[0] + '/forcesList' + '?event_id=' + window.event.event_id)
		.then(response => response.text())
		.then(data => {
			window.forces = JSON.parse(data).forces;
			presentForces($('#list'), crud_state, window.event, window.forces, window.map);
			$('#event-modal').modal('hide');
		})
		.finally(() => { hideSpinner() })
}

function presentForces(list, crud_state, event, forces) {
	list.html('');
	window.mainMapMarkers.forEach(marker => { marker.setMap(null); })
	window.mainMapMarkers = [];
	forces
		.map(force => new ForceCell(force, crud_state).generateCell())
		.forEach(cell => { $('#list').append(cell); });
	window.mainMapMarkers = forces
		.map(force => new google.maps.Marker({ position: { lat: parseFloat(force.latitude), lng: parseFloat(force.longitude) }, map: window.map }));
}

function formToFormData(formElement) {
	const data = new URLSearchParams();
	for (const pair of new FormData(formElement))
		data.append(pair[0], pair[1]);
	return data;
}

function showModal(event_id, force_id, type, forceName, forceDescription, latitude, longitude) {
	$('#event-modal').on('show.bs.modal', () => {
		$('#event-modal-title').html(`Add ${type.charAt(0).toUpperCase() + type.slice(1)}`);
		$(`input[name="event_id"]`).val(event_id);
		$(`input[name="force_id"]`).val(force_id);
		$('#InputForceName').val(force_id <= 0 ? "" : forceName);
		$('#InputDescription').val(force_id <= 0 ? "" : forceDescription);
		$('#submit_btn').html(force_id <= 0 ? "Add" : "Edit");
		if (typeof google === 'object' && typeof google.maps === 'object') {
			window.formMapMarkers.forEach(marker => { marker.setMap(null); });
			if (force_id > 0) {
				window.formMapMarkers.push(new google.maps.Marker({
					position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
					map: window.map_form,
				}));
				window.map_form.setCenter({ lat: parseFloat(latitude), lng: parseFloat(longitude) });
			} else {
				window.map_form.setCenter({ lat: parseFloat(window.event.latitude), lng: parseFloat(window.event.longitude) })
			}
			window.map_form.setZoom(14);
		}
	})
	$('#event-modal').modal('show');
}