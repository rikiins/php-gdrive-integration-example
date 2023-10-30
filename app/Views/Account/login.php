<!DOCTYPE html>

<html>
<head>
	<meta name="viewport" content="width=device-width">
	<title>Login | Simple Drive</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<style>
		body {
			background-color: #3a3a3a;
		}
	</style>
</head>
<body>
	<section class="vh-100">
		<div class="container py-5 h-100">
			<div class="row d-flex align-items-center justify-content-center h-100">

				<div class="col-md-8 col-lg-7 col-xl-6">
					<img src="<?= base_url('assets/img/cloud-server.png') ?>" class="img-fluid" alt="storage_icon">
				</div>

				<div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 p-4 rounded" style="background-color: #f9f4f4;">
					<h4 class="text-center mb-5">Login Simple Drive</h4>

					<form action="<?= base_url('Account/Auth') ?>" method="post">
						<?= csrf_field() ?>
						<div class="mb-4">
							<strong class="text-danger"><?= validation_show_error('username') ?></strong>
							<input type="text" name="username" value="<?= old('username') ?>" id="username" class="form-control form-control-lg" autofocus required>
							<label class="form-label" for="username">Username</label>
							<p id="username-msg" class="text-danger"></p>
						</div>

						<div class="mb-4">
							<strong class="text-danger"><?= validation_show_error('password') ?></strong>
							<input type="Password" name="password" id="password" class="form-control form-control-lg" required>
							<label class="form-label" for="password">Password</label>
							<p id="password-msg" class="text-danger"></p>
						</div>

						<div class="col d-flex mb-4">
							<div class="form-check">
								<input class="form-check-input" name="remember_me" type="checkbox" id="remember-me">
								<label class="form-check-label" for="remember-me"> Remember me </label>
							</div>
						</div>

						<?php if (session()->getFlashdata('message')) : ?>
						<div class="col d-flex mb-4">
							<strong class="text-danger"><?= session()->getFlashdata('message') ?></strong>
						</div>
						<?php endif ?>
						<div class="col-12">
							<button type="submit" style="width: 100%;" class="btn btn-primary btn-lg">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
