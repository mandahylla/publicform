<?php
		namespace App\Controllers;
		use App\Controllers\BaseController;
		class register extends BaseController
		{
			public function index()
			{
				$data = array_merge($this->data, [
					'title'         => '/register'
				]);
				return view('register', $data);
			}
		}
		