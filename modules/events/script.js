$(function() {
	$('input[name="daterange"]')
		.daterangepicker({
			opens: 'center',
			locale: {
				format: 'DD/MM/YYYY'
			}
		});
});

function editButtons() {
	let edit = document.getElementsByClassName('editButton');
	let remove = document.getElementsByClassName('removeButton');
	if (remove[0].hasAttribute("hidden"))
		for (let i = 0; i < edit.length; i++)
			if (edit[i].hasAttribute("hidden")) edit[i].removeAttribute("hidden");
			else edit[i].setAttribute("hidden", "hidden");
}
function removeButtons() {
	let edit = document.getElementsByClassName('editButton');
	let remove = document.getElementsByClassName('removeButton');
	if (edit[0].hasAttribute("hidden"))
		for (let i = 0; i < remove.length; i++)
			if (remove[i].hasAttribute("hidden")) remove[i].removeAttribute("hidden");
			else remove[i].setAttribute("hidden", "hidden");
}

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