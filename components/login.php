<div class="d-table h-100 col-9 col-md-6 col-lg-4 mx-auto">
	<form action="./events/echo.php" method="get" class="d-table-cell align-middle overflow-scroll">
		<div class="d-flex flex-column align-items-center gap-2 p-5 rounded shadow-lg bg-light">
			<h3 class="m-0">Sign In</h3>
			<div class="input-group">
				<label class="input-group-text bg-secondary bi bi-person-plus-fill text-white" for="username_input"></label>
				<input class="form-control" type="text" id="username_input" name="Username" placeholder="Username" required>
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