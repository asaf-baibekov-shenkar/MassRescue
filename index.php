<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<!-- google font insert style -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">

	<title>Mass Rescue</title>
	<script src="./script.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark" style="padding: 0 env(safe-area-inset-right) 0 env(safe-area-inset-left);">
		<div class="container-fluid">
			<div class="navbar-brand">
				<a class="d-flex align-items-center nav-link text-light fs-2" href="./index.html">
					<img class="bg-white rounded-circle me-3 py-1" src="./images/logo/logo.svg" width="74" height="74" alt="">
					<span style="font-family: Audiowide, sans-serif;">Mass Rescue</span>
				</a>
			</div>
			<button
				class="navbar-toggler" type="button"
				data-bs-toggle="collapse" data-bs-target="#main-nav"
				area-controls="main-nav" area-expended="false" area-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end" id="main-nav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link text-center px-4 fs-5" href="#">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-center px-4 fs-5" href="#">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-center px-4 fs-5" href="#">Contact Us</a>
					</li>
					<li class="nav-item mb-md-0 mb-3">
						<a id="login_button" class="nav-link btn btn-secondary px-4 fs-5" href="#">Login</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
    <main class="overflow-scroll" style="height: calc(100vh - 100px); background-color: var(--bs-gray-800);">
		<div id="intro" class="h-100">
			<?php include('components/intro.php') ?>
		</div>
		<div id="login" class="h-100">
			<?php include('components/login.php') ?>
		</div>
    </main>
</body>
</html>