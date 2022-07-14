window.initMap = () => {
	let event = events[0] || { latitude: 31.734394, longitude: 35.204517 }
	
	let mapElement = document.getElementById("map");
	window.map = new google.maps.Map(mapElement, {
		center: {
			lat: parseFloat(event.latitude),
			lng: parseFloat(event.longitude)
		},
		zoom: event[0] == null ? 8 : 14,
		mapTypeId: google.maps.MapTypeId.HYBRID
	});
	window.mainMapMarkers = [];

	let mapFormElement = document.getElementById("map_form");
	window.map_form = new google.maps.Map(mapFormElement, {
		center: {
			lat: parseFloat(event.latitude),
			lng: parseFloat(event.longitude)
		},
		zoom: 10,
	});
	window.formMapMarkers = [];
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

	presentEvents($('#list'), crudEnum.read, window.events);
};

$(document).on('DOMNodeInserted', '.cell', function () {
	$(this).click(function() {
		let index = $(this).attr('index');
		showSpinner();
		window.location.replace(window.location.href.slice(0, -1) + '?id=' + index);
		return false;
	});

	$(this).hover(function () {
		let index = $(this).attr('index');
		let event = window.events.filter(event => event.event_id == index)[0]
		if (typeof google === 'object' && typeof google.maps === 'object')
			window.map.panTo({ lat: parseFloat(event.latitude), lng: parseFloat(event.longitude) });
	}, function () { });

	$('.btn_edit').click(function(e) { 
		e.stopPropagation();
		let index = $(this).parent().parent().attr('index');
		let event = events.filter(event => event.event_id == index)[0]
		let eventName = event.title;
		let eventDescription = event.subtitle;
		let eventType = event.type;
		let latitude = event.latitude
		let longitude = event.longitude
		showModal(index, eventName, eventDescription, eventType, latitude, longitude);
	});

	$('.btn_close').click(function(event) { 
		event.stopPropagation();
		let index = $(this).parent().parent().attr('index');
		let formData = new FormData();
		formData.append('id', index);
		showSpinner();
		fetch(window.location.href + '/remove', { method: 'POST', body: formData })
			.then(() => fetchEvents(crudEnum.delete))
			.catch(error => console.log("error: ", error))
			.finally(() => { showSpinner(); })
	});
});


$(function() {

	$('input[name="daterange"]').daterangepicker({ opens: 'center', locale: { format: 'DD/MM/YYYY' } });

	$('#search-event').on('input', function(e) {
		let text = e.target.value;
		let filteredEvents = window.events.filter(event => event.title.toLowerCase().includes(text.toLowerCase()))
		presentEvents($('#list'), crudEnum.none, filteredEvents, window.map);
	});

	$('#btn_create').click(event => {
		$('#btn_edit, #btn_close').toggleClass('active', false).change();
		showModal(-1);
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

	$('#form-create-event').submit(function(event) {
		event.preventDefault();
		let index = parseInt($(this).parent().attr('index'));
		if (window.formMapMarkers.length > 0) {
			let marker = window.formMapMarkers[0]
			$(`input[name="latitude"]`).val(marker.position.lat());
			$(`input[name="longitude"]`).val(marker.position.lng());
		}
		console.log($("#form-create-event").serializeArray());
		const data = formToFormData(document.getElementById('form-create-event'));
		showSpinner();
		fetch(window.location.href + (index <= 0 ? '/create' : '/update'), { method: 'POST', body: data })
			.then(() => fetchEvents((index <= 0 ? crudEnum.create : crudEnum.update)))
			.catch(error => console.log("error: ", error))
			.finally(() => { hideSpinner() })
	})

});

function fetchEvents(crud_state) { 
	showSpinner();
	return fetch(window.location.href + '/eventsList')
		.then(response => response.text())
		.then(data => {
			window.events = JSON.parse(data).events;
			presentEvents($('#list'), crud_state, window.events, window.map);
			$('#event-modal').modal('hide');
		})
		.finally(() => { hideSpinner(); })
}

function presentEvents(list, crud_state, events) {
	list.html('');
	window.mainMapMarkers.forEach(marker => { marker.setMap(null); })
	window.mainMapMarkers = [];
	events
		.map(event => new EventCell(event, crud_state).generateCell())
		.forEach(cell => { $('#list').append(cell); });
	window.mainMapMarkers = events
		.map(event => new google.maps.Marker({ position: { lat: parseFloat(event.latitude), lng: parseFloat(event.longitude) }, map: window.map }));
}

function formToFormData(formElement) {
	const data = new URLSearchParams();
	for (const pair of new FormData(formElement))
		data.append(pair[0], pair[1]);
	return data;
}

function showModal(index, eventName, eventDescription, eventType, latitude, longitude) {
	$('#event-modal').attr('index', index);
	$('#event-modal').on('show.bs.modal', () => {
		$('#event-modal-title').html(index <= 0 ? "Create Event" : "Edit Event");
		$(`input[name="id"]`).val(index);
		$('#InputEventName').val(index <= 0 ? "" : eventName);
		$('#InputDescription').val(index <= 0 ? "" : eventDescription);
		$('#InputAddress').val(index <= 0 ? "" : `${parseFloat(latitude).toFixed(5)}, ${parseFloat(longitude).toFixed(5)}`);
		$(`input[name="type"][value="${index <= 0 ? "" : eventType}"]`).prop('checked', true);

		if (typeof google === 'object' && typeof google.maps === 'object') {
			window.formMapMarkers.forEach(marker => { marker.setMap(null); });
			if (index > 0) {
				window.formMapMarkers.push(new google.maps.Marker({
					position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
					map: window.map_form,
				}));
				window.map_form.setCenter({ lat: parseFloat(latitude), lng: parseFloat(longitude) });
				window.map_form.setZoom(10);
			} else {
				window.map_form.setCenter({ lat: 31.734394, lng: 35.204517 })
				window.map_form.setZoom(6);
			}
		}

		$('#create_btn').html(index <= 0 ? "Create" : "Edit");
	})
	$('#event-modal').modal('show');
}