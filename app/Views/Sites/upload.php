<?php $this->extend('_Layouts/template') ?>

<?php $this->section('content') ?>

<div class="d-flex justify-content-center">
	<div class="wrapper" style="width: 40vw;">
		<?php if (session()->has('message')) : ?>
			<div class="alert alert-<?= session()->getFlashdata('type') ?> alert-dismissible fade show" role="alert">
				<strong>Pesan :</strong> <?= session()->getFlashdata('message') ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php endif ?>
		
		<div class="card">
			<h5 class="card-header">Upload File</h5>
			<div class="card-body">
				<form action="<?= base_url('File/UploadFile') ?>" enctype="multipart/form-data" method="post">
					<div>
						<input class="form-control form-control-md" id="file-input" name="file" type="file">
					</div>
					<hr>
	
					<h5 class="card-title">Pilih file yang ingin diupload</h5>
					<p class="card-text">Rincian akan muncul di bawah ini setelah memilih file.</p>
					<div id="file-detail"></div>
					
					<hr>
					<button type="submit" class="btn btn-outline-primary">Upload sekarang</a>
				</form>
			</div>
		</div>
	</div>
</div>


<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script>
	const fileInput = document.getElementById('file-input');
	
	fileInput.addEventListener('change', readFile);

	function readFile() {
		const fileContent = document.getElementById('file-detail');
		const file = fileInput.files[0];

		if (fileContent.hasChildNodes()) {
			fileContent.textContent = '';
		}

		if (file) {
			const reader = new FileReader();

			reader.onload = function(event) {
				const fileName = document.createElement('p');
				const fileSize = document.createElement('p');
				
				fileName.textContent = `File name : ${file.name}`;

				if (file.size < 1024**2) {
					fileSize.textContent = `File size : ${Math.round(file.size / 1024)} KB`;
				} else {
					fileSize.textContent = `File size : ${Math.round((file.size / 1024**2) * 100) / 100} MB`;
				}

				fileContent.appendChild(fileName);
				fileContent.appendChild(fileSize);
			};

			reader.readAsText(file);
			console.log(file.name);
		} else {
			fileContent.textContent = "No file selected.";
		}
	}
</script>
<?php $this->endSection() ?>