<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Admin | Login Page</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
		<meta name="color-scheme" content="light dark" />
		<meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
		<meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

		<meta name="title" content="Admin | Login Page" />
		<meta name="author" content="ColorlibHQ" />
		<meta name="description" content="Administrator of AquaTerra" />

		<!-- Fonts and Icons via CDN -->
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
			crossorigin="anonymous"
			media="print"
			onload="this.media='all'"
		/>
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
			crossorigin="anonymous"
		/>
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
			crossorigin="anonymous"
		/>

		<!-- Laravel Vite -->
		@vite(['resources/css/admin/admin.css'])
	</head>
	<body class="login-page bg-body-secondary">
		<div class="login-box">
			<div class="card card-outline card-primary">
				<div class="card-header text-center">
					<a href="{{ url('/') }}" class="link-dark link-offset-2 link-opacity-100 link-opacity-50-hover">
						<img src="{{asset('images/logo/aquaterra-transparent.png')}}" alt="logo" class="img-fluid">	
					</a>
				</div>
				<div class="card-body login-card-body">
					<p class="login-box-msg">Sign in to start your session</p>
					<form action="{{ route('admin.login.submit') }}" method="POST">
						@csrf
						<div class="input-group mb-1">
							<div class="form-floating">
								<input id="loginEmail" type="email" name="email" class="form-control" required autofocus />
								<label for="loginEmail">Email</label>
							</div>
							<div class="input-group-text">
								<span class="bi bi-envelope"></span>
							</div>
						</div>

						<div class="input-group mb-1 pb-3">
							<div class="form-floating">
								<input id="loginPassword" type="password" name="password" class="form-control" required />
								<label for="loginPassword">Password</label>
							</div>
							<div class="input-group-text">
								<span class="bi bi-lock-fill"></span>
							</div>
						</div>

						<div class="row">
							<div class="col-8 d-inline-flex align-items-center">
								<div class="form-check">
								<input class="form-check-input" type="checkbox" name="remember" id="rememberMe" />
								<label class="form-check-label" for="rememberMe"> Remember Me </label>
								</div>
							</div>
							<div class="col-4">
								<div class="d-grid gap-2">
								<button type="submit" class="btn btn-primary">Sign In</button>
								</div>
							</div>
						</div>
					</form>

					<div class="social-auth-links text-center mb-3 d-grid gap-2">
						<p>- OR -</p>
						<a href="#" class="btn btn-danger">
						<i class="bi bi-google me-2"></i> Sign in using Google+
						</a>
					</div>

					<p class="mb-1">
						<a href="">I forgot my password</a>
					</p>
				</div>
			</div>
		</div>

		<!-- Scripts -->
		<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

		<!-- Laravel Vite JS -->
		@vite(['resources/js/admin/admin.js'])

		<!-- Optional: OverlayScrollbars init -->
		<script>
		document.addEventListener('DOMContentLoaded', () => {
			const sidebar = document.querySelector('.sidebar-wrapper');
			if (sidebar && window.innerWidth > 992 && window.OverlayScrollbarsGlobal) {
			OverlayScrollbarsGlobal.OverlayScrollbars(sidebar, {
				scrollbars: {
					theme: 'os-theme-light',
					autoHide: 'leave',
					clickScroll: true,
				},
			});
			}
		});
		</script>
	</body>
</html>