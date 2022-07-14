<?php $event = json_decode($data['event'], true)["event"]; ?>
<?php $user = json_decode($data['user'], true)["user"]; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<title>Mass Rescue - Event</title>

	<!-- https://www.daterangepicker.com/ -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

	<link rel="stylesheet" type="text/css" href="<?= $data['css'] ?>" />
	<script type="text/javascript" src="<?= $data['js'] ?>"></script>
	<script type="text/javascript" src="<?= $data['force-cell-js'] ?>"></script>
	<script type="text/javascript" src="<?= $data['consts-js'] ?>"></script>
	<script type="text/javascript" src="<?= $data['spinner-js'] ?>"></script>
	<script>
		window.event = <?php print_r(json_encode(json_decode($data['event'], true)["event"])) ?>;
		window.forces = <?php print_r(json_encode(json_decode($data['forces'], true)["forces"])) ?>;
	</script>
	<style>
		.pac-container {
			z-index: 2000 !important;
		}
	</style>
	<!-- google maps api -->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAU6K6LHaENovtEo203MCMtuL8Q_XeuIJE&libraries=places&callback=initMap"></script>
</head>

<body>
	<?php include 'nav.php' ?>
	<main>
		<div class="row flex-column h-100 g-0">
			<div class="col col-lg-6 h-100 p-0 order-1 order-lg-0 d-flex flex-column">
				<div id="filter" class="shadow p-2">
					<div class="d-flex flex-column flex-lg-row gap-2 gap-lg-0">
						<div class="col-12 col-lg-6 d-flex align-items-center">
							<input id="search-event" class="form-control" type="text" placeholder="Search">
						</div>
						<div class="col-12 col-lg-6 d-flex align-items-center justify-content-evenly">
							<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_firefighter">
								<img src="<?php echo ICONS_PATH . 'event-forces/firefighter.png' ?>" alt="" width="24px" height="24px">
							</a>
							<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_medic">
								<img src="<?php echo ICONS_PATH . 'event-forces/medic.png' ?>" alt="" width="24px" height="24px">
							</a>
							<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_police">
								<img src="<?php echo ICONS_PATH . 'event-forces/police.png' ?>" alt="" width="24px" height="24px">
							</a>
							<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_drone">
								<img src="<?php echo ICONS_PATH . 'event-forces/drone.png' ?>" alt="" width="24px" height="24px">
							</a>
							<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_block">
								<img src="<?php echo ICONS_PATH . 'event-forces/block.png' ?>" alt="" width="24px" height="24px">
							</a>
						</div>
					</div>
				</div>
				<div id="list" class="overflow-auto flex-grow-1">
				</div>
			</div>
			<div class="col col-lg-6 h-100 p-0">
				<div id="map" class="w-100 h-100"></div>
			</div>
		</div>
	</main>
	<?php include 'modal.php' ?>
	<div id="spinner-view" class="d-none justify-content-center align-items-center position-absolute top-0 start-0 vh-100 vw-100 bg-dark bg-opacity-75">
		<div class="spinner-border text-light" role="status">
			<span class="sr-only"></span>
		</div>
	</div>
</body>

</html>