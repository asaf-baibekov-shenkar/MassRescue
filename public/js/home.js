$(function() {
	var toggle = true;
	$('#login').hide();
	$('#login_button').click(function (e) { 
		e.preventDefault();
		$(toggle ? '#intro' : '#login').hide();
		$(!toggle ? '#intro' : '#login').show();
		toggle = !toggle;
	});
})