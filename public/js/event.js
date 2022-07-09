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
});