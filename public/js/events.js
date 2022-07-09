window.initMap = () => {
	let mapElement = document.getElementById("map");
	window.map = new google.maps.Map(mapElement, {
		center: {
			lat: parseFloat(events[0].latitude),
			lng: parseFloat(events[0].longitude)
		},
		zoom: 9,
	});
	window.mainMapMarkers = events.map(event => {
		return new google.maps.Marker({
			position: {
				lat: parseFloat(event.latitude),
				lng: parseFloat(event.longitude)
			},
			map: window.map,
		});
	});

	let mapFormElement = document.getElementById("map_form");
	window.map_form = new google.maps.Map(mapFormElement, {
		center: {
			lat: parseFloat(events[0].latitude),
			lng: parseFloat(events[0].longitude)
		},
		zoom: 10,
	});
	window.formMapMarkers = [];
};

$(function() {
	$('input[name="daterange"]').daterangepicker({ opens: 'center', locale: { format: 'DD/MM/YYYY' } });

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
		console.log($("#form-create-event").serializeArray());
		$.ajax({
			type: "POST",
			url: window.location.href + (index <= 0 ? '/create' : '/update'),
			data: $("#form-create-event").serializeArray(),
			success: function (data) {
				location.reload()
			},
			error: function (data) {
				alert("error");
			}
		});
	})
	$('.cell').click(function() {
		let index = $(this).attr('index');
		window.location.replace(window.location.href.slice(0, -1) + '?id=' + index);
		return false;
	});

	$('.cell').hover(function () {
		let index = $(this).attr('index');
		let event = events.filter(event => event.event_id == index)[0]
		if (typeof google === 'object' && typeof google.maps === 'object')
			window.map.panTo({ lat: parseFloat(event.latitude), lng: parseFloat(event.longitude) });
	}, function () { });
	$('.btn_close').click(function(event) { 
		event.stopPropagation();
		let index = $(this).parent().parent().attr('index');
		$('.btn_close').addClass("d-flex").removeClass("d-none");
	});

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
});



function showModal(index, eventName, eventDescription, eventType, latitude, longitude) {
	$('#event-modal').attr('index', index);
	$('#event-modal').on('show.bs.modal', () => {
		$('#event-modal-title').html(index <= 0 ? "Create Event" : "Edit Event");
		$(`input[name="id"]`).val(index);
		$('#InputEventName').val(index <= 0 ? "" : eventName);
		$('#InputDescription').val(index <= 0 ? "" : eventDescription);
		$(`input[name="type"][value="${index <= 0 ? "" : eventType}"]`).prop('checked', true);

		if (typeof google === 'object' && typeof google.maps === 'object') {
			window.formMapMarkers.forEach(marker => { marker.setMap(null); });
			if (index > 0) {
				window.formMapMarkers.push(new google.maps.Marker({
					position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
					map: window.map_form,
				}));
				window.map_form.setCenter({ lat: parseFloat(latitude), lng: parseFloat(longitude) });
			} else {
				window.map_form.setCenter({ lat: 31.734394, lng: 35.204517 })
				window.map_form.setZoom(6);
			}
		}

		$('#create_btn').html(index <= 0 ? "Create" : "Edit");
	})
	$('#event-modal').modal('show');
}