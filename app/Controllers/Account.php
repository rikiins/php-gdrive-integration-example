<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class Account extends BaseController
{
	private $validation, $user;

	public function __construct()
	{
		if (session()->get('is_logged_in')) {
			redirect()->to('Home');
		}

		$this->validation = Services::validation();
		$this->user 	  = Services::userModel();
	}

	public function Login(): string
	{
		helper('form');

		return view('Account/Login', []);
	}

	public function Auth(): mixed
	{
		if (!$this->request->is('post')) {
			return $this->response->setStatusCode(405);
		}

		$data = [
			'username' => (string)$this->request->getPost('username'),
			'password' => (string)$this->request->getPost('password')
		];

		if (!$this->validation->run($data, 'login')) {
			return redirect()->back()->withInput();
		}

		$matchedUser = $this->user->get($data['username']);

		if (empty($matchedUser) || !password_verify($data['password'], $matchedUser['password'])) {
			return redirect()->back()->withInput()->with('message', 'Username atau Password salah');
		}

		$this->session->set('is_logged_in', true);
		$this->session->set('username', $matchedUser['username']);

		return redirect()->to(base_url('Home'));
	}

	public function Logout(): RedirectResponse
	{
		if (!$this->request->is('post')) {
			return $this->response->setStatusCode(405);
		}

		$this->session->destroy();

		return redirect()->to(base_url('Account/Login'));
	}
}
