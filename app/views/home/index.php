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
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
	<script type="text/javascript" src="<?= $data['js'] ?>"></script>
	<title>Mass Rescue</title>
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
		<div class="container h-100">
			<div class="h-100 col-md-6 d-flex flex-column align-items-center align-items-md-start justify-content-center">
				<h1 class="text-white">Mass Rescue</h1>
				<h2 class="text-white">It's all about Savings lives.</h2>
				<p class="text-white text-center text-md-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum.</p>
			</div>
		</div>
		</div>
		<div id="login" class="h-100">
			<div class="d-table h-100 col-9 col-md-6 col-lg-4 mx-auto">
				<form action="" method="POST" class="d-table-cell align-middle overflow-scroll">
					<div class="d-flex flex-column align-items-center gap-2 p-5 rounded shadow-lg bg-light">
						<h3 class="m-0">Sign In</h3>
						<div class="input-group">
							<label class="input-group-text bg-secondary bi bi-123 text-white" for="id_input"></label>
							<input class="form-control" type="text" id="id_input" name="ID_Number" placeholder="Number ID" required>
						</div>
						<div class="input-group">
							<label class="input-group-text bg-secondary bi bi-key-fill text-white" for="password_input"></label>
							<input class="form-control" type="password" id="password_input" name="Password" placeholder="password" required>
						</div>
						<div class="form-check m-0">
							<label class="form-check-label" for="remember_me_check">Remember Me</label>
							<input class="form-check-input" type="checkbox" id="remember_me_check">
						</div>
						<button type="submit" class="btn btn-outline-secondary text-black">Login</button>
						<p class="text-center text-black m-0">
							<span>Don't have an account?</span>
							<span>Sign Up</span>
						</p>
						<p class="text-center text-black m-0">Forgot your password?</p>
					</div>
				</form>
			</div>
		</div>
    </main>
</body>
</html>