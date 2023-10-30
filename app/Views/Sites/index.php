<?php $this->extend('_Layouts/template') ?>

<?php $this->section('content') ?>
<div class="row">
    <?php if (empty($files)) : ?>
        <h4 class="mt-4 text-center">Belum ada file yang anda upload.</h4>
    <?php endif ?>

    <?php foreach($files as $file) : ?>
        <div class="col-lg-4 mb-4 d-flex align-items-stretch" style="width: 30rem;">
            <div class="card w-100">
                <div class="position-absolute px-3 py-2 text-danger" style="background-color: rgba(0,0,0,0.7);">
                    <div class="delete-file" data-id="<?= $file['file_id'] ?>" data-file-name="<?= $file['file_name'] ?>" style="cursor: pointer;">X</div>
                </div>
                <div class="text-center">
                    <iframe src="<?= $file['embed_url'] ?>" frameborder="0"></iframe>
                </div>
                <hr>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $file['file_name'] ?></h5>
                    <p class="card-text">Type : <?= $file['mime_type'] ?></p>
                    <p class="card-text">Size : <?= round($file['file_size'] / 1024**2, 2) ?> MB</p>
                    <p class="card-text">Uploaded at : <?= strftime('%e %B %T', strtotime($file['created_time'])) ?> UTC</p>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<script>
    document.querySelectorAll('.delete-file').forEach(btn => {
        btn.addEventListener('click', function() {
            const fileId = this.attributes['data-id'].value;
            const fileName = this.attributes['data-file-name'].value;
            const fileCard = this.parentElement.parentElement;

            if (confirm(`Yakin ingin menghapus file ${fileName} ?`)) {
                fetch(`<?= base_url('File/DeleteFile') ?>/${fileId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status == 'success') {
                        alert(`File ${fileName} berhasil dihapus`);
                        location.reload();
                    }
                })
            }
        })
    });
</script>
<?php $this->endSection() ?>
