window.initMap = () => {
	let mapElement = document.getElementById("map");

	let first_force = forces[0] || { latitude: event.latitude, longitude: event.longitude }
	window.map = new google.maps.Map(mapElement, {
		center: {
			lat: parseFloat((first_force).latitude),
			lng: parseFloat((first_force).longitude)
		},
		zoom: first_force == null ? 26 : 14,
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
};

$(function() {
	$('#filter .btn').click(function(event) {
		let type = $(this).attr("id").substring(4);
		type = type.charAt(0).toUpperCase() + type.slice(1);
		$('#event-modal').on('show.bs.modal', () => {
			$('#event-modal-title').html(`Add ${type}`);
			$('#create_btn').html("Submit");
			$('#InputEventName').val('');
			$('#InputDescription').val('');
			$(`input[name="event_type"][value="0"]`).prop('checked', true);
		})
		$('#event-modal').modal('show');
	});
	$('.cell').hover(function () {
		let index = $(this).attr('index');
		let force = forces.filter(force => force.force_id == index)[0]
		if (typeof google === 'object' && typeof google.maps === 'object')
			window.map.panTo({ lat: parseFloat(force.latitude), lng: parseFloat(force.longitude) });
	}, function () { });
});