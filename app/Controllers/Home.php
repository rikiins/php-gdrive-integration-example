<?php

namespace App\Controllers;

use Config\Services;

class Home extends BaseController
{
	private $driveCache;

	public function __construct()
	{
		$this->driveCache = Services::driveCacheModel();
	}

	public function index(): string
	{
		$data = [
			'title' => 'Home',
			'files' => $this->driveCache->get()
		];

		return view('Sites/Index', $data);
	}
}
