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
		$('#event-modal-title').html("Create Event");
		$('#event-modal').on('show.bs.modal', () => {
			$('#event-modal-title').html("Create Event");
			$('#create_btn').html("Create");
			$('#InputEventName').val('');
			$('#InputDescription').val('');
			$(`input[name="event_type"][value="0"]`).prop('checked', true);
		})
		$('#event-modal').attr('index', -1);
		$('#event-modal').modal('show');
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
		$('#event-modal').on('show.bs.modal', () => {
		})
		$('#event-modal').attr('index', index);
		$('#event-modal').modal('show');
	});
});