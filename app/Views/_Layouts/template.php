<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <title><?= $title ?> | Simple Drive</title>
	<style>
		body {
			padding-left: 2rem;
			padding-right: 2rem;
			padding-top: 4.5rem;
		}
	</style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">SimpleDrive!</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav me-auto mb-2 mb-md-0">
				<li class="nav-item">
					<a class="nav-link <?= uri_string() == 'Home' ? 'active' : '' ?>" href="<?= base_url('Home') ?>">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= uri_string() == 'File/Upload' ? 'active' : '' ?>" href="<?= base_url('File/Upload') ?>">Upload</a>
				</li>
			</ul>

			<form action="<?= base_url('Account/Logout') ?>" method="post" class="d-flex mr-4">
				<?= csrf_field() ?>
				<button class="btn btn-outline-danger" type="submit">Logout</button>
			</form>
		</div>
	</div>
</nav>

<?= $this->renderSection('content'); ?>

</body>
</html>