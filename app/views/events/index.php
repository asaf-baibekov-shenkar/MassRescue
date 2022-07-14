<?php $user = json_decode($data['user'], true)["user"]; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<title>Mass Rescue - Events</title>

	<!-- https://www.daterangepicker.com/ -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

	<link rel="stylesheet" type="text/css" href="<?= $data['css'] ?>" />
	<script type="text/javascript" src="<?= $data['consts-js'] ?>"></script>
	<script type="text/javascript" src="<?= $data['events-cell-js'] ?>"></script>
	<script type="text/javascript" src="<?= $data['js'] ?>"></script>
	<script type="text/javascript" src="<?= $data['spinner-js'] ?>"></script>
	<style>
		.pac-container {
			z-index: 2000 !important;
		}
	</style>
	<script>
		window.events = <?php print_r(json_encode(json_decode($data['events'], true)["events"])) ?>;
	</script>
	<!-- google maps api -->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAU6K6LHaENovtEo203MCMtuL8Q_XeuIJE&libraries=places&callback=initMap"></script>
</head>

<body>
	<?php include 'nav.php' ?>
	<main style="height: calc(100vh - 100px);">
		<div class="row flex-column h-100 g-0">
			<div class="col col-lg-6 h-100 p-0 order-1 order-lg-0 d-flex flex-column">
				<div id="filter" class="shadow p-2">
					<div class="d-flex flex-column flex-lg-row gap-2 gap-lg-0">
						<div class="col-12 col-lg-3 d-flex align-items-center">
							<input id="search-event" class="form-control" type="text" placeholder="Search">
						</div>
						<div class="col-12 col-lg-9 d-flex align-items-center justify-content-evenly">
							<div class="col-8 col-lg-7">
								<input class="form-control text-center" type="text" name="daterange" value="26/04/2022 - 18/05/2022" readonly="readonly" />
							</div>
							<?php if ($user["role"] == "admin") : ?>
								<div class="col-4 col-lg-4 h-100 d-flex align-items-center justify-content-evenly">
									<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_create" style="height: 38px; width: 38px">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="black" xmlns="http://www.w3.org/2000/svg">
											<path d="M22.8947 3.31987H20.6849V1.08449C20.6849 0.486915 20.1759 0 19.5789 0C18.971 0 18.4741 0.486915 18.4741 1.08449V3.31987H16.2522C15.6553 3.31987 15.1689 3.82348 15.1579 4.42105C15.1579 5.0297 15.6443 5.52632 16.2522 5.52632H18.4741V7.75743C18.4741 8.35501 18.971 8.85299 19.5789 8.84192C20.1759 8.84192 20.6849 8.35501 20.6849 7.75743V5.52632L22.8947 5.53312C23.4917 5.53312 24.0011 5.01863 24.0011 4.42105C24.0011 3.82348 23.4917 3.31987 22.8947 3.31987Z"/>
											<path d="M19.5789 11.0526C18.9711 11.0526 18.4737 11.55 18.4737 12.1579V19C18.4737 19.6079 17.9763 20 17.3684 20H6.31579C5.70789 20 5.21053 19.6079 5.21053 19V6.63158C5.21053 6.02368 5.70789 5.52632 6.31579 5.52632H11.8421C12.45 5.52632 12.9474 5.02895 12.9474 4.42105C12.9474 3.81316 12.45 3.31579 11.8421 3.31579H5.21053C3.99474 3.31579 3 4.31053 3 5.52632V20C3 21.2158 3.99474 22 5.21053 22H18.4737C19.6895 22 20.6842 21.2158 20.6842 20V12.1579C20.6842 11.55 20.1868 11.0526 19.5789 11.0526Z"/>
											<path d="M15.1579 8.48H8.52632C7.91842 8.48 7.42105 8.97211 7.42105 9.58C7.42105 10.1879 7.91842 10.69 8.52632 10.69H15.1579C15.7658 10.69 16.2632 10.1879 16.2632 9.58C16.2632 8.97211 15.7658 8.48 15.1579 8.48Z"/>
											<path d="M15.1579 11.79H8.52632C7.91842 11.79 7.42105 12.2921 7.42105 12.9C7.42105 13.5079 7.91842 14 8.52632 14H15.1579C15.7658 14 16.2632 13.5079 16.2632 12.9C16.2632 12.2921 15.7658 11.79 15.1579 11.79Z"/>
											<path d="M15.1579 15.1H8.52632C7.91842 15.1 7.42105 15.5921 7.42105 16.2C7.42105 16.8079 7.91842 17.31 8.52632 17.31H15.1579C15.7658 17.31 16.2632 16.8079 16.2632 16.2C16.2632 15.5921 15.7658 15.1 15.1579 15.1Z"/>
										</svg>
									</a>
									<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_edit" style="height: 38px; width: 38px">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="black" xmlns="http://www.w3.org/2000/svg">
											<path d="M2 18.0672V21.4445C2 21.7556 2.24441 22 2.55548 22H5.93279C6.07721 22 6.22164 21.9445 6.32162 21.8334L18.4533 9.71282L14.2872 5.54673L2.16664 17.6673C2.05555 17.7784 2 17.9117 2 18.0672ZM21.675 6.49104C22.1083 6.05777 22.1083 5.35787 21.675 4.92459L19.0754 2.32495C18.6421 1.89168 17.9422 1.89168 17.509 2.32495L15.4759 4.35801L19.642 8.52409L21.675 6.49104Z"/>
										</svg>
									</a>
									<a class="btn btn-light border border-1 border-dark p-0 d-flex justify-content-center align-items-center" id="btn_close" style="height: 38px; width: 38px">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="black" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 2C6.47 2 2 6.47 2 12C2 17.53 6.47 22 12 22C17.53 22 22 17.53 22 12C22 6.47 17.53 2 12 2ZM16.3 16.3C15.91 16.69 15.28 16.69 14.89 16.3L12 13.41L9.11 16.3C8.72 16.69 8.09 16.69 7.7 16.3C7.31 15.91 7.31 15.28 7.7 14.89L10.59 12L7.7 9.11C7.31 8.72 7.31 8.09 7.7 7.7C8.09 7.31 8.72 7.31 9.11 7.7L12 10.59L14.89 7.7C15.28 7.31 15.91 7.31 16.3 7.7C16.69 8.09 16.69 8.72 16.3 9.11L13.41 12L16.3 14.89C16.68 15.27 16.68 15.91 16.3 16.3Z"/>
										</svg>
									</a>
								</div>
							<?php endif; ?>
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
	<div id="spinner-view" class="d-none justify-content-center align-items-center position-absolute top-0 start-0 vh-100 vw-100 bg-dark bg-opacity-75" style="z-index: 3000;">
		<div class="spinner-border text-light" style="width: 4rem; height: 4rem;" role="status">
			<span class="sr-only"></span>
		</div>
	</div>
</body>

</html>