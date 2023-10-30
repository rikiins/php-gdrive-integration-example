<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class File extends BaseController
{
	private $driveCache,
			$drive;

	public function __construct()
	{
		$this->driveCache = Services::driveCacheModel();
		$this->drive = Services::driveService();

		helper('security');
	}

	public function Upload(): string
	{
		$data = [
			'title' => 'Upload File'
		];

		return view('Sites/upload', $data);
	}

	public function UploadFile(): RedirectResponse
	{
		$file = $this->request->getFile('file');

		if (empty($file->getName())) {
			return redirect()->back()
				->with('message', 'File tidak boleh kosong')
				->with('type', 'danger');
		}

		$fileName = sanitize_filename($file->getName());
		$fileData = file_get_contents($file->getTempName());
		$upload	  = $this->drive->upload($fileName, $fileData, htmlspecialchars($file->getMimeType()));

		if (empty($upload)) {
			return redirect()->back()
				->with('message', 'File gagal diupload')
				->with('type', 'danger');
		}
		
		$this->driveCache->saveMetadata($upload);

		return redirect()->back()
			->with('message', 'File berhasil diupload')
			->with('type', 'primary');
	}

	public function DeleteFile(string $fileId): ResponseInterface
	{
		if (empty($fileId)) {
			return $this->response->setJSON([
				'status' => 'failed',
				'message' => 'File ID tidak boleh kosong'
			]);
		}

		$delete = $this->drive->delete($fileId);

		if (!$delete) {
			return $this->response->setJSON([
				'status'  => 'failed',
				'message' => 'File gagal dihapus',
				'file_id' => $fileId,
			]);	
		}

		$this->driveCache->deleteMetadata($fileId);

		return $this->response->setJSON([
			'status'  => 'success',
			'message' => 'File berhasil dihapus',
			'file_id' => $fileId,
		]);
	}
}
