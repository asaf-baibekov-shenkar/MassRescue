$(function() {
	$('input[name="daterange"]')
		.daterangepicker({
			opens: 'center',
			locale: {
				format: 'DD/MM/YYYY'
			}
		});
});