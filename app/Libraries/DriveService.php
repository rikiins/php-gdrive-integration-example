<?php

namespace App\Libraries;

use Google\Client;
use Google\Service\Drive;

class DriveService
{
	private $client, $service, $folderId;

	public function __construct()
	{
		putenv('GOOGLE_APPLICATION_CREDENTIALS='. ROOTPATH .'credentials.json');
		
		$this->client = new Client();
		$this->client->useApplicationDefaultCredentials();
		$this->client->addScope(Drive::DRIVE);

		$this->service  = new Drive($this->client);
		$this->folderId = env('drive.folderId');
	}

	public function upload(string $fileName, string $fileData, string $mimeType): array
	{
		try {
			$fileMetadata = new Drive\DriveFile([
				'name' => $fileName,
				'parents' => ["$this->folderId"]
			]);

			$file = $this->service->files->create($fileMetadata, [
				'data' => $fileData,
				'mimeType' => $mimeType,
				'uploadType' => 'multipart',
				'fields' => 'id, name, size, mimeType, createdTime, modifiedTime, thumbnailLink'
			]);

			return [
				'file_id' => $file->id,
				'file_name' => $file->name,
				'file_size' => $file->size,
				'mime_type' => $file->mimeType,
				'created_time' => $file->createdTime,
				'modified_time' => $file->modifiedTime,
				'thumbnail_url' => $file->thumbnailLink ?? 'N/A',
				'embed_url' => 'https://drive.google.com/file/d/' . $file->id . '/preview'
			];

		} catch (\Exception $e) {
			log_message('error', 'DriveService.upload : ' . $e->getMessage());

			return [];
		}
	}

	public function delete(string $fileId): bool
	{
		try {
			$this->service->files->delete($fileId);
			
			return true;
		} catch (\Exception $e) {
			log_message('error', 'DriveService.delete : ' . $e->getMessage());

			return false;
		}
	}

	public function getMetadata($fileId = ''): array
	{
		try {
			$data = [];
			
			if (!empty($fileId)) {
				$data[] = $this->service->files->get($fileId, [
					'fields' => 'id, name, mimeType, size, createdTime, webContentLink, thumbnailLink'
				]);
			}

			if (empty($fileId)) {
				$data = $this->service->files->listFiles([
					'q' => "'{$this->folderId}' in parents",
					'fields' => 'files(id, name, mimeType, size, createdTime, modifiedTime)'
				])->getFiles();
			}

			$metaData = [];

			foreach($data as $file) {
				$metaData[] = [
					'file_id'   => $file->id,
					'file_name' => $file->name,
					'file_size' => $file->size,
					'mime_type' => $file->mimeType,
					'created_time' => $file->createdTime,
					'modified_time' => $file->modifiedTime,
					'thumbnail_url' => $file->thumbnailLink ?? 'N/A',
					'embed_url' => 'https://drive.google.com/file/d/' . $file->id . '/preview'
				];
			}

			if (count($metaData) == 1) {
				return $metaData[0];
			}

			return $metaData;

		} catch (\Exception $e) {
			log_message('error', 'DriveService.getMetadata' . $e->getMessage());

			return [];
		}
	}
}