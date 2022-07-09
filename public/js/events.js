window.initMap = () => {
	let AzrieliLocation = { lat: 32.07458646100024, lng: 34.79189151265392 }
	let mapElement = document.getElementById("map");
	let map = new google.maps.Map(mapElement, {
		center: AzrieliLocation,
		zoom: 16,
	});
	const marker = new google.maps.Marker({
		position: AzrieliLocation,
		map: map,
	});
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
		if (index == -1) {
			
		} else {

		}
		$('#event-modal').modal('hide');
	})
	$('.cell').click(function() {
		let index = $(this).attr('index');
		window.location.replace(window.location.href.slice(0, -1) + '?id=' + index);
		return false;
	});
	$('.btn_close').click(function(event) { 
		event.stopPropagation();
		let index = $(this).parent().parent().attr('index');
		$('.btn_close').addClass("d-flex").removeClass("d-none");
	});

	$('.btn_edit').click(function(event) { 
		event.stopPropagation();
		let index = $(this).parent().parent().attr('index');
		let eventName = events[index - 1].title;
		let eventDescription = events[index - 1].subtitle;
		
		let eventType = (() => {
			switch (events[index - 1].type) {
				case "earthquake": return 1;
				case "fire": return 2;
				default: return 0;
			}
		})();
		let latitude = events[index - 1].latitude
		let longitude = events[index - 1].longitude
		showModal(index, eventName, eventDescription, eventType, latitude, longitude);
	});
});



function showModal(index, eventName, eventDescription, eventType, latitude, longitude) {
	$('#event-modal').attr('index', index);
	$('#event-modal').on('show.bs.modal', () => {
		$('#event-modal-title').html(index <= 0 ? "Create Event" : "Edit Event");
		$('#InputEventName').val(index <= 0 ? "" : eventName);
		$('#InputDescription').val(index <= 0 ? "" : eventDescription);
		$(`input[name="event_type"][value="0"]`).prop('checked', false);
		$(`input[name="event_type"][value="1"]`).prop('checked', false);
		$(`input[name="event_type"][value="2"]`).prop('checked', false);
		$(`input[name="event_type"][value="${index <= 0 ? 0 : eventType}"]`).prop('checked', true); 
		$('#create_btn').html(index <= 0 ? "Create" : "Edit");
	})
	$('#event-modal').modal('show');
}