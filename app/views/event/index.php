<?php $event = json_decode($data['event'], true)["event"]; ?>
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
	<nav class="navbar navbar-dark bg-dark" style="padding: 0 env(safe-area-inset-right) 0 env(safe-area-inset-left);">
		<div class="container-fluid">
			<div class="navbar-brand d-flex align-items-center">
				<button
					class="navbar-toggler" type="button"
					data-bs-toggle="offcanvas" data-bs-target="#offcanvas-main"
					aria-controls="offcanvas-main" area-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
				</button>
				<a class="d-flex align-items-center nav-link text-light mx-3 my-2 p-0" href="../events/index.html">
					<img class="bg-white rounded-circle" src="<?php echo IMAGES_PATH . 'profile_picture.jpg' ?>" width="74" height="74" alt="">
				</a>
				<ol class="breadcrumb mb-0">
					<li class="breadcrumb-item"><a class="text-light" href="<?php echo BASE_URL . 'events' ?>">Events</a></li>
					<li class="breadcrumb-item"><?php echo $event["title"]; ?></li>
				</ol>
			</div>
		</div>
		<div class="offcanvas offcanvas-start rounded-start bg-dark shadow-lg overflow-hidden" id="offcanvas-main" tabindex="-1" style="border-radius: 2.5rem; width: 350px;">
			<div class="offcanvas-header flex-column gap-1">
				<img class="bg-white rounded-circle" src="<?php echo IMAGES_PATH . 'profile_picture.jpg' ?>" width="120" height="120" alt="">
				<span class="offcanvas-title text-light fs-3 fw-bolder">Ariella Katzir</span>
				<span class="text-light fs-5">205374333</span>
			</div>
			<div class="offcanvas-body d-flex flex-column justify-content-between gap-5 p-0">
				<div class="d-flex flex-column gap-2">
					<a class="nav-link p-4 fs-3 bg-secondary d-flex align-items-center gap-2" href="./events/index.php">
						<svg width="40" height="40" fill="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path d="M19 4h-1V3c0-.55-.45-1-1-1s-1 .45-1 1v1H8V3c0-.55-.45-1-1-1s-1 .45-1 1v1H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 15c0 .55-.45 1-1 1H6c-.55 0-1-.45-1-1V9h14v10zM7 11h2v2H7zm4 0h2v2h-2zm4 0h2v2h-2z"></path>
						</svg>
						<span class="text-light fs-4">Events</span>
					</a>
				</div>
				<div class="d-flex flex-column gap-2">
					<a class="nav-link p-4 fs-3 bg-secondary d-flex align-items-center gap-2" href="../../index.html">
						<svg width="40" height="40" fill="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.79 16.29c.39.39 1.02.39 1.41 0l3.59-3.59c.39-.39.39-1.02 0-1.41L12.2 7.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L12.67 11H4c-.55 0-1 .45-1 1s.45 1 1 1h8.67l-1.88 1.88c-.39.39-.38 1.03 0 1.41zM19 3H5c-1.11 0-2 .9-2 2v3c0 .55.45 1 1 1s1-.45 1-1V6c0-.55.45-1 1-1h12c.55 0 1 .45 1 1v12c0 .55-.45 1-1 1H6c-.55 0-1-.45-1-1v-2c0-.55-.45-1-1-1s-1 .45-1 1v3c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"></path>
						</svg>
						<span class="text-light fs-4">Log out</span>
					</a>
				</div>
			</div>
		</div>
	</nav>
	<main style="height: calc(100vh - 100px);">
		<div class="row flex-column h-100 g-0">
			<div class="col col-lg-6 h-100 p-0 order-1 order-lg-0 d-flex flex-column">
				<div id="filter" class="shadow p-2">
					<div class="d-flex flex-column flex-lg-row gap-2 gap-lg-0">
						<div class="col-12 col-lg-6 d-flex align-items-center">
							<input class="form-control" type="text" placeholder="Search">
						</div>
						<div class="col-12 col-lg-6 d-flex align-items-center justify-content-evenly">
							<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_firefighter" style="height: 38px; width: 38px">
								<img src="<?php echo ICONS_PATH . 'event-forces/firefighter.png' ?>" alt="" width="24px" height="24px">
							</a>
							<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_medic" style="height: 38px; width: 38px">
								<img src="<?php echo ICONS_PATH . 'event-forces/medic.png' ?>" alt="" width="24px" height="24px">
							</a>
							<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_police" style="height: 38px; width: 38px">
								<img src="<?php echo ICONS_PATH . 'event-forces/police.png' ?>" alt="" width="24px" height="24px">
							</a>
							<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_drone" style="height: 38px; width: 38px">
								<img src="<?php echo ICONS_PATH . 'event-forces/drone.png' ?>" alt="" width="24px" height="24px">
							</a>
							<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_block" style="height: 38px; width: 38px">
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
</body>

</html>